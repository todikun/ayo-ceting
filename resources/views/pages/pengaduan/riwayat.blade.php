@extends('layouts.main')

@section('title', 'Riwayat Pengaduan')

@section('content-header')
<h1>Riwayat Pengaduan</h1>
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item">Dashboard</div>
    <div class="breadcrumb-item active"><a href="#">Riwayat Pengaduan</a></div>
</div>
@endsection

@section('content-body')
<div class="row">
    <div class="col-12">
        <div class="card-body bg-white rounded">
            <div class="section-title">List Riwayat Pengaduan</div>
            <div class="table-responsive">
                <table id="myTable" class="table">
                    <thead>
                        <tr>
                            <th width="1%">#</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">KATEGORI</th>
                            <th scope="col">ISI PENGADUAN</th>
                            <th scope="col">TANGGAL</th>
                            <th scope="col">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengajuan as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item['user']['name']}}</td>
                            <td>{{$item['category_pengajuan']['category_name']}}</td>
                            <td>{{$item['isi_pengajuan']}}</td>
                            <td>
                                {{\Carbon\Carbon::parse($item['created_at'])->locale('id')->translatedFormat('j F Y')}}
                            </td>
                            <td>
                                <span class="badge badge-success">{{$item['status']}}</span>
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