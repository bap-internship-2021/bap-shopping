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
            <div class="col-6 align-self-center">
                <h4 class="page-title">Sản phẩm</h4>
            </div>
            <div class="col-6 align-self-center">
                <h4 class="page-title">Thông số kĩ thuật</h4>
            </div>
            
        </div>
    </div>
    <form action="{{route('products.store')}}" class="col-12 border p-5 rounded" method="POST" enctype='multipart/form-data'>
        @csrf
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="exampleInputct">Tên sản phẩm</label>
                    <input type="text" value="{{old('name')}}" name="name" class="form-control " id="exampleInputct" aria-describedby="emailHelp" placeholder="Nhập tên sản phẩm...">
                </div>
                
                <div class="form-group">
                    <label for="exampleInputp">Giá tiền sản phẩm</label>
                    <input type="text" value="{{old('price')}}" name="price" class="form-control" id="exampleInputp" aria-describedby="emailHelp" placeholder="Nhập giá tiền...">
                </div>

                <div class="form-group">
                    <label for="exampleInputq">Số lượng</label>
                    <input type="text" value="{{old('quantity')}}" name="quantity" class="form-control" id="exampleInputq" aria-describedby="emailHelp" placeholder="Nhập số lượng...">
                </div>

                <div class="form-group">
                    <label for="exampleInputctg">Danh mục sản phẩm</label>
                    <select name="category_id" class="form-control" id="exampleInputctg">
                        @foreach($categories as $key => $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlFile1">Hình ảnh sản phẩm</label>
                    <input type="file" class="form-control-file" name="files[]" multiple id="gallery-photo-add">
                </div>

                <button type="submit" class="btn btn-primary">Thêm</button>
            </div>
            
            <div class="col">
                <div class="form-group">
                    <label for="exampleInputscreen">Màn hình</label>
                    <input type="text" value="{{old('screen')}}" name="screen" class="form-control" id="exampleInputscreen" aria-describedby="emailHelp" placeholder="Thông số màn hình...">
                </div>
                
                <div class="form-group">
                    <label for="exampleInputCamera">Camera</label>
                    <input type="text" value="{{old('camera')}}" name="camera" class="form-control" id="exampleInputCamera" aria-describedby="emailHelp" placeholder="Thông số Camera...">
                </div>
            
                <div class="form-group">
                    <label for="exampleInputCameraSelfie">Camera trước</label>
                    <input type="text" value="{{old('camera_selfie')}}" name="camera_selfie" class="form-control" id="exampleInputCameraSelfie" aria-describedby="emailHelp" placeholder="Thông số Camera trước...">
                </div>
            
                <div class="form-group">
                    <label for="exampleInputRam">Ram</label>
                    <input type="text" value="{{old('ram')}}" name="ram" class="form-control" id="exampleInputRam" aria-describedby="emailHelp" placeholder="Thông số Ram...">
                </div>
            
                <div class="form-group">
                    <label for="exampleInputIM">Bộ nhớ trong</label>
                    <input type="text" value="{{old('internal_memory')}}" name="internal_memory" class="form-control" id="exampleInputIM" aria-describedby="emailHelp" placeholder="Thông số bộ nhớ trong...">
                </div>
            
                <div class="form-group">
                    <label for="exampleInputCPU">CPU</label>
                    <input type="text" value="{{old('cpu')}}" name="cpu" class="form-control" id="exampleInputCPU" aria-describedby="emailHelp" placeholder="Thông số CPU...">
                </div>
            
                <div class="form-group">
                    <label for="exampleInputGPU">GPU</label>
                    <input type="text" value="{{old('gpu')}}" name="gpu" class="form-control" id="exampleInputGPU" aria-describedby="emailHelp" placeholder="Thông số GPU...">
                </div>
            
                <div class="form-group">
                    <label for="exampleInputPIN">PIN</label>
                    <input type="text" value="{{old('pin')}}" name="pin" class="form-control" id="exampleInputPIN" aria-describedby="emailHelp" placeholder="Thông số PIN...">
                </div>
            
                <div class="form-group">
                    <label for="exampleInputSIM">SIM</label>
                    <input type="text" value="{{old('sim')}}" name="sim" class="form-control" id="exampleInputSIM" aria-describedby="emailHelp" placeholder="Thông số SIM...">
                </div>
            
                <div class="form-group">
                    <label for="exampleInputOS">Hệ điều hành</label>
                    <input type="text" value="{{old('operating_system')}}" name="operating_system" class="form-control" id="exampleInputOS" aria-describedby="emailHelp" placeholder="Hệ điều hành...">
                </div>
            
                <div class="form-group">
                    <label for="exampleInputMI">Xuất xứ</label>
                    <input type="text" value="{{old('made_in')}}" name="made_in" class="form-control" id="exampleInputMI" aria-describedby="emailHelp" placeholder="Xuất xứ tại...">
                </div>
            
                <div class="form-group">
                    <label for="exampleInputRT">Thời gian ra mắt</label>
                    <input type="date" value="{{old('release_time')}}" name="release_time" class="form-control" id="exampleInputRT" aria-describedby="emailHelp" placeholder="Thời gian ra mắt...">
                </div>
            
                <div class="form-group">
                    <label for="exampleInputct">Mô tả</label>
                    <textarea id="demo" value="{{old('description')}}" name="description" class="form-control" rows="8" style="resize:none"></textarea>
                </div>
            </div>
        </div>
    </form> 
    <div class="d-flex flex-row">
        <div class="gallery"></div>  
    </div>
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
