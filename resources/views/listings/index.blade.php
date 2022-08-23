<x-layout>
    <x-hero></x-hero>
    <x-search></x-search>

    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

        @unless(count($listings) == 0)
            @foreach ($listings as $listing)
                <x-listing-card :listing="$listing"></x-listing-card>
            @endforeach
        @else
            <div>no listings found...</div>
        @endunless

    </div>
    <div class="py-10 px-8">
        {{ $listings->links("vendor.pagination.tailwind") }}
    </div>
</x-layout>
<x-flash></x-flash>

