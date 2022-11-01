<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="images/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        main: "#22BF7D",
                    },
                    backgroundImage: {
                        'banner': "url({{ asset('images/banner-image.png') }})",
                    },

                },
            },

        };
    </script>
    <title>找職缺</title>
</head>

<body class="mb-48">
    <nav class="flex justify-between items-center mb-4">
        <a href={{ route('listings.index') }}><img class="w-24" src="{{ asset('images/logo.png') }}" alt=""
                class="logo" /></a>
        <ul class="flex space-x-6 mr-6 text-lg">
            @auth
                <li>
                    歡迎,<span>{{ auth()->user()->name }}</span>
                </li>
                <li>
                    <a href="{{ route('listings.manage', ['user_id' => auth()->user()->id]) }}" class="hover:text-main"><i
                            class="fa-solid fa-gear"></i> 管理職缺</a>
                </li>
                <li>
                    <form action="{{ route('users.logout') }}" method="post">
                        @csrf
                        <button class="hover:text-main" type="submit">
                            <i class="fa-solid fa-door-closed"></i>登出
                        </button>
                    </form>
                </li>
            @else
                <li>
                    <a href="{{ route('users.register') }}" class="hover:text-main"><i class="fa-solid fa-user-plus"></i>
                        註冊</a>
                </li>
                <li>
                    <a href="{{ route('users.login') }}" class="hover:text-main"><i
                            class="fa-solid fa-arrow-right-to-bracket"></i>
                        登入</a>
                </li>
            @endauth
        </ul>
    </nav>



    <main>


        {{ $slot }}
    </main>

    <footer
        class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-emerald-800 text-white h-24 mt-24 opacity-90 md:justify-center">
        <p class="ml-2">Copyright &copy; 2022, All Rights reserved</p>

        @if (Request::route()->getName()=='listings.manage')
            <a href={{ route('listings.create',['src'=>'listings.manage']) }}
                class="absolute top-1/3 right-10 bg-black text-white py-2 px-5">新增職缺</a>
        @else
            <a href={{ route('listings.create') }}
                class="absolute top-1/3 right-10 bg-black text-white py-2 px-5">新增職缺</a>
        @endif
    </footer>
</body>

</html>
