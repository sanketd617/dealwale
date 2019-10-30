@extends('master')

@section('content')
    <ul class="collection">
        <a href="{{ route('get.search') }}" class="collection-item avatar">
            <i class="material-icons circle green">add</i>
            <span class="title">Search Products</span>
            <p>Find your favorite products & wishlist them</p>
        </a>
        <a href="{{ route('get.wishlist') }}" class="collection-item avatar">
            <i class="material-icons circle red">view_list</i>
            <span class="title">Wishlist</span>
            <p>View your wishlist</p>
        </a>
    </ul>
@endsection
