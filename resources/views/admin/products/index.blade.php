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
        <div class="col-md-12 p-2">
        <form autocomplete="off" class="form-inline my-2 my-lg-0" action="" method="POST">
                @csrf
                <input class="form-control mr-sm-2" type="search" name="keywords" id="keywords" placeholder="Search" aria-label="Search" >
                <div id="search_ajax"></div>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>

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
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
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
                                
                                <td>
                                    <a href="{{route('products.edit', [$pd->id])}}" class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                    <form action="{{route('products.destroy', $pd->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                        <button type="submit" onclick="return confirm('Bạn chắc chắn muốn xóa?');" class="btn btn-danger">Delete</button>
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
    </div>
</div>
{{ $products->links() }}

@endsection