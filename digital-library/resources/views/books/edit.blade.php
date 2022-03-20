@extends('layouts.master')

@push('css-styles')
<style>
.form-group label { color: var(--second-color); font-size: 11pt; font-weight: 500; }
</style>
@endpush

@section('content')

<!-- section-create -->
<div id="section-create" class="ptb-60 prl-20">
	<div class="container">
		<div class="row content">
            <div class="page-subtitle col-md-12 mb-20">
                <h3>Edit Book Details</h3>
            </div>

        </div> <!-- row end -->
        <div class="row content vertical-center justify-content-center">

            <div class="col-md-4 prl-20">
                <form role="form" action="/books/{{ $books->id }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="1">
                <input type="hidden" name="old_cover" value="{{$books->cover}}">
                <input type="hidden" name="upload_date" value="<?= date('Y-m-d'); ?>">
                <img id="img_preview" class="mb-40 box-shadow-1" src="{{ asset('img/covers/'.$books->cover) }}">
                <input class="form-control form-input mb-20" type="file" name="cover" id="input_img">
                <img id="img_preview" src="">
            </div> <!-- Form left end -->

            <div class="col-md-6 prl-20">
                <!-- form start -->
                    <p class="mb-20"><?= date("l, d-M-Y"); ?></p>
                    <div class="form-group"> <!-- title -->
                        <label>Title</label>
                        <input name="title" type="name" class="form-control" placeholder="Title" value="{{$books->title}}">
                        @error('title')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group"> <!-- authors -->
                        <label>Authors</label>
                        <input name="authors" type="text" class="form-control" placeholder="Authors" value="{{$books->authors}}">
                        @error('author')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group"> <!-- publisher -->
                        <label>Publisher</label>
                        <input name="publisher" type="text" class="form-control" placeholder="Publisher" value="{{$books->publisher}}">
                        @error('publisher')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group"> <!-- publication year -->
                        <label>Publication Year</label>
                        <input name="publication_year" type="text" class="form-control" placeholder="Publication Year" value="{{$books->publication_year}}">
                        @error('publisher')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group"> <!-- ISBN -->
                        <label>ISBN</label>
                        <input name="isbn" type="text" class="form-control" placeholder="ISBN" value="{{$books->isbn}}">
                        @error('publisher')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group"> <!-- description -->
                        <label>Description</label>
                        <textarea name="description" class="form-control" placeholder="Description">{{$books->description}}</textarea>
                        @error('description')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-40"> <!-- url -->
                        <label>URL</label>
                        <input name="url" type="text" class="form-control" placeholder="Url" value="{{$books->url}}">
                        @error('url')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class='bx bx-edit-alt'></i> Update</button>
                    </div>

                </form> <!-- form end -->
            </div> <!-- Form right end -->

        </div> <!-- row end -->

		</div>
	</div>
</div>
<!-- end of section-create -->

@endsection

@push('scripts')
<script type="text/javascript">

$(document).ready(function (e) {
    $('#input_img').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => { 
            $('#img_preview').attr('src', e.target.result); 
        }
        reader.readAsDataURL(this.files[0]); 
    }); 
});
</script>
@endpush