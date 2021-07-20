@extends('layouts.master')
@section('title', 'Chi tiết sản phẩm')

@section('content')
    @if(!empty($data))
        <section class="py-5">
            <div class="border bg-blue-900 shadow rounded  mx-auto">
                <div class="animate-pulse mx-auto">
                    <p class="text-center text-white p-3">Hình thức thanh toán COD</p>
                </div>
            </div>
        </section>
        <div><p class="text-xl font-bold">GIỎ HÀNG</p></div>
        <section class="flex flex-row">
            <div class="w-3/6">

                <div>
                    <div class="border border-white rounded bg-white mb-5">
                        <div class="flex">
                            <div class="w-2/6 py-2">
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
                <div class="py-5 border border-white rounded bg-white">
                    @foreach($data as $key => $item)
                        <div class="flex py-5">
                            <div class="w-2/6 flex">
                                <div>
                                    <img src="{{ asset("admin\\images\\products\\" . $item['image']) }}"
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
                    <!-- Form enter sale code -->
                    <div class="bg-gray-100 mt-5">
                        <div class="flex flex-col bg-white rounded p-2">
                            <div class="py-2">
                                <p>Nhập mã khuyến mãi <span
                                        class="text-sm text-blue-900">(Tối đa một mã khuyến mãi)</span></p>
                            </div>

                            <div>
                                <div>
                                    <form action="#" method="post">
                                        @csrf
                                        <input type="text"
                                               id="sale-code"
                                               class="border border-blue-400 rounded w-full ring:none focus:outline-none focus:ring-2  focus:ring-blue-400 p-1"
                                               placeholder="Mã khuyến mãi">
                                        <button
                                            class="mt-1 border bg-blue-400 border-blue-400 hover:bg-blue-500 rounded w-full ring:none focus:outline-none focus:ring-2  focus:ring-blue-400 p-1">
                                            Sử dụng mã giảm giá
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div>

                        </div>
                    </div>
                    <!-- End form enter sale code -->

                    <!-- Start count price total and sale price -->
                    <div class="">
                        <div class="font-light bg-white p-2 rounded rounded-b-none mt-5">
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

                            <div class="flex justify-between">
                                <div>
                                    <p>Giảm giá</p>
                                </div>
                                <div class="font-semibold">
                                    @if(isset($salePrice))
                                        <p class="font-semibold">{{ $salePrice }} <span class="underline">đ</span></p>
                                    @else
                                        <p class="font-semibold">0 <span class="underline">đ</span></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Divide  -->
                        <div class="h-px"></div>
                        <!-- End divide -->
                        <div class="flex justify-between bg-white border-t-0 rounded rounded-t-none p-2">

                            <div>
                                <p class="font-light">Tổng cộng</p>
                            </div>
                            <div>
                                <p class="font-semibold">{{ $subTotal }} <span class="underline">đ</span></p>
                            </div>
                        </div>
                    </div>
                    <!-- End count price total and sale price -->

                    <!-- Start form click to buy -->
                    <div>
                        <div class="pt-5">
                            <form action="" method="post">
                                <button class="bg-red-500 p-2 w-full rounded text-white font-semibold hover:bg-red-600">
                                    Mua hàng
                                </button>
                            </form>
                        </div>
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
            <a href="{{ route('/') }}" title="Tiki Pha Ke"
               class="mt-20 bg-yellow-300 p-3 rounded-lg focus:ring-4 focus:ring-orange-400">Tiếp tục mua sắm</a>
        </div>
    @endif
@endsection
