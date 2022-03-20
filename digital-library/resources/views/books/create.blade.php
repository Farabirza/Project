@extends('layouts.master')

@section('content')

<!-- section-create -->
<div id="section-create" class="ptb-60 prl-20">
	<div class="container">
		<div class="row content">
            <div class="page-subtitle col-md-12 mb-20">
                <h3>Upload a New Book</h3>
            </div>

        </div> <!-- row end -->
        <div class="row content vertical-center justify-content-center">

            <div class="col-md-4 prl-20">
                <form role="form" action="/books" enctype="multipart/form-data" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="1">
                <img id="img_preview" class="mb-40 box-shadow-1" src="{{ asset('img/covers/sample.jpg') }}">
                <input class="form-control form-input mb-20" type="file" name="cover" id="input_img">
                <img id="img_preview" src="">
            </div> <!-- Form left end -->

            <div class="col-md-6 prl-20">
                <!-- form start -->
                    <p class="mb-20">{{ date("l, d M Y") }}</p>
                    <div class="form-group"> <!-- title -->
                        <input name="title" type="name" class="form-control" placeholder="Title" value="{{ old('title', '') }}">
                        @error('title')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group"> <!-- authors -->
                        <input name="authors" type="text" class="form-control" placeholder="Authors" value="{{ old('authors', '') }}">
                        @error('author')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group"> <!-- publisher -->
                        <input name="publisher" type="text" class="form-control" placeholder="Publisher" value="{{ old('publisher', '') }}">
                        @error('publisher')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group"> <!-- publication year -->
                        <input name="publication_year" type="text" class="form-control" placeholder="Publication Year" value="{{ old('publication_year', '') }}">
                        @error('publisher')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group"> <!-- ISBN -->
                        <input name="isbn" type="text" class="form-control" placeholder="ISBN" value="{{ old('isbn', '') }}">
                        @error('publisher')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group"> <!-- description -->
                        <textarea name="description" class="form-control" placeholder="Description">{{ old('description', '') }}</textarea>
                        @error('description')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-40"> <!-- url -->
                        <input name="url" type="text" class="form-control" placeholder="URL" value="{{ old('Url', '') }}">
                        @error('url')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-40"> <!-- url -->
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class='bx bx-file' ></i> Submit</button>
                    </div>

                </form> <!-- form end -->
            </div> <!-- Form right end -->
        </div> <!-- row end -->

		</div>
	</div>
</div>
<!-- end of section-create -->

<section id="section-guide">
    <div class="container">
        
        <div class="row">
                <div class="page-subtitle col-md-12 mb-20">
                    <h3>Aturan dan Petunjuk Submit Buku</h3>
                </div>
                <div class="col-md-12" data-aos="fade-right" data-aos-duration="1200">
                    <ol>
                        <h5><b>Upload file buku</b></h5>
                        <li>Isi data judul, penulis, penerbit, dan deskripsi singkat dari konten buku pada form diatas.</li>
                        <li>Klik tombol <mark>Upload the book's file here</mark> untuk menuju ke link drive perpustakaan.</li>
                        <li>Silahkan upload file PDF buku pada drive tersebut sesuai dengan kategorinya. Apabila anda tidak yakin, anda dapat mengupload file tersebut pada folder bernama <mark>- Silahkan upload Buku baru disini!</mark></li>
                        <li>Setelah file berhasil ter-upload, klik kanan pada file dan pilih menu <mark>Share</mark>.</li>
                        <li>Secara <i>default</i>, semua orang dengan email sekolah <span class="text-muted">( @pribadidepok.sch.id )</span> dapat mengakses buku tersebut di <i>Google Drive</i>. Hanya orang-orang dengan status <i>Editor</i> yang dapat mengedit, menghapus, dan mendownload file tersebut.</li>
                        <p class="ptb-10 align-center"><img src="{{ asset('img/materials/guide-1.jpg') }}" class="mb-15" style="max-height:480px;"> <img src="{{ asset('img/materials/guide-3.jpeg') }}" style="max-height:480px;"></p>
                        <li>Pada jendela yang muncul, nama-nama yang tercantum adalah <b>orang-orang yang dapat mengontrol</b> file buku tersebut. Pastikan tidak ada nama dari orang yang tidak berwewenang pada list tersebut.</li>
                        <li>Untuk mencegah agar orang lain <b>tidak dapat men-download</b> file buku tersebut, klik tombol <i>share with people settings</i> <span class="text-muted">( bagian kanan atas )</span> dan hilangkan centang pada opsi kedua.</li>
                        <p class="ptb-10 align-center"><img src="{{ asset('img/materials/guide-4.jpeg') }}" style="max-height:480px;"></p>
                        <li>Pada bagian bawah jendela, klik tombol <mark>Copy link</mark> untuk menyalin alamat dari buku yang telah ter-upload.</li>
                        <li><b>Catatan</b> : apabila ukuran file PDF terlalu besar (lebih  dari 50 MB) atau terdapat lebih dari satu file, kami sarankan untuk membuat folder khusus, masukan file buku di folder tersebut, kemudian copy link dari folder tersebut ketimbang filenya langsung.</li>
                        <li>Kembali ke halaman ini dan masukan alamat yang telah disalin pada kotak bertuliskan <mark>Put the book's shared link here</mark>.</li>
                        <h5><b>Upload cover buku</b></h5>
                        <li>Ketentuan cover buku adalah sebagai berikut :</li>
                            <ul>
                                <li>Format file cover yang dianjurkan adalah <i>.jpg</i> atau <i>.jpeg</i>.</li>
                                <li>Ukuran file cover tidak boleh lebih dari 1 MB.</li>
                                <li>Dimensi yang dianjurkan adalah 548 x 726 px.</li>
                                <li>Berikut adalah platform yang dapat digunakan untuk mengurangi ukuran file cover : <a href="https://compressjpeg.com/" target="_blank">https://compressjpeg.com/</a> dan ini adalah platform yang dapat dimanfaatkan untuk mengatur dimensi cover : <a href="https://www.iloveimg.com/crop-image" target="_blank">https://www.iloveimg.com/crop-image</a>.</li>
                            </ul>
                        <li>Untuk meng-upload file gambar cover, klik pada tombol <mark>Browse...</mark> dan pilih file yang akan di-upload.</li>
                        <li>Pastikan kembali semua data telah sesuai, setelah itu klik tombol <mark>Submit &raquo;</mark> untuk mengirim data buku.</li>
                    </ol>
                </div>
            </div>
        </div> <!-- row end -->

</section>

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