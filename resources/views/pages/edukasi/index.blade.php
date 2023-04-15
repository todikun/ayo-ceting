@extends('layouts.main')

@section('title', 'Edukasi')

@section('content')

<div class="pagetitle">
    <h1>Edukasi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">Edukasi</li>
            <li class="breadcrumb-item active">Edukasi</li>
        </ol>
    </nav>
</div>

{{-- <div class="col mb-2">
    <a href="{{route('edukasi.create')}}" class="btn btn-primary"><i class="ri-add-line"></i></a>
</div> --}}

<div class="card">
    <div class="card-body">
        <div class="col d-flex mb-3">
            <div class="col">
                <h5 class="card-title">{{$puskesmas}}</h5>
            </div>
            <div class="row justify-content-end mt-3">
                <div class="col">
                    <a href="{{route('edukasi.create')}}" class="btn btn-sm btn-primary"><i class="ri-add-line"></i> Tambah</a>
                </div>
            </div>
        </div>
        <!-- Table with hoverable rows -->
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">JUDUL</th>
                    <th scope="col">DIBUAT PADA</th>
                    <th scope="col">_ACTION</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($edukasi as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item['judul']}}</td>
                    <td>
                        {{\Carbon\Carbon::parse($item['created_at'])->locale('id')->translatedFormat('j F Y')}}
                    </td>
                    <td>
                        <a href="{{route('edukasi.show', $item['slug'])}}" class="btn btn-sm btn-edit btn-secondary"
                            title="Detail">
                            <i class="ri-eye-line"></i>
                        </a>

                        <a href="{{route('edukasi.edit', $item['slug'])}}" class="btn btn-sm btn-edit btn-warning"
                            title="Edit">
                            <i class="ri-edit-box-line"></i>
                        </a>

                        <form action="{{route('edukasi.destroy', $item['id'])}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Apakah data ini akan dihapus?')" title="Delete">
                                <i class="ri-eraser-line"></i>
                            </button>
                        </form>
                    </td>
                <tr>
                    @empty
                    <td colspan="50%" class="text-center">No data</td>
                    @endforelse
            </tbody>
        </table>
        <!-- End Table with hoverable rows -->

    </div>
</div>

@endsection