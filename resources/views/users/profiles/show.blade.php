@extends('layouts.master')
@section('title', 'Tài khoản của tôi')

@section('content')
    <div class="">
        <div>
            <h1 class="text-2xl font-light">Thông tin tài khoản</h1>
        </div>
        <div>
            <div class="w-1/2 mx-auto">
                <form class="bg-white p-5 rounded" action="{{ route('users.profiles.update') }}" method="post"
                      enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="text-center">
                        <div><p>Họ tên</p></div>
                        <input class="border border-black p-1 w-8/12 rounded" type="text"
                               value="{{ Auth()->user()->name }}"
                               name="name"
                               placeholder="Nhập tên của bạn">
                    </div>
                    @if($errors->has('name'))
                        <p class="text-center text-red-500">{{ $errors->first('name') }}</p>
                    @endif

                    <div class="text-center">
                        <div>Tuổi</div>
                        <input class="border border-black p-1 w-8/12 rounded" type="number"
                               name="age"
                               value="{{ Auth()->user()->age }}"
                               placeholder="Nhập tuổi của bạn">
                    </div>
                    @if($errors->has('age'))
                        <p class="text-center text-red-500">{{ $errors->first('age') }}</p>
                    @endif

                    <div class="text-center">
                        <div><p>Số điện thoại</p></div>
                        <input class="border border-black p-1 w-8/12 rounded" type="text"
                               name="phone"
                               value="{{ Auth()->user()->phone }}"
                               placeholder="Nhập số điện thoại">
                    </div>
                    @if($errors->has('phone'))
                        <p class="text-center text-red-600">{{$errors->first('phone')}}</p>
                    @endif

                    <div class="text-center">
                        <div><p>Email</p></div>
                        <input class="border border-black p-1 w-8/12 rounded bg-gray-200" disabled
                               value="{{ Auth()->user()->email }}">
                    </div>

                    <div class="text-center">
                        <div>Địa chỉ</div>
                        <input class="border border-black p-1 w-8/12 rounded" type="text"
                               name="address"
                               value="{{ Auth()->user()->address }}"
                               placeholder="Nhập địa chỉ">
                    </div>
                    @if($errors->has('address'))
                        <p class="text-red-600 text-center">{{$errors->first('address')}}</p>
                    @endif
                    <div class="text-center">
                        <div>
                            <p>Ảnh đại diện</p>
                        </div>
                        <div>
                            <input class="border border-black p-1 w-8/12 rounded" type="file" name="file">
                        </div>
                    </div>
                    @if($errors->has('file'))
                        <p class="text-center text-red-500">{{ $errors->first('file') }}</p>
                    @endif

                    <div class="text-center">
                        <div><p>Giới tính</p></div>
                        <div class="flex justify-center">
                            <div class="flex items-center">
                                <input type="radio"
                                       class="cursor-pointer"
                                       name="gender"
                                       {{ Auth()->user()->gender == \App\Models\User::MALE_GENDER ? 'checked' : ''  }}
                                       value="{{ \App\Models\User::MALE_GENDER }}">
                                <label for="" class="pl-1">Nam</label>
                            </div>
                            <div class="flex items-center pl-2">
                                <input type="radio"
                                       class="cursor-pointer"
                                       name="gender"
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
                        <button type="submit" class="border border-black hover:bg-blue-500 p-1 w-8/12 rounded">Cập
                            nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @if(session()->has('update-success'))
            <p class="text-center text-green-500">{{ session()->get('update-success') }}</p>
        @endif

        @if(session()->has('update-fail'))
            <p class="text-center text-red-500">{{ session()->get('update-fail') }}</p>
        @endif
    </div>
@endsection
