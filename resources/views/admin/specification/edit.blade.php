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
    @foreach ($specification as $item)
    <a href="{{route('products.show', [$item->product_id])}}" class="btn btn-primary">Back</a>
    @endforeach
</div>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-3 align-self-center">
            <h4 class="page-title">Update Specification</h4>
        </div>

    </div>
</div>

<div class="card-body">
@foreach ($specification as $item)
<form action="{{route('specification.update', [$item->id])}}" class="col-8 border p-5 rounded" method="POST">
    @method('PUT')
    @csrf
    <div class="form-group">
        <label for="exampleInputscreen">Screen</label>
        <input type="text" value="{{$item->screen}}" name="screen" class="form-control" id="exampleInputscreen" aria-describedby="emailHelp" placeholder="Screen">
    </div>
    
    <div class="form-group">
        <label for="exampleInputCamera">Camera</label>
        <input type="text" value="{{$item->camera}}" name="camera" class="form-control" id="exampleInputCamera" aria-describedby="emailHelp" placeholder="Camera">
    </div>

    <div class="form-group">
        <label for="exampleInputCameraSelfie">Camera Selfie</label>
        <input type="text" value="{{$item->camera_selfie}}" name="camera_selfie" class="form-control" id="exampleInputCameraSelfie" aria-describedby="emailHelp" placeholder="Camera Selfie">
    </div>

    <div class="form-group">
        <label for="exampleInputRam">Ram</label>
        <input type="text" value="{{$item->ram}}" name="ram" class="form-control" id="exampleInputRam" aria-describedby="emailHelp" placeholder="Ram">
    </div>

    <div class="form-group">
        <label for="exampleInputIM">Internal Memory</label>
        <input type="text" value="{{$item->internal_memory}}" name="internal_memory" class="form-control" id="exampleInputIM" aria-describedby="emailHelp" placeholder="Internal Memory">
    </div>

    <div class="form-group">
        <label for="exampleInputCPU">CPU</label>
        <input type="text" value="{{$item->cpu}}" name="cpu" class="form-control" id="exampleInputCPU" aria-describedby="emailHelp" placeholder="CPU">
    </div>

    <div class="form-group">
        <label for="exampleInputGPU">GPU</label>
        <input type="text" value="{{$item->gpu}}" name="gpu" class="form-control" id="exampleInputGPU" aria-describedby="emailHelp" placeholder="GPU">
    </div>

    <div class="form-group">
        <label for="exampleInputPIN">PIN</label>
        <input type="text" value="{{$item->pin}}" name="pin" class="form-control" id="exampleInputPIN" aria-describedby="emailHelp" placeholder="PIN">
    </div>

    <div class="form-group">
        <label for="exampleInputSIM">SIM</label>
        <input type="text" value="{{$item->sim}}" name="sim" class="form-control" id="exampleInputSIM" aria-describedby="emailHelp" placeholder="SIM">
    </div>

    <div class="form-group">
        <label for="exampleInputOS">Operating System</label>
        <input type="text" value="{{$item->operating_system}}" name="operating_system" class="form-control" id="exampleInputOS" aria-describedby="emailHelp" placeholder="Operating System">
    </div>

    <div class="form-group">
        <label for="exampleInputMI">Made in</label>
        <input type="text" value="{{$item->made_in}}" name="made_in" class="form-control" id="exampleInputMI" aria-describedby="emailHelp" placeholder="Made in">
    </div>

    <div class="form-group">
        <label for="exampleInputRT">Release Time</label>
        <input type="date" value="{{$item->release_time}}" name="release_time" class="form-control" id="exampleInputRT" aria-describedby="emailHelp" placeholder="release Time">
    </div>

    <div class="form-group">
        <label for="exampleInputct">Description</label>
        <textarea id="demo" name="description" class="form-control" rows="8" style="resize:none">{!! $item->description !!}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endforeach
</div>
@endsection()


@section('js')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script> CKEDITOR.replace('demo'); </script>
@endsection

