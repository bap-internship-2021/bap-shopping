@extends('layouts.master')
@section('title', 'Chi tiết sản phẩm')


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/tiny-slider.css">
    <style>
        #tns1-ow > button {
            display: none;
        }
    </style>
@endsection

@section('content')

    <div class="">
        <div class="flex flex-row">
            @foreach ($product as $key => $item)
                {{-- Product detail --}}
                <div class="w-1/2">
                    {{-- List image product --}}
                    <div class="my-slider">
                        @foreach($item->images as $image)
                            <div>
                                <img class="object-cover h-96 w-full shadow-sm"
                                     src="{{ asset('admin/images/products/' . '/' . $image->path) }}" alt="">
                            </div>
                        @endforeach
                    </div>
                    {{--   End list images product   --}}
                </div>

                {{-- Product description --}}
                @if(Auth()->user()->role_id == \App\Models\User::USER_ROLE)
                    <div class="w-1/2">
                        <div class="pl-2">
                            <p class="invisible"><span id="product-id">{{ $item->id }}</span></p>
                            <p class="invisible"><span id="image-path">{{ $item->images->first()->path }}</span></p>
                            <p class="p-2">{{__('Tên sản phẩm: ')}} <span id="product-name">{{ $item->name }}</span></p>
                            <p id="product-price" class="invisible">{{ $item->price }}</p>
                            <p class="p-2">{{__('Giá: ')}}
                                <span id="" class="text-blue-900"> {{ number_format($item->price, 0, '', ',') }} </span>$
                            </p>
                        </div>

                        <!-- Add to cart form -->
                        <div id="app">
                            <app></app>
                        </div>
                    </div>
                @else
                    <div class="w-1/2">
                        <div class="pl-2">
                            <p class="p-2">{{__('Tên sản phẩm: ')}} <span id="product-name">{{ $item->name }}</span></p>
                            <p class="p-2">{{__('Giá: ')}}
                                <span id="" class="text-blue-900"> {{ number_format($item->price, 0, '', ',') }} </span>$
                            </p>
                            @if($item->quantity > 0)
                                <p class="p-2">Số lượng còn lại: {{$item->quantity}}</p>
                            @else
                                <p class="p-2 text-red-600">Hết hàng</p>
                            @endif
                            <div class="p-2">
                                <button class="bg-blue-300 text-white p-3 rounded hover:bg-blue-400"><a
                                        href="{{ route('products.edit', $item->id) }}">Chỉnh sửa sản phẩm này</a>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        @if($product->first()->specification != null)
            <div>
                <table class="table-fixed border">
                    <caption>Thông tin chi tiết</caption>
                    <tbody>
                    <tr>
                        <td class="pr-5 bg-gray-200">Màn hình</td>
                        <td class="w-7/12">{{ $product->first()->specification->screen }}</td>
                    </tr>
                    <tr class="bg-emerald-200">
                        <td class="pr-5 bg-gray-200">Camera</td>
                        <td>{{ $product->first()->specification->camera }}</td>
                    </tr>
                    <tr class="bg-emerald-200">
                        <td class="pr-5 bg-gray-200">Camera selfie</td>
                        <td>{{ $product->first()->specification->camera_selfie }}</td>
                    </tr>
                    <tr>
                        <td class="pr-5 bg-gray-200">Dung lượng RAM</td>
                        <td>{{ $product->first()->specification->ca }}</td>
                    </tr>
                    <tr>
                        <td class="pr-5 bg-gray-200">Bộ nhớ ROM</td>
                        <td>{{ $product->first()->specification->screen }}</td>
                    </tr>
                    <tr>
                        <td class="pr-5 bg-gray-200">Cpu</td>
                        <td>{{ $product->first()->specification->screen }}</td>
                    </tr>
                    <tr>
                        <td class="pr-5 bg-gray-200">GPU</td>
                        <td>{{ $product->first()->specification->screen }}</td>
                    </tr>
                    <tr>
                        <td class="pr-5 bg-gray-200">Sim</td>
                        <td>{{ $product->first()->specification->screen }}</td>
                    </tr>
                    <tr>
                        <td class="pr-5 bg-gray-200">Hệ điều hoành</td>
                        <td>{{ $product->first()->specification->screen }}</td>
                    </tr>
                    <tr>
                        <td class="pr-5 bg-gray-200">Xuất xứ</td>
                        <td>{{ $product->first()->specification->screen }}</td>
                    </tr>
                    <tr>
                        <td class="pr-5 bg-gray-200">Sản xuất năm</td>
                        <td>{{ $product->first()->specification->release_time }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <h1>Mô tả sản phẩm</h1>
                <div class="bg-white rounded">
                    <!-- content here -->
                   {{ $product->first()->specification->description }}
                </div>
            </div>
        @endif
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
    <script>
        var slider = tns({
            container: '.my-slider',
            items: 1,
            slideBy: 'page',
            autoplay: true,
            controls: false,
            nav: false
        });
    </script>
    <script type="text/javascript">
        window.csrf_token = "{{ csrf_token() }}"
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
