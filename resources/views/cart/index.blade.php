@extends('layouts.master')
@section('title', 'Chi tiết sản phẩm')

@section('content')
    @if(!empty($data))
        <!-- Check email verify -->
        <div class="bg-gray-100 pt-5">
            @if (Auth()->user()->email_verified_at === null)
                <div class="alert alert-warning w-9/12 mx-auto">
                    <div class="flex-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             class="w-6 h-6 mx-2 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <label>
                            <p class="text-red-600 text-center">
                                Tài khoản của bạn chưa được xác thực để xử dụng
                                các chức năng khác
                                của hệ thống, ấn vào link này để xác thực:
                                <a
                                    href="{{ route('verification.notice') }}"
                                    class="text-blue-600 font-semibold underline hover:text-blue-900">
                                    Ấn vào đây!
                                </a>
                            </p>
                        </label>
                    </div>
                </div>
            @endif
        </div>
        <!-- -->

        <div class="bg-gray-100 h-screen">
            <div class="w-11/12 mx-auto">
                <div class="py-5">
                    <p class="text-xl font-bold text-black">GIỎ HÀNG</p>
                </div>

                <section class="flex flex-row text-black">
                    <div class="w-4/6">
                        <div>
                            <div class="rounded bg-white mb-5">
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
                                                    href="{{ route('user.products.show', $item['id']) }}">{{ $item['name'] }}</a>
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
                                        <p class="text-red-500">{{ number_format($item['totalPrice'], 0, '', ',') }}
                                            <span
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
                    <div class="w-2/6">
                        <div class="w-4/6 ml-5 border border-gray-100">
                            <div class="bg-white rounded p-2">
                                <div class="flex justify-between">
                                    <div>
                                        <p class="font-semibold">Giao tới</p>
                                    </div>
                                    <div id="change-address">
                                        <button onclick="showFormChangeAddress()">Thay đổi</button>
                                    </div>
                                </div>
                                <div>
                                    @if(session()->has('userInfo'))
                                        <div>
                                            <p class="font-bold">{{ session()->get('userInfo')['name'] }} <span
                                                    class="text-gray-300 font-normal">|</span> {{ session()->get('userInfo')['phone'] }}
                                            </p>
                                        </div>
                                    @else
                                        <div>
                                            <p class="font-bold">{{ Auth()->user()->name }} <span
                                                    class="text-gray-300 font-normal">|</span> {{ Auth()->user()->phone }}
                                            </p>
                                        </div>
                                    @endif

                                </div>
                                <div>
                                    @if(session()->has('userInfo'))
                                        <div>
                                            <p>
                                                Địa chỉ:
                                                <span class="text-sm text-gray-400 italic">
                                      {{ session()->get('userInfo')['address'] }}
                                    </span>
                                            </p>
                                        </div>
                                    @else
                                        <div>
                                            <p>
                                                Địa chỉ:
                                                <span class="text-sm text-gray-400 italic">
                                      {{ Auth::user()->address }}
                                    </span>
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Form change new address -->
                            <div class="bg-gray-100 mt-5 hidden" id="form-change-address">
                                <div class="flex flex-col bg-white rounded p-2">
                                    <!-- Input voucher code -->
                                    <div>
                                        <div>
                                            <form action="{{ route('carts.changeShipping') }}" method="post">
                                                @csrf
                                                <label for="name">Tên người nhận</label>
                                                <input type="text"
                                                       class="border border-blue-400 rounded w-full ring:none focus:outline-none focus:ring-2  focus:ring-blue-400 p-1"
                                                       placeholder="Nhập tên người nhận"
                                                       value="{{ old('name') }}"
                                                       name="name">
                                                @if($errors->has('name'))
                                                    <p class="text-red-600">{{$errors->first('name')}}</p>
                                                @endif
                                                <label for="phone">Số điện thoại người nhận</label>
                                                <input type="text"
                                                       class="border border-blue-400 rounded w-full ring:none focus:outline-none focus:ring-2  focus:ring-blue-400 p-1"
                                                       placeholder="Nhập số điện thoại"
                                                       value="{{ old('phone') }}"
                                                       name="phone">
                                                @if($errors->has('phone'))
                                                    <p class="text-red-600">{{$errors->first('phone')}}</p>
                                                @endif
                                                <label for="">Địa chị người nhận</label>
                                                <input type="text"
                                                       class="border border-blue-400 rounded w-full ring:none focus:outline-none focus:ring-2  focus:ring-blue-400 p-1"
                                                       placeholder="Nhập địa chỉ người nhận"
                                                       value="{{ old('address') }}"
                                                       name="address">
                                                @if($errors->has('address'))
                                                    <p class="text-red-600">{{$errors->first('address')}}</p>
                                                @endif
                                                <div class="pt-3">
                                                    <button
                                                        class="bg-green-500 p-2 w-full rounded text-white font-semibold hover:bg-red-600">
                                                        Xác nhận thay đổi
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div>

                                </div>
                            </div>
                            <! -- End form change new address -->


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
                                                   onchange="getVoucherCode()">
                                        </div>
                                    </div>
                                </div>
                                <div>

                                </div>
                            </div>
                            <!-- End form enter voucher code -->

                            <!-- Start form click to buy -->
                            <div>
                                <div class="pt-5">
                                    <form action="{{ route('orders.confirmation') }}" method="post">
                                        @csrf
                                        <input type="hidden" id="code" name="code">
                                        <button
                                            class="bg-red-500 p-2 w-full rounded text-white font-semibold hover:bg-red-600">
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

                            <!-- Display warning email verify -->
                            <div>
                                @if(session()->has('not-verify-email'))
                                    <div class="alert alert-error mt-5">
                                        <div class="flex-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 class="w-6 h-6 mx-2 stroke-current">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                            </svg>
                                            <label>Bạn chưa xác thực địa chỉ email!</label>
                                        </div>
                                    </div>

                                @endif
                            </div>
                            <!-- -->
                        </div>
                    </div>
                </section>
            </div>
        </div>
    @else
        {{--    Display notification empty cart    --}}
        <div>
            <img class="mt-5 mx-auto text-sm" src="https://salt.tikicdn.com/desktop/img/mascot@2x.png" alt="Image"
                 width="190px" height="auto">
        </div>
        <div>
            <p class="text-2xl text-gray-900 text-center mt-10">{{ __('Giỏ hàng trống.') }}</p>
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('/') }}"
               class="mt-20 bg-yellow-300 p-3 rounded-lg focus:ring-4 focus:ring-orange-400">Tiếp tục mua sắm</a>
        </div>
    @endif
    @if(session()->has('notify-order'))
        <p class="p-5 text-center">{{ session()->get('notify-order') }}</p>
    @endif
@endsection
@section('js')
    {{--  Get user input voucher code  --}}
    <script src="{{ asset('js/get-voucher-code.js') }}"></script>
    <script>
        function showFormChangeAddress() {
            document.getElementById("form-change-address").style.display = "block";
        }
    </script>
@endsection
