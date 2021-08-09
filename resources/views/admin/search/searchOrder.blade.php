@extends('admin.layouts.layouts')

@section('content')

<div class="container-fluid">
    <div class="pb-5">
        <a href="#" class="btn btn-primary" id="back">Quay lại</a>
    </div>
    @if(count($orders) == 0)
    <h1>Không tìm thấy sản phẩm</h1>
    @else 
    <h1>Số lượng({{count($orders)}})</h1>
    <div class="row">
        <div class="col-6 card re-card st-card">
            <div class="card-body">
                @foreach($orders as $value)
                <table class="table table-striped table-dark">
                    <tbody>
                        <tr onclick="location.href='{{route('admin.order.detail', [$value->id])}}';" style="cursor: pointer;">
                            <td>Mã đơn hàng</td>
                            <td><span>{{$value->custom_order_id}}</span></td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
{{ $orders->links() }}
@endsection()

@section('js')
<script>
    $(function(){
        $("#back").on("click", function(){
            window.history.back();
        });
    })
</script>
@endsection