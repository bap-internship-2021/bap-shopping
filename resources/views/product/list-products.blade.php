@extends('layouts.master')
@section('title', 'Products')

@section('content')
    @isset($products)
        <div class="grid grid-cols-3 gap-2 bg-gray-100">
            @foreach($products as $key => $product)
                <a href="{{ route('user.products.show', ['product' => $product->name ]) }}">
                    <div class="flex flex-col group hover:shadow hover:bg-white">
                        <div class="pt-5">
                            <img class="object-cover h-48 w-full"
                                 src="{{ asset("admin\\images\\products\\") . $product->first()->images->first()->path }}"
                                 alt="Product">
                        </div>
                        <div>
                            <p class="p-2">Tên sản phẩm: <span>{{ $product->name }}</span></p>
                        </div>
                        <div>
                            <p class="p-2">Giá: <span>{{ number_format($product->price, 0, '', ',') }}</span> <span class="underline">đ</span></p>
                        </div>
                    </div>
                </a>

            @endforeach
        </div>
        {{--  Paginate product --}}
        <div>
            {{ $products->links() }}
        </div>
    @endisset
@endsection
