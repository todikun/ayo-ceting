@extends('layouts.main')

@section('title', 'Dashboard')

@section('content-header')

<h1>Activities</h1>
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
    <div class="breadcrumb-item">Activities</div>
</div>
@endsection

@section('content-body')
<h2 class="section-title">Pengaduan {{\Carbon\Carbon::now()->locale('id')->translatedFormat('F Y')}}</h2>

<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="fas fa-check"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Approved</h4>
                </div>
                <div class="card-body">
                    {{sizeof($approved)}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="fas fa-times"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Rejected</h4>
                </div>
                <div class="card-body">
                    {{sizeof($rejected)}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-secondary">
                <i class="fas fa-clock"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Pending</h4>
                </div>
                <div class="card-body">
                    {{sizeof($pending)}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="fas fa-list"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>All</h4>
                </div>
                <div class="card-body">
                    {{sizeof($all)}}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-info">
                <i class="fas fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Pengaduan : Diri Sendiri</h4>
                </div>
                <div class="card-body">
                    {{sizeof($diriSendiri)}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-info">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Pengaduan : Orang Lain</h4>
                </div>
                <div class="card-body">
                    {{sizeof($orangLain)}}
                </div>
            </div>
        </div>
    </div>
</div>

<a class="text-decoration-none" data-toggle="collapse" href="#collapseYear" role="button" aria-expanded="false"
    aria-controls="collapseYear">
    <h2 class="section-title">Pengaduan {{\Carbon\Carbon::now()->format('Y')}}</h2>
</a>

<div class="collapse" id="collapseYear">
    <div class="row">
        <div class="col-lg-12 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div id="barChart"></div>
            </div>
        </div>
    </div>
</div>

<form action="#" onsubmit="addData(event)">
    <input type="text" name="pengaduan_id" value="57">
    <input type="text" name="receiver" value="24">
    <input type="text" name="sender" value="6">
    <input type="text" name="message">
    <button type="submit">Kirim</button>
</form>

<div class="pt-5">
    <h5>Test firebase</h5>
    <ul id="firebase-data">

    </ul>
</div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    var series = @json($chart); 
    var options = 
    {
        chart: {
            type: 'bar',
            height: 500,
            width: '100%',
            toolbar: {"show":false},
            zoom: {"enabled":true},
            fontFamily: 'Helvetica, Arial, sans-serif',
            foreColor: '#373d3f',
            sparkline: {"enabled":false}
        },
        plotOptions: {
            bar: {"horizontal":false}
        },
        colors: ["#008FFB","#00E396","#feb019","#ff455f","#775dd0","#80effe","#0077B5","#ff6384","#c9cbcf","#0057ff","#00a9f4","#2ccdc9","#5e72e4"],
        series: series,
        dataLabels: {"enabled":false},
                title: {
            text: ""
        },
        subtitle: {
            text: '',
            align: ''
        },
        xaxis: {
            categories: ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"]
        },
        yaxis: {
            show: true,
            labels: {
                formatter: function (value) {
                    return value.toFixed(0);
                }
            }
        },
        grid: {"show":false},
        markers: {"show":true},
    };

    var chart = new ApexCharts(document.querySelector("#barChart"), options);
    chart.render();
</script>

@endpush