@extends('layouts.master')
@section('title', 'Tài khoản của tôi')

@section('content')
    <div class="relative">
        <div>
            <!-- Background -->
            <div class="w-full absolute">
                <img
                    src="https://images.unsplash.com/photo-1494698853255-d0fa521abc6c?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80"
                    alt="Image profile"
                    class="object-cover h-full w-full filter z-0 backdrop-filter opacity-40"
                >
            </div>
            <div class="pt-5"></div>
            {{-- User image --}}
            <div
                class="card shadow-lg compact side bg-white w-1/2 mx-auto text-white flex flex-row justify-content-between"
                style="background-color: #0c3254">
                <div class="w-4/6">
                    <div class="flex-row items-center space-x-4 card-body">
                        <div>
                            <div class="avatar">
                                <div class=" w-14 h-14 shadow mask mask-heart"><img
                                        src="{{ asset("admin\\images\\avatar\\") . Auth::user()->profile_photo_path }}">
                                </div>
                            </div>
                        </div>
                        <div><h2 class="card-title">{{ Auth::user()->name }}</h2>
                            <p class="">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>
                <div class="text-right w-2/6 flex items-center justify-end cursor-pointer">
                    @if(Auth::user()->email_verified_at != null)
                        <i class="fas fa-check-square text-green-500 mr-5 text-5xl"></i>
                    @else
                        <i class="fas fa-exclamation text-yellow-500 mr-5 text-4xl"></i>
                    @endif
                </div>
            </div>

            <!-- Notification -->
            @if(session()->has('update-success'))

                <div id="update-profile-success-aleart" class="alert alert-success relative w-8/12 mx-auto mt-2">
                    <div class="flex-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#009688"
                             class="flex-shrink-0 w-6 h-6 mx-2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <label>
                            <h4>Thông báo</h4>
                            <p class="text-sm text-base-content">
                                {{ session()->get('update-success')}}
                            </p>
                        </label>
                    </div>
                    <div class="flex-none">
                        <button class="btn btn-sm btn-primary" onclick="closeAlertProfileUpdate()">Đóng</button>
                    </div>
                </div>
                <script>
                    function closeAlertProfileUpdate() {
                        document.getElementById("update-profile-success-aleart").remove();
                    }
                </script>
        @endif
        <!-- -->

            <div class="w-full flex justify-evenly text-black z-10 absolute pt-5">
                <form class="bg-none border-2 border-white p-5 rounded w-3/6 text-left "
                      style="border-color: #0c3254"
                      action="{{ route('users.profiles.update') }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div>
                        <h1 class="text-2xl font-light text-center">Thông tin tài khoản</h1>
                    </div>
                    <div class="text-center">
                        <div>
                            <p>Họ tên</p>
                        </div>
                        <input class="border border-black p-1 w-7/12 rounded" type="text"
                               value="{{ Auth()->user()->name }}"
                               name="name" placeholder="Nhập tên của bạn">
                    </div>
                    @if($errors->has('name'))
                        <p class="text-center text-red-500">{{ $errors->first('name') }}</p>
                    @endif

                    <div class="text-center">
                        <div>Tuổi</div>
                        <input class="border border-black p-1 w-7/12 rounded" type="number" name="age"
                               value="{{ Auth()->user()->age }}" placeholder="Nhập tuổi của bạn">
                    </div>
                    @if($errors->has('age'))
                        <p class="text-center text-red-500">{{ $errors->first('age') }}</p>
                    @endif

                    <div class="text-center">
                        <div>
                            <p>Số điện thoại</p>
                        </div>
                        <input class="border border-black p-1 w-7/12 rounded" type="text" name="phone"
                               value="{{ Auth()->user()->phone }}" placeholder="Nhập số điện thoại">
                    </div>
                    @if($errors->has('phone'))
                        <p class="text-center text-red-600">{{$errors->first('phone')}}</p>
                    @endif

                    <div class="text-center">
                        <div>
                            <p>Email</p>
                        </div>
                        <input class="border border-black p-1 w-7/12 rounded bg-gray-300 cursor-not-allowed" disabled
                               value="{{ Auth()->user()->email }}">
                    </div>

                    <div class="text-center">
                        <div>Địa chỉ</div>
                        <input class="border border-black p-1 w-7/12 rounded" type="text" name="address"
                               value="{{ Auth()->user()->address }}" placeholder="Nhập địa chỉ">
                    </div>
                    @if($errors->has('address'))
                        <p class="text-red-600 text-center">{{$errors->first('address')}}</p>
                    @endif
                    <div class="text-center">
                        <div class="pb-2">
                            <p>Ảnh đại diện</p>
                            <img class="mx-auto rounded-lg border-2 border-black border-dashed" id="frame" src="{{ asset("admin\\images\\avatar\\" . Auth::user()->profile_photo_path )  }}" width="100px" height="100px"/>
                        </div>
                        <div>
                            <input class="border border-black p-1 w-7/12 rounded" onchange="preview()" type="file" name="file">
                        </div>
                    </div>
                    @if($errors->has('file'))
                        <p class="text-center text-red-500">{{ $errors->first('file') }}</p>
                    @endif

                    <div class="text-center">
                        <div>
                            <p>Giới tính</p>
                        </div>
                        <div class="flex justify-center">
                            <div class="flex items-center">
                                <input type="radio" class="cursor-pointer" name="gender"
                                       {{ Auth()->user()->gender == \App\Models\User::MALE_GENDER ? 'checked' : ''  }}
                                       value="{{ \App\Models\User::MALE_GENDER }}">
                                <label for="" class="pl-1">Nam</label>
                            </div>
                            <div class="flex items-center pl-2">
                                <input type="radio" class="cursor-pointer" name="gender"
                                       {{ Auth()->user()->gender == \App\Models\User::FEMALE_GENDER ? 'checked' : ''  }}
                                       value="{{ \App\Models\User::FEMALE_GENDER }}">
                                <label for="" class="pl-1">Nữ</label>
                            </div>
                        </div>
                    </div>
                    @if($errors->has('gender'))
                        <p class="text-center text-red-500">{{ $errors->first('gender') }}</p>
                    @endif

                    <div class="text-center pt-2">
                        <div class="mx-auto">
                            <button type="submit" class="rounded text-sm p-1 w-2/12"
                                    style="background-color: rgb(253 216 53)">Cập
                                nhật
                            </button>
                        </div>
                    </div>
                    @if (Auth()->user()->email_verified_at === null)
                        <p class="text-red-600 text-center">Tài khoản của bạn chưa được xác thực để xử dụng các chức
                            năng khác của hệ thống, ấn vào link này để xác thực: <a
                                href="{{ route('verification.notice') }}"
                                class="text-blue-800 underline hover:text-blue-900">Xác thực</a></p>
                    @endif
                </form>


                {{-- Form change current password --}}
                <form id="formChangePassword"
                      class="bg-none border-2 border-white p-5 rounded w-2/6 text-left"
                      action="{{ route('users.password.update') }}"
                      style="border-color: #0c3254"
                      method="post">
                    @method('PUT')
                    @csrf
                    <div>
                        <h1 class="text-2xl font-light text-center">Thay đổi mật khẩu</h1>
                    </div>
                    <div class="text-center">
                        <div>
                            <p>Mật khẩu cũ</p>
                        </div>
                        <input class="border border-black p-1 w-10/12 rounded" type="password"
                               value="{{ old('old_password') }}"
                               name="old_password" placeholder="Nhập mật khẩu cũ"
                        >
                    </div>
                    @if($errors->has('old_password'))
                        <p class="text-center text-red-500">{{ $errors->first('old_password') }}</p>
                    @endif

                    <div class="text-center">
                        <div>
                            <p>Mật khẩu mới</p>
                        </div>
                        <input class="border border-black p-1 w-10/12 rounded" type="password"
                               value="{{ old('new_password') }}"
                               name="new_password" placeholder="Mật khẩu từ 6 đến 32 ký tự">
                    </div>
                    @if($errors->has('new_password'))
                        <p class="text-center text-red-500">{{ $errors->first('new_password') }}</p>
                    @endif

                    <div class="text-center">
                        <div>
                            <p>Nhập lại</p>
                        </div>
                        <input class="border border-black p-1 w-10/12 rounded" type="password"
                               value="{{ old('new_password_confirmation') }}"
                               name="new_password_confirmation" placeholder="Nhập lại mật khẩu mới">
                    </div>

                    <div class="text-center pt-2">
                        <div class="mx-auto">
                            <button type="submit" class="p-2 rounded text-sm" style="background-color: rgb(253 216 53)">
                                Cập
                                nhật
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        <!-- Preview image -->
        <div class="gallery absolute z-50 w-24 h-24" style="left: 45%; top: 450px"></div>
        <!-- -->

        @if(session()->has('update-fail'))
            <p class="text-center text-red-500">{{ session()->get('update-fail') }}</p>
        @endif

        @if(session()->has('change-pass-success'))
            <p class="text-center text-green-500">{{ session()->get('change-pass-success') }}</p>
        @endif

        @if(session()->has('change-pass-fail'))
            <p class="text-center text-red-500">{{ session()->get('change-pass-fail') }}</p>
        @endif
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/profiles/previewImageProfile.js') }}"></script>
@endsection
