@extends('layouts.main')

<!-- Set Title -->
@push('title')
<title>Dashboard</title>
@endpush

@section('main-section')
<!-- START View Content Here -->
<link rel="stylesheet" href="{{ asset('bootstrap/css/dashboard.css') }}">


<!--
<div class="container">
    <h5>Dashboard</h5>
    <div class="row">
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Products</h6>
                    <h2 class="text-right"><i class="fa fa-cart-plus f-left"></i><span>112</span></h2>
                    <p class="m-b-0">Active<span class="f-right">108</span></p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Employees</h6>
                    <h2 class="text-right"><i class="fa fa-rocket f-left"></i><span>80</span></h2>
                    <p class="m-b-0">Active<span class="f-right">80</span></p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-yellow order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Invoice</h6>
                    <h2 class="text-right"><i class="fa fa-refresh f-left"></i><span>486</span></h2>
                    <p class="m-b-0">Completed<span class="f-right">351</span></p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-pink order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Sold Figure</h6>
                    <h2 class="text-right"><span>863,968,360.60</span></h2>
                  
                </div>
            </div>
        </div>
    </div>
</div>
-->
<!-- END View Content Here -->
@endsection