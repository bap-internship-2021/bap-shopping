@extends('layouts.master')
@section('title', '')

@section('content')
    <div>
        <!-- Start list grid categories -->
        <div class="mx-auto grid grid-cols-3 gap-0.5">
            <div class="iphone">
                <a title="Iphone"
                   href="{{ route('categories.products.index', ['category'=> \App\Models\Category::IPHONE]) }}"><img
                        src="{{ asset('background-image/iphone-12-pro-max.jpg') }}" alt=""
                        class="object-cover h-96 w-full transition duration-2000 transform hover:scale-110 filter hover:blur-lg"></a>
            </div>
            <div class="ipad col-span-2">
                <a title="Ipad"
                   href="{{ route('categories.products.index', ['category'=> \App\Models\Category::IPAD]) }}"><img
                        src="{{ asset('background-image/ipad-pro.jpg') }}" alt=""
                        class="object-cover h-96 w-full transition duration-2000 transform hover:scale-110 filter hover:blur-lg  "></a>
            </div>
            <div class="macbook col-span-2">
                <a title="Macbook"
                   href="{{ route('categories.products.index', ['category'=> \App\Models\Category::MACBOOK]) }}"><img
                        src="{{ asset('background-image/macbook-m1.jpg') }}" alt=""
                        class="object-cover h-96 w-full transition duration-2000 transform hover:scale-110 filter hover:blur-lg"></a>
            </div>
            <div class="apple-watch">
                <a title="Apple Watch"
                   href="{{ route('categories.products.index', ['category'=> \App\Models\Category::APPLE_WATCH]) }}"><img
                        src="{{ asset('background-image/apple-watch.jpg') }}" alt=""
                        class="object-cover h-96 w-full transition duration-2000 transform hover:scale-110 filter hover:blur-lg"></a>
            </div>
            <div class="imac col-span-2">
                <a title="Imac"
                   href="{{ route('categories.products.index', ['category'=> \App\Models\Category::IMAC]) }}"><img
                        src="{{ asset('background-image/imac.jpg') }}" alt=""
                        class="object-cover h-96 w-full transition duration-2000 transform hover:scale-110 filter hover:blur-lg"></a>
            </div>
            <div title="AirPod" class="airport">
                <a href="{{ route('categories.products.index', ['category'=> \App\Models\Category::AIR_POD]) }}"><img
                        src="{{ asset('background-image/airpods.jpg') }}" alt=""
                        class="object-cover h-96 w-full transition duration-2000 transform hover:scale-110 filter hover:blur-lg"></a>
            </div>
        </div>
        <!-- End list grid categories -->
    </div>
@endsection
