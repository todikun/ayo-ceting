<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') | AYOCETING</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('dist/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/components.css')}}">

    <link rel="stylesheet" href="{{asset('dist/datatables/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link href="{{asset('dist/iziToast/css/iziToast.min.css')}}" rel="stylesheet">

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- Page Specific CSS File -->
    @stack('css')
</head>

<body>
    <div id="app">
        <div class="main-wrapper">

            @include('includes.navbar')

            @include('includes.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        @yield('content-header')
                    </div>
                    <div class="section-body">
                        @yield('content-body')
                    </div>
                </section>
            </div>

            <!-- Modal start -->
            <div class="modal fade" tabindex="-1" role="dialog" id="modal-form">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal end -->

            <!-- Footer -->
            <footer class="main-footer">
                @include('includes.footer')
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{asset('dist/js/stisla.js')}}"></script>

    <!-- Template JS File -->
    <script src="{{asset('dist/js/scripts.js')}}"></script>
    <script src="{{asset('dist/js/custom.js')}}"></script>

    <script src="{{asset('dist/datatables/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('dist/datatables/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

    <script src="{{asset('dist/iziToast/js/iziToast.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Page Specific JS File -->
    @stack('script')

    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-firestore.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
    <script src="{{asset('dist/js/firebase-config.js')}}"></script>

    <script>
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig());

        const firestore = firebase.firestore();
        const messageCollection = firestore.collection('message');

        const pengaduanId = "{{$pengaduanId ?? ''}}";
        const loggedUser = "{{$_auth['id'] ?? null}}";
        const userIdPengaduan = "{{$userIdPengaduan ?? ''}}";

        if (pengaduanId != '') {
            const chatContent = document.querySelector('.chat-content');
            const chatBubble = document.querySelector('.chat-content');

            messageCollection.orderBy("timestamp", "asc").onSnapshot(function(snapshot) {
                if (!snapshot.empty) {
                    let messageTemp = '';
                    let groupDateText = '';
                    let tempDate = '';

                    snapshot.forEach(function(doc) {
                        let data = doc.data();
                        
                        if (data.pengaduan_id == pengaduanId) {
                            let dateFormatToHHMM = formatTimestampToHHMM(data.timestamp);
                            let dateFormatToDmY = formatTimestampToDate(data.timestamp);
                            let position = loggedUser == data.sender ? 'chat-right' : '';
                            
                            if (tempDate != dateFormatToDmY) {
                                tempDate = dateFormatToDmY;
                                groupDateText = `
                                    <div class="row justify-content-center mb-3">
                                        <span class="btn btn-sm btn-light disabled text-center">${dateFormatToDmY}</span>
                                    </div>
                                `;
                            } else {
                                groupDateText = '';
                            }

                            messageTemp += `
                            ${groupDateText}
                            <div class="chat-item ${position}">
                                <div class="chat-details">
                                    <div class="chat-text">
                                        ${data.message}
                                        <div class="chat-time">${dateFormatToHHMM}</div>    
                                    </div>
                                </div>
                            </div>
                            `;
                        }
                    });
                    chatBubble.innerHTML = messageTemp;
                    chatContent.scrollTop = chatContent.scrollHeight;
                } 
                
            }, function(error) {
                console.log('Firestore error:', error);
            });

            function addData(e) {
                e.preventDefault();
                const collectionRef = firestore.collection('message'); // Replace 'collection_name' with your desired collection name
                const messageInput = document.getElementById('messageInput');
                // Data to be added
                const data = {
                    message: e.target.elements.message.value,
                    pengaduan_id: Number(pengaduanId),
                    receiver: Number(userIdPengaduan),
                    sender: Number(loggedUser),
                    timestamp: new Date()
                };
                
                messageInput.value = '';
                
                // Add the data to Firestore
                collectionRef.add(data)
                    .then(function(docRef) {
                        console.log("Document written with ID: ", docRef.id);
                    })
                    .catch(function(error) {
                        console.error("Error adding document: ", error);
                    });
            }

            function formatTimestampToHHMM(timestamp) {
                let date = new Date(timestamp.seconds * 1000);
                let hours = date.getHours().toString().padStart(2, '0');
                let minutes = date.getMinutes().toString().padStart(2, '0');
                return `${hours}:${minutes}`;
            }

            function formatTimestampToDate(timestamp) {
                let date = new Date(timestamp.seconds * 1000); 
                let year = date.getFullYear();
                let monthIndex = date.getMonth();
                let monthNames = [
                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                ];
                let month = monthNames[monthIndex];
                let day = date.getDate().toString().padStart(2, '0');
                return `${day} ${month} ${year}`;
            }

        }
    </script>


</body>

</html>