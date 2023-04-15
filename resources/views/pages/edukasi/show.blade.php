@extends('layouts.main')

@section('title', 'Detail Edukasi')

@section('content')

<div class="pagetitle">
    <h1>Detail Edukasi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Edukasi</li>
            <li class="breadcrumb-item">Edukasi</li>
            <li class="breadcrumb-item active">Detail Edukasi</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{$edukasi['judul']}}
        </h5>
        {!! $edukasi['isi'] !!}
    </div>
    <div class="card-footer">
        <span class="text-sm">
            {{\Carbon\Carbon::parse($edukasi['created_at'])->locale('id')->translatedFormat('j F Y')}}
        </span>
    </div>
</div>


@endsection