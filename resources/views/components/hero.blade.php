    <!-- Hero -->
    <section class="relative h-72 bg-main flex flex-col justify-center align-center text-center space-y-4 mb-4">
        {{-- <div class="absolute top-0 left-0 w-full h-full opacity-10 bg-no-repeat bg-center"
            style="background-image: url('images/banner-img.png')"></div> --}}
        <div class="absolute top-0 left-0 w-full h-full bg-no-repeat bg-left opacity-30 bg-banner"></div>
        <div class="z-10">
            <h1 class="text-6xl font-bold uppercase text-white">
                找<span class="text-black">職缺</span>
            </h1>
            <p class="text-2xl text-gray-200 font-bold my-4">
                尋找或刊登理想職缺
            </p>
            <div>
                <a href="{{ route('listings.create') }}"
                    class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black">點此新增職缺</a>
            </div>
        </div>
    </section>
