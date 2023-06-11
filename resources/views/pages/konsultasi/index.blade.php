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

                    </tbody>
                    {{-- <tbody>
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
                                <span class="badge badge-success">
                                    active
                                </span>
                            </td>
                            <td>

                                <a href="{{route('konsultasi.message', ['pengaduanId'=>$item['id'], 'userIdPengaduan'=>$item['user_id']])}}"
                                    class="btn btn-primary" title="Konsultasi">
                                    <i class="fas fa-comments"></i>
                                </a>

                            </td>
                        <tr>
                            @empty
                            <td colspan="50%" class="text-center">No data</td>
                            @endforelse
                    </tbody> --}}
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function(){
            let table = $('#myTable').DataTable({
                "autoWidth": false,
                "processing": true,
                "serverSide": true,
                "orderable": true,
                "ajax":{
                    "url": "{{route('konsultasi.index')}}",
                    "dataType": "json",
                    "type": "GET",
                    "data":function(d) {
                        d._token = "{{csrf_token()}}"
                    },
                },
                "columns": [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'user' },
                    { data: 'category_pengajuan' },
                    { data: 'isi_pengajuan' },
                    { data: 'created_at' },
                    { data: '_status' },
                    { data: '_action' }
                ]
            });
        });
</script>
@endpush