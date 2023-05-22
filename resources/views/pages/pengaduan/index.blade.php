@extends('layouts.main')

@section('title', 'Pengajuan')

@section('content-header')
<h1>Pengaduan</h1>
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item">Dashboard</div>
    <div class="breadcrumb-item active"><a href="#">Pengaduan</a></div>
</div>
@endsection

@section('content-body')
<div class="row">
    <div class="col-12">
        <div class="card-body bg-white rounded">
            <div class="section-title">List Pengaduan</div>
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
                                <span class="badge badge-light">
                                    {{$item['status']}}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">

                                    <a href="{{route('pengaduan.show', $item['id'])}}"
                                        data-approve="{{route('approve.update', $item['id'])}}"
                                        data-reject="{{route('reject.update', $item['id'])}}"
                                        class="btn btn-sm btn-detail btn-dark" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{route('approve.update', $item['id'])}}" class="btn btn-sm btn-success"
                                        title="Approve"
                                        onclick="return confirm('Apakah anda yakin approve pengajuan ini?')">
                                        <i class="fas fa-check"></i>
                                    </a>

                                    <a href="{{route('reject.update', $item['id'])}}" class="btn btn-sm btn-warning"
                                        title="Reject"
                                        onclick="return confirm('Apakah anda yakin reject pengajuan ini?')">
                                        <i class="fas fa-times"></i>
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

@push('script')
<script>
    $('.btn-detail').on('click', function (e) {
        e.preventDefault();
        const url = $(this).attr('href');
        const tombolApproveReject = `
            <a href="${this.dataset.approve}" class="btn btn-sm btn-success" title="Approve"
                onclick="return confirm('Apakah anda yakin approve pengajuan ini?')">
                Approve
            </a>
            
            <a href="${this.dataset.reject}" class="btn btn-sm btn-warning"
                title="Reject" onclick="return confirm('Apakah anda yakin reject pengajuan ini?')">
                Reject
            </a>
        `;

        $.ajax({
            url: url,
            dataType: 'HTML',
            method: 'GET',
            success: function (result) {
                $('#modal-form').find('.modal-title').html('Detail Laporan');
                $('#modal-form').find('.modal-body').html(result);
                $('#modal-form').find('.modal-footer').html(tombolApproveReject);
                $('#modal-form').modal('show');
            },
            error: function (err) {
                console.log(err);
            },
        });
    });
</script>
@endpush