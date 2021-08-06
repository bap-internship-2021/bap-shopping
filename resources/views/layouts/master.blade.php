<!doctype html>
<html lang="en" data-theme="light">

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

<!-- Alert verify email success -->
@if(session()->has('email-verified'))
<div id="verify-email-notification">
    <div class="box bg-black w-screen h-full  absolute z-10 blur-3xl opacity-90">
    </div>
    <div class="alert absolute z-20 text-center"
         style="position: absolute; top: 50%;left: 50%; margin-right: -50%; transform: translate(-50%, -50%)">
        <div class="flex-1">
            <label class="mx-3">Bạn đã xác minh tài khoản thành công!</label>
        </div>
        <div class="flex-none">
            <button onclick="closeAlert()" class="btn btn-sm btn-primary">Đóng</button>
        </div>
    </div>
    <script>
        document.getElementsByTagName("BODY")[0].style.overflow = "hidden";
        function closeAlert() {
            document.getElementById("verify-email-notification").remove();
            document.getElementsByTagName("BODY")[0].style.overflow = "initial";
        }
    </script>
</div>
@endif
<!---->

<!-- Start top nav -->
<div class="w-screen h-24 flex" style="background-color: #0c3254">

    <!-- Start Logo -->
    <div class="text-gray-700 p-8 w-1/6">
        <a href="{{ route('/') }}" class="text-white w-1/6 text-xl" style="font-family: 'Zen Tokyo Zoo', cursive;">
            {{--            <img src="https://bap.bemo.cloud/web/image/website/1/logo/Bemo?unique=44aea3b" class="" alt="BAP LOGO">--}}
            BIP SHOP
        </a>
    </div>
    <!-- End Logo -->


    {{--  start 2 child  --}}
    <div class="pt-8 flex w-5/6">
        <!-- START SEARCH BAR -->
        <div class="w-full relative">

            <input type="text"
                   id="search-text"
                   name="search"
                   class="bg-purple-white shadow-lg rounded p-2 w-4/6 placeholder-black placeholder-opacity-90 w-full"
                   placeholder="Tìm kiếm sản phẩm">
            <div class="w-full h-96 bg-white absolute z-50 mt-1 rounded overflow-scroll" id="show-result"
                 style="display: none;">
                <ul>
                </ul>
            </div>
        </div>
        <!-- END SEARCH BAR -->

        <div class="w-1/2">

            <div class="cursor-pointer">
                <div class="user-image">
                    <div class="flex items-center justify-center">
                        <img class="mask mask-squircle w-10 h-10 mr-2"
                             src="{{ asset("admin\\images\\avatar\\" . Auth::user()->profile_photo_path) }}">

                        <div class=" dropdown dropdown-hover">
                            <div tabindex="0" class="m-1"><p class="text-white">{{ Auth::user()->name }} <i
                                        class="fas fa-chevron-down"></i></p></div>
                            <ul tabindex="0"
                                class="p-2 shadow menu dropdown-content bg-base-100 rounded-box w-52 cursor-pointer">
                                <li>
                                    @if(Auth::user()->role_id == \App\Models\User::AMIN_ROLE)
                                        <a
                                            class=""
                                            href="{{ route('admin.dashboard') }}">Quản lý hệ thống</a>

                                        <!-- Admin side -->
                                        <a
                                            class=""
                                            href="{{ route('profiles.show', ['profile' => Auth::id()]) }}"><i
                                                class="fas fa-user mr-1"></i>Tài
                                            khoản của tôi</a>

                                    @else
                                    <!-- User Profile side -->
                                        <a
                                            class=""
                                            href="{{ route('users.profiles.show') }}"><i
                                                class="fas fa-user mr-1"></i>Tài khoản của tôi
                                        </a>
                                    @endif
                                </li>
                                <li>
                                    @if(Auth::user()->email_verified_at == null)
                                        <a
                                            class="bg-white hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap"
                                            style="color:red;"
                                            href="{{ route('verification.notice') }}">Xác thực tài khoản
                                        </a>

                                    @endif
                                </li>
                                <li>
                                    <a href="">
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button type="submit"><i class="fas fa-sign-out-alt mr-1"></i>Đăng xuất
                                            </button>
                                        </form>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- end 2 child  --}}

</div>
<!-- END TOP NAV-->

<div style="background-color: #0c3254" class="px-8 pb-8 flex">
    <div class="dropdown dropdown-hover dropdown-right mr-1">
        <!-- Product categories -->
        <div tabindex="0" class="btn glass mr-1"><i class="fas fa-align-justify pr-1"></i>Danh mục sản phẩm</div>
        <ul tabindex="0" class="p-2 shadow menu dropdown-content bg-base-100 rounded-box w-52">
            <li>
                <a href="{{ route('categories.products.index', ['category'=> \App\Models\Category::IPHONE]) }}"
                   title="Iphone">Iphone</a>
            </li>
            <li>
                <a href="{{ route('categories.products.index', ['category'=> \App\Models\Category::IPAD]) }}">Ipad</a>
            </li>
            <li>
                <a href="{{ route('categories.products.index', ['category'=> \App\Models\Category::IMAC]) }}">Imac</a>
            </li>
            <li>
                <a href="{{ route('categories.products.index', ['category'=> \App\Models\Category::MACBOOK]) }}">Macbook</a>
            </li>
            <li>
                <a href="{{ route('categories.products.index', ['category'=> \App\Models\Category::APPLE_WATCH]) }}">Apple
                    Watch</a>
            </li>
            <li>
                <a href="{{ route('categories.products.index', ['category'=> \App\Models\Category::AIR_POD]) }}">Air
                    Pod</a>
            </li>
        </ul>
    </div>

    <!-- Orders -->
    <div>
        @if(Auth::check())
            @if(Auth::user()->role_id === \App\Models\User::USER_ROLE)
                <div class="mr-2">
                    <button class="btn btn glass"><a href="{{ route('orders.index') }}"><i
                                class="fas fa-shopping-bag pr-1"></i>Đơn hàng của tôi</a></button>
                </div>
            @endif
        @endif
    </div>

    <!-- Vouchers -->
    <div class="mr-2">
        <button class="btn btn glass"><a href="{{ route('user.vouchers.index') }}"><i class="fas fa-gift pr-1"></i>Mã
                khuyến mãi</a></button>
    </div>

    <!-- Cart -->
    <div class="mr-2">
        @if(Auth::check())
            @if(Auth::user()->role_id == \App\Models\User::USER_ROLE)
                <button class="btn btn glass"><a href="{{ route('carts.index') }}"><i
                            class="fas fa-shopping-cart pr-1"></i>Giỏ
                        hàng</a></button>
            @endif
        @endif
    </div>

</div>

<div class="bg-white text-black">

    {{-- Start content--}}
    <div class="w-screen h-full">
        @yield('content')
    </div>
    {{-- End content --}}
</div>

</body>
@yield('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('js/search-product.js') }}"></script>
</html>
