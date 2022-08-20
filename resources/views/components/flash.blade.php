@if (session()->has('message'))
    <div x-data="{show:true}"
    x-init="setTimeout(()=>show=false,1000)"
    x-show="show"
    {{-- x-transition:enter="transition ease-out duration-300" --}}
    {{-- x-transition:enter-start="opacity-0 scale-90" --}}
    {{-- x-transition:enter-end="opacity-100 scale-100" --}}
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"

    class="fixed top-0 left-1/2 transform-translate-x-1/2 bg-laravel text-white px-48 py-3">
        <p>
            {{ session('message') }}
    </div>
    </p>
@endif
