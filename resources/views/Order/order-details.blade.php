@extends('layouts.master')
@section('title', 'Chi tiết đơn hàng')
@section('css')
    <style>
        .pagination{
            display: flex;
            flex-direction: row;
        }
        .pagination li {
            background: white;
            padding: 5px;
        }
    </style>
@endsection()
@section('content')
    <div class="">
        <div class="">
            <p class="text-2xl p-5 text-center">Chi tiết đơn hàng <span>#{{ $order->custom_order_id }}</span></p>
        </div>
        <div class="flex justify-between w-11/12 mx-auto">
            {{-- Dia chi nguoi nhan--}}
            <div class="flex flex-col w-3/12">
                <div class="pb-3">
                    <p>Địa chỉ người nhận</p>
                </div>
                <div class="p-5 rounded shadow-sm bg-white h-28">
                    <div>
                        <p class="font-bold">{{ !empty(Auth::user()->name) ? Auth::user()->name : '' }}</p>
                    </div>
                    <div>
                        <p>Địa chỉ: <span>{{ Auth::user()->address }}</span></p>
                    </div>
                    <div>
                        <p>Điện thoại: <span>{{ Auth::user()->phone }}</span></p>
                    </div>
                </div>
            </div>
            {{--Hinh thuc giao hang--}}
            <div class="flex flex-col w-3/12">
                <div class="pb-3">
                    <p>Hình thức giao hàng</p>
                </div>
                <div class="p-5 rounded shadow-sm bg-white h-28">
                    <p>Giao hàng tiết kiệm</p>
                    @if($order->status === \App\Models\Order::PENDING_STATUS)
                        {{__('Đang đợi kiểm duyệt')}}
                    @elseif($order->status === \App\Models\Order::SENDING_STATUS)
                        {{__('Đang vận chuyển đơn hàng')}}
                    @elseif($order->status === \App\Models\Order::FINISH_STATUS)
                        @php
                            $date_end = \Carbon\Carbon::parse($order->date_end)->format('\n\g\à\y d \t\h\á\n\g m \n\ă\m Y');
                        @endphp
                        {{__('Giao vào ') . $date_end }}
                    @endif
                </div>
            </div>

            {{--Hinh thuc thanh toan--}}
            <div class="flex flex-col w-3/12">
                <div class="pb-3">
                    <p>Hình thức thanh toán</p>
                </div>
                <div class="p-5 rounded shadow-sm bg-white h-28">
                    <div>
                        <p>Thanh toán khi nhận hàng</p>
                    </div>
                    @if($order->status === \App\Models\Order::FINISH_STATUS)
                        <p class="text-sm text-yellow-400">Thanh toán thành công</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Start table list products --}}
        <div class="products w-11/12 mx-auto pt-10">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 rounded">
                            <table class="table-fixed min-w-full divide-y divide-gray-200 cursor-default">
                                <thead class="bg-white">
                                <tr class="hover:bg-blue-50">
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/6">
                                        Sản phẩm
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/6">
                                        Giá
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/6">
                                        Số lượng
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/6">
                                        Tạm tính
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($orderDetails as $key => $orderDetail)

                                    <tr class="hover:bg-blue-50 cursor-pointer" onclick="location.href='{{ route('user.products.show', ['product' => $orderDetail->product_id]) }}'">

                                        {{-- Image and product name --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium flex">

                                                        <div>
                                                            <img
                                                                src="{{ asset("admin\\images\\products\\") . \App\Models\Product::find($orderDetail->product_id)->images->first()->path }}"
                                                                alt="sảm phẩm" class="w-16 h-16">
                                                        </div>

                                                        <div>

                                                            <div class="px-5">
                                                                <p>{{ \App\Models\Product::find($orderDetail->product_id)->name }}
                                                                </p>
                                                            </div>

                                                            {{-- Write comment and buy again --}}
                                                            <div class="flex px-5 pt-2">
                                                                <div>
                                                                    <button
                                                                        class="text-blue-400 bg-white border border-blue-400 p-1 rounded w-24">
                                                                        Viết nhận xét
                                                                    </button>
                                                                </div>

                                                                <div class="pl-3">
                                                                    <button
                                                                        class="text-blue-400 bg-white border border-blue-400 p-1 rounded w-24">
                                                                        <a href="{{ route('user.products.show', ['product' => $orderDetail->product_id]) }}">Mua lại</a>
                                                                    </button>
                                                                </div>

                                                            </div>
                                                            {{-- End write comment and buy again button --}}

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        {{-- End Image and product name --}}

                                        {{-- Price of a product --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ number_format(\App\Models\Product::find($orderDetail->product_id)->price, 0, '', ',') }}
                                            <span class="underline"> đ</span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $orderDetail->quantity }}
                                        </td>
                                        {{--End Price of a product --}}

                                        {{-- Subtotal Price --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $subTotal = (\App\Models\Product::find($orderDetail->product_id)->price *
                                                $orderDetail->quantity);
                                            @endphp
                                            <p class="subTotalPrice">{{ number_format($subTotal, 0, '', ',') }}
                                                <span class="underline">đ</span>
                                            </p>

                                        </td>
                                        {{-- End subtotal price --}}

                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="px-6 py-4"></td>
                                    <td class="px-6 py-4"></td>
                                    <td class="cursor-text px-6 py-4">
                                        <div class="pb-1">
                                            <p>Tạm tính:</p>
                                        </div>
                                        <div class="pb-1">
                                            <p>Giảm giá:</p>
                                        </div>
                                        <div class="pb-1">
                                            <p>Tổng cộng:</p>
                                        </div>
                                    </td>
                                    <td class="cursor-text px-6 py-4">
                                        <div class="pb-1">
                                            {{  number_format($subTotalPrice, 0, '', ',') }}
                                            <span class="underline">đ</span>
                                        </div>
                                        <div class="pb-1 ">
                                            @if(isset($discount))
                                                @php
                                                    $discountPrice = ($subTotalPrice * $discount) / 100;
                                                @endphp
                                            @else
                                                @php
                                                    $discountPrice = 0;
                                                @endphp
                                            @endif
                                            {{ number_format($discountPrice, 0, '', ',') }}
                                            <span class="underline">đ</span>
                                        </div>

                                        {{-- Total price  --}}
                                        <div class="pb-1  text-red-600">
                                            {{ number_format($order->total_price, 0, '', ',') }}
                                            <span class="underline">đ</span>
                                        </div>
                                        {{-- End total price --}}

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- End table list products --}}

        <div class="w-11/12 mx-auto">
            {{ $orderDetails->links() }}
        </div>
    </div>
@endsection
