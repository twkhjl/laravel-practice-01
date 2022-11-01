@if (session()->has('message'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 1000)" x-show="show" {{-- x-transition:enter="transition ease-out duration-300" --}} {{-- x-transition:enter-start="opacity-0 scale-90" --}}
        {{-- x-transition:enter-end="opacity-100 scale-100" --}} x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed w-1/3 left-1/3 text-center bg-teal-600 text-white p-2 text-4xl top-10 shadow-lg shadow-black">
        <p>
            {{ session('message') }}
        </p>
    </div>

    {{ session()->forget('message'); }}
@endif
