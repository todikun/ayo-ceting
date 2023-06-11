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
                    <button class="btn btn-danger" onclick="endChat(event)">End Chat</button>
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
                    <input type="text" name="message" class="form-control" id="messageInput" placeholder="Type a message">
                    <button class="btn btn-primary" type="submit">
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
                <form id="vonis-form">
                    <textarea name="vonis" id="vonis-input" class="form-control" style="height: 15rem;"
                        required></textarea>
                </form>
            </div>
            <div class="card-footer">
                <button class="btn btn-secondary form-control" id="secondary-submit">Submit
                </button>
                <button class="btn btn-primary form-control d-none" id="primary-submit"
                    onclick="sendVonis(event)">Submit
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    // var pengaduanId = "{{$pengaduanId}}";
    // var loggedUser = "{{$loggedUser}}";
    // var userIdPengaduan = "{{$userIdPengaduan}}";
    // var chatContent = document.querySelector('.chat-content');

    // document.addEventListener("DOMContentLoaded", function(event) {
    //     const chatBubble = document.querySelector('.chat-content');
    //     const message = document.querySelector('.message');
    //     const sendChat = document.querySelector('.sending-chat');

    //     // setInterval(() => {
    //     //     fetch(`http://103.141.74.123:5000/diskusi/${pengaduanId}`, {
    //     //         method: "GET",
    //     //         headers: {
    //     //             "Authorization": `Bearer ${token}`,
    //     //             "Content-type": "application/json; charset=UTF-8"
    //     //         }
    //     //     })
    //     //     .then(res => {
    //     //         return res.json();
    //     //     })
    //     //     .then(result => {
    //     //         let messageTemp = '';
    //     //         result.data.map(data => {
    //     //             let created_at = new Date(data.created_at);

    //     //             if (userIdPengaduan == data.to_user_id) {
    //     //                 messageTemp += `
    //     //                 <div class="chat-item chat-right">
    //     //                     <div class="chat-details">
    //     //                         <div class="chat-text">${data.isi_diskusi}</div>
    //     //                         <div class="chat-time">${created_at.toLocaleTimeString('id-ID', {hour: '2-digit', minute:'2-digit'})}</div>
    //     //                     </div>
    //     //                 </div>
    //     //                 `;
    //     //             } else {
    //     //                 messageTemp += `
    //     //                 <div class="chat-item">
    //     //                     <div class="chat-details">
    //     //                         <div class="chat-text">${data.isi_diskusi}</div>
    //     //                         <div class="chat-time">${created_at.toLocaleTimeString('id-ID', {hour: '2-digit', minute:'2-digit'})}</div>
    //     //                     </div>
    //     //                 </div>
    //     //                 `;
    //     //             }
    //     //         });
    //     //         chatBubble.innerHTML = messageTemp;

    //     //         if (reloadMessage == 0) {
    //     //             // scroll to bottom
    //     //             chatContent.scrollTop = chatContent.scrollHeight;
    //     //         }

    //     //         reloadMessage++;
    //     //         // console.log('Fetch success');
    //     //         console.log("Result : ", result);
    //     //     })
    //     //     .catch(err => {
    //     //         console.log('Fetch error');
    //     //     });
    //     // }, 3000);

    // });

    function sendMessage(e)
    {
        e.preventDefault();
        const form = document.getElementById('chat-form');
        const formData = new FormData(form);

        fetch(`http://103.141.74.123:5000/diskusi/${pengaduanId}`, {
            method: "POST",
            body: JSON.stringify({
                to_user_id: userIdPengaduan,
                from_user_id: loggedUser,
                isi_diskusi: formData.get('isi_diskusi'),
            }),
            headers: {
                "Authorization": `Bearer ${token}`,
                "Content-type": "application/json; charset=UTF-8"
            }
        })
        .then(res => {
            return res.json();
        })
        .then(result => {
            form.reset();
            // scroll to bottom
            chatContent.scrollTop = chatContent.scrollHeight;
            console.log('Message has been successfully to stored');
        })
        .catch(err => {
            console.log('Message has been failed to stored');
        });
    }

    function endChat(e) 
    {
        e.preventDefault();
        const primarySubmit = document.getElementById('primary-submit');
        const secondarySubmit = document.getElementById('secondary-submit');

        primarySubmit.classList.remove('d-none');
        secondarySubmit.classList.add('d-none');
    }
    
    function sendVonis(e)
    {
        e.preventDefault();
        const form = document.getElementById('vonis-form');
        const formData = new FormData(form);
        const vonisInput = form.querySelectorAll('textarea');

        if (vonisInput[0].value.trim() === '') {
            vonisInput[0].focus();
            alert('vonis tidak boleh kosong');
        }

        fetch(`http://103.141.74.123:5000/vonis/${pengaduanId}`, {
                method: "POST",
                body: JSON.stringify({
                    vonis: formData.get('vonis'),
                }),
                headers: {
                    "Authorization": `Bearer ${token}`,
                    "Content-type": "application/json; charset=UTF-8"
                }
            })
            .then(res => {
                return res.json();
            })
            .then(result => {
                alert('vonis berhasil dibuat');
                setTimeout(() => {
                    window.location.replace('http://127.0.0.1:8000/pengaduan/list');
                }, 3000);
            })
            .catch(err => {
                console.log('Fetch error');
            });
    }

</script>
@endpush