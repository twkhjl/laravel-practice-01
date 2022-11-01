<x-layout>
    <x-hero></x-hero>
    <x-search></x-search>

    <div class="flex flex-col lg:grid lg:grid-cols-2 gap-[20px] space-y-2 md:space-y-0 mx-4">

        @unless(count($listings) == 0)
            @foreach ($listings as $listing)
                <x-listing-card :listing="$listing"></x-listing-card>
            @endforeach
        @else
            <div>目前無任何職缺...</div>
        @endunless

    </div>
    <div class="py-10 px-8">
        {{ $listings->links("vendor.pagination.tailwind") }}
    </div>
</x-layout>
<x-flash></x-flash>

