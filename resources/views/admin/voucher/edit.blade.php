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
    <a href="{{route('voucher.show', [$voucher->id])}}" class="btn btn-primary">Back</a>
</div>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-3 align-self-center">
            <h4 class="page-title">Update Voucher</h4>
        </div>

    </div>
</div>

<div class="card-body">

<form action="{{route('voucher.update', [$voucher->id])}}" class="col-8 border p-5 rounded" method="POST">
    @method('PUT')
    @csrf
    <div class="form-group">
        <label for="exampleInputn">Name</label>
        <input type="text" value="{{$voucher->name}}" name="name" class="form-control " id="exampleInputn" aria-describedby="emailHelp">
    </div>

    <div class="form-group">
        <label for="exampleInputsc">Code</label>
        <input type="text" value="{{$voucher->code}}" name="code" class="form-control " id="exampleInputsc" aria-describedby="emailHelp">
    </div>

    <div class="form-group">
        <label for="exampleInputdc">Discount</label>
        <input type="text" value="{{$voucher->discount}}" name="discount" class="form-control" id="exampleInputdc" aria-describedby="emailHelp">
    </div>

    <div class="form-group">
        <label for="exampleInputsa">Quantity</label>
        <input type="text" value="{{$voucher->quantity}}" name="quantity" class="form-control" id="exampleInputsa" aria-describedby="emailHelp">
    </div>

    <div class="form-group">
        <label for="exampleInputm">Min price to apply</label>
        <input type="text" value="{{$voucher->min_price}}" name="min_price" class="form-control" id="exampleInputm" aria-describedby="emailHelp">
    </div>

    <div class="form-group">
        <label for="exampleInputproduct">Status</label>
        <select name="status" class="form-control" id="exampleInputproduct">
            <option {{$voucher->status == 1 ? 'selected' : ''}} value="1">DUE</option>
            <option {{$voucher->status == 2 ? 'selected' : ''}} value="2">EXPIRED</option>
        </select>
    </div>

    <div class="form-group">
        <label for="exampleInputf">From</label>
        <input type="date" value="{{date('Y-m-d', strtotime($voucher->from))}}" name="from" class="form-control" id="exampleInputf" aria-describedby="emailHelp">
    </div>

    <div class="form-group">
        <label for="exampleInputt">To</label>
        <input type="date" value="{{date('Y-m-d', strtotime($voucher->to))}}" name="to" class="form-control" id="exampleInputt" aria-describedby="emailHelp">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>
@endsection()


