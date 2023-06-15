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
<div class="row d-flex">
    <div class="col-12 col-sm-6 col-lg-6">
        <div class="card chat-box" id="mychatbox">
            <div class="card-header">
                <div class="col">
                    <h4>{{$userNamePengaduan}}</h4>
                </div>
                <div class="col text-right">
                    <button class="btn btn-danger" type="button" onclick="endChat()">End Chat</button>
                </div>
            </div>
            <div class="card-body chat-content">
                <div class="d-flex pt-5 justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="card-footer chat-form">
                <form id="chat-form" onsubmit="addData(event)">
                    <input type="text" name="message" class="form-control" id="messageInput"
                        placeholder="Type a message">

                    <button class="btn btn-primary" id="btnSend" type="submit">
                        <i class="far fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-lg-6">
        <div class="card chat-box">
            <div class="card-header">
                <h4>Vonis awal</h4>
            </div>
            <div class="card-body chat-content">
                <textarea name="vonis" id="vonis-input" class="form-control" style="height: 250px;"></textarea>
            </div>
            <div class="card-footer chat-form">
                <form id="vonis-form" onsubmit="sendVonis(event)">
                    <input type="submit" name="message" class="bg-secondary form-control text-white" disabled
                        style="padding-right: 0;" id="btnVonis" placeholder="Type a message" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    const btnSend = document.getElementById('btnSend');
    const btnVonis = document.getElementById('btnVonis');

    function endChat() 
    {
        btnVonis.classList.remove('bg-secondary');
        btnVonis.classList.add('bg-primary');
        btnVonis.disabled = false;
    }
    
    function sendVonis(e)
    {
        e.preventDefault();
        const vonisInput = document.getElementById('vonis-input');
        const pengaduanId = "{{$pengaduanId}}";
        const token = "{{$_auth['token']}}";
        const url = `http://103.141.74.123:5000/vonis/${pengaduanId}`;

        if (vonisInput.value.trim() === '') {
            vonisInput.focus();
            iziToast.warning({
                title: 'Warning',
                message: 'Vonis tidak boleh kosong!',
                position: 'topRight',    
                timeout: 2500,
                drag: false,
                transitionIn: 'fadeInUp',
                transitionOut: 'fadeOutRight',
            });
        } else {
            Swal.fire({
                title: 'Vonis Awal',
                text: 'Apakah anda yakin submit vonis awal untuk pengaduan ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, submit!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        method: "POST",
                        dataType: "JSON",
                        data: JSON.stringify({
                            vonis: vonisInput.value
                        }),
                        headers: {
                            "Authorization": `Bearer ${token}`,
                            "Content-type": "application/json; charset=UTF-8"
                        },
                        success: function(data) {
                            if (data.meta.success) {
                                //btn send deactived
                                btnSend.classList.remove('btn-primary');
                                btnSend.classList.add('btn-secondary');
                                btnSend.disabled = true;
                                //btn vonis deactived
                                btnVonis.classList.remove('bg-primary');
                                btnVonis.classList.add('bg-secondary');
                                btnVonis.disabled = true;

                                iziToast.success({
                                    title: 'Success',
                                    message: data.meta.message,
                                    position: 'topRight',    
                                    timeout: 2500,
                                    drag: false,
                                    transitionIn: 'fadeInUp',
                                    transitionOut: 'fadeOutRight',
                                });
                            } else {
                                iziToast.error({
                                    title: 'Error',
                                    message: 'Network Error',
                                    position: 'topRight',    
                                    timeout: 2500,
                                    drag: false,
                                    transitionIn: 'fadeInUp',
                                    transitionOut: 'fadeOutRight',
                                });
                            }
                        },
                    });
                }
            })

            
        }
    }

</script>
@endpush