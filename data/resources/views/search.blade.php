@extends('master')

@section('content')
    @include('includes.menu', ['page' => 'search'])
    <div class="input-field col s12">
        <form action="{{ route('get.search') }}" method="GET">
            <i class="material-icons prefix">search</i>
            {{ csrf_field() }}
            <input id="icon_prefix" type="text" name="q" class="validate" value="{{ isset($query) ? $query : '' }}">
            <label for="icon_prefix">Search</label>
        </form>
    </div>
    <div id="results">
        @if (isset($results))
            <ul class="collection">

                {{--                    productId--}}
                {{--                    title--}}
                {{--                    imageUrls -> 200x200--}}
                {{--                    flipkartSellingPrice -> amount--}}
                {{--                    flipkartSpecialPrice -> amount--}}
                {{--                    productUrl--}}
                {{--                    discountPercentage--}}


                @foreach($results as $result)
                    <li class="collection-item avatar">
                        <form action="{{ \App\Wish::where('product_id', $result['productBaseInfoV1']['productId'])->count() > 0 ? route('post.unwish') : route('post.wish') }}" method="POST" name="form_{{ $result['productBaseInfoV1']['productId'] }}">
                            <input type="hidden" name="title" value="{{ $result['productBaseInfoV1']['title'] }}">
                            <input type="hidden" name="url" value="{{ $result['productBaseInfoV1']['productUrl'] }}">
                            <input type="hidden" name="image_url" value="{{ $result['productBaseInfoV1']['imageUrls']['200x200'] }}">
                            <input type="hidden" name="product_id" value="{{ $result['productBaseInfoV1']['productId'] }}">
                            <img style="width: 42px; position: absolute; left: 15px;" src="{{ $result['productBaseInfoV1']['imageUrls']['200x200'] }}">
                            <span class="title" style="display: inline-block; padding-right: 2rem;">{{ $result['productBaseInfoV1']['title'] }}</span>
                            <p> Rs.
                                <span style="text-decoration: line-through;">{{ $result['productBaseInfoV1']['flipkartSellingPrice']['amount'] }}</span>
                                <span style="color: #2196f3;">{{ $result['productBaseInfoV1']['flipkartSpecialPrice']['amount'] }}</span>
                                <span style="color: grey;">| {{ $result['productBaseInfoV1']['discountPercentage'] }}% off</span>
                                <br>
                                <p class="range-field">
                                {{ csrf_field() }}
                                    <input name="wish_price" onchange="changePrice(event, 'price_{{ $result['productBaseInfoV1']['productId'] }}')"
                                           onmousemove="changePrice(event, 'price_{{ $result['productBaseInfoV1']['productId'] }}')"
                                           ontouchmove="changePrice(event, 'price_{{ $result['productBaseInfoV1']['productId'] }}')"
                                           value="{{ \App\Wish::where('product_id', $result['productBaseInfoV1']['productId'])->count() > 0 ? \App\Wish::where('product_id', $result['productBaseInfoV1']['productId'])->first()->wish_price : $result['productBaseInfoV1']['flipkartSpecialPrice']['amount'] }}"
                                           type="range" min="0" max="{{ $result['productBaseInfoV1']['flipkartSellingPrice']['amount'] }}" step="100"/>
                                </p>
                            </p>
                            <a href="javascript: ({{ "form_".$result['productBaseInfoV1']['productId'] }}).submit()" class="secondary-content">
                                <div id="price_{{ $result['productBaseInfoV1']['productId'] }}"> {{ \App\Wish::where('product_id', $result['productBaseInfoV1']['productId'])->count() > 0 ? \App\Wish::where('product_id', $result['productBaseInfoV1']['productId'])->first()->wish_price : $result['productBaseInfoV1']['flipkartSpecialPrice']['amount'] }} </div>
                                <div>
                                    <i class="material-icons">
                                        @if(\App\Wish::where('product_id', $result['productBaseInfoV1']['productId'])->count() > 0)
                                            favorite
                                        @else
                                            favorite_border
                                        @endif
                                    </i>
                                </div>
                            </a>
                        </form>
                    </li>
                @endforeach
            </ul>

        @else
            No results found!
        @endif
    </div>

    <script>

        function changePrice(event, id) {
            document.getElementById(id).innerHTML = event.target.value;
        }
    </script>
@endsection
