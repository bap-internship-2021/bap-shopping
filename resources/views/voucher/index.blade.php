@extends('layouts.master')
@section('title', 'Mã Khuyến mãi')

@section('content')
    <div class="grid grid-cols-3 gap-1">
        @foreach($vouchers as $key => $voucher)
            <div class="bg-white hover:shadow">
                <div class="bg-green-400">
                    <p class="text-center p-2">{{ $voucher->name }}</p>
                </div>
                <div class="p-3">
                    <p>Mã code: <span id="{{ 'code-' . $key }}">{{ $voucher->code }}</span></p>
                </div>
                <div class="p-3">
                    <p>Giảm giá: {{ $voucher->discount }}<span>%</span></p>
                </div>
                <div class="p-3">
                    <p>Số lượng còn lại: {{ $voucher->quantity }}</p>
                </div>
                <div class="p-3">
                    <p>Áp dụng cho đơn hàng: {{ number_format($voucher->min_price, 0, '', ',') }}<span
                            class="underline">đ</span> trở lên</p>
                </div>
                <div class="p-3">
                    <p>Hết hạn: <span class="transition text-red-500">{{ \Carbon\Carbon::parse($voucher->to)->format('d-m-Y')  }}</span></p>
                </div>
                <div class="p-3">
                    <button

                        data-clipboard-target="{{ '#code-' . $key }}"
                        class="btn bg-blue-400 hover:bg-blue-500 p-2 w-full rounded ring:none focus:outline-none focus:ring-2 focus:ring-500-50">
                        Sao chép
                    </button>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Paginate -->
    <div>
        {{$vouchers->links()}}
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
    <script>
        var clipboard = new ClipboardJS('.btn');

    </script>
@endsection
