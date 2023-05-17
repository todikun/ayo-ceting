@extends('layouts.main')

@section('title', 'Tambah Edukasi')

@section('content-header')
<h1>Tambah Edukasi</h1>
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item">Dashboard</div>
    <div class="breadcrumb-item">Edukasi</div>
    <div class="breadcrumb-item active"><a href="#">Tambah Edukasi</a></div>
</div>
@endsection

@section('content-body')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('edukasi.store')}}" method="POST">
                    @csrf

                    <div class="form-group row mb-4">
                        <div class="col-12">
                            <label class="col-form-label">Judul</label>
                            <input type="text" class="form-control" name="judul" required>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-12">
                            <label class="col-form-label">Isi</label>
                            <textarea class="summernote" name="isi" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-4 mt-0">
                        <label class="col-form-label col-12"></label>
                        <div class="col-12">
                            <button class="btn btn-primary col-12" type="submit">Publish</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css">
@endpush

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
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
@endpush