@extends('layouts.main')

@section('title', 'Edukasi')

@section('content-header')
<h1>Edukasi</h1>
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item">Dashboard</div>
    <div class="breadcrumb-item active"><a href="#">Edukasi</a></div>
</div>
@endsection

@section('content-body')

<div class="row">
    <div class="col-12">
        <div class="card-body bg-white rounded">
            <div class="d-flex">
                <div class="section-title">List Edukasi </div>

                <div class="col pt-4">

                    <div class="float-right">

                        <a href="{{route('edukasi.create')}}" class="mr-1 btn btn-sm btn-primary" title="Tambah">
                            Tambah
                        </a>
                        <a href="#" id="btnRefreshTable" class="btn btn-sm btn-info" title="Refresh"> Refresh
                            <i class="fas fa-refresh"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">

                <table class="table " id="myTable">
                    <thead>
                        <tr>
                            <th width="1%">#</th>
                            <th scope="col">JUDUL</th>
                            <th scope="col">DIBUAT PADA</th>
                            <th scope="col">_ACTION</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')

<script>
    $(document).ready(function(){
        $('#myTable').DataTable({
			"autoWidth": false,
            "processing": true,
            "serverSide": true,
			"orderable": true,
            "ajax":{
				"url": "{{route('edukasi.index')}}",
				"dataType": "json",
				"type": "GET",
				"data":function(d) {
					d._token = "{{csrf_token()}}"
				},
			},
            "columns": [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'judul' },
                { data: 'created_at' },
                { data: '_action' }
            ]
        });
        
    });

    $('#btnRefreshTable').on('click', function(e) {
        e.preventDefault();
        var table = $('#myTable').DataTable();
        table.ajax.reload();
    })

    // event button detail
    $('.btn-detail').on('click', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');

        $.ajax({
            url: url,
            dataType: 'HTML',
            method: 'GET',
            success: function (result) {
                $('#modal-form').find('.modal-title').html('Detail Edukasi');
                $('#modal-form').find('.modal-body').html(result);
                $('#modal-form').modal('show');
            },
            error: function (err) {
                console.log(err);
            },
        });
    });
</script>
@endpush