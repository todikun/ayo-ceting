@extends('layouts.main')

@section('title', 'Riwayat Konsultasi')

@section('content-header')
<h1>Riwayat Konsultasi</h1>
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item">Dashboard</div>
    <div class="breadcrumb-item active"><a href="#">Riwayat Konsultasi</a></div>
</div>
@endsection

@section('content-body')
<div class="row">
    <div class="col-12">
        <div class="card-body bg-white rounded">
            <div class="section-title">List Riwayat Konsultasi</div>
            <div class="table-responsive">
                <table id="myTable" class="table">
                    <thead>
                        <tr>
                            <th width="1%">#</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">KATEGORI</th>
                            <th scope="col">ISI PENGAJUAN</th>
                            <th scope="col">TANGGAL</th>
                            <th scope="col">_ACTION</th>
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
                                <div class="btn-group">

                                    <a tabindex="0" class="btn btn-sm btn-danger" role="button" data-toggle="popover"
                                        data-trigger="focus" title="" data-placement="right" data-content="
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore, labore."
                                        data-original-title="Detail Vonis Awal">Detail Vonis Awal</a>

                                    <a href="{{route('konsultasi.riwayat.detail', $item['id'])}}"
                                        class="btn btn-sm btn-secondary btn-dark" title="Konsultasi">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
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