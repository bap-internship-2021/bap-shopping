@extends('admin.layouts.layouts')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="col-4 p-3">
            <a href="{{route('admin.dashboard')}}" class="btn btn-primary">Quay lại</a>
        </div>
      <h1 class="pl-5">Khách hàng VIP</h1>
      <div class="col-8 card re-card st-card">
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Tên khách hàng</th>
                <th scope="col">Tổng hóa đơn</th>
                
              </tr>
            </thead>
            <tbody>
              @foreach($users as $key => $value)
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