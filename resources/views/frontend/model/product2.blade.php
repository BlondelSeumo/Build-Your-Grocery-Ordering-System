@foreach ($data['products'] as $item)
    <div class="col-lg-3 col-md-6">
        <div class="product-item mb-30">
            <a href="{{url('product/'.$item['id'] .'/'.Str::slug($item['name']))}}" class="product-img">
                <img src="{{ $item['imagePath'] . $item['image'] }}" alt="">
                <div class="product-absolute-options">
                    <span class="offer-badge-1">{{$item['off']}}% {{__('off')}}</span>
                    <span class="like-icon like-{{$item['id']}} {{ $item['isWishlist'] == 1? 'liked':'' }}" data-id="{{$item['id']}}" title="wishlist"></span>
                </div>
            </a>
            <div class="product-text-dt">
                @if ($item['stock'] <= 0)
                    <p> {{__('Not Available')}} <span> {{__('(Out Of Stock)')}} </span></p>
                @else
                    <p> {{__('Available')}} <span> {{__('(In Stock)')}} </span></p>
                @endif
                <h4> {{$item['name']}} </h4>
                <div class="product-price">
                    {{$data['currency']}}<span class="sell_price">{{$item['sell_price']}}</span>
					<span class="line-through">{{$data['currency']}}<span class="fake_price">{{$item['fake_price']}}</span></span>
                </div>
                <div class="qty-cart">
                    <div class="quantity buttons_added">
                        <input type="button" value="-" class="minus minus-btn">
                        <input type="number" step="1" name="quantity" min="1" value="{{$item['qtyCount']}}" class="input-text qty text qtyOf-{{$item['id']}}">
                        <input type="button" value="+" class="plus plus-btn">
                    </div>
                    <span class="cart-icon add-to-cart cart-{{$item['id']}} {{$item['isCart'] == 1? 'pri-color':''}}" data-id="{{$item['id']}}"><i class="uil uil-shopping-cart-alt"></i></span>
                </div>
            </div>
        </div>
    </div>
@endforeach