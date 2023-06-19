<div class="col-lg">
    <div class="card">
        <div class="card-header">
            <p>Kategori pengaduan : <span
                    class="badge bg-warning text-white">{{$pengajuan['category_pengajuan']['category_name']}}</span>
            </p>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Tanggal</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="Tanggal"
                        value="{{\Carbon\Carbon::parse($pengajuan['created_at'])->locale('id')->translatedFormat('j F Y')}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Pelapor</label>
                    <input type="password" class="form-control" id="inputPassword4" placeholder="Pelapor"
                        value="{{$pengajuan['user']['name']}}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">No.hp</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="Tanggal"
                        value="{{$pengajuan['user']['phone_number']}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Pelapor</label>
                    <input type="text" class="form-control" id="inputPassword4" placeholder="Pelapor"
                        value="{{$pengajuan['user']['name']}}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Isi Pengaduan</label>
                <textarea name="isi_pengaduan" class="form-control" id="" cols="30" rows="10"
                    style="height: 100px">{{$pengajuan['isi_pengajuan']}}</textarea>
            </div>
            <div class="form-group">
                <label for="inputAddress">Detail Alamat</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="Detail Alamat"
                    value="{{$pengajuan['alamat_lengkap']}}">
            </div>

            <div class="form-group">
                <div id="map" class="rounded" style="height: 250px; width: 100%;"></div>
            </div>
        </div>
    </div>

    <script>
        var map = L.map('map').setView(["{{$pengajuan['lokasi']['coordinates'][1]}}", "{{$pengajuan['lokasi']['coordinates'][0]}}"], 15);
        
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        L.tileLayer('http://{s}.google.com/vt?lyrs=s,h&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);

        // marker
        L.marker(["{{$pengajuan['lokasi']['coordinates'][1]}}", "{{$pengajuan['lokasi']['coordinates'][0]}}"], {
            // icon: greenIcon
        }).addTo(map);

        // re-render
        setTimeout(() => {
            map.invalidateSize();
        }, 200);
    </script>
</div>