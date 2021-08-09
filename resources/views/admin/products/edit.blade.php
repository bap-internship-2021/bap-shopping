@extends('admin.layouts.layouts')

@section('css')
    <link href="{{URL::asset('admin/dist/css/adminDashboard.css')}}" rel="stylesheet">
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
    <a href="{{route('products.index')}}" class="btn btn-primary">Quay lại</a>
</div>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-3 align-self-center">
            <h4 class="page-title">Chỉnh sửa sản phẩm</h4>
        </div>
        
    </div>
</div>

<div class="card-body">

<form action="{{route('products.update', [$product->id])}}" class="border p-5 rounded" method="POST" enctype='multipart/form-data'>
    @csrf   
    @method('PUT')
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="exampleInputct">Product Name</label>
                <input type="text" value="{{$product->name}}" name="name" class="form-control " id="exampleInputct" aria-describedby="emailHelp" >
            </div>
            
            <div class="form-group">
                <label for="exampleInputp">Price</label>
                <input type="text" value="{{$product->price}}" name="price" class="form-control" id="exampleInputp" aria-describedby="emailHelp" >
            </div>
        
            <div class="form-group">
                <label for="exampleInputq">Quantity</label>
                <input type="text" value="{{$product->quantity}}" name="quantity" class="form-control" id="exampleInputq" aria-describedby="emailHelp">
            </div>
        
            <div class="form-group">
                <label for="exampleInputctg">Category</label>
                <select name="category_id" class="form-control" id="exampleInputctg">
                    @foreach($categories as $ct)
                    <option {{$ct->id == $product->category_id ? 'selected' : ''}} value="{{$ct->id}}">{{$ct->name}}</option>
                    @endforeach
                </select>
            </div>
        
            <div class="form-group">
                <label for="exampleFormControlFile1">Product Image</label>
                <input type="file" class="form-control-file" name="files[]" multiple id="gallery-photo-add">
            </div>
            <div class="form-group">
                <div class="d-flex flex-row">
                    <div class="gallery"></div>  
                </div>
            </div>
        </div>


        <div class="col">
            <div class="form-group">
                <label for="exampleInputscreen">Screen</label>
                <input type="text" value="{{$product->specification->screen}}" name="screen" class="form-control" id="exampleInputscreen" aria-describedby="emailHelp" placeholder="Screen">
            </div>
            
            <div class="form-group">
                <label for="exampleInputCamera">Camera</label>
                <input type="text" value="{{$product->specification->camera}}" name="camera" class="form-control" id="exampleInputCamera" aria-describedby="emailHelp" placeholder="Camera">
            </div>
        
            <div class="form-group">
                <label for="exampleInputCameraSelfie">Camera Selfie</label>
                <input type="text" value="{{$product->specification->camera_selfie}}" name="camera_selfie" class="form-control" id="exampleInputCameraSelfie" aria-describedby="emailHelp" placeholder="Camera Selfie">
            </div>
        
            <div class="form-group">
                <label for="exampleInputRam">Ram</label>
                <input type="text" value="{{$product->specification->ram}}" name="ram" class="form-control" id="exampleInputRam" aria-describedby="emailHelp" placeholder="Ram">
            </div>
        
            <div class="form-group">
                <label for="exampleInputIM">Internal Memory</label>
                <input type="text" value="{{$product->specification->internal_memory}}" name="internal_memory" class="form-control" id="exampleInputIM" aria-describedby="emailHelp" placeholder="Internal Memory">
            </div>
        
            <div class="form-group">
                <label for="exampleInputCPU">CPU</label>
                <input type="text" value="{{$product->specification->cpu}}" name="cpu" class="form-control" id="exampleInputCPU" aria-describedby="emailHelp" placeholder="CPU">
            </div>
        
            <div class="form-group">
                <label for="exampleInputGPU">GPU</label>
                <input type="text" value="{{$product->specification->gpu}}" name="gpu" class="form-control" id="exampleInputGPU" aria-describedby="emailHelp" placeholder="GPU">
            </div>
        
            <div class="form-group">
                <label for="exampleInputPIN">PIN</label>
                <input type="text" value="{{$product->specification->pin}}" name="pin" class="form-control" id="exampleInputPIN" aria-describedby="emailHelp" placeholder="PIN">
            </div>
        
            <div class="form-group">
                <label for="exampleInputSIM">SIM</label>
                <input type="text" value="{{$product->specification->sim}}" name="sim" class="form-control" id="exampleInputSIM" aria-describedby="emailHelp" placeholder="SIM">
            </div>
        
            <div class="form-group">
                <label for="exampleInputOS">Operating System</label>
                <input type="text" value="{{$product->specification->operating_system}}" name="operating_system" class="form-control" id="exampleInputOS" aria-describedby="emailHelp" placeholder="Operating System">
            </div>
        
            <div class="form-group">
                <label for="exampleInputMI">Made in</label>
                <input type="text" value="{{$product->specification->made_in}}" name="made_in" class="form-control" id="exampleInputMI" aria-describedby="emailHelp" placeholder="Made in">
            </div>
        
            <div class="form-group">
                <label for="exampleInputRT">Release Time</label>
                <input type="date" value="{{$product->specification->release_time}}" name="release_time" class="form-control" id="exampleInputRT" aria-describedby="emailHelp" placeholder="release Time">
            </div>
        
            <div class="form-group">
                <label for="exampleInputct">Description</label>
                <textarea id="demo" name="description" class="form-control" rows="8" style="resize:none">{!! $product->specification->description !!}</textarea>
            </div>
        </div>
    </div>
        
    

    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>   


</div> 
@endsection()

@section('js')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script> CKEDITOR.replace('demo'); </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        $(function() {
            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#gallery-photo-add').on('change', function() {
                imagesPreview(this, 'div.gallery');
            });
        });
    </script>
@endsection
