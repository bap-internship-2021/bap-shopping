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
                <div class="col-5 align-self-center">
                    <h4 class="page-title">Detail Voucher</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-5 card re-card st-card">
                <div class="card-body">
                    <table class="table table-striped table-dark">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td><span>{{$voucher->name}}</span></td>
                            </tr>
                            <tr>
                                <td>Code</td>
                                <td><span>{{$voucher->code}}</span></td>
                            </tr>
                            <tr>
                                <td>Discount</td>
                                <td><span>{{$voucher->discount}}</span></td>
                            </tr>
                            <tr>
                                <td>Min Price</td>
                                <td><span>{{$voucher->min_price}}</span></td>
                            </tr>
                            <tr>
                                <td>Quantity</td>
                                <td><span>{{$voucher->quantity}}</span></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><span>{{$voucher->status == 1 ? 'Due' : 'Expired'}}</span></td>
                            </tr>
                            <tr>
                                <td>From</td>
                                <td><span>{{$voucher->from}}</span></td>
                            </tr>
                            <tr>
                                <td>to</td>
                                <td><span>{{$voucher->to}}</span></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="8">
                                    <a href="{{route('voucher.edit', [$voucher->id])}}"><button class="btn btn-primary" style="margin-top:20px" id="button">Edit Voucher</button></a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    

@endsection