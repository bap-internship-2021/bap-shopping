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
                    <h4 class="page-title">Products</h4>
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
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Specification</th>
                                        <th scope="col" colspan="2">&nbsp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach($products as $key => $pd){
                                    ?>
                                    <tr>
                                        <th scope="row">{{$pd->id}}</th>
                                        <td>{{$pd->name}}</td>
                                        <td>{{$pd->price}}$</td>
                                        <td>{{$pd->quantity}}</td>
                                        <td>{{$pd->category->name}}</td>
                                        <td><img src="{{asset('admin/images/products/'.$pd->images[2]['path'])}}" style="width: 160px; height:180px"></td>
                                        <td><a href="{{route('product.specification', [$pd->id])}}" class="btn btn-danger"><i class="fas fa-eye"></i></a></td>
                                        <td>
                                            <a href="{{route('products.edit', [$pd->id])}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                        </td>
                                        <td>
                                            <form action="{{route('products.destroy', $pd->id)}}" method="POST">
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
                                            <a href="{{route('products.create')}}"><button class="btn btn-primary" style="margin-top:20px" id="button">Add Product</button></a>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
        <div class="row">
            <div class="col">
                {{ $products->links() }}
            </div>
        </div>

@endsection
