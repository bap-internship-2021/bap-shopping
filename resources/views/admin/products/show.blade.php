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
    <a href="{{route('products.index')}}" class="btn btn-primary mb-2">Quay lại</a>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <h1>Hình ảnh sản phẩm</h1>
            <div id="carouselExampleControls" class="carousel slide col-8" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img src="{{asset('admin/images/products/'.$product->images->first()->path)}}" style="width:250px; height: 300px;" class="d-block w-100" alt="...">
                    </div>
                    @foreach($product->images as $key => $image)
                    @if($key > 0)
                    <div class="carousel-item">
                    <img src="{{asset('admin/images/products/'.$image->path)}}" style="width:250px; height: 300px;" class="d-block w-100" alt="...">
                    </div>
                    @endif
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        
        <div class="col-6">
            <h1>Chi tiết sản phẩm</h1>
            <table class="table table-striped table-dark">
                <tbody>
                    <tr>
                        <td class="col-3">Tên sản phẩm</td>
                        <td>{{$product->name}}</td>
                    </tr>
                    <tr>
                        <td class="col-3">Danh mục</td>
                        <td>{{$product->category}}</td>
                    </tr>
                    <tr>
                        <td class="col-3">Giá</td>
                        <td>{{ number_format($product->price, 0, '', ',') }} VNĐ</td>
                    </tr>
                    <tr>
                        <td class="col-3">Số lượng</td>
                        <td>{{$product->quantity}}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8">
                            <a href="{{route('products.edit', [$product->id])}}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-6 pt-5">
            <div class="card re-card st-card">
                <div class="card-body">
                    <h2 class="card-title text-center">Mô tả sản phẩm</h2>
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
                <h2 class="card-title p-3 text-center">Thông số kĩ thuật</h2>
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