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
        <div class="col-md-12 p-2">
            <form autocomplete="off" class="form-inline my-2 my-lg-0" action="{{route('search')}}" method="GET">
                <input class="form-control mr-sm-2" type="search" name="keywords" id="keywords" placeholder="Search" aria-label="Search" >
                <div id="search_ajax"></div>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
            </form>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Chi tiết</th>
                                <th scope="col" colspan="2">&nbsp</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($products as $key => $pd){
                            ?>
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$pd->name}}</td>
                                <td><a href="{{route('products.show', [$pd->id])}}" class="btn btn-danger"><i class="fas fa-eye"></i></a></td>
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
                                    <a href="{{route('products.create')}}"><button class="btn btn-primary" style="margin-top:20px" id="button">Thêm sản phẩm</button></a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
        <div class="row">
            <div class="col">
                {{ $products->links() }}
            </div>
        </div>

@endsection

@section('js')
<script type="text/javascript">
    $('#keywords').keyup(function(){
        var keywords = $(this).val();

        if(keywords != '') {
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url:"{{URL('admin/search-products')}}",
                method:"POST",
                data:{keywords:keywords, _token:_token},
                success:function(data) {
                    $('#search_ajax').fadeIn();
                    $('#search_ajax').html(data);
                }
            });

        } else {
            $('#search_ajax').fadeOut();
        }
    });

    $(document).on('click', '.li_search_ajax', function(){
        $('#keywords').val( $(this).text() );
        $('#search_ajax').fadeOut();
    })
</script>
@endsection