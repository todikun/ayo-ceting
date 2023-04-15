@extends('layouts.main')

@section('title', 'Edit Edukasi')

@section('content')

<div class="pagetitle">
    <h1>Edit Edukasi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Edukasi</li>
            <li class="breadcrumb-item">Edukasi</li>
            <li class="breadcrumb-item active">Edit Edukasi</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">

        <form action="{{route('edukasi.update', $edukasi['id'])}}" method="POST" class="row g-3 mt-1">
            @csrf
            @method('PUT')

            <div class="col-12">
                <label class="form-label">Judul</label>
                <input type="text" name="judul" class="form-control" value="{{$edukasi['judul']}}">
            </div>

            <div class="col-12">
                <label class="form-label">Isi</label>
                <textarea name="isi" cols="10" rows="50" class="form-control summernote">{{$edukasi['isi']}}</textarea>
            </div>
            <div class="d-grid gap-2 mt-3">
                <button class="btn btn-primary" type="submit">Update</button>
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