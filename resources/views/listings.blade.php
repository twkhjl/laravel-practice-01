<h1>{{ $header }}</h1>


@unless(count($listings) == 0)

    @foreach ($listings as $listing)
        <a href={{ route('listing',['id'=>$listing['id']]) }}><h2>{{ $listing['title'] }}</h2></a>

        <div>{{ $listing['content'] }}</div>
    @endforeach
@else
    <div>no listings found...</div>
@endunless
