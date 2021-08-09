<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.order.status', [\App\Models\Order::PENDING_STATUS])}}">Đang chờ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.order.status', [\App\Models\Order::SENDING_STATUS])}}">Đang giao</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.order.status', [\App\Models\Order::FINISH_STATUS])}}">Hoàn thành</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.order.status', [\App\Models\Order::CANCEL_STATUS])}}">Đã Hủy</a>
            </li>
        </ul>
        <form autocomplete="off" class="form-inline my-2 my-lg-0" action="{{route('search.order.result')}}" method="GET">
            <input class="form-control mr-sm-2" type="search" name="orderkey" id="orderkey" placeholder="Nhập vào đây..." aria-label="Search" >
            <div id="search_order"></div>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm Kiếm</button>
        </form>
    </div>
</nav>