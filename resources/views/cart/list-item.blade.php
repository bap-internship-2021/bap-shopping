@extends('layouts.master')
@section('title', 'Chi tiết sản phẩm')

@section('content')

    @if(!empty($cart))
        <div>
            <button
                class="text-2xl bg-blue-500 mt-5 rounded-sm p-2 hover:bg-blue-400 ring-none focus:bg-gray-100 focus:ring-4 focus:bg-blue-400 ">
                Thanh toán ngay
            </button>
        </div>
        <div class="border-2 rounded-lg mt-5 shadow-2xl flex flex-row">
            @foreach($cart as $key => $item)
                <div class="border shadow-2xl w-100">
                    <p>Sản phẩm: <span>{{ $item['productName'] }}</span></p>
                    <p>Giá: <span>{{ $item['price'] }}</span></p>
                    <p>Số lượng: <span>{{ $item['quantity'] }}</span></p>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-2xl text-gray-900 text-center mt-10">{{ __('Giỏ hàng Trống') }}</p>
    @endif
@endsection
