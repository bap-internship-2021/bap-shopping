@extends('layouts.master')
@section('title', 'Products')

@section('content')
    <div class="mt-20 mx-auto grid grid-cols-4 gap-y-10 gap-4">
        @if(!empty($products))
            @foreach ($products as $product)
                <div
                    class="flex flex-col justify-between border-4 border-blue-300 border-opacity-75 rounded-lg transform transition duration-300 ease-liner hover:scale-105 hover:border-pink-300 bg-blue-100">
                    <div>
                        <div>
                            <img class="p-2 truncate overflow-hidden hover:overflow-visible"
                                 src="{{ $product->image_path }}">
                        </div>
                        <div>
                            <p class="p-2 truncate overflow-hidden hover:overflow-visible">Tên sản
                                phẩm: {{ $product->name }}</p>
                        </div>
                        <div>
                            <p class="p-2">Số lượng còn lại: {{ $product->quantity }}</p>
                        </div>
                        <div>
                            <p class="p-2">Giá sản phẩm: {{ $product->price }}</p>
                        </div>
                    </div>

                    <div class="text-center h-full">
                        <a class="font-bold text-blue-900 hover:text-gray-800"
                           href="{{ route('products.detail', ['product' => $product->name]) }}">
                            Chi tiết sản phẩm
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="flex sm:justify-start mt-5">
        {{ $products->onEachSide(5)->links() }}
    </div>
@endsection
