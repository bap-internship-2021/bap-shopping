@extends('layouts.master')
@section('title', 'Chi tiết sản phẩm')

@section('content')

    @if(!empty($cart))
        <div class="flex flex-row justify-between">
            <button
                class="text-2xl text-white cursor-pointer duration-100 bg-indigo-500 mt-5 rounded-lg p-4 hover:bg-indigo-400 ring-none focus:ring-4 focus:ring-indio-500">
                Thanh toán ngay
            </button>
            <div>
                <form action="{{ route('carts.destroy.all') }}" method="post">
                    @csrf
                    <button
                        type="submit"
                        class="text-2xl text-white cursor-pointer duration-100 bg-indigo-500 mt-5 rounded-lg p-4 hover:bg-indigo-400 ring-none focus:ring-4 focus:ring-indio-500">
                        Xoá toàn bộ đơn hàng
                    </button>
                </form>
            </div>
        </div>
        <div class="border-2 rounded-lg mt-5  grid-auto">
            @foreach($cart as $key => $item)
                <div class="border shadow-2xl w-100 mt-5 p-5">
                    <p id="product-id" class="invisible ">{{ $item['productId'] }}</p>
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
