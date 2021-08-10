@extends('layouts.master')
@section('title', 'Products')
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

        #pagination > nav > ul > li.page-item.active {
            cursor: not-allowed;
        }
    </style>
@endsection()
@section('content')
    @isset($products)
        <div class="grid grid-cols-3 gap-2 bg-white text-black pt-5 px-5">
            @foreach($products as $key => $product)
                <a href="{{ route('user.products.show', ['product' => $product->id ]) }}">
                    <div
                        class="flex flex-col group bg-blue-50 shadow-inner transition duration-300 ease-in-out hover:shadow-lg rounded-lg">
                        <div class="pt-5">
                            <img class="object-cover h-48 w-full transition transform hover:-translate-y-2"
                                 src="{{ asset('admin/images/products/') . '/' . $product->images->first()->path }}"
                                 alt="Product">
                        </div>
                        <div>
                            <p class="p-2">Tên sản phẩm: <span>{{ $product->name }}</span></p>
                        </div>
                        <div>
                            <p class="p-2">Giá: <span>{{ number_format($product->price, 0, '', ',') }}</span> <span
                                    class="underline">đ</span></p>
                        </div>
                    </div>
                </a>

            @endforeach
        </div>
        {{--  Paginate product --}}
        <div class="px-5 pt-5">
            <div id="pagination">
                {{ $products->links() }}
            </div>
        </div>
    @endisset
    @if(count($products) === 0)
        <div class="p-5">
            <p class="text-center">Chưa có sản phẩm</p>
        </div>
    @endif
@endsection
