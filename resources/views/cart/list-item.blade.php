@extends('layouts.master')
@section('title', 'Chi tiết sản phẩm')

@section('content')

    @if(!empty($cart))
        <div class="flex flex-row justify-between">
            <form action="{{ route('carts.checkout') }}" method="post">
                @csrf
                <button
                    class="text-2xl text-white cursor-pointer duration-100 bg-blue-500 mt-5 rounded-lg p-4 hover:bg-blue-400 ring-none focus:ring-4 focus:ring-indio-500">
                    Thanh toán ngay
                </button>
            </form>
            <div>
                <form action="{{ route('carts.destroy') }}" method="post">
                    @csrf
                    <button
                        type="submit"
                        class="text-2xl text-white cursor-pointer duration-100 bg-blue-500 mt-5 rounded-lg p-4 hover:bg-blue-400 ring-none focus:ring-4 focus:ring-indio-500">
                        Xoá toàn bộ đơn hàng
                    </button>
                </form>
            </div>
        </div>
        <div class="border-2 rounded-lg mt-5  grid-auto">
            @foreach($cart as $key => $item)
                <div class="border shadow-2xl w-100 mt-5 p-5">
                    <p id="product-id" class="invisible">{{ $key }}</p>
                    <p>Sản phẩm: <span>{{ $item['name'] }}</span></p>
                    <p>Giá sản phẩm: <span>{{ $item['price'] }}</span></p>
                    <p>Tổng số lượng: <span>{{ $item['quantity'] }}</span></p>
                    <a href="{{ route('user.products.show', ['product' => $item['name']]) }}" class="underline text-blue-400">Chi tiết đơn hàng</a>
                </div>
            @endforeach
        </div>
    @else
        <div>
            <img class="mt-5 mx-auto text-sm" src="https://salt.tikicdn.com/desktop/img/mascot@2x.png" alt="Image" width="190px" height="auto">
        </div>
        <div>
            <p class="text-2xl text-gray-900 text-center mt-10">{{ __('Không có sản phẩm nào trong giỏ hàng của bạn.') }}</p>
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('products.list') }}" class="mt-20 bg-yellow-300 p-3 rounded-lg focus:ring-4 focus:ring-orange-400">Tiếp tục mua sắm</a>
        </div>
    @endif
@endsection
