@extends('layouts.main')

@section('title', 'Pengaduan')

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
        let table = $('#myTable').DataTable({
            "autoWidth": false,
            "processing": true,
            "serverSide": true,
            "orderable": true,
            "ajax":{
                "url": "{{route('pengaduan.index')}}",
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

        table.on('draw.dt', function(){
            var btnKonfirmasi = document.querySelectorAll('.konfirmasi');
            btnKonfirmasi.forEach(function(button){
                button.addEventListener('click', function(){
                    let id = button.dataset.id;
                    let status = button.dataset.status;
                    let nama = button.dataset.nama;
                    let url = `http://103.141.74.123:5000/pengajuan/${status}/${id}`;
                    let token = @json($token);

                    if (confirm(`Apakah anda yakin ${status} pengaduan dari ${nama}?`) == true) {  
                        fetch(url, {
                            method: "PUT",
                            body: JSON.stringify({}),
                            headers: {
                                "Authorization": `Bearer ${token}`,
                                "Content-type": "application/json; charset=UTF-8"
                            }
                        })
                        .then(res =>{
                            return res.json();
                        })
                        .then(result => {
                            iziToast.success({
                                title: 'Success',
                                message: result.meta.message,
                                position: 'topRight',    
                                timeout: 2500,
                                drag: false,
                                transitionIn: 'fadeInUp',
                                transitionOut: 'fadeOutRight',
                            });
                            table.ajax.reload();
                        })
                        .catch(err => {
                            console.log('err',err);
                            iziToast.error({
                                title: 'Error',
                                message: 'Network Error',
                                position: 'topRight',    
                                timeout: 2500,
                                drag: false,
                                transitionIn: 'fadeInUp',
                                transitionOut: 'fadeOutRight',
                            });
                        });
                    } 
                });
            });

            var btnDetail = document.querySelectorAll('.btn-detail');
            btnDetail.forEach(function(button){
                button.addEventListener('click', function(e){
                    e.preventDefault();
                    let url = button.href;

                    $.ajax({
                        url: url,
                        dataType: 'HTML',
                        method: 'GET',
                        success: function (result) {
                            console.log('result', result);
                            $('#modal-form').find('.modal-title').html('Detail Pengaduan');
                            $('#modal-form').find('.modal-body').html(result);
                            $('#modal-form').modal('show');
                        },
                        error: function (err) {
                            console.log(err);
                        },
                    }); 
                });
            });
        });

    });

    

</script>

@endpush