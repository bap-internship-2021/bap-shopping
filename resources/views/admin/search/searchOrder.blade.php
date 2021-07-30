@extends('admin.layouts.layouts')

@section('content')

<div class="container-fluid">
    <div class="pb-5">
        <a href="#" class="btn btn-primary" id="back">Back</a>
    </div>
    <h1>Số lượng({{count($orders)}})</h1>
    <div class="row">
        <div class="col-6 card re-card st-card">
            <div class="card-body">
                @foreach($orders as $value)
                <table class="table table-striped table-dark">
                    <tbody>
                        <tr>
                            <td>Mã đơn hàng</td>
                            <td><span>{{$value->custom_order_id}}</span></td>
                        </tr>
                    </tbody>
                    
                </table>
                @endforeach
            </div>
        </div>
    </div>
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