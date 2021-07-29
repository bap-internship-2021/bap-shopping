$(document).ready(function () {
    $("#show-result").hide();
    $('#search-text').keyup(function (e) {
        $("#show-result").show();
        if ($('#search-text').val().length < 1) {
            $("#show-result").hide();
        }
        var url = "http://127.0.0.1:8000/api/search/products?search=Iphone";
        console.log('url1: ', url);
        $.ajax({
            type: "GET",
            url: url,
            data: {
                'search': $('input[name="search"]').val(),
            },
            dataType: "json",
            success: function (response) {
                console.log(response.product[0]);
                var html = '';
                html += '';
                $.each(response.product, function (item, value) {
                    html += '<li class="p-2">' +
                        '<a class="text-blue-300 hover:underline" href="http://127.0.0.1:8000/products' + '/' + value.id + '">' + value.name + '</a>' +
                        '</li>';
                });
                $('#show-result > ul').html('');
                $('#show-result > ul').append(html);
            }
        });
    });
});
