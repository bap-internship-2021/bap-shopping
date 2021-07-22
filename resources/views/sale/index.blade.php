@extends('layouts.master')
@section('title', 'Mã Khuyến mãi')

@section('content')
    <div class="grid grid-cols-3 gap-1">
        @foreach($sales as $key => $sale)
            <div class="bg-white hover:shadow">
                <div class="bg-green-400">
                    <p class="text-center p-2">{{ $sale->name }}</p>
                </div>
                <div class="p-3">
                    <p>Mã code: <span id="{{ 'sale-code-' . $key }}">{{ $sale->sale_code }}</span></p>
                </div>
                <div class="p-3">
                    <p>Giảm giá: {{ $sale->discount }}<span>%</span></p>
                </div>
                <div class="p-3">
                    <p>Số lượng còn lại: {{ $sale->sales_amount }}</p>
                </div>
                <div class="p-3">
                    <p>Áp dụng cho đơn hàng: {{ number_format($sale->min_price_to_apply, 0, '', ',') }}<span
                            class="underline">đ</span> trở lên</p>
                </div>
                <div class="p-3">
                    <button

                        data-clipboard-target="{{ '#sale-code-' . $key }}"
                        class="btn bg-blue-400 hover:bg-blue-500 p-2 w-full rounded ring:none focus:outline-none focus:ring-2 focus:ring-500-50">
                        Sao chép mã khuyến mãi
                    </button>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Paginate -->
    <div>
        {{$sales->links()}}
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
    <script>
        var clipboard = new ClipboardJS('.btn');

    </script>
@endsection
