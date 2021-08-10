@extends('layouts.master')
@section('title', 'Chi tiết sản phẩm')


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/tiny-slider.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
    <script type="text/javascript"
            src="https://cdn.rawgit.com/igorlino/elevatezoom-plus/1.1.6/src/jquery.ez-plus.js"></script>
    <style>
        #tns1-ow > button {
            display: none;
        }

        /*set a border on the images to prevent shifting*/
        #gallery_01 img {
            border: 2px solid white;
        }

        /*Change the colour*/
        .active img {
            border: 2px solid #333 !important;
        }
    </style>
@endsection

@section('content')

    <div class="text-black pt-5 bg-gray-100">
        <div class="flex flex-col w-11/12 mx-auto bg-white shadow-lg p-5 rounded-lg">
            @foreach ($product as $key => $item)
                {{-- Product detail --}}
                <div class="w-1/2">

                    {{-- List image product--}}
                    <div class="my-slider">
                        @foreach($item->images as $key => $image)
                            <div>
                                <img class="object-cover h-96 w-full shadow-sm zoom-img"
                                     id="zoom_0{{ $key }}"
                                     src="{{ asset('admin/images/products/' . '/' . $image->path) }}" alt="">
                            </div>
                        @endforeach
                    </div>
                    @foreach($item->images as $key => $image)
                        <script>
                            $("#zoom_0{{ $key }}").ezPlus();
                        </script>
                    @endforeach
                    {{-- End list images product--}}

                </div>

                {{-- Product description --}}
                @if(Auth::check())
                    @if(Auth()->user()->role_id == \App\Models\User::USER_ROLE)
                        <div class="w-1/2 bg-gray-100">
                            <div class="pl-2">
                                <p class="invisible"><span id="product-id">{{ $item->id }}</span></p>
                                <p class="invisible"><span id="image-path">{{ $item->images->first()->path }}</span></p>
                                <p class="p-2">{{__('Tên sản phẩm: ')}} <span id="product-name">{{ $item->name }}</span>
                                </p>
                                <p id="product-price" class="invisible">{{ $item->price }}</p>
                                <p class="p-2">{{__('Giá: ')}}
                                    <span id=""
                                          class="text-blue-900"> {{ number_format($item->price, 0, '', ',') }} </span>
                                    <span class="underline">đ</span>
                                </p>
                            </div>

                            <!-- Add to cart form -->
                            <div id="app">
                                <app></app>
                            </div>
                            <!-- -->

                        </div>
                    @else
                        <div class="w-1/2">
                            <div class="pl-2">
                                <p class="p-2">{{__('Tên sản phẩm: ')}} <span id="product-name">{{ $item->name }}</span>
                                </p>
                                <p class="p-2">{{__('Giá: ')}}
                                    <span id=""
                                          class="text-blue-900"> {{ number_format($item->price, 0, '', ',') }} </span>vnd
                                </p>
                                @if($item->quantity > 0)
                                    <p class="p-2">Số lượng còn lại: {{$item->quantity}}</p>
                                @else
                                    <p class="p-2 text-red-600">Hết hàng</p>
                                @endif
                                <div class="p-2">
                                    <button class="bg-blue-300 text-white p-3 rounded hover:bg-blue-400"><a
                                            href="{{ route('products.edit', $item->id) }}">Chỉnh sửa sản phẩm này</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>

        <div class="w-11/12 rounded-lg bg-white shadow-lg mt-5 mx-auto">
            @if($product->first()->specification != null)
                <div class="pl-5">
                    <table class="table-fixed border bg-white">
                        <caption class="text-2xl pt-5 pb-2 text-left">Thông tin chi tiết</caption>
                        <tbody class="">
                        <tr class="">
                            <td class="pr-5 bg-gray-200">Màn hình</td>
                            <td class="w-7/12">{{ $product->first()->specification->screen }}</td>
                        </tr>
                        <tr class="bg-emerald-200">
                            <td class="pr-5 bg-gray-200">Camera</td>
                            <td>{{ $product->first()->specification->camera }}</td>
                        </tr>
                        <tr class="bg-emerald-200">
                            <td class="pr-5 bg-gray-200">Camera selfie</td>
                            <td>{{ $product->first()->specification->camera_selfie }}</td>
                        </tr>
                        <tr>
                            <td class="pr-5 bg-gray-200">Dung lượng RAM</td>
                            <td>{{ $product->first()->specification->ca }}</td>
                        </tr>
                        <tr>
                            <td class="pr-5 bg-gray-200">Bộ nhớ ROM</td>
                            <td>{{ $product->first()->specification->screen }}</td>
                        </tr>
                        <tr>
                            <td class="pr-5 bg-gray-200">Cpu</td>
                            <td>{{ $product->first()->specification->screen }}</td>
                        </tr>
                        <tr>
                            <td class="pr-5 bg-gray-200">GPU</td>
                            <td>{{ $product->first()->specification->screen }}</td>
                        </tr>
                        <tr>
                            <td class="pr-5 bg-gray-200">Sim</td>
                            <td>{{ $product->first()->specification->screen }}</td>
                        </tr>
                        <tr>
                            <td class="pr-5 bg-gray-200">Hệ điều hoành</td>
                            <td>{{ $product->first()->specification->screen }}</td>
                        </tr>
                        <tr>
                            <td class="pr-5 bg-gray-200">Xuất xứ</td>
                            <td>{{ $product->first()->specification->screen }}</td>
                        </tr>
                        <tr>
                            <td class="pr-5 bg-gray-200">Sản xuất năm</td>
                            <td>{{ $product->first()->specification->release_time }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="pl-5 pt-2">
                    <h1 class="text-2xl">Mô tả sản phẩm</h1>
                    <div class="bg-white rounded" id="productDescription">
                        <div>
                            <!-- content here -->
                            {!! $product->first()->specification->description !!}
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Comment -->
        <div class="pt-1">
            <div class="w-11/12 mx-auto">
                <p class="text-2xl py-2">Viết bình luận</p>
                <div class="">
                    <form action="{{ route('comments.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->first()->id }}"/>
                        <div class="form-control pb-2">
                            <textarea class="textarea h-24 textarea-bordered textarea-info" name="content"
                                      placeholder="Viết bình luận ở đây"></textarea>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-outline btn-primary">Gửi bình luận</button>
                        </div>
                    </form>
                </div>
            </div>

            <div>
                <div class="w-11/12 mx-auto pb-2">
                    <h1 class="text-black text-2xl pt-2 text-uppercase">
                        Bình luận của khách hàng
                    </h1>
                    <span class="text-base">
                    (Tổng cộng:
                    @php echo \App\Models\Comment::where('product_id', $product->first()->id)->count(); @endphp
                    bình luận)
                </span>
                </div>
                <div>
                    @if($comments->count() > 0)
                        <div class="bg-white w-11/12 shadow-lg rounded-lg p-10 mx-auto">
                            <div>
                                @foreach ($comments as $key => $comment)
                                    <div class="">
                                        <!-- parent comment -->
                                        <div class="flex border-t-2 border-blue-600 pt-5 ">
                                            <div class="flex flex-row w-full">
                                                <div class="w-4/12 flex flex-row">
                                                    <!-- user parent image comment-->
                                                    @php
                                                        $user = \App\Models\User::find($comment->user_id);
                                                        $userName = $user->name;
                                                        $profile_photo_path = $user->profile_photo_path;
                                                    @endphp
                                                    <div class="pr-2">
                                                        <img class="rounded-sm"
                                                             src="{{ asset("admin\\images\\avatar\\") . $profile_photo_path }}"
                                                             style="width: 60px; height: 50px" alt="Image">

                                                    </div>
                                                    <div>
                                                        <p>{{ $userName }} <span
                                                                class="text-sm">{{ $user->role_id == 1 ? '(Quản trị viên)' : '(Người dùng)' }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="w-8/12">
                                                    <!-- user parent comment content -->
                                                    <div>
                                                        <p class="">
                                                            {{ $comment->content }}
                                                        </p>
                                                    </div>

                                                    <div>
                                                        <p onclick="showFormComment({{ $key }})"
                                                           class="font-bold text-blue-500 cursor-pointer"
                                                           id="{{ 'show-comment-form-' . $key }}">Gửi trả lời</p>
                                                    </div>

                                                    <!-- Script click to show form comment -->
                                                    <script>
                                                        function showFormComment(key) {
                                                            id = 'comment-form-' + key;
                                                            var x = document.getElementById(id);
                                                            if (x.style.display === "none") {
                                                                x.style.display = "block";
                                                            } else {
                                                                x.style.display = "none";
                                                            }
                                                        }
                                                    </script>

                                                    <div id="{{ 'comment-form-' . $key }}" style="display: none;">
                                                        <div>
                                                            <!-- Form add child comment -->
                                                            <form action="{{ route('child.comments.store') }}"
                                                                  method="post">
                                                                @csrf
                                                                <div class="w-full pb-2">
                                                                    <input type="hidden" name="parent_comment_id"
                                                                           value="{{ $comment->id }}">
                                                                    <input type="hidden" name="product_id"
                                                                           value="{{ $product->first()->id }}">
                                                                    <input type="text" placeholder="Viết câu trả lời"
                                                                           name="content"
                                                                           class="w-full p-2 rounded-lg border border-blue-400 focus:outline-none">
                                                                </div>
                                                                <button type="submit"
                                                                        class="btn btn-outline btn-primary">
                                                                    Gửi trả lời
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @php
                                        $childComments = \App\Models\Comment::where('parent_comment_id', $comment->id)->take(1)->get();
                                    @endphp
                                    @foreach($childComments as $childComment)
                                        <!-- Sub comment -->
                                            <div class="flex p-5">
                                                <div class="w-4/12"></div>
                                                <div class="w-8/12 p-5 border border-gray-200 rounded bg-gray-100">
                                                    <div>
                                                        @php
                                                            $user = \App\Models\User::find($childComment->user_id);
                                                            $userName = $user->name;
                                                            $profile_photo_path = $user->profile_photo_path;
                                                        @endphp
                                                        <div class="pr-2 flex flex-row">
                                                            <div class="pr-2">
                                                                <img class="rounded-sm"
                                                                     src="{{ asset("admin\\images\\avatar\\") . $profile_photo_path }}"
                                                                     style="width: 60px; height: 50px" alt="image">
                                                            </div>

                                                            <div>
                                                                <p>{{ $userName }} <span
                                                                        class="text-sm">{{ $user->role_id == 1 ? '(Quản trị viên)' : '(Người dùng)' }}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="">
                                                            <p>
                                                                {{ $childComment->content }}
                                                            </p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                    @endforeach
                                    <!-- Show more if more parent comment have more than 1 child comemht -->
                                        @if(\App\Models\Comment::where('parent_comment_id', $comment->id)->get()->count() > 1)
                                            @php
                                                $childComments = \App\Models\Comment::where('parent_comment_id', $comment->id)->get()->skip(1);
                                            @endphp
                                            <div class="flex">
                                                <div class="w-4/12"></div>
                                                <div class="w-8/12">
                                                    <p class="text-blue-900 cursor-pointer font-semibold hover:text-blue-700 flex"
                                                       id="btn-show-child-cmt-{{$key}}"
                                                       onclick="showListChildComments({{$key}}); return false">
                                        <span class="" onclick="showListChildComments({{$key}}); return false">
                                            <img style="width: 20px; height: 20px; background-color: #FFF"
                                                 src="https://salt.tikicdn.com/ts/upload/46/4a/fc/c90b4ae516353f181f844ed98276e28b.png"
                                                 alt=""></span>
                                                        <span>Xem
                                            thêm {{ App\Models\Comment::where('parent_comment_id', $comment->id)->get()->skip(1)->count() }}
                                            câu trả lời
                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- Script click to show list child-comment -->
                                            <script>
                                                function showListChildComments(key) {
                                                    let childCommentId = 'list-child-comments-' + key;
                                                    let btnShow = 'btn-show-child-cmt-' + key;
                                                    let y = document.getElementById(childCommentId);
                                                    if (y.style.display === "none") {
                                                        y.style.display = "block";
                                                        document.getElementById(btnShow).remove();
                                                    } else {
                                                        y.style.display = "none";
                                                    }
                                                }
                                            </script>
                                            <div style="display: none;" class="mb-2" id="list-child-comments-{{$key}}">
                                            @foreach($childComments as $childComment)
                                                <!-- Sub comment -->
                                                    <div class="flex p-5">
                                                        <div class="w-4/12"></div>
                                                        <div
                                                            class="w-8/12 p-5 border border-gray-200 rounded bg-gray-100 mb-5">
                                                            <div>
                                                                @php
                                                                    $user = \App\Models\User::find($childComment->user_id);
                                                                    $userName = $user->name;
                                                                    $profile_photo_path = $user->profile_photo_path;
                                                                @endphp
                                                                <div class="pr-2 flex flex-row">
                                                                    <div class="pr-2">
                                                                        <img class="rounded-sm"
                                                                             src="{{ asset("admin\\images\\avatar\\") . $profile_photo_path }}"
                                                                             style="width: 60px; height: 50px"
                                                                             alt="image">
                                                                    </div>

                                                                    <div>
                                                                        <p>{{ $userName }} <span
                                                                                class="text-sm">{{ $user->role_id == 1 ? '(Quản trị viên)' : '(Người dùng)' }}</span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="">
                                                                    <p>
                                                                        {{ $childComment->content }}
                                                                    </p>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                    @endif
                                    <!-- end Sub comment -->

                                        <!-- end parent comment -->
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Related products -->
        <div class="pt-5">
            @if($relatedProducts->count() > 0)
                <div class="related-product mx-auto w-11/12 bg-white shadow-lg rounded-lg p-5">

                    <div class="title">
                        <h1 class="text-center text-2xl">Sản phẩm tương tự</h1>
                    </div>

                    <div class="carousel rounded-box cursor-pointer">
                        @foreach($relatedProducts as $key => $relatedProduct)

                            <div class="carousel-item mr-2 shadow-lg">

                                <div class="w-52 h-80 bg-white shadow-lg border border-black"
                                     onclick="location.href='{{ route('user.products.show', $relatedProduct->id) }}';">
                                    <img class="w-52 h-52"
                                         src="{{ asset("admin\\images\\products\\") . $relatedProduct->images()->inRandomOrder()->first()->path }}"
                                         alt="Image">
                                    <div class="p-2">
                                        <p>{{ $relatedProduct->name }}</p>
                                        <p>Giá: {{ number_format($relatedProduct->price, 0, '', ',') }} <span
                                                class="underline">đ</span></p>
                                    </div>
                                </div>

                            </div>

                        @endforeach
                    </div>

                </div>
            @endif
        </div>
        <!-- end related product -->
        <div class="py-5"></div>
        @endsection

        @section('js')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
            <script>
                var slider = tns({
                    container: '.my-slider',
                    items: 1,
                    slideBy: 'page',
                    autoplay: true,
                    controls: false,
                    nav: false
                });
            </script>
            <script type="text/javascript">
                window.csrf_token = "{{ csrf_token() }}"
            </script>
            <script src="{{ mix('js/app.js') }}"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </div>
@endsection
