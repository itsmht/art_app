<!DOCTYPE html>
<html lang="en">
    
@include('publicLayouts.head')
<body>
    @include('sweetalert::alert')
    @include('publicLayouts.preloader')

    <header>
        <img src="C:\Users\iamta\Downloads\n-n-artistry-logo-zip-file\png\logo-no-background.png" alt="logo" class="logo">
        <h1>{{$category->category_name}}</h1>
        <p>Discover and purchase exquisite artwork</p>
    </header>

    <!-- Navbar -->
    @include('publicLayouts.navbar')

    <main class="gallery">
        @foreach ($products as $product)
        <div class="art-item">
            <img src="{{ asset('product_images/' . $product->product_images->first()->product_image_value) }}" alt="Product Image" style="width: 250px; height: 200px;">
            <h3>{{$product->product_name}}</h3>
            <p>Price: ৳{{$product->product_discounted_price + $product->delivery_charge}}</p>
            <a href="{{route('productDetails',['iden'=>$product->product_id, 'distinct_name'=>$product->product_name])}}" class="btn btn-danger buy-button">Buy</a>
        </div> 
        @endforeach
        
    </main>
    {!! $products->onEachSide(1)->links() !!}
    @include('publicLayouts.footer')

    @include('publicLayouts.js')
</body>
</html>
