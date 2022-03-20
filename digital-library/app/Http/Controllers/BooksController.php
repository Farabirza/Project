<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use DB;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::latest()->filter(request(['keyword']))->paginate(8);
        $most_visited_ids = DB::table('records')
                            ->select('book_id')
                            ->groupBy('book_id')
                            ->orderByDesc(\DB::raw('count(book_id)'))
                            ->limit(5)
                            ->get();
        $most_visited = [];
        $items = [];
        foreach($most_visited_ids as $book_id){
            $items = Book::where('id', $book_id->book_id)->first();
            $most_visited[] = $items;
        }
        return view('books.index', [
            'books' => $books, 'keyword' => request('keyword'), 'most_visited' => $most_visited,
            'page_title' => 'Book Index'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create', [
            'page_title' => 'Submit New Book'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => 'required|max:45',
            "authors" => 'required',
            "url" => 'required'
        ]);
        $imageName = time().'.'.$request['cover']->extension();  
        $image = $request['cover']->move(public_path('img/covers'), $imageName);
        $title = $request['title'];
        $books = Book::create([
            "title" => $title,
            "authors" => $request['authors'],
            "publisher" => $request['publisher'],
            "publication_year" => $request['publication_year'],
            "isbn" => $request['isbn'],
            "cover" => $imageName,
            "description" => $request['description'],
            "user_id" => Auth::user()->id,
            "url" => $request['url']
        ]);
        $records = Record::create([
            "user_email" => Auth::user()->email,
            "user_id" => Auth::user()->id,
            "book_id" => Book::where('title',$title)->first()->id,
            "action" => 'add'
        ]);
        return redirect('/books')->with('success', 'Book added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $books = Book::where('id',$id)->first();
        // $books = Book::find($id);
        // $records = Record::with(['book' => function ($query) {
        //     global $id;
        //     $query->where('book_id', '==', $id);
        // }])->get();
        // $users = [];
        $records = Record::where('book_id',$id)->get();
        // foreach($records as $record){
        //     $user = User::where('id',$record->user_id)->first()->email;
        //     $users[] = $user;
        // }
        return view('books.show', compact('books'), [
            'page_title' => 'Book Details', 'records' => $records
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $books = Book::where('id',$id)->first();
        return view('books.edit', compact('books'), [
            'page_title' => 'Edit Details'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $book = Book::where('id', $id);
        if(isset($_POST['cover'])){
            $imageName = time().'.'.$request['cover']->extension();
            if($imageName!==$book->first()->cover){
                unlink(public_path('img/covers/'.$book->first()->cover));
                $book->update(['cover' => $imageName]);
                $image = $request['cover']->move(public_path('img/covers'), $imageName);
            }
        }
        $update = Book::where('id', $id)->update([
            "title" => $request['title'],
            "authors" => $request['authors'],
            "publisher" => $request['publisher'],
            "publication_year" => $request['publication_year'],
            "isbn" => $request['isbn'],
            "description" => $request['description'],
            "upload_date" => $request['upload_date'],
            "user_id" => $request['user_id'],
            "url" => $request['url']
        ]);
        $records = Record::create([
            "user_email" => Auth::user()->email,
            "user_id" => Auth::user()->id,
            "book_id" => $id,
            "action" => 'edit'
        ]);
        return redirect('/books')->with('success', 'Book updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $records = Record::create([
            "user_email" => Auth::user()->email,
            "user_id" => Auth::user()->id,
            "book_id" => $id,
            "action" => 'remove'
        ]);
        unlink(public_path('img/covers/'.Book::where('id',$id)->first()->cover));
        $books = Book::where('id',$id)->delete();
        return redirect('/books')->with('success', 'Book deleted successfully!');
    }
}
