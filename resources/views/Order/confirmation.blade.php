@extends('layouts.master')
@section('title', 'Đặt hàng')

@section('content')
    <div class="bg-gray-100 h-screen">
        <div>
            <div class="font-bold text-xl bg-gray-100 uppercase text-black py-5 w-11/12 mx-auto">
                Xác nhận đơn hàng
            </div>
        </div>
        <div class="flex justify-between text-black bg-gray-100 bg-gray-100 w-11/12 mx-auto">
            <div class="w-3/6 pt-10">
                <div>
                    <div class="rounded bg-white mb-5">
                        <div class="flex p-2">
                            <div class="w-2/6">
                                <p>Tất cả ({{ count(session()->get('dataCart')) }} sản phẩm)</p>
                            </div>
                            <div class="w-2/6">
                                <p>Đơn giá</p>
                            </div>
                            <div class="w-1/6">
                                <p>Số lượng</p>
                            </div>
                            <div class="w-1/6">
                                <p>Thành tiền</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-2 border border-white rounded bg-white">
                    @foreach(session()->get('dataCart') as $key => $item)
                        <div class="flex py-5">
                            <div class="w-2/6 flex">
                                <div>
                                    <img src="{{ asset('admin/images/products') . '/' . $item['image'] }}"
                                         class="rounded w-16 h-16"
                                         alt="">
                                </div>
                                <div>
                                    <p class="text-sm pl-2 w-20 truncate text-blue-600 hover:underline"><a
                                            href="{{ route('user.products.show', $item['name']) }}">{{ $item['name'] }}</a>
                                    </p>
                                </div>
                            </div>
                            <div class="w-2/6">
                                <p class="text-sm">{{ number_format($item['price'], 0, '', ',') }} <span
                                        class="underline">đ</span>
                                </p>
                            </div>
                            <div class="w-1/6">
                                <p>{{ $item['quantity'] }}</p>
                            </div>
                            <div class="w-1/6">
                                <p class="text-red-500">{{ number_format($item['totalPrice'], 0, '', ',') }} <span
                                        class="underline">đ</span>
                                </p>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Form order -->
            <div class="w-2/6 pt-10 pr-10">
                <div class="">
                    <div class="rounded p-3 bg-white">
                        <div>
                            @if(session()->has('subTotal'))
                                <p>Giá gốc: {{ number_format(session()->get('subTotal'), 0, '', ',') }} <span
                                        class="underline">đ</span></p>
                            @else
                                <p>Giá gốc: 0 <span class="underline">đ</span></p>
                            @endif
                        </div>
                        <div>
                            @if(session()->has('voucherPrice'))
                                <p>Giảm giá: <span
                                        class="text-red-500">{{ number_format(session()->get('voucherPrice'), 0, '', ',') }}</span>
                                    <span class="underline text-red-500">đ</span></p>
                            @else
                                <p>Giảm giá: 0 <span class="underline">đ</span></p>
                            @endif
                        </div>

                        <div>
                            @if(session()->has('grandTotal'))
                                <p>Tổng cộng: <span
                                        class="font-bold">{{ number_format(session()->get('grandTotal'), 0, '', ',') }}</span>
                                    <span class="underline">đ</span></p>
                            @else
                                <p>Tổng cộng: 0 <span class="underline">đ</span></p>
                            @endif
                        </div>
                    </div>
                    <div class="p-5"></div>
                    <div class="rounded p-3 bg-white">
                        @if(session()->has('userInfo'))
                            <div>
                                <p class="font-bold">Thông tin nhận hàng</p>
                                <p class="text-sm">Người nhận: <span
                                        class="text-base">{{ session()->get('userInfo')['name'] }}</span>
                                </p>
                                <p class="text-sm">Số điện thoại: <span
                                        class="text-base">{{ session()->get('userInfo')['phone'] }}</span></p>
                                <p class="text-sm">Địa chỉ: <span
                                        class="text-base">{{ session()->get('userInfo')['address'] }}</span>
                                </p>
                            </div>
                        @else
                            <div>
                                <p class="font-bold">Thông tin nhận hàng</p>
                                <p class="text-sm">Người nhận: <span class="text-base">{{ Auth::user()->name }}</span>
                                </p>
                                <p class="text-sm">Số điện thoại: <span
                                        class="text-base">{{ Auth::user()->phone }}</span></p>
                                <p class="text-sm">Địa chỉ: <span class="text-base">{{ Auth::user()->address }}</span>
                                </p>
                            </div>
                        @endif

                        <div class="p-2"></div>

                        <div class="flex flex-col">

                            <div>
                                <form action="{{ route('orders.store') }}" method="post">
                                    @csrf
                                    <button type="submit" class="p-1 w-full bg-blue-400 rounded hover:bg-blue-500">Đặt
                                        hàng
                                    </button>
                                </form>
                            </div>

                            <div class="p-2"></div>

                            <div class="text-center">
                                <a href="{{ route('carts.index') }}"
                                   class="text-center text-blue-800 underline hover:text-blue-400">Quay lại giỏ hàng</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
