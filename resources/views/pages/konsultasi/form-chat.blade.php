@extends('layouts.main')


@section('content-header')
<h1>Konsultasi</h1>
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item">Dashboard</div>
    <div class="breadcrumb-item active"><a href="#">Konsultasi</a></div>
</div>
@endsection

@section('content-body')
<div class="row">

    <div class="col-12 col-sm-6 col-lg-6">
        <div class="card chat-box" id="mychatbox">
            <div class="card-header">
                <h4>Chat with Rizal</h4>
            </div>
            <div class="card-body chat-content">
                @foreach ($message as $item)
                <div class="chat-item chat-left"><img src="../assets/img/avatar/avatar-1.png">
                    <div class="chat-details">
                        <div class="chat-text">{{$item['isi_diskusi']}}</div>
                        <div class="chat-time">
                            {{
                                \Carbon\Carbon::parse($item['created_at'])->format('H:i')
                            }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="card-footer chat-form">
                <form id="chat-form">
                    <input type="text" class="form-control" placeholder="Type a message">
                    <button class="btn btn-primary">
                        <i class="far fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@push('script')
<script>
    const chatBubble = document.querySelector('.chat-content');
    const message = document.querySelector('.message');
    const sendChat = document.querySelector('.sending-chat');
    // const pengaduanId = document.querySelector('.pengaduan-id');
    // const userId = "";
    
    // console.log("User id : " + userId);

    sendChat.addEventListener('click', function(event) {
        console.log("message : " + message.value);
        // console.log("pengaduan : " + pengaduanId.value);

        // chat input empty
        if (message.value.trim() == '') {
            return;
        } 

        chatBubble.innerHTML += `
            <div class="chat">
                <div class="chat-body">
                    <div class="chat-message">${message.value}</div>
                </div>
            </div>
        `;

        message.value = '';

    })
</script> 
@endpush