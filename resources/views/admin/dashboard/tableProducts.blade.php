@extends('admin.dashboard.statisticalProduct')

@section('dashboard')
<div class="row pt-5">
    <div class="col-12">
      <h1 class="pl-5">Sản phẩm bán chạy nhất</h1>
      <div class="col-8 card re-card st-card">
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Số lượng đã bán</th>
                
              </tr>
            </thead>
            <tbody>
              @foreach($products as $key => $value)
                <tr>
                  <th scope="row">{{$key+1}}</th>
                  <td>{{$value->name}}</td>
                  <td>{{$value->soluong}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
