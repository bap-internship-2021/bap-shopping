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
                <div class="col-6 align-self-center pb-3">
                <h1>Quản Lí Đơn Hàng</h1>
                </div>
            </div>
            <div class="row pb-3">
                @include('admin.order.nav')
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        @foreach ($orders as $order)
                        <tbody>
                            <tr onclick="location.href='{{route('admin.order.status', [$order['trangthai']])}}';" style="cursor: pointer;">
                                @if($order['trangthai'] == 1)
                                <th scope="row">Đang chờ</th>
                                @elseif($order['trangthai'] == 2)
                                <th scope="row">Đang giao</th>
                                @elseif($order['trangthai'] == 3)
                                <th scope="row">Hoàn thành</th>
                                @elseif($order['trangthai'] == 4)
                                <th scope="row">Đã hủy</th>
                                @endif
                                <td>
                                    <span>{{$order['soluong']}} ( đơn hàng )</span>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
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