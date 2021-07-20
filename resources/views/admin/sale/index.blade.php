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

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Sales</h4>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Sale_code</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Sale_amount</th>
                                <th scope="col">Min_price_to_apply</th>
                                <th scope="col">From</th>
                                <th scope="col">to</th>
                                <th scope="col" colspan="2">&nbsp</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($sales as $key => $sale){
                            ?>
                            <tr>
                                <th scope="row">{{$sale->id}}</th>
                                <td>{{$sale->name}}</td>
                                <td>{{$sale->sale_code}}</td>
                                <td>{{$sale->discount}}%</td>
                                <td>{{$sale->sales_amount}}</td>
                                <td>{{$sale->min_price_to_apply}}$</td>
                                <td>{{$sale->from}}</td>
                                <td>{{$sale->to}}</td>
                                <td>
                                    <a href="{{route('sale.edit', [$sale->id])}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                </td>
                                <td>
                                    <form action="{{route('sale.destroy', $sale->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                        <button type="submit" onclick="return confirm('Bạn chắc chắn muốn xóa?');" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="8">
                                    <a href="{{route('sale.create')}}"><button class="btn btn-primary" style="margin-top:20px" id="button">Add Sale</button></a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{ $sales->links() }}

@endsection