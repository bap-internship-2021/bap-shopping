@extends('layouts.master')
@section('title', 'Đơn hàng')

@section('css')
<style>
    .pagination {
        display: flex;
        flex-direction: row;
    }

    .pagination li {
        background: #0c3254;
        padding: 5px 15px;
        color: white;
    }

    #pagination>nav>ul>li.page-item.active {
        cursor: not-allowed;
    }
</style>
@endsection()
@section('content')
<!-- List order if it exist -->
@if($orders->count() > 0)
@isset($orders)
<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200">
                <table class="min-w-full divide-y divide-gray-200 cursor-default">
                    <thead class="bg-white">
                        <tr class="hover:bg-blue-50">
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Mã đơn hàng
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ngày mua
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tổng tiền
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Trạng thái đơn hàng
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($orders as $key => $order)
                        <tr class="hover:bg-blue-50 cursor-pointer" onclick="location.href='{{ route('orders.oderDetails.index', ['id' => $order->id]) }}'">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-blue-600">
                                            {{ $order->custom_order_id }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                $order_at = \Carbon\Carbon::parse($order->created_at)->format('\N\g\à\y d \T\h\á\n\g m \N\ă\m Y');
                                @endphp
                                <div class="text-sm text-gray-900">{{ $order_at }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-left">
                                {{ number_format($order->total_price, 0, '', ',') }}
                                <span class="underline">đ</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if($order->status === \App\Models\Order::PENDING_STATUS)
                                <p class="text-yellow-400">{{__('Đang đợi kiểm duyệt')}}</p>
                                @elseif($order->status === \App\Models\Order::SENDING_STATUS)
                                <p class="text-blue-600">{{__('Đang bàn giao')}}</p>
                                @elseif($order->status === \App\Models\Order::FINISH_STATUS)
                                <p class="text-green-600">{{__('Giao hàng thành công')}}</p>
                                @elseif($order->status === \App\Models\Order::CANCEL_STATUS)
                                <p class="text-red-600">{{__('Đã huỷ đơn hàng')}}</p>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="pagination">
        {{ $orders->links()}}
    </div>
</div>
@endisset
@else
<div class="pt-10">
    <div class="alert alert-info w-1/2 mx-auto">
        <div class="flex-1 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <label>Bạn chưa có đơn hàng nào!</label>
            <div class="flex-none pl-5">
                <button class="btn btn-sm btn-primary"><a href="{{ route('/') }}">Ấn vào đây để mua hàng</a></button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection