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
            <a href="{{route('admin.orderpending')}}" class="btn btn-primary">Quay lại</a>
        </div>
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Form hủy đơn hàng</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                @foreach($order as $value)
                <form  action="{{route('admin.order.confirmcancel', [$value->id])}}" class="col-11 border p-5 rounded" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="staticEmail">Send to</label>
                        <input type="text" name="email" readonly class="form-control-plaintext" id="staticEmail" value="{{$value->useremail}}">
                    </div>
                    <div class="form-group">
                        <label for="inputContent">Nội dung</label>
                        <textarea class="form-control" name="content" id="inputContent" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                  </form>
                  @endforeach
            </div>
            <div class="col-6 card re-card st-card">
                <div class="card-body">
                    <table class="table table-striped table-dark">
                        @foreach($order as $value)
                        <tbody>
                            <tr>
                                <td>Mã đơn hàng</td>
                                <td><span>{{$value->custom_order_id}}</span></td>
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
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    

@endsection