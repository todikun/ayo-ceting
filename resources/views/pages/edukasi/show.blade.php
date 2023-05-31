@extends('layouts.main')

@section('title', 'Detail Edukasi')

@section('content-header')
<h1>Detail Edukasi</h1>
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item">Dashboard</div>
    <div class="breadcrumb-item">Edukasi</div>
    <div class="breadcrumb-item active"><a href="#">Detail Edukasi</a></div>
</div>
@endsection

@section('content-body')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="#">

                    <div class="form-group row mb-4">
                        <div class="col-12">
                            <label class="col-form-label">Judul</label>
                            <input type="text" class="form-control" name="judul" value="{{$edukasi['judul']}}" required>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-12">
                            <label class="col-form-label">Isi</label>
                            <textarea class="summernote" name="isi" required>{{$edukasi['isi']}}</textarea>
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
        toolbar: []
    });
</script>
@endpush