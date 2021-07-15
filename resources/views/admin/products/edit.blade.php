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
    <a href="{{route('products.index')}}" class="btn btn-primary">Back</a>
</div>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-3 align-self-center">
            <h4 class="page-title">Update Product</h4>
        </div>
        
    </div>
</div>

<div class="card-body">

<form action="{{route('products.update', [$product->id])}}" class="col-8 border p-5 rounded" method="POST" enctype='multipart/form-data'>
    @csrf   
    @method('PUT')
    <div class="form-group">
        <label for="exampleInputct">Product Name</label>
        <input type="text" value="{{$product->name}}" name="name" class="form-control " id="exampleInputct" aria-describedby="emailHelp" >
    </div>
    
    <div class="form-group">
        <label for="exampleInputp">Price</label>
        <input type="text" value="{{$product->price}}" name="price" class="form-control" id="exampleInputp" aria-describedby="emailHelp" >
    </div>

    <div class="form-group">
        <label for="exampleInputq">Quantity</label>
        <input type="text" value="{{$product->quantity}}" name="quantity" class="form-control" id="exampleInputq" aria-describedby="emailHelp">
    </div>

    <div class="form-group">
        <label for="exampleInputctg">Category</label>
        <select name="category_id" class="form-control" id="exampleInputctg">
            @foreach($categories as $ct)
            <option {{$ct->id == $product->category_id ? 'selected' : ''}} value="{{$ct->id}}">{{$ct->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="exampleFormControlFile1">Product Image</label>
        <input type="file" class="form-control-file" name="file" id="exampleFormControlFile1">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>   
</div> 
@endsection()
