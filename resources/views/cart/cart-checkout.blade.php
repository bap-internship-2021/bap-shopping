@extends('layouts.master')
@section('title', 'Chi tiết sản phẩm')

@section('content')
    <div>
        <h1 class="text-5xl mx-auto text-center mt-5">Xác nhận đơn hàng</h1>
    </div>
    <div class="bg-gray-50">

        <div>
            <p class="text-2xl text-center">Hình thức thanh toán: <span class="text-green-500 p-2 rounded-full font-bold">Giao hàng tận nơi</span>
            </p>
        </div>
        {{--    User information    --}}
        <div class="border bg-white w-1/3 rounded my-5">
            <div>
                <p>Giao tới</p>
            </div>
            {{-- Username and phone --}}
            <div>
                <p class="font-bold">{{  Auth::user()->name }} | {{ Auth::user()->phone }}</p>
            </div>
            {{--Address--}}
            <div>
                <p class="font-light text-sm">Địa chỉ: {{ Auth::user()->address }}</p>
            </div>
        </div>
        <div></div>
        <div>
            <form action="">
                <button class="bg-red-400 hover:bg-red-500 p-2 rounded w-1/3">Tiến hành đặt hàng</button>
            </form>
        </div>

    </div>
@endsection
