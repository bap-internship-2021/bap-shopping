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
    <a href="{{route('category.index')}}" class="btn btn-primary">Quay lại</a>
</div>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-4 align-self-center">
            <h4 class="page-title">Cập nhật danh mục sản phẩm</h4>
        </div>
        
    </div>
</div>

<div class="card-body">

<form action="{{route('category.update', [$category->id])}}" method="POST">
    @method('PUT')
    @csrf
    <div class="form-group">
        <label for="exampleInputct">Tên danh mục sản phẩm</label>
        <input type="text" value="{{$category->name}}" name="name" class="form-control" id="exampleInputct" aria-describedby="emailHelp">
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>   
</div> 
@endsection()
