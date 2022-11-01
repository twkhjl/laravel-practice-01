@php
$listings = App\Models\Listing::all();
@endphp

<x-layout>

    <a href={{ url()->previous() }} class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i>
        上一頁
    </a>
    <div class="mx-4">
        <x-card class="p-10">
            <div class="flex flex-col items-center justify-center text-center">
                <img class="w-48 mr-6 mb-6"
                    src="{{ $listing->logo ? asset('storage/' . $listing->logo) : asset('images/no-image.png') }}"
                    alt="" />

                <h3 class="text-2xl mb-2">{{ $listing->title }}</h3>
                <div class="text-xl font-bold mb-4">{{ $listing->company }}</div>
                {{-- <x-listing-tags :listing="$listing" :listings="$listings"></x-listing-tags> --}}
                <x-listing-tags :tagsStr="$listing->tags"></x-listing-tags>


                <div class="text-lg my-4">
                    <i class="fa-solid fa-location-dot"></i> {{ $listing->location }}
                </div>
                <div class="border border-gray-200 w-full mb-6"></div>
                <div>
                    <h3 class="text-3xl font-bold mb-4">
                        職缺描述
                    </h3>
                    <div class="text-lg space-y-6">
                        <p>{{ $listing->description }}</p>

                        <a href="mailto:test@test.com"
                            class="block bg-main text-white mt-6 py-2 rounded-xl hover:opacity-80"><i
                                class="fa-solid fa-envelope"></i>
                            我要聯絡</a>

                        <a href="https://test.com" target="_blank"
                            class="block bg-black text-white py-2 rounded-xl hover:opacity-80"><i
                                class="fa-solid fa-globe"></i> 造訪網站</a>
                    </div>
                </div>
            </div>
        </x-card>

    </div>

</x-layout>
