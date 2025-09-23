{{-- page search --}}
@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
<div>
    <p>cart page</p>
    {{-- item qty --}}
    @foreach($items as $item)
        <div>
            <p>{{ $item->product->name }}</p>
            <p>Quantity: {{ $item->qty }}</p>
        </div>
    @endforeach
</div>

@endsection
