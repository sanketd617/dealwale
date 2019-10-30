<div>
    <a href="/" class="blue-text" style="padding: 1rem;">Home</a>
    @if($page == 'search')
        <a href="{{ route('get.wishlist') }}" style="padding: 1rem;"> Wishlist</a>
    @elseif($page == 'wishlist')
        <a href="{{ route('get.search') }}" style="padding: 1rem;"> Search</a>
    @endif

</div>
