@extends('admin.layouts.layouts')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div>
            <a href="#" class="btn btn-primary" id="back">Back</a>
        </div>
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Chi tiết đơn hàng</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-6 card re-card st-card">
                @foreach($order as $value)
                <div class="card-body">
                    <table class="table table-striped table-dark">
                        <tbody>
                            <tr>
                                <td>Mã đơn hàng</td>
                                <td><span>{{$value->custom_order_id}}</span></td>
                            </tr>
                            <tr>
                                <td>Tình trạng</td>
                                @if($value->status == \App\Models\Order::PENDING_STATUS)
                                <td><span>Đang chờ xét duyệt</span></td>
                                @elseif($value->status == \App\Models\Order::SENDING_STATUS)
                                <td><span>Đang giao</span></td>
                                @elseif($value->status == \App\Models\Order::FINISH_STATUS)
                                <td><span>Hoàn thành</span></td>
                                @elseif($value->status == \App\Models\Order::CANCEL_STATUS)
                                <td><span>Đã hủy</span></td>
                                @endif
                            </tr>
                            <tr>
                                <td>Người mua</td>
                                <td><span>{{$value->name}}</span></td>
                            </tr>
                            <tr>
                                <td>Số điện thoại</td>
                                <td><span>{{$value->phone}}</span></td>
                            </tr>
                            <tr>
                                <td>Địa chỉ nhận hàng</td>
                                <td><span>{{$value->address}}</span></td>
                            </tr>
                            <tr>
                                <td>Tên sản phẩm</td>
                                <td><span>{{$value->productname}}</span></td>
                            </tr>
                            <tr>
                                <td>Số lượng</td>
                                <td><span>{{$value->quantity}}</span></td>
                            </tr>
                            <tr>
                                <td>Tổng tiền</td>
                                <td><span>{{$value->total_price}}$</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="pl-4">
                    @if($value->status == \App\Models\Order::PENDING_STATUS)
                    <h4 class="page-title">Xác nhận đơn hàng<a href="{{route('admin.order.accept', [$value->status])}}" class="btn btn-primary ml-2"><i class="fas fa-check-circle"></i></a></h4>
                    <h4 class="page-title">Hủy đơn hàng<a href="{{route('admin.order.cancel', [$value->status])}}" class="btn btn-danger ml-2"><i class="fas fa-window-close"></i></a></h4>
                    @elseif($value->status == \App\Models\Order::SENDING_STATUS)
                    <h4 class="page-title">Xác nhận hoàn thành<a href="{{route('admin.order.cancel', [$value->status])}}" class="btn btn-danger"><i class="fas fa-window-close"></i></a></h4>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    $(function(){
        $("#back").on("click", function(){
            window.history.back();
        });
    })
</script>
@endsection