@extends('layouts.master')
@section('title', 'Chi tiết sản phẩm')

@section('content')
    <div class="border-2 rounded-lg mt-5 shadow-2xl flex flex-row">
        <div class="w-1/2">
            <img class="shadow-inner rounded-sm " src="{{ $product->image_path }}" alt="Sản phẩm">
        </div>
        <div class="ml-12 font-bold text-2xl">
            <p class="invisible"><span id="product-id">{{ $product->id }}</span></p>
            <p class="p-2">{{__('Tên sản phẩm: ')}} <span id="product-name">{{ $product->name }}</span></p>
            <p class="p-2">{{__('Giá: ')}} <span id="product-price" class="text-blue-900"> {{ $product->price }} </span>$</p>
            <div id="app">
                <app></app>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        window.csrf_token = "{{ csrf_token() }}"
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
