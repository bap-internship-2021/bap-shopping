@extends('layouts.master')
@section('title', 'Chi tiết sản phẩm')

@section('content')
    <div class="border-2 rounded-lg mt-5 shadow-2xl flex flex-row">
        <div class="">
            <img class="shadow-inner rounded-sm" src="{{ $product->image_path }}" alt="Sản phẩm">
        </div>
        <div class="ml-12 font-bold text-2xl">
            <p class="p-2">{{__('Tên sản phẩm: ')}} <span id="product-name">{{ $product->name }}</span></p>
            <p class="p-2">{{__('Giá: ')}} <span id="product-price"> {{ $product->price }}</span></p>
            <div id="app">
                <app></app>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
