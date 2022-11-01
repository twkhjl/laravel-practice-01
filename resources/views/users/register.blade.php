<x-layout>

    <div class="mx-4">
        <div class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24">
            <header class="text-center">
                <h2 class="text-2xl font-bold uppercase mb-1">
                    註冊
                </h2>
                <p class="mb-4">註冊以新增職缺</p>
            </header>

            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="name" class="inline-block text-lg mb-2">
                        用戶名
                    </label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name" value="{{ old('name') }}"/>
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="email" class="inline-block text-lg mb-2">Email</label>
                    <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email" value="{{ old('email') }}"/>
                    @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="inline-block text-lg mb-2">
                        密碼
                    </label>
                    <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password" />
                    @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password2" class="inline-block text-lg mb-2">
                        確認密碼
                    </label>
                    <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password_confirmation" />
                </div>

                <div class="mb-6">
                    <button type="submit" class="bg-main text-white rounded py-2 px-4 hover:bg-black">
                        註冊
                    </button>
                </div>

                <div class="mt-8">
                    <p>
                        已有帳號?
                        <a href="{{ route('users.login') }}" class="text-main">登入</a>
                    </p>
                </div>
            </form>
        </div>
    </div>


</x-layout>
