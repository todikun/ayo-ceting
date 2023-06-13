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
<div class="row d-flex">
    <div class="col-12 col-sm-6 col-lg-6">
        <div class="card">
            <div class="card-header">
                Detail Pengaduan
            </div>
            <div class="card-body">
                <form action="#">

                    <div class="row mb-3">
                        <div class="badge bg-warning text-white">{{$pengajuan['category_pengajuan']['category_name']}}
                        </div>
                    </div>
                    <div class="row d-flex mb-3">
                        <div class="col-4">
                            Tanggal
                        </div>

                        <div>
                            : {{\Carbon\Carbon::parse($pengajuan['created_at'])->locale('id')->translatedFormat('j F
                            Y')}}
                        </div>
                    </div>

                    <div class="row d-flex mb-3">
                        <div class="col-4">
                            Pelapor
                        </div>

                        <div>
                            : {{$pengajuan['user']['name']}}
                        </div>
                    </div>

                    <div class="row d-flex mb-3">
                        <div class="col-4">
                            No.Hp
                        </div>

                        <div>
                            : {{$pengajuan['user']['phone_number']}}
                        </div>
                    </div>

                    <div class="row d-flex mb-3">
                        <div class="col-4">
                            Alamat lengkap
                        </div>

                        <div>
                            : {{$pengajuan['alamat_lengkap']}}
                        </div>
                    </div>

                    <div class="row d-flex mb-3">
                        <div class="col-4">
                            Isi pengaduan
                        </div>
                        <div>
                            : {{$pengajuan['isi_pengajuan']}}
                        </div>
                    </div>

                    <div class="row d-flex my-3">
                        <div class="col-4">
                            Vonis Awal
                        </div>
                        <div>
                            <h5 class="fw-bold">: {{$pengajuan['vonis_awal']['vonis'] ?? 'null null null null'}}</h5>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-6">
        <div class="card chat-box" id="mychatbox">
            <div class="card-header">
                <div class="col">
                    <h4>{{$userNamePengaduan}}</h4>
                </div>
            </div>
            <div class="card-body chat-content">
                <div class="d-flex pt-5 justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection