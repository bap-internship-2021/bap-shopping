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
            <h4 class="page-title">Danh mục sản phẩm</h4>
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
                                <th scope="col">Danh mục</th>
                                <th scope="col" colspan="2">&nbsp</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($categories as $key => $ct){
                            ?>
                            <tr>
                                <th scope="row">{{$ct->id}}</th>
                                <td>{{$ct->name}}</td>
                                <td>
                                    <a href="{{route('category.edit', [$ct->id])}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                </td>
                                <td>
                                    <form action="{{route('category.destroy', $ct->id)}}" method="POST">
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
                                    <a href="{{route('category.create')}}"><button class="btn btn-primary" style="margin-top:20px" id="button">Thêm danh mục</button></a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection