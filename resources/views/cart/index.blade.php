@extends('layouts.master')
@section('title', 'Chi tiết sản phẩm')

@section('content')
    @if(!empty($data))
        <div><p class="text-xl font-bold">GIỎ HÀNG</p></div>
        <section class="flex flex-row">
            <div class="w-3/6">

                <div>
                    <div class="border border-white rounded bg-white mb-5">
                        <div class="flex p-2">
                            <div class="w-2/6">
                                <p>Tất cả ({{ count($data) }} sản phẩm)</p>
                            </div>
                            <div class="w-1/6">
                                <p>Đơn giá</p>
                            </div>
                            <div class="w-1/6">
                                <p>Số lượng</p>
                            </div>
                            <div class="w-1/6">
                                <p>Thành tiền</p>
                            </div>
                            <div class="w-1/6 text-right">
                                <form action="{{ route('carts.destroy') }}" method="post" class="">
                                    @csrf
                                    @method('DELETE')
                                    <button><i
                                            class="fas fa-trash-alt fill-current text-gray-500 hover:text-red-500"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-2 border border-white rounded bg-white">
                    @foreach($data as $key => $item)
                        <div class="flex py-5">
                            <div class="w-2/6 flex">
                                <div>
                                    <img src="{{ asset('admin/images/products') . '/' . $item['image'] }}"
                                         class="rounded w-16 h-16" alt="">
                                </div>
                                <div>
                                    <p class="text-sm pl-2 w-20 truncate text-blue-600 hover:underline"><a
                                            href="{{ route('user.products.show', $item['name']) }}">{{ $item['name'] }}</a>
                                    </p>
                                </div>
                            </div>
                            <div class="w-1/6">
                                <p class="text-sm">{{ number_format($item['price'], 0, '', ',') }} <span
                                        class="underline">đ</span></p>
                            </div>
                            <div class="w-1/6">
                                <p>{{ $item['quantity'] }}</p>
                            </div>
                            <div class="w-1/6">
                                <p class="text-red-500">{{ number_format($item['totalPrice'], 0, '', ',') }} <span
                                        class="underline">đ</span>
                                </p>
                            </div>
                            <div class="w-1/6 text-right">
                                <form action="{{ route('carts.item.destroy') }}" method="post" class="">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="productId" value="{{ $key }}">
                                    <button><i
                                            class="fas fa-trash-alt fill-current text-gray-500 hover:text-red-500"></i>
                                    </button>
                                </form>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>

            {{--      Form confrim order   --}}
            <div class="w-3/6">
                <div class="w-4/6 ml-5 border border-gray-100">
                    <div class="bg-white rounded p-2">
                        <div class="flex justify-between">
                            <div>
                                <p class="font-semibold">Giao tới</p>
                            </div>
                            <div>
                                <a class="text-blue-500 hover:underline cursor-pointer">Thay đổi</a>
                            </div>
                        </div>
                        <div>
                            <div>
                                <p class="font-bold">{{ Auth()->user()->name }} <span class="text-gray-300 font-normal">|</span> {{ Auth()->user()->phone }}
                                </p>
                            </div>
                        </div>
                        <div>
                            <div>
                                <p>
                                    Địa chỉ:
                                    <span class="text-sm text-gray-400 italic">
                                      {{ Auth::user()->address }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Form enter voucher code -->
                    <div class="bg-gray-100 mt-5">
                        <div class="flex flex-col bg-white rounded p-2">
                            <div class="py-2">
                                <p>Nhập mã khuyến mãi <span
                                        class="text-sm text-blue-900">(Tối đa một mã khuyến mãi)</span></p>
                            </div>
                            <!-- Input voucher code -->
                            <div>
                                <div>
                                    <input type="text"
                                           id="voucher-code-input"
                                           class="border border-blue-400 rounded w-full ring:none focus:outline-none focus:ring-2  focus:ring-blue-400 p-1"
                                           placeholder="Mã khuyến mãi"
                                           value="{{ old('code') }}"
                                    onchange="getVoucherCode()">
                                </div>
                            </div>
                        </div>
                        <div>

                        </div>
                    </div>
                    <!-- End form enter voucher code -->

                    <!-- Start count price total and voucher price -->
                    <div class="">
                        <div class="font-light bg-white p-2 rounded mt-5">
                            <div class="flex justify-between">
                                <div>
                                    <p>Tạm tính</p>
                                </div>
                                <div>
                                    <p class="font-semibold">
                                        <span>{{ number_format($subTotal, 0, '', ',') }}</span>
                                        <span class="underline">đ</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Divide  -->
                        <div class="h-px"></div>
                        <!-- End divide -->
                    </div>
                    <!-- End count price total and voucher price -->

                    <!-- Start form click to buy -->
                    <div>
                        <div class="pt-5">
                            <form action="{{ route('orders.confirmation') }}" method="post">
                                @csrf
                                <input type="hidden" id="code"  name="code">
                                <button class="bg-red-500 p-2 w-full rounded text-white font-semibold hover:bg-red-600">
                                    Tiến hành thanh toán
                                </button>
                            </form>
                        </div>
                        @if(session()->has('errorVoucherCode'))
                            <div class="pt-5">
                            <p class="border bg-white border-red-500 p-2 w-full rounded text-black font-semibold text-center">{{ session()->get('errorVoucherCode') }}</p>
                            </div>
                        @endif
                    </div>
                    <!-- End form click to buy -->
                </div>
            </div>
        </section>
        {{--    Display notification empty cart    --}}
    @else
        <div>
            <img class="mt-5 mx-auto text-sm" src="https://salt.tikicdn.com/desktop/img/mascot@2x.png" alt="Image"
                 width="190px" height="auto">
        </div>
        <div>
            <p class="text-2xl text-gray-900 text-center mt-10">{{ __('Không có sản phẩm nào trong giỏ hàng của bạn.') }}</p>
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('/') }}"
               class="mt-20 bg-yellow-300 p-3 rounded-lg focus:ring-4 focus:ring-orange-400">Tiếp tục mua sắm</a>
        </div>
    @endif
@endsection
@section('js')
{{--  Get user input voucher code  --}}
<script src="{{ asset('js/get-voucher-code.js') }}"></script>
@endsection
