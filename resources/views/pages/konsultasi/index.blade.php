@extends('layouts.main')

@section('title', 'Konsultasi')

@section('content-header')
<h1>Konsultasi</h1>
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item">Dashboard</div>
    <div class="breadcrumb-item active"><a href="#">Konsultasi</a></div>
</div>
@endsection

@section('content-body')
<div class="row">
    <div class="col-12">
        <div class="card-body bg-white rounded">
            <div class="section-title">List Konsultasi</div>
            <div class="table-responsive">
                <table id="myTable" class="table">
                    <thead>
                        <tr>
                            <th width="1%">#</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">KATEGORI</th>
                            <th scope="col">ISI PENGAJUAN</th>
                            <th scope="col">TANGGAL</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">_ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengajuan as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item['user']['name']}}</td>
                            <td>{{$item['category']['category_name']}}</td>
                            <td>{{$item['isi_pengajuan']}}</td>
                            <td>
                                {{\Carbon\Carbon::parse($item['created_at'])->locale('id')->translatedFormat('j F Y')}}
                            </td>
                            <td>
                                <span class="badge badge-success">
                                    {{-- {{$item['status']}} --}}
                                    active
                                </span>
                            </td>
                            <td>

                                <a href="{{route('konsultasi.message', $item['id'])}}" class="btn btn-primary"
                                    title="Konsultasi">
                                    <i class="fas fa-comments"></i>
                                </a>

                            </td>
                        <tr>
                            @empty
                            <td colspan="50%" class="text-center">No data</td>
                            @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection