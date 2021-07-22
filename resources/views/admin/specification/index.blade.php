@extends('admin.layouts.layouts')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/tiny-slider.css">
<style>
    #tns1-ow > button {
        display: none;
    }
</style>
@endsection

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
        <div class="col-2 p-3 align-self-center">
            <h3 class="page-title text-white bg-dark rounded-circle p-2">Detail Product</h3>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="flex flex-row">
        @foreach($product as $key => $value)
            <div>
                <h1>{{$value->name}}</h1>
                <div class="my-slider">
                    
                    @foreach($value->images as $image)
                    <div>
                        <img src="{{asset('admin/images/products/'.$image->path)}}" style="width:250px; height: 300px;">
                    </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-8 p-5">
        <div class="card">
            <div class="table-responsive">
                <table class="table table-striped table-dark">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                      </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8">
                                <a href="{{route('product.specification.create')}}"><button class="btn btn-primary" style="margin-top:20px" id="button">Add</button></a>
                            </td>
                        </tr>
                    </tfoot>
                  </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
<script>
    var slider = tns({
        container: '.my-slider',
        items: 1,
        slideBy: 'page',
        autoplay: true,
        controls: false,
        nav: false
    });
</script>
<script type="text/javascript">
    window.csrf_token = "{{ csrf_token() }}"
</script>
<script src="{{ mix('js/app.js') }}"></script>
@endsection
