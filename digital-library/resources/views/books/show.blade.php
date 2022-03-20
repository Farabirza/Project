@extends('layouts.master')

@push('css-styles')
<style>
.book-attr span { color: var(--second-color); font-size: 11pt; font-weight: 500; }
p { font-size: 12pt; }
</style>
@endpush

@section('content')

<!-- Section-details -->
<section id="section-details">
    <div class="container">
        <div class="row content justify-content-center vertical-center mb-60">
            <div class="page-subtitle col-md-12 mb-20">
                <h3>{{$page_title}}</h3>
            </div>
            <div class="col-md-5 prl-20">
                <img class="box-shadow-1 portfolio-lightbox" data-gallery="portfolioGallery" src="{{ asset('img/covers/'.$books->cover) }}">
            </div>
            <div class="col-md-5 prl-20 book-attr">
                <h3 class="mb-20">{{$books->title}}</h3>
                <span>Authors</span>
                <p>{{$books->authors}}</p>
                <span>Publisher</span>
                <p>{{$books->publisher}}</p>
                <span>Publication Year</span>
                <p>{{$books->publication_year}}</p>
                <span>ISBN</span>
                <p>{{$books->isbn}}</p>
                <span>Description</span>
                <p>{{$books->isbn}}</p>
                <span>Uploaded by</span>
                <p><b>{{$books->user->email}}</b> at {{ date('l, Y-m-d', strtotime($books->created_at)) }}</p>
                @auth
                <div class="dflex mb-15">
                    <a class="btn warn-visit btn-small btn-outline-primary mr-8" href="/redirect/{{ $books->id }}"><i class='bx bx-book-reader' ></i> Read</a>
                    @if(Auth::user()->role == 'admin')
                    <a class="btn btn-small btn-outline-success mr-8" href="/books/{{$books->id}}/edit"><i class='bx bx-edit-alt'></i> Edit</a>
                    <form action="/books/{{ $books->id }}" method="POST" class="btn warn-delete padd-0">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-small btn-outline-danger mr-8" role="submit" type="submit"><i class='bx bx-trash'></i> Delete</button>
                    </form>
                    @endif
                </div>
                @endauth
            </div>
        </div> <!-- end row -->
        <div class="row content justify-content-center">
            <div class="col-md-12">
                <table id="visitorTable" class="table">
                    <thead>
                        <tr>
                            <th>Visitor</th>
                            <th>Visited at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($records as $record)
                        <tr>
                            <td>{{ $record->user->email }}</td>
                            <td>{{ date('l, Y-m-d | h:i A', strtotime($record->created_at)) }}</td>
                            @empty
                            <td colspan="2" class="align-center">No activity on this book yet</td>
                        </tr> 
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div> <!-- end row -->
    </div>
</section>
<!-- Section-details end -->

@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
  $('#visitorTable').DataTable();
}
</script>
@endpush