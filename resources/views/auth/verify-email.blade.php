<x-guest-layout>
    <x-jet-authentication-card>
        
            <x-slot name="logo">
            <img src="{{asset('admin/images/Bap-logo.jpg')}}" class="w-80 h-80 rounded-full">
            </x-slot>
        
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Tài khoản chưa xác thực email. Vui lòng xác thực để sử dụng tính năng của shop') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-jet-button type="submit">
                        {{ __('Gửi lại mã') }}
                    </x-jet-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Đăng xuất') }}
                </button>
            </form>
            <a href="{{route('/')}}">Để sau</a>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
