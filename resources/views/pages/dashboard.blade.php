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
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
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
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
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
    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
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
@endsection