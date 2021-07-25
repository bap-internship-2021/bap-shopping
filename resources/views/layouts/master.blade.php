<!doctype html>
<html lang="en" class="bg-gray-100">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    {{--  FONT AWESOME 6  --}}
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integ\rity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Zen+Tokyo+Zoo&display=swap" rel="stylesheet">

{{-- Custom CSS --}}
@yield('css')
<!-- TailwindCSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="https://cdn3.iconfinder.com/data/icons/inficons/512/apple.png" type="image/gif"
          sizes="16x16">
    <style>
        #tns1-ow > button {
            display: none;
        }
    </style>
    <title>BAP Shopping @yield('title', '')</title>
</head>

<body>

<!-- Start top nav -->
<div class="w-screen h-24 flex justify-between" style="background-color: #1A94FF">

    <!-- Start Logo -->
    <div class="text-gray-700 p-8">
        <a href="{{ route('/') }}" class="text-white w-1/6 text-xl" style="font-family: 'Zen Tokyo Zoo', cursive;">BAP
            SHOPPING</a>
    </div>
    <!-- End Logo -->

    <!-- START SEARCH BAR -->
    <div class="w-4/6 p-8 pl-12">
        <form action="" method="GET">
            <input type="text"
                   class="px-3 py-2 bg-purple-white  shadow-lg rounded w-5/6"
                   placeholder="Tìm kiếm sản phẩm">
            <button style="background-color: #0D5CB6" class="px-3 py-2 rounded shadow-lg text-black font-medium"><i class="fas fa-search"></i>
                Tìm Kiếm
            </button>
        </form>
    </div>
    <!-- END SEARCH BAR -->

    <div class="w-1/6 p-8">
        <ul class="flex justify-between">
            @if(Auth::check())
                <li><a class="p-2 text-white rounded text-sm mr-2" href=""><i
                            class="fas fa-user"></i> {{ !empty(Auth()->user()->name) ? Auth()->user()->name : '' }}</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" title="Click to logout"><i class="fas fa-sign-out-alt"></i></button>
                    </form>
                </li>
            @else
                <li><a class="p-2 text-blue-900 rounded text-sm mr-2" href=""><i class="fas fa-user"></i> Đăng nhập</a>
                </li>
            @endif

        </ul>
    </div>
</div>
<!-- END TOP NAV-->

<div class="w-screen h-screen bg-gray-100">

    <div class="flex justify-between">

        {{--    START LEFT NAV --}}
        <div class="w-1/6 h-96">
            <nav class="bg-blue-50 shadow-sm h-full">
                <ul class="px-4 py-2">
                    <li class="animate-bounce transition hover:text-red-500  cursor-pointer">
                        <a href="{{ route('user.vouchers.index') }}"><i class="fas fa-tags fill-current text-blue-400"></i> Xem voucher</a>
                    </li>
                    <li class="cursor-pointer transition hover:text-red-500">
                        <a href="{{ route('carts.index') }}"><i
                                class="fas fa-shopping-basket fill-current text-blue-400"></i> Giỏ hàng của
                            tôi</a>
                    </li>
                    <li class="cursor-pointer transition hover:text-red-500">
                        <a href="{{ route('orders.index') }}"><i
                                class="fas fa-shopping-basket fill-current text-blue-400"></i> Đơn hàng của tôi</a>
                    </li>
                    <li class="cursor-pointer transition hover:text-red-500">
                        <a href="{{ route('categories.products.index', ['category'=> \App\Models\Category::IPHONE]) }}"><i
                                class="fas fa-mobile fill-current text-blue-400"></i> Iphone</a>
                    </li>
                    <li class="cursor-pointer transition hover:text-red-500">
                        <a href="{{ route('categories.products.index', ['category'=> \App\Models\Category::IPAD]) }}"><i
                                class="fas fa-tablet fill-current text-blue-400"></i> Ipad</a>
                    </li>
                    <li class="cursor-pointer transition hover:text-red-500">
                        <a href="{{ route('categories.products.index', ['category'=> \App\Models\Category::IMAC]) }}"><i
                                class="fas fa-desktop fill-current text-blue-400"></i> Imac</a>
                    </li>
                    <li class="cursor-pointer transition hover:text-red-500">
                        <a href="{{ route('categories.products.index', ['category'=> \App\Models\Category::MACBOOK]) }}"><i
                                class="fas fa-laptop fill-current text-blue-400"></i> MacBook</a>
                    </li>
                    <li class="cursor-pointer transition hover:text-red-500">
                        <a href="{{ route('categories.products.index', ['category'=> \App\Models\Category::APPLE_WATCH]) }}">
                            <span class="iconify inline fill-current text-blue-400" data-icon="gg-apple-watch"
                                  data-inline="false"></span>Apple Watch
                        </a>
                    </li>
                    <li class="cursor-pointer transition hover:text-red-500">
                        <a href="{{ route('categories.products.index', ['category'=> \App\Models\Category::AIR_POD]) }}">
                            <span class="iconify inline fill-current text-blue-400" data-icon="akar-icons:airpods"
                                  data-inline="false"></span>Air Pod
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        {{--    END LEFT NAV--}}

        {{-- Start content--}}
        <div class="w-5/6 bg-gray-100 h-screen">
            @yield('content')
        </div>
        {{-- End content --}}

    </div>

</div>

</body>
@yield('js')
</html>
