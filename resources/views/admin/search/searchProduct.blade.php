@extends('admin.layouts.layouts')

@section('content')
<div>
    <a href="{{route('products.index')}}" class="btn btn-primary">Back</a>
</div>
<div class="container-fluid" style="box-sizing:border-box">
    <h1>Results({{count($products)}})</h1>
    <div class="row" >
        @foreach($products as $value)
        <div class="column p-3">
            <h3>{{$value->name}}</h3>
            
            <img src="{{asset('admin/images/products/'.$value->images[0]['path'])}}" style="width:200px; height:250px">
            <h3><a href="{{route('products.show', [$value->id])}}" class="btn btn-primary">Detail</a></h3>
        </div>
        @endforeach
    </div>
</div>
{{ $products->links() }}
@endsection()