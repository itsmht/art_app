@foreach ($products as $product)
    <div class="product-card">
        <img src="{{ asset('product_images/' . $product->product_images->first()->product_image_value) }}" alt="{{ $product->product_name }}">
        <p>{{ $product->product_name }}</p>
        <p>৳{{$product->product_discounted_price}}</p>
        <a href="{{ route('productDetails', ['iden' => $product->product_id, 'distinct_name' => $product->product_name]) }}" class="button">
            <span class="text">View</span>
        </a>
    </div>
@endforeach