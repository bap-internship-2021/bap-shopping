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

        <div class="page-breadcrumb">
            <div class="row">
                
                <div class="col-12 align-self-center">
                    <h1>Danh sách đơn hàng</h1>
                </div>
                
                
            </div>
            <div class="row pb-2">
                @include('admin.order.nav')
            </div>
            <div class="col-12">
                <h2>Số lượng ({{count($orders)}})</h2>
            </div>
        </div>
        @foreach ($orders as $order)
        @endforeach
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-striped">
                        @if($orders->count() > 0 && $order->status == \App\Models\Order::PENDING_STATUS)
                        <thead>
                            <tr>
                                <th scope="col">Mã đơn hàng</th>
                                <th scope="col">Chi tiết đơn hàng</th>
                                <th scope="col">Duyệt đơn hàng</th>
                                <th scope="col">Hủy đơn hàng</th>
                            </tr>
                        </thead>
                        <tbody>   
                            @foreach($orders as $order)
                            <tr>
                                <th scope="row">{{$order->custom_order_id}}</th>
                                <td>
                                    <a href="{{route('admin.order.detail', [$order->id])}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                </td>
                                <td>
                                    <a href="{{route('admin.order.accept', [$order->id])}}" class="btn btn-primary"><i class="fas fa-check-circle"></i></a>
                                </td>
                                <td>
                                    <a href="{{route('admin.order.cancel', [$order->id])}}" class="btn btn-danger"><i class="fas fa-window-close"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="8">
                                    <a href="{{route('admin.order.acceptall')}}"><button class="btn btn-primary" style="margin-top:20px" id="button">Duyệt tất cả</button></a>
                                </td>
                            </tr>
                        </tfoot>    
        
                        @elseif($orders->count() > 0 && $order->status == \App\Models\Order::SENDING_STATUS)
                        <thead>
                            <tr>
                                <th scope="col">Mã đơn hàng</th>
                                <th scope="col">Chi tiết đơn hàng</th>
                                <th scope="col">Tình trạng</th>
                                <th scope="col">Xác nhận</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <th scope="row">{{$order->custom_order_id}}</th>
                                <td>
                                    <a href="{{route('admin.order.detail', [$order->id])}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                </td>
                                <td>
                                    <span>Đang giao</span>
                                    <i class="fas fa-truck"></i>
                                </td>
                                <td>
                                    <a href="{{route('admin.order.finish', [$order->id])}}" class="btn btn-primary"><i class="fas fa-check-circle"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    @elseif($orders->count() > 0 && $order->status == \App\Models\Order::FINISH_STATUS)
                        <thead>
                            <tr>
                                <th scope="col">Mã đơn hàng</th>
                                <th scope="col">Chi tiết đơn hàng</th>
                                <th scope="col">Tình trạng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                
                                <th scope="row">{{$order->custom_order_id}}</th>
                                <td>
                                    <a href="{{route('admin.order.detail', [$order->id])}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                </td>
                                <td>
                                    <span>Đã hoàn thành</span>
                                    <i class="fas fa-check-circle"></i>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    @elseif($orders->count() > 0 && $order->status == \App\Models\Order::CANCEL_STATUS)
                        <thead>
                            <tr>
                                <th scope="col">Mã đơn hàng</th>
                                <th scope="col">Chi tiết đơn hàng</th>
                                <th scope="col">Tình trạng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                
                                <th scope="row">{{$order->custom_order_id}}</th>
                                <td>
                                    <a href="{{route('admin.order.detail', [$order->id])}}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                </td>
                                <td>
                                    <span>Đã Hủy</span>
                                    <i class="fas fa-ban"></i>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>

                {{ $orders->links() }}
            </div>
        </div>

@endsection

@section('js')
<script type="text/javascript">
    $('#orderkey').keyup(function(){
        var orderkey = $(this).val();

        if(orderkey != '') {
            // var _token = $('input[name="_token"]').val();

            $.ajax({
                url:"{{URL('admin/search-orders')}}",
                method:"POST",
                data:{
                    orderkey: orderkey, 
                    _token: '{{csrf_token()}}'
                    },
                success:function(data) {
                    console.log(data);
                    $('#search_order').fadeIn();
                    $('#search_order').html(data);
                }
            });

        } else {
            $('#search_order').fadeOut();
        }
    });

    $(document).on('click', '.li_search_order', function(){
        $('#orderkey').val( $(this).text() );
        $('#search_order').fadeOut();
    })
</script>
@endsection