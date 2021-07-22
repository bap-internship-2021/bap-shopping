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
            <h4 class="page-title">Update Sale</h4>
        </div>

    </div>
</div>

<div class="card-body">

<form action="{{route('voucher.update', [$sale->id])}}" class="col-8 border p-5 rounded" method="POST">
    @method('PUT')
    @csrf
    <div class="form-group">
        <label for="exampleInputn">Name</label>
        <input type="text" value="{{$sale->name}}" name="name" class="form-control " id="exampleInputn" aria-describedby="emailHelp">
    </div>

    <div class="form-group">
        <label for="exampleInputsc">Sale Code</label>
        <input type="text" value="{{$sale->sale_code}}" name="sale_code" class="form-control " id="exampleInputsc" aria-describedby="emailHelp">
    </div>

    <div class="form-group">
        <label for="exampleInputdc">Discount</label>
        <input type="text" value="{{$sale->discount}}" name="discount" class="form-control" id="exampleInputdc" aria-describedby="emailHelp">
    </div>

    <div class="form-group">
        <label for="exampleInputsa">Sale Amount</label>
        <input type="text" value="{{$sale->sales_amount}}" name="sales_amount" class="form-control" id="exampleInputsa" aria-describedby="emailHelp">
    </div>

    <div class="form-group">
        <label for="exampleInputm">Min price to apply</label>
        <input type="text" value="{{$sale->min_price_to_apply}}" name="min_price_to_apply" class="form-control" id="exampleInputm" aria-describedby="emailHelp" placeholder="Min price">
    </div>

    <div class="form-group">
        <label for="exampleInputf">From</label>
        <input type="date" value="{{date('Y-m-d', strtotime($sale->from))}}" name="from" class="form-control" id="exampleInputf" aria-describedby="emailHelp">
    </div>

    <div class="form-group">
        <label for="exampleInputt">To</label>
        <input type="date" value="{{date('Y-m-d', strtotime($sale->to))}}" name="to" class="form-control" id="datepicker">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>
@endsection()


