@extends('layouts.master')
@section('title', 'Chi tiết sản phẩm')

@section('content')
    <div>
        <h1 class="text-5xl mx-auto text-center mt-5">Xác nhận đơn hàng</h1>
    </div>
    <div class="bg-white">

        <div>
            <p class="text-2xl">Hình thức thanh toán: <span class="text-green-500 p-2 rounded-full font-bold">Giao hàng tận nơi</span>
            </p>
        </div>

        <div>
            <p>Đơn hàng: {{ $productCount }} sản phẩm</p>
        </div>

        @foreach($data as $value)
  
        @endforeach

        <p>Tổng tiền: {{ $data['totalPrice'] }}</p>

    </div>
@endsection
