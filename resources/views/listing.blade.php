@if ($listing == null)
    <h3>id: {{ $id }} does not exists</h3>
@else
    <h1>{{ $listing['title'] }}</h1>
    <div>{{ $listing['content'] }}</div>


    <h3><a href={{ route('listings') }}>back</a></h3>
@endif
