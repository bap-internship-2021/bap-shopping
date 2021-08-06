@extends('admin.layouts.layouts')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="col-4 p-3">
            <a href="{{route('admin.dashboard')}}" class="btn btn-primary">Quay lại</a>
        </div>
      <h1 class="pl-5">Thống kê truy cập</h1>
      <div class="col-8 card re-card st-card">
        <div class="card-body">
          <table class="table table-striped table-dark">
            <thead>
              <tr>
                <th scope="col">Đang online</th>
                <th scope="col">Truy cập tháng trước</th>
                <th scope="col">Truy cập tháng này</th>
                <th scope="col">Tổng truy cập một năm</th>
                <th scope="col">Tổng truy cập</th>
              </tr>
            </thead>
            <tbody>
              {{-- @foreach($products as $key => $value) --}}
                <tr>
                    <td>{{$visitor_count}}</td>
                    <td>{{$visitor_last_month_count}}</td>
                    <td>{{$visitor_this_month_count}}</td>
                    <td>{{$visitor_of_year_count}}</td>
                    <td>{{$visitors_total}}</td>
                </tr>
              {{-- @endforeach --}}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection