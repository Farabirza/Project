<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Book;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;

class UsersController extends Controller
{
    public function register()
    {
        return view('users.register',[
            'page_title' => 'Registration Page'
        ]);
    }
    public function store(Request $request){
        $validateData = $request->validate([
            "email" => 'required|unique:users|max:24',
            "password" => 'required|min:6|max:24',
            "first_name" => 'required|max:12',
            "last_name" => 'required|max:12',
            "gender" => 'required',
            "occupation" => 'required'
        ]);
        $first_name = ucfirst($request['first_name']);
        $last_name = ucfirst($request['last_name']);
        $password = Hash::make($request['password']);
        $email = $request['email'].$request['email2'];
        User::create([
            "email" => $email,
            "password" => $password,
            "role" => 'user'
        ]);
        $user_id = User::where('email',$email)->first()->id;
        Profile::create([
            "first_name" => $first_name,
            "last_name" => $last_name,
            "gender" => $request['gender'],
            "occupation" => $request['occupation'],
            "user_id" => $user_id
        ]);
        if($request['occupation'] == 'student'){
            Profile::where('user_id', $user_id)->update([
                "grade" => $request['grade']
            ]);
        }
        return redirect('/login')->with('success', 'Successfully registered!');
    }
    public function login()
    {
        return view('users.login',[
            'page_title' => 'Login Page'
        ]);
    }
    public function authenticate(Request $request)
    {
        $email = $request['email1'].$request['email2'];
        // $credentials = $request->validate([
        //     'email' => 'required|email:dns',
        //     'password' => ['required']
        // ]);
        if($request['remember'] == 'true'){
            $remember = true;
        } else {
            $remember = false;
        }
        // dd('Login success');
        if(Auth::attempt([
            'email' => $email, 'password' => $request['password']
        ], $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/books');
        }
        return back()->with('error', 'Username or password incorrect!');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
    public function record_visit($book_id)
    {
        $url = Book::where('id',$book_id)->first()->url;
        Record::create([
            "user_email" => Auth::user()->email,
            "user_id" => Auth::user()->id,
            "book_id" => $book_id,
            "action" => 'visit'
        ]);
        return redirect()->away($url);
    }
    public function dashboard()
    {
        $users = User::with('profile')->get();
        $count_users = $users->count();
        // $count_users_new = User::whereDate('created_at', '>=', date('Y-m-d'))->count();
        // $count_users_thisMonth = User::whereMonth('created_at', '>=', date('m'))->count();
        $count_student = Profile::where('occupation','student')->count();
        $count_teacher = Profile::where('occupation','teacher')->count();
        $count_management = Profile::where('occupation','management')->count();
        $count_staff = Profile::where('occupation','staff')->count();
        $books = Book::with('user')->get();
        return view('dashboard.index', [
            'page_title' => 'Admin Dashboard',
            'users' => $users, 'count_users' => $count_users,
            'count_teacher' => $count_teacher, 'count_student' => $count_student, 'count_management' => $count_management, 'count_staff' => $count_staff,
            'books' => $books
        ]);
    }
    public function toggle_role($id)
    {
        $user = User::where('id',$id);
        $current_role = $user->first()->role;
        if($current_role == 'user'){
            $update = $user->update([
                "role" => 'admin'
            ]);
        } else {
            $update = $user->update([
                "role" => 'user'
            ]);
        }
        return redirect('/dashboard')->with('success', "User's role has changed!");
    }
    public function delete_user($id)
    {
        $user = User::where('id',$id)->delete();
        $profile = Profile::where('user_id',$id)->delete();
        return redirect('/dashboard')->with('success', 'User deleted successfully!');
    }
}
