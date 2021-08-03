@extends('admin.layouts.layouts')

@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="col-2">
            <a href="{{route('products.index')}}" class="btn btn-primary">Back</a>
        </div> 
        <div class="page-breadcrumb text-center">
            <div class="row">
                <div>
                    <h1>Thống kê doanh thu</h1>
                </div>
                
            </div>
        </div>
        <div class="row">
            
            <form autocomplete="off" action="{{route('admin.searchByDate')}}" class="border rounded" method="get" id="frm-sales">
                @csrf
                <div class="form-row">
                    <div class="col-md-5">
                        <p class="h5 pt-1">Từ ngày: <input type="text" id="datepicker" class="form-control border rounded"></p>
                    </div>
                    <div class="col-md-5">
                        <p class="h5 pt-1">Đến ngày: <input type="text" id="datepicker2" class="form-control border rounded"></p>
                    </div>
                    
                </div>
                <button type="submit" id="btn-dashboard-filter" class="btn btn-primary btn-sm">Lọc kết quả</button>
            </form>
            <div class="col-md-12">
                <div id="myfirstchart" style="height: 250px;"></div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
    $(document).ready(function () {
        $(function(){
            $("#datepicker").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "yy-mm-dd",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
                duration: "slow"
            });

            $("#datepicker2").datepicker({
                prevText: "Tháng trước",
                nextText: "Tháng sau",
                dateFormat: "yy-mm-dd",
                dayNamesMin: ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
                duration: "slow"
            });
        });

        // $("#frm-sales").submit(function (e) {
        //     e.preventDefault();
        //     var from_date = $('#datepicker').val();
        //     var to_date = $('#datepicker2').val();
        //     var token = $("input[name='_token']").val();
            
        //     console.log('token:', token);
        //     $.ajax({
        //         URL: "http://127.0.0.1:8000/admin/dashboard/sale/search-by-date",
        //         type: "GET",
        //         dataType: "json",
        //         data:{
        //             'from_date': from_date, 
        //             'to_date': to_date, 
        //             '_token': token
        //         },
        //         success:function(data){
        //             alert('ok');
        //             console.log('success:', data);
        //             // chart.setData(data);
        //         },
        //         error: function(e){
        //             console.log('error: ', e);
        //         }
        //     })
        // })

        
    $("#frm-sales").submit(function (e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var from_date = $('#datepicker').val();
        var to_date = $('#datepicker2').val();
        var token = $("input[name='_token']").val();

        $.ajax({
            type: "GET",
            url: url,
            data: {
                'from_date': from_date,
                'to_date': to_date,
                '_token': token
            },
            dataType: "json",
            success: function (response) {
                var data = JSON.parse(response.data);
                console.log(data);
            },

            error: function (response) {
                console.log('error: ', response);
                $.each(err.error, function (key, value) {
                    if (key == 'email') {
                        $("#email-error").text(value[0]);
                    }

                    if (key == 'password') {
                        $("#password-error").text(value[0]);
                    }
                });
            }

        });
    });
});

    </script>
@endsection