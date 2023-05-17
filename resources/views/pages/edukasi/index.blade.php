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
                <div class="section-title">List Edukasi</div>

                <div class="col pt-4">
                    <a href="{{route('edukasi.create')}}" class="btn btn-sm btn-primary" style="float: right"
                        title="Tambah">
                        Tambah
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table id="myTable" class="table">
                    <thead>
                        <tr>
                            <th width="1%">#</th>
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
                                {{\Carbon\Carbon::parse($item['created_at'])->locale('id')->translatedFormat('j
                                F Y')}}
                            </td>
                            <td>
                                <a href="{{route('edukasi.show', $item['slug'])}}"
                                    class="btn btn-sm btn-edit btn-secondary" title="Detail">
                                    <i class="ri-eye-line"></i>
                                </a>

                                <a href="{{route('edukasi.edit', $item['slug'])}}"
                                    class="btn btn-sm btn-edit btn-warning" title="Edit">
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
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
    // event button detail
    $('.btn-detail').on('click', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');

        $.ajax({
            url: url,
            dataType: 'HTML',
            method: 'GET',
            success: function (result) {
                $('#modal-form').find('.modal-title').html('Detail Nontender');
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