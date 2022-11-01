<x-layout>


    <div class="mx-4">
        <div class="bg-gray-50 border border-gray-200 p-10 rounded">
            <header>
                <h1 class="text-3xl text-center font-bold my-6 uppercase">
                    管理職缺
                </h1>
            </header>

            <a href="{{ route('listings.create',["src"=>"listings.manage"]) }}"
                class="transition-all duration-200 mt-10 text-2xl rounded-sm bg-gray-600 hover:bg-gray-300 text-white hover:text-black shadow-sm shadow-black px-4 py-2">新增職缺</a>

            @if ($listings->count() <= 0)
                <div class="mt-10 text-xl">目前無任何職缺...</div>
            @endif

            <table class="w-full table-auto rounded-sm mt-10">


                <tbody>

                    @foreach ($listings as $listing)
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="{{ route('listings.show',['listing'=>$listing]) }}">
                                    {{ $listing->title }}
                                </a>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <a href="{{ route('listings.edit', ['listing' => $listing]) }}"
                                    class="text-blue-400 px-6 py-2 rounded-xl"><i class="fa-solid fa-pen-to-square"></i>
                                    編輯</a>
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                <form action="{{ route('listings.destroy', ['listing' => $listing]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" value="{{ $listing->id }}" name="id">
                                    <button class="text-red-600">
                                        <i class="fa-solid fa-trash-can"></i>
                                        刪除
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

</x-layout>
<x-flash></x-flash>
