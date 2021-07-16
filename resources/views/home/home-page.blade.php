@extends('layouts.master')
@section('title', '')

@section('content')
<div>
    <div>
        <h1 class="text-center text-3xl p-5">Danh mục sản phẩm</h1>
    </div>

    <!-- Start list grid categories -->
    <div class="grid grid-cols-3 gap-4">
        <div class="iphone">
        <a href="#"><img src="{{ asset('background-image/iphone-12-pro-max.jpg') }}" alt=""></a>
        </div>
        <div class="ipad col-span-2">
        <a href="#"><img src="{{ asset('background-image/ipad-pro.jpg') }}" alt=""></a>
        </div>
        <div class="macbook col-span-2">
        <a href="#"><img src="{{ asset('background-image/ipad-pro.jpg') }}" alt=""></a>
        </div>
        <div class="imac col-span-2">
4
        </div>
        <div class="airport">
5
        </div>
        <div class="apple-watch">
6
        </div>
    </div>
    <!-- End list grid categories -->
</div>
@endsection