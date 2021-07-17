<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    {{--  FONT AWESOME 6  --}}
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Zen+Tokyo+Zoo&display=swap" rel="stylesheet">
    <!-- TailwindCSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="https://cdn3.iconfinder.com/data/icons/inficons/512/apple.png" type="image/gif" sizes="16x16">
    <title>BAP Shopping @yield('title', '')</title>
</head>

<body>

<!-- Start top nav -->
<div class="w-screen h-24 flex justify-between bg-blue-200">

    <!-- Start Logo -->
    <div class="text-gray-700 p-8">
        <a href="{{ route('/') }}" class="text-blue-900 w-1/6 text-xl" style="font-family: 'Zen Tokyo Zoo', cursive;">BAP
            SHOPPING</a>
    </div>
    <!-- End Logo -->

    <!-- START SEARCH BAR -->
    <div class="w-4/6 p-8">
        <form action="" method="GET">
            <input type="text"
                   class="px-3 py-2 bg-purple-white  shadow-lg rounded w-5/6"
                   placeholder="Tìm kiếm...">
            <button class="px-3 py-2 bg-blue-300 rounded shadow-lg"><i class="fas fa-search"></i>Tìm kiếm</button>
        </form>
    </div>
    <!-- END SEARCH BAR -->

    <div class="w-1/6 p-8">
        <ul class="flex justify-between">
            <li><a class="p-2 text-blue-900 rounded text-sm mr-2" href="">Đăng nhập</a></li>
            <li><a class="p-2 text-blue-900 rounded text-sm" href="">Đăng ký</a></li>
        </ul>
    </div>
</div>
<!-- END TOP NAV-->

<div class="w-screen">

    <div class="flex justify-between">

        {{--    START LEFT NAV --}}
        <div class="w-1/6 h-96">
            <nav>
                <ul class="px-4 py-2">
                    <li class="animate-bounce transition hover:text-red-500 text-blue-400 cursor-pointer"><i class="fas fa-tags"></i> Chương trình khuyến mãi</li>
                    <li class="cursor-pointer transition hover:text-red-500"><i class="fas fa-shopping-basket fill-current text-blue-400"></i> Giỏ hàng của tôi</li>
                    <li class="cursor-pointer transition hover:text-red-500"><i class="fas fa-mobile fill-current text-blue-400"></i> Iphone</li>
                    <li class="cursor-pointer transition hover:text-red-500"><i class="fas fa-tablet fill-current text-blue-400"></i> Ipad</li>
                    <li class="cursor-pointer transition hover:text-red-500"><i class="fas fa-desktop fill-current text-blue-400"></i> Imac</li>
                    <li class="cursor-pointer transition hover:text-red-500"><i class="fas fa-desktop fill-current text-blue-400"></i> MacBook</li>
                    <li class="cursor-pointer transition hover:text-red-500"><span class="iconify inline fill-current text-blue-400" data-icon="gg-apple-watch" data-inline="false"></span>Apple Watch</li>
                </ul>
            </nav>
        </div>
        {{--    END LEFT NAV--}}

        {{-- Start content--}}
        <div class="w-5/6">
            @yield('content')
        </div>
        {{-- End content --}}

    </div>

</div>

</body>
@yield('js')

</html>
