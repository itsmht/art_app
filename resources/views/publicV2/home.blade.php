<!DOCTYPE html>
<html lang="en">
    @include('publicLayoutsV2.head')
<body>
    <section id="banner" class="banner">
        <img src="../assets3/images/banner.png" alt="Art Banner" class="banner-image">
    </section>
    @include('sweetalert::alert')
    @include('publicLayoutsV2.preloader')

@include('publicLayoutsV2.navbar')

    <section id="featured" class="featured-products">
        <h2>Featured Products</h2>
        <div class="product-slider">
            @foreach ($products as $product)
            <div class="product-card">
                <img src="{{ asset('product_images/' . $product->product_images->first()->product_image_value) }}" alt="{{$product->product_name}}">
                <p>{{$product->product_name}}</p>
                <a href="{{route('productDetails',['iden'=>$product->product_id, 'distinct_name'=>$product->product_name])}}" class="button"><span class="text">View</span></a>
            </div>
            @endforeach
        </div>
    </section>

    <section id="mail-list" class="mail-list">
        <h2>Join Our Mailing List</h2>
        <p>Stay updated with the latest artworks and offers.</p>
        <form>
            <input type="email" placeholder="Enter your email" required>
            <button type="submit" class="button"><span class="text">Subscribe</span></button>
        </form>
    </section>

    @include('publicLayoutsV2.footer')
    @include('publicLayoutsV2.js')
</body>
</html>
