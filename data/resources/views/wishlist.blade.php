@extends('master')

@section('content')
    @include('includes.menu', ['page' => 'wishlist'])
    <div id="results">
        @foreach($errors->all() as $error)
            <div class="red-text center">{{ $error }}</div>
        @endforeach
        @if (\App\Wish::all()->count() > 0)
            <ul class="collection">

                @foreach(\App\Wish::all() as $result)
                    <li class="collection-item avatar">
                        <form action="{{ route('post.unwish') }}" method="POST" name="form_{{ $result['product_id'] }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="product_id" value="{{ $result['product_id'] }}">
                            <img style="width: 42px; position: absolute; left: 15px;" src="{{ $result['image_url'] }}">
                            <span class="title" style="display: inline-block; padding-right: 2rem;">{{ $result['title'] }}</span>
                            <a href="javascript: ({{ "form_".$result['product_id'] }}).submit()" class="secondary-content">
                                <div id="price_{{ $result['product_id'] }}"> {{ $result['wish_price'] }} </div>
                                <div>
                                    <i class="material-icons">
                                            favorite
                                    </i>
                                </div>
                            </a>
                        </form>
                    </li>
                @endforeach
            </ul>

        @else
            No items in wishlist!
        @endif
    </div>
@endsection
