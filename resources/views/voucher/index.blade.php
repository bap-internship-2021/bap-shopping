@extends('layouts.master')
@section('title', 'Mã Khuyến mãi')
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
    <div>
        @if($vouchers->count() > 0)
            <div class="grid grid-cols-3 gap-2 pt-5 px-5">
                @foreach($vouchers as $key => $voucher)
                    <div class="bg-gray-50 shadow-inner transition duration-300 ease-in-out hover:shadow-lg rounded-lg">
                        <div class="bg-green-400 rounded-t-lg" style="background-color: #0c3254">
                            <p class="text-center text-white p-2">{{ $voucher->name }}</p>
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
                            <p>Hết hạn: <span
                                    class="transition text-red-500">{{ \Carbon\Carbon::parse($voucher->to)->format('d-m-Y')  }}</span>
                            </p>
                        </div>
                        <div class="p-3">
                            <button

                                data-clipboard-target="{{ '#code-' . $key }}"
                                class="btn bg-blue-400 hover:bg-blue-500 p-2 w-full rounded ring:none focus:outline-none focus:ring-2 focus:ring-500-50"
                                style="background-color: #0c3254">
                                Sao chép
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Paginate -->
            <div id="pagination">
                {{$vouchers->links()}}
            </div>
        @else
            <h1 class="text-center text-2xl pt-5">Tạm thời chưa có mã khuyến mãi.</h1>
        @endif
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
    <script>
        var clipboard = new ClipboardJS('.btn');
    </script>
@endsection
