@extends('layouts.main')

@section('title', 'Tambah Edukasi')

@section('content')

<div class="pagetitle">
    <h1>Tambah Edukasi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Edukasi</li>
            <li class="breadcrumb-item">Edukasi</li>
            <li class="breadcrumb-item active">Tambah Edukasi</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">

        <form action="{{route('edukasi.store')}}" method="POST" class="row g-3 mt-1">
            @csrf

            <div class="col-12">
                <label class="form-label">Judul</label>
                <input type="text" name="judul" class="form-control">
            </div>

            <div class="col-12">
                <label class="form-label">Isi</label>
                <textarea name="isi" cols="10" rows="50" class="form-control summernote"></textarea>
            </div>
            <div class="d-grid gap-2 mt-3">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>

    </div>

    <script>
        $('.summernote').summernote({
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                // ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                // ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>

</div>


@endsection