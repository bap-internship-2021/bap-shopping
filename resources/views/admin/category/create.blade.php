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
    <a href="{{route('category.index')}}" class="btn btn-primary">Back</a>
</div>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-3 align-self-center">
            <h4 class="page-title">Create Category</h4>
        </div>
        
    </div>
</div>

<div class="card-body">

<form action="{{route('category.store')}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="exampleInputct">Category Name</label>
        <input type="text" value="{{old('name')}}" name="name" class="form-control" id="exampleInputct" aria-describedby="emailHelp" placeholder="Name">
    </div>
    <button type="submit" class="btn btn-primary">Add</button>
</form>   
</div> 
@endsection()
