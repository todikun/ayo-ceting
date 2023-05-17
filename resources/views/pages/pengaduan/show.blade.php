<div class="col-lg">
    <!-- Vertical Form -->
    <form class="row g-3">
        <div class="mb-3">
            <span class="badge bg-warning text-small text-dark">
                {{$pengajuan['category_pengajuan']['category_name']}}
            </span>
            <span class="badge bg-secondary text-small">
                {{Carbon\Carbon::parse($pengajuan['created_at'])->locale('id')->translatedFormat('j
                F Y')}}
            </span>
        </div>
        <div class="col-12">
            <label for="pelapor" class="form-label">Pelapor</label>
            <input type="text" class="form-control" value="{{$pengajuan['user']['name']}}" id="pelapor">
        </div>
        <div class="col-12">
            <label for="nohp" class="form-label">No.HP</label>
            <input type="text" class="form-control" value="{{$pengajuan['user']['phone_number']}}" id="nohp">
        </div>
        <div class="col-12">
            <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
            <textarea id="alamat_lengkap" class="form-control" cols="5"
                rows="2">{{$pengajuan['alamat_lengkap']}}</textarea>
        </div>
        <div class="col-12">
            <label for="isi_pengajuan" class="form-label">Isi Pengajuan</label>
            <textarea id="isi_pengajuan" class="form-control" cols="5"
                rows="3">{{$pengajuan['isi_pengajuan']}}</textarea>
        </div>
    </form>
    <!-- Vertical Form -->
</div>