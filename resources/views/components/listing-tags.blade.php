{{-- @props(['tagsStr','type']) --}}

@php
$tags = explode(',', $tagsStr);

if(!$attributes->get('tagType')){
    $tagType='';
}

$class = $tagType == 'small' ? 'flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs' : 'bg-black text-white rounded-xl px-3 py-1 mr-2';
@endphp


<ul class="flex">
    @foreach ($tags as $tag)
        <li {{ $attributes->merge(['class'=>$class]) }}>
            <a href="#">{{ $tag }}</a>
        </li>
    @endforeach

</ul>
