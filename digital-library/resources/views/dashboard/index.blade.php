<!-- Check wether this user is an admin -->
@if(Auth::user()->role != 'admin')
<?php header("Location: /books"); die(); ?>
@endif
<!-- Check wether this user is an admin -->

@extends('layouts.master')

@push('css-styles')
<style>
body { overflow-x: auto; }
label { margin-bottom: 10px; }
.card-count { text-align: center; margin: 10px; }
.card-count .purecounter { font-size: 42pt; color: #3085d6; }
@media (max-width: 768px) {
    .media-hide {
        display: none;
    }
    table { font-size: 11pt; }
    .card-count, .card-count .purecounter { font-size: 11pt; }
}
</style>
@endpush

@section('content')

<!-- section-users -->
<section id="section-users">
    <div class="container">
        <div class="row content justify-content-center">
            <div class="page-subtitle col-md-12 mb-20">
                <h3>Users Data</h3>
            </div>
 
            <!-- user table -->
            <div class="col-md-12 mb-40">
                <table id="usersTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="media-hide">Name</th>
                            <th>Email</th>
                            <th class="media-hide">Occupation</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="media-hide">@if ($user->profile) {{ $user->profile->first_name }} {{ $user->profile->last_name }} @endif</td>
                            <td>{{ $user->email }}</td>
                            <td class="media-hide">
                                @if($user->profile) {{ $user->profile->occupation }} @endif
                                @if($user->profile->occupation == 'student') Grade {{ $user->profile->grade }} @endif
                            </td>
                            <td>{{ $user->role }}</td>
                            <td class="d-flex">
                                @if( $user->role === 'admin')
                                <a href="/role/{{$user->id}}" class="btn warn-role btn-primary btn-sm mr-4"><i class='bx bx-user'></i> Change role</a>
                                @else
                                <a href="/role/{{$user->id}}" class="btn warn-role btn-outline-primary btn-sm mr-4"><i class='bx bx-user'></i> Change role</a>
                                @endif
                                <a href="#" class="btn btn-success btn-sm mr-4"><i class='bx bx-file' ></i> Profile</a>
                                @if( $user->role === 'user')
                                <a href="/delete_user/{{$user->id}}" class="btn warn-delete_user btn-danger btn-sm mr-4"><i class='bx bx-trash' ></i> Delete</a>
                                @endif
                            </td>
                        </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- user table end -->

            <!-- user data -->
            <div class="col-md-12 users_count d-flex"> <!-- based on occupation -->
                <div class="card card-count col">
                    <div class="card-header">Student</div>
                    <div class="card-body align-center">
                        <p><span data-purecounter-start="0" data-purecounter-end="{{$count_student}}" class="purecounter">0</span></p>
                    </div>
                </div>
                <div class="card card-count col">
                    <div class="card-header">Teacher</div>
                    <div class="card-body align-center">
                        <p><span data-purecounter-start="0" data-purecounter-end="{{$count_teacher}}" class="purecounter">0</span></p>
                    </div>
                </div>
                <div class="card card-count col">
                    <div class="card-header">Staff</div>
                    <div class="card-body align-center">
                        <p><span data-purecounter-start="0" data-purecounter-end="{{$count_staff}}" class="purecounter">0</span></p>
                    </div>
                </div>
            </div>
            <!-- user data end -->

        </div>
    </div>
</section>
<!-- section-users end -->

<!-- section-books -->
<section id="section-books" class="bg-light">
    <div class="container">
        <div class="row content justify-content-center">
            <div class="page-subtitle col-md-12 mb-20">
                <h3>Books Data</h3>
            </div>
            <div class="col-md-12">
                <table id="booksTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th class="media-hide">Uploader</th>
                            <th class="media-hide">Uploaded at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td class="media-hide">{{ $book->user->email }}</td>
                            <td class="media-hide">{{ date('l, Y-m-d', strtotime($book->created_at)) }}</td>
                            <td class="d-flex">
                                <a href="/books/{{ $book->id }}" class="btn btn-success btn-sm mr-4" target="_blank"><i class='bx bx-file' ></i> Details</a>
                            </td>
                        </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- section-books end -->

@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
  $('#usersTable').DataTable();
  $('#booksTable').DataTable();
  $('.nav-link').removeClass('active');
  $('#link-dashboard').addClass('active');
  if($('#main').css('width') <= '768px') {
    // $(".users_count").removeClass('d-flex');
  }
});
</script>
@endpush