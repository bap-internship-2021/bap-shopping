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
    <a href="{{route('voucher.index')}}" class="btn btn-primary">Back</a>
</div>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-3 align-self-center">
            <h4 class="page-title">Create Voucher</h4>
        </div>

    </div>
</div>

<div class="card-body">

<form action="{{route('voucher.store')}}" class="col-8 border p-5 rounded" method="POST">
    @csrf
    <div class="form-group">
        <label for="exampleInputn">Name</label>
        <input type="text" value="{{old('name')}}" name="name" class="form-control " id="exampleInputn" aria-describedby="emailHelp" placeholder="Name">
    </div>

    <div class="form-group">
        <label for="exampleInputsc">Code</label>
        <input type="text" value="{{old('code')}}" name="code" class="form-control " id="exampleInputsc" aria-describedby="emailHelp" placeholder="Code">
    </div>

    <div class="form-group">
        <label for="exampleInputdc">Discount</label>
        <input type="text" value="{{old('discount')}}" name="discount" class="form-control" id="exampleInputdc" aria-describedby="emailHelp" placeholder="Discount">
    </div>

    <div class="form-group">
        <label for="exampleInputsa">Quantity</label>
        <input type="text" value="{{old('quantity')}}" name="quantity" class="form-control" id="exampleInputsa" aria-describedby="emailHelp" placeholder="Quantity">
    </div>

    <div class="form-group">
        <label for="exampleInputm">Min price to apply</label>
        <input type="text" value="{{old('min_price')}}" name="min_price" class="form-control" id="exampleInputm" aria-describedby="emailHelp" placeholder="Min price">
    </div>

    <div class="form-group">
        <label for="exampleInputproduct">Status</label>
        <select name="status" class="form-control" id="exampleInputproduct">
            <option value="1">DUE</option>
            <option value="2">EXPIRED</option>
        </select>
    </div>

    <div class="form-group">
        <label for="exampleInputf">From</label>
        <input type="date" value="{{old('from')}}" name="from" class="form-control" id="exampleInputf" aria-describedby="emailHelp" placeholder="From">
    </div>

    <div class="form-group">
        <label for="exampleInputt">To</label>
        <input type="date" value="{{old('to')}}" name="to" class="form-control" id="exampleInputt" aria-describedby="emailHelp" placeholder="To">
    </div>

    <button type="submit" class="btn btn-primary">Add</button>
</form>
</div>
@endsection()


