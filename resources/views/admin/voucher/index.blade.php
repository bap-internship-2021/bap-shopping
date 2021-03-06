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
                    <h4 class="page-title">Khuyến mãi</h4>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Chi tiết</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($vouchers as $key => $voucher){
                            ?>
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$voucher->name}}</td>
                                <td><a href="{{route('voucher.show', [$voucher->id])}}" class="btn btn-danger"><i class="fas fa-eye"></i></a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="8">
                                    <a href="{{route('voucher.create')}}"><button class="btn btn-primary" style="margin-top:20px" id="button">Thêm khuyến mãi</button></a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
        <div class="row">
            <div class="col">
                {{ $vouchers->links() }}
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