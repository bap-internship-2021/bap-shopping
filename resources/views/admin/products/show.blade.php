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
<div>
    <a href="{{route('products.index')}}" class="btn btn-primary">Back</a>
</div>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-2 p-3 align-self-center">
            <h3 class="page-title text-white bg-dark rounded-circle p-2">Detail Product</h3>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        @foreach($product as $key => $value)
            <div class="col-sm-6">
                <h1>{{$value->name}}</h1>
                <div class="my-slider">
                    
                    @foreach($value->images as $image)
                    <div>
                        <img src="{{asset('admin/images/products/'.$image->path)}}" style="width:250px; height: 300px;">
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-5">
                <h1>Detail</h1>
                <table class="table table-striped table-dark">
                    <tbody>
                        <tr>
                            <td class="col-3">Category</td>
                            <td>{{$value->category}}</td>
                        </tr>
                        <tr>
                            <td class="col-3">Price</td>
                            <td>{{$value->price}}$</td>
                        </tr>
                        <tr>
                            <td class="col-3">Quantity</td>
                            <td>{{$value->quantity}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-6 pt-5">
            <div class="card re-card st-card">
                <div class="card-body">
                    <h2 class="card-title text-center">Description</h2>
                    <div class="card-body">
                        @foreach ($specification as $value)
                        {!! $value->description !!}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>  
        <div class="col-6 pt-5">
            <div class="card re-card st-card">
                @if(count($specification) == 0)
                <div class="col-8 p-3 align-self-center">
                    <h3 class="page-title text-white bg-dark rounded-circle p-5">The product has no specifications. Please create<a href="{{route('specification.create')}}"><button class="btn btn-primary" style="margin-top:20px" id="button">Create Now</button></a></h3>
                </div>
                @endif
                <h2 class="card-title p-3 text-center">Specification</h2>
                <div class="card-body">
                    <table class="table table-striped table-dark">
                        @foreach ($specification as $value)
                        <tbody>
                            <tr>
                                <td>Screen</td>
                                <td><span>{{$value->screen}}</span></td>
                            </tr>
                            <tr>
                                <td>Camera</td>
                                <td><span>{{$value->camera}}</span></td>
                            </tr>
                            <tr>
                                <td>Camera Selfie</td>
                                <td><span>{{$value->camera_selfie}}</span></td>
                            </tr>
                            <tr>
                                <td>Ram</td>
                                <td><span>{{$value->ram}}</span></td>
                            </tr>
                            <tr>
                                <td>Internal Memory</td>
                                <td><span>{{$value->internal_memory}}</span></td>
                            </tr>
                            <tr>
                                <td>CPU</td>
                                <td><span>{{$value->cpu}}</span></td>
                            </tr>
                            <tr>
                                <td>GPU</td>
                                <td><span>{{$value->gpu}}</span></td>
                            </tr>
                            <tr>
                                <td>PIN</td>
                                <td><span>{{$value->pin}}</span></td>
                            </tr>
                            <tr>
                                <td>SIM</td>
                                <td><span>{{$value->sim}}</span></td>
                            </tr>
                            <tr>
                                <td>Operating System</td>
                                <td><span>{{$value->operating_system}}</span></td>
                            </tr>
                            <tr>
                                <td>Made In</td>
                                <td><span>{{$value->made_in}}</span></td>
                            </tr>
                            <tr>
                                <td>Release Time</td>
                                <td><span>{{$value->release_time}}</span></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="8">
                                    <a href="{{route('specification.edit', [$value->id])}}"><button class="btn btn-primary" style="margin-top:20px" id="button">Edit Specification</button></a>
                                </td>
                            </tr>
                        </tfoot>
                        @endforeach
                    </table>
                </div>
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