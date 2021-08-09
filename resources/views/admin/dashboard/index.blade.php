@extends('admin.layouts.layouts')

@section('css')
    <link href="{{URL::asset('admin/dist/css/adminDashboard.css')}}" rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid" style="background-image: url('https://media.istockphoto.com/vectors/data-stream-background-vector-id491219352'); background-size:cover;">
    <h1 class="text-center" style="color: #fff">Số liệu thống kê</h1>
    <div class="cardBox">
        <div class="card" onclick="location.href='{{route('admin.statistical.product')}}';" style="cursor: pointer; background-color: #2d972e">
            <div>
                <div class="numbers text-center">Sản phẩm</div>
            </div>
            <div class="iconBox text-center">
                <i class="fas fa-chart-pie" aria-hidden="true"></i>
            </div>
        </div>

        <div class="card" onclick="location.href='{{route('admin.statistical.sale')}}';" style="cursor: pointer; background-color: #ffa705">
            <div>
                <div class="numbers text-center">Doanh thu</div>
            </div>
            <div class="iconBox text-center">
                <i class="fas fa-search-dollar" aria-hidden="true"></i>
            </div>
        </div>

        <div class="card" onclick="location.href='{{route('admin.statistical.user')}}';" style="cursor: pointer; background-color: #9132bd">
            <div>
                <div class="numbers text-center">Khách hàng</div>
            </div>
            <div class="iconBox text-center">
                <i class="fas fa-star" aria-hidden="true"></i>
            </div>
        </div>

        <div class="card" onclick="location.href='{{route('admin.statistical.access')}}';" style="cursor: pointer; background-color: #fc7b03">
            <div>
                <div class="numbers text-center">Truy cập</div>
            </div>
            <div class="iconBox text-center">
                <i class="fas fa-eye" aria-hidden="true"></i>
            </div>
        </div>
    </div>
</div>

@endsection