@extends('admin.layouts.layouts')

@section('css')
    <link href="{{URL::asset('admin/dist/css/adminDashboard.css')}}" rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid">
    <div class="cardBox">
        <div class="card" onclick="location.href='{{route('admin.statistical.product')}}';" style="cursor: pointer;">
            <div>
                <div class="numbers text-center">Sản phẩm</div>
            </div>
            <div class="iconBox text-center">
                <i class="fas fa-chart-pie" aria-hidden="true"></i>
            </div>
        </div>

        <div class="card">
            <div>
                <div class="numbers">111</div>
                <div class="cardName">ABC</div>
            </div>
            <div class="iconBox">
                <i class="fas fa-eye" aria-hidden="true"></i>
            </div>
        </div>

        <div class="card">
            <div>
                <div class="numbers">111</div>
                <div class="cardName">ABC</div>
            </div>
            <div class="iconBox">
                <i class="fas fa-eye" aria-hidden="true"></i>
            </div>
        </div>

        <div class="card">
            <div>
                <div class="numbers">111</div>
                <div class="cardName">ABC</div>
            </div>
            <div class="iconBox">
                <i class="fas fa-eye" aria-hidden="true"></i>
            </div>
        </div>
    </div>
</div>

@endsection