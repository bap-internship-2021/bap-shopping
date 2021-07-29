<!doctype html>
<html lang="en" class="bg-gray-100">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link rel="stylesheet" href="{{ asset('css/my-custom.css') }}">
    <link rel="icon" href="https://cdn3.iconfinder.com/data/icons/inficons/512/apple.png" type="image/gif"
          sizes="16x16">

    <!-- TailwindCSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>@yield('title', 'BAP SHOPPING')</title>
</head>

<body>

<!-- Start top nav -->
<div class="w-screen h-24 flex" style="background-color: #0c3254">

    <!-- Start Logo -->
    <div class="text-gray-700 p-8 w-1/6">
        <a href="{{ route('/') }}" class="text-white w-1/6 text-xl" style="font-family: 'Zen Tokyo Zoo', cursive;">
            <img src="https://bap.bemo.cloud/web/image/website/1/logo/Bemo?unique=44aea3b" class="" alt="BAP LOGO">
            BAP SHOPPING
        </a>
    </div>
    <!-- End Logo -->


    {{--  start 2 child  --}}
    <div class="pt-8 flex w-5/6">
        <!-- START SEARCH BAR -->
        <div class="w-1/2">
            <form action="" method="GET" class="flex">
                <input type="text"
                       class="bg-purple-white shadow-lg rounded p-2 w-4/6 placeholder-black placeholder-opacity-90"
                       placeholder="Tìm kiếm sản phẩm">
                <button style="background-color: #fff" class="p-2 ml-2 rounded shadow-lg text-black font-medium"><i
                        class="fas fa-search"></i>
                    Tìm Kiếm
                </button>
            </form>
        </div>
        <!-- END SEARCH BAR -->

        <div class="w-1/2">
            <ul class="flex justify-end">
                @if(Auth::check())
                    @if(Auth::user()->role_id == \App\Models\User::USER_ROLE)
                        <li class="pr-3">
                            <a class="text-white rounded" href="{{ route('carts.index') }}">
                            <span class="font-semibold">
                                <i class="fas fa-shopping-cart pr-1"></i></span>Giỏ
                                hàng
                            </a>
                        </li>
                    @endif
                    <li class="pr-2">
                        <div class="">
                            <div class="dropdown inline-block relative">
                                <button
                                    class="text-white font-semibold rounded inline-flex items-center">
                                    <span class="flex"><img class="rounded-full"
                                                            src="{{ asset("admin\\images\\avatar\\") . Auth()->user()->profile_photo_path }}"
                                                            alt="" style="width: 30px; height: 30px"> {{ !empty(Auth()->user()->name) ? Auth()->user()->name : '' }}</span>
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                    </svg>
                                </button>
                                <ul class="dropdown-menu absolute hidden text-black pt-1 z-50">
                                    <div class="divide-y divide-gray-100 cursor-pointer">
                                        @if(Auth::user()->role_id == \App\Models\User::AMIN_ROLE)
                                            <li class=""><a
                                                    class="rounded-t bg-white hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                                                    href="#">Quản lý hệ thống</a>
                                            </li>
                                            <li class=""><a
                                                    class="bg-white hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                                                    href="{{ route('profiles.show', ['profile' => Auth::id()]) }}">Tài
                                                    khoản của tôi</a>
                                            </li>
                                        @else
                                        <!-- User Profile -->
                                            <li class=""><a
                                                    class="rounded-t bg-white hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                                                    href="{{ route('users.profiles.show') }}">Tài khoản của tôi</a>
                                            </li>
                                        @endif

                                    <!-- Show link to verify email for user not verified -->
                                        @if(Auth::user()->email_verified_at == null)
                                            <li class=""><a
                                                    class="bg-white hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                                                    href="{{ route('verification.notice') }}">Xác thực tài khoản</a>
                                            </li>
                                        @endif
                                    <!--  -->


                                        {{--                                        <li class=""><a--}}
                                        {{--                                                class="bg-white hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"--}}
                                        {{--                                                href="#">Do something</a>--}}
                                        {{--                                        </li>--}}

                                        <li class="">
                                            <form action="{{ route('logout') }}" method="post">
                                                @csrf
                                                <input type="submit"
                                                       class="w-full rounded-b bg-white hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap cursor-pointer"
                                                       value="Đăng xuất">
                                            </form>
                                        </li>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </li>
                @else
                    <li><a class="text-white rounded text-sm" href=""><i class="fas fa-user text-white text-xl"></i>
                            Đăng
                            nhập</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    {{-- end 2 child  --}}

</div>
<!-- END TOP NAV-->

<div class="w-screen h-screen bg-gray-100">

    <div class="flex justify-between">

        {{--    START LEFT NAV --}}
        <div class="w-1/6 h-96">
            <nav class="bg-blue-200 shadow-sm h-full">
                <ul class="px-4 py-2">
                    <li class="animate-bounce transition hover:text-red-500  cursor-pointer">
                        <a href="{{ route('user.vouchers.index') }}"><i
                                class="fas fa-tags fill-current text-blue-400"></i> Xem voucher</a>
                    </li>
                    @if(Auth::user()->role_id === \App\Models\User::USER_ROLE)
                        <li class="cursor-pointer transition hover:text-red-500">
                            <a href="{{ route('orders.index') }}"><i
                                    class="fas fa-shopping-basket fill-current text-blue-400"></i> Đơn hàng của tôi</a>
                        </li>
                    @endif
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
