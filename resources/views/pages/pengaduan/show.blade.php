<div class="col-lg">
    <form action="#">

        <div class="row mb-3">
            <div class="badge bg-warning text-white">{{$pengajuan['category_pengajuan']['category_name']}}</div>
        </div>
        <div class="row d-flex mb-3">
            <div class="col-4">
                Tanggal
            </div>

            <div>
                : {{\Carbon\Carbon::parse($pengajuan['created_at'])->locale('id')->translatedFormat('j F Y')}}
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
    </form>
</div>