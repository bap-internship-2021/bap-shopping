@extends('layouts.master')
@section('title', 'Đặt hàng')

@section('content')
    <div>
        <div class="w-1/3 mx-auto mt-5 hover:shadow">
            <div class="border border-white bg-white rounded text-left p-5">
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
                        <p>Giảm giá: <span class="text-red-500">{{ number_format(session()->get('voucherPrice'), 0, '', ',') }}</span> <span
                                class="underline text-red-500">đ</span></p>
                    @else
                        <p>Giảm giá: 0 <span class="underline">đ</span></p>
                    @endif
                </div>
                <div>
                    @if(session()->has('grandTotal'))
                        <p>Tổng cộng: {{ number_format(session()->get('grandTotal'), 0, '', ',') }} <span
                                class="underline">đ</span></p>
                    @else
                        <p>Tổng cộng: 0 <span class="underline">đ</span></p>
                    @endif
                </div>
                <div>
                    <p>Giao tới: <span class="font-italic text-sm">{{Auth::user()->address}}</span></p>
                </div>
                <div>
                    <form action="{{ route('orders.store') }}" method="post">
                        @csrf
                        <button type="submit" class="p-1 bg-blue-400  w-full rounded hover:bg-blue-500">Đặt hàng</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
