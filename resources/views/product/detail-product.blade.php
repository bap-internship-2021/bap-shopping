@extends('layouts.master')
@section('title', 'Chi tiết sản phẩm')

@section('content')
    <div class="border-2 rounded-lg mt-5 shadow-2xl flex flex-row">
        <div class="">
            <img class="shadow-inner rounded-sm" src="{{ $product->image_path }}" alt="Sản phẩm">
        </div>
        <div class="ml-12 font-bold text-2xl">
            <p class="p-2">{{__('Tên sản phẩm: ')}} {{ $product->name }}</p>
            <p class="p-2">{{__('Giá: ')}} {{ $product->name }}</p>
            <p class="p-2">{{__('Số lượng còn lại: ')}} {{ $product->quantity }}</p>
            <div class="p-2 mt-20">
                <button class="bg-indigo-300 rounded-lg p-5 hover:bg-indigo-200 transition">Thêm vào giỏ hàng</button>
            </div>
        </div>
    </div>
@endsection
