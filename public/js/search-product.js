$(document).ready(function () {
    $("#show-result").hide();
    $('#search-text').keyup(function (e) {
        $("#show-result").show();
        if ($('#search-text').val().length < 1) {
            $("#show-result").hide();
        }
        var url = "http://127.0.0.1:8000/api/search/products?search=Iphone";
        $.ajax({
            type: "GET",
            url: url,
            data: {
                'search': $('input[name="search"]').val(),
            },
            dataType: "json",
            success: function (response) {
                var html = '';
                html += '';
                $.each(response.product, function (item, value) {
                    html += '<li ' +
                        ' onclick="location.href=' + "'http://127.0.0.1:8000/products/" + value.id + "'" + '"' +
                        ' class="p-2 group flex transition items-center hover:shadow-lg cursor-pointer hover:bg-gray-200">' +
                        '<img' + ' src="http://127.0.0.1:8000/admin/images/products/' + value.images[0].path + '"' + ' class="w-20 h-24"' + ' alt=""/>' +
                        '<a class="text-blue-500 hover:underline hover:text-blue-600 uppercase" href="http://127.0.0.1:8000/products' + '/' + value.id + '">' + value.name + '</a>' +
                        '</li>';
                });
                $('#show-result  ul').html('');
                $('#show-result > ul').append(html);
            }
        });
    });
});
