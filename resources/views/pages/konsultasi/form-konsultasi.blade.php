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

                    <h4>{{$_auth['name']}}</h4>
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
                <button class="btn btn-secondary form-control" id="secondary-submit">Submit</button>
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
        const pengaduanId = "{{$pengaduanId}}";
        const token = "{{$_auth['token']}}";
        const baseUrl = "{{url('/')}}"; 

        if (vonisInput[0].value.trim() === '') {
            vonisInput[0].focus();
            
            iziToast.warning({
                title: 'Warning',
                message: 'Vonis tidak boleh kosong!',
                position: 'topRight',    
                timeout: 2500,
                drag: false,
                transitionIn: 'fadeInUp',
                transitionOut: 'fadeOutRight',
            });
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
                iziToast.success({
                    title: 'Success',
                    message: result.meta.message,
                    position: 'topRight',    
                    timeout: 2500,
                    drag: false,
                    transitionIn: 'fadeInUp',
                    transitionOut: 'fadeOutRight',
                });
                setTimeout(() => {
                    window.location.replace(`${baseUrl}/pengaduan/list`);
                }, 3000);
            })
            .catch(err => { 
                iziToast.warning({
                    title: 'Warning',
                    message: 'Network error!',
                    position: 'topRight',    
                    timeout: 2500,
                    drag: false,
                    transitionIn: 'fadeInUp',
                    transitionOut: 'fadeOutRight',
                });
            });
    }

</script>
@endpush