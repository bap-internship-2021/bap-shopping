<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Zen+Tokyo+Zoo&display=swap" rel="stylesheet">
    <!-- TailwindCSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BAP Shopping @yield('title', '')</title>
</head>

<body>

    <div class="container mx-auto">
        <!-- Start top nav -->
        <div class="flex justify-between">
            <!-- Start Logo -->
            <div class="text-gray-700 py-2">
                <a href="{{ route('/') }}" class="text-blue-900 text-2xl" style="font-family: 'Zen Tokyo Zoo', cursive;">BAP SHOPPING</a>
            </div>
            <!-- End Logo -->

            <div>
                <ul class="flex">
                    <li><a class="px-2" href="">Login</a></li>
                    <li><a class="px-2" href="">Register</a></li>
                </ul>
            </div>
        </div>
        <!-- End top nav -->

        <!-- START SEARCH BAR -->
        <div class="">
            <input type="search" class="bg-purple-white border border-blue-200 shadow rounded  p-3 w-full ring-none focus:ring-4" placeholder="Tìm kiếm...">
        </div>
        <!-- END SEARCH BAR -->

        <!-- START CONTENT -->
        <div>
            @yield('content')
        </div>
        <!-- END CONTENT -->
    </div>

</body>
@yield('js')

</html>