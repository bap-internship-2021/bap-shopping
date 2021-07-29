<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.orderpending')}}">Đang chờ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.ordersending')}}">Đang giao</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.orderfinish')}}">Hoàn thành</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.ordercancel')}}">Đã Hủy</a>
            </li>
        </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
</nav>