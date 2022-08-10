@extends('layout')


@section('content')
    @if ($listing == null)
        <h3>id: {{ $id }} does not exists</h3>
    @else
        <h1>{{ $listing['title'] }}</h1>
        <div>{{ $listing['description'] }}</div>


        <h3><a href={{ route('listings.index') }}>back</a></h3>
    @endif
@endsection
