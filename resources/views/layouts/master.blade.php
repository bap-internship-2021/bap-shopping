<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BAP Shopping @yield('title', '')</title>
</head>

<body>


<div class="w-screen h-screen relative bg-fixed bg-center bg-cover bg-no-repeat"
     style="background-image:linear-gradient(rgba(0, 0, 0, 0.9), rgba(0, 24, 100, 0.1)), url('{{asset('background-image/iphone-12-pro-max.jpg')}}')">

    {{--  Start top nav  --}}
    <ul class="flex flex-row mx-auto w-1/2 justify-center text-white text-2xl">
        <li class="mt-5 p-2"><a href="{{ route('/') }}"
                                class="transition delay-150 duration-700 ease-in-out hover:bg-blue-400 hover:scale-150 rounded-lg p-2">Trang
                chủ</a></li>
        <li class="mt-5 p-2"><a href=""
                                class="transition delay-150 duration-700 ease-in-out hover:bg-blue-400 hover:scale-150 rounded-lg p-2">Sản
                phẩm</a></li>
        <li class="mt-5 p-2"><a href=""
                                class="transition delay-150 duration-700 ease-in-out hover:bg-blue-400 hover:scale-150 rounded-lg p-2">Giỏ
                hàng</a></li>
        <li class="mt-5 p-2"><a href=""
                                class="transition delay-150 duration-700 ease-in-out hover:bg-blue-400 hover:scale-150 rounded-lg p-2">Về
                chúng tôi</a></li>
    </ul>
    {{--  End top nav  --}}

    <div>
        @yield('content')
    </div>
</div>

</body>
@yield('js')
</html>
