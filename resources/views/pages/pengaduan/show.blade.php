<div class="col-lg">
    {{-- <form action="#">

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
    </form> --}}

    <div id="map" style="height: 200px; width: 500px;"></div>

    <script>
        var map = L.map('map').setView([-0.936542765043, 100.37384033203], 15);
        

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            L.tileLayer('http://{s}.google.com/vt?lyrs=s,h&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }).addTo(map);
    </script>
</div>