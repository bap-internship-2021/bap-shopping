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
            <h4 class="page-title">Create Sale</h4>
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
        <label for="exampleInputsc">Sale Code</label>
        <input type="text" value="{{old('sale_code')}}" name="sale_code" class="form-control " id="exampleInputsc" aria-describedby="emailHelp" placeholder="sale_code">
    </div>

    <div class="form-group">
        <label for="exampleInputdc">Discount</label>
        <input type="text" value="{{old('discount')}}" name="discount" class="form-control" id="exampleInputdc" aria-describedby="emailHelp" placeholder="Discount">
    </div>

    <div class="form-group">
        <label for="exampleInputsa">Sale Amount</label>
        <input type="text" value="{{old('sales_amount')}}" name="sales_amount" class="form-control" id="exampleInputsa" aria-describedby="emailHelp" placeholder="Sale Amount">
    </div>

    <div class="form-group">
        <label for="exampleInputm">Min price to apply</label>
        <input type="text" value="{{old('min_price_to_apply')}}" name="min_price_to_apply" class="form-control" id="exampleInputm" aria-describedby="emailHelp" placeholder="Min price">
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


