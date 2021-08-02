@extends('admin.layouts.layouts')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="col-4 p-3">
        <a href="{{route('admin.dashboard')}}" class="btn btn-primary">Back</a>
    </div>
    <div class="col-8 pl-3">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              @foreach ($categories as $value)
                <li class="nav-item">
                  <a class="nav-link" href="{{route('admin.statistical.productByCategory', [$value->id])}}">{{$value->name}}</a>
                </li>
              @endforeach
            </ul>
            <form autocomplete="off" class="form-inline my-2 my-lg-0" action="" method="GET">
                <input class="form-control mr-sm-2" type="search" name="orderkey" id="orderkey" placeholder="Search" aria-label="Search" >
                <div id="search_order"></div>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
      </nav>
    </div>
</div>
</div>

@yield('dashboard')

@endsection()