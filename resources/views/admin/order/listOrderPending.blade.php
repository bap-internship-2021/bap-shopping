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
                    <h1>Quản Lí Đơn Hàng (Đang chờ)</h1>
                </div>
            </div>
            <div class="row pb-3">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admin.orderpending')}}">Đang chờ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admin.ordersending')}}">Đang giao</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Hoàn thành</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Đã Hủy</a>
                            </li>
                        </ul>
                      <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                      </form>
                    </div>
                  </nav>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Mã đơn hàng</th>
                                <th scope="col">Chi tiết đơn hàng</th>
                                <th scope="col">Duyệt đơn hàng</th>
                                <th scope="col">Hủy đơn hàng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($orders as $order){
                            ?>
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
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="8">
                                    <a href="{{route('admin.order.acceptall')}}"><button class="btn btn-primary" style="margin-top:20px" id="button">Duyệt tất cả</button></a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
        <div class="row">
            <div class="col">
                {{ $orders->links() }}
            </div>
        </div>

@endsection