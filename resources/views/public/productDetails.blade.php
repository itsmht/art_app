<!DOCTYPE html>
<html lang="en">
@include('publicLayouts.head')

<style>
    body, html {
        margin: 0;
        padding: 0;
        font-family: 'Arial', sans-serif;
        overflow-y: auto;
        height: auto;
    }

    header {
        text-align: center;
        background-color: #f8f9fa;
        padding: 20px;
        border-bottom: 1px solid #ddd;
    }

    header img.logo {
        width: 120px;
        margin-bottom: 10px;
    }

    header h1 {
        margin: 0;
        font-size: 1.8rem;
        color: #333;
    }

    header p {
        margin: 5px 0 15px;
        color: #555;
    }

    .product-page {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        padding: 20px;
    }

    .product-images {
        flex: 1 1 300px;
        max-width: 400px;
        margin: 20px;
        text-align: center;
    }

    .product-images img {
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        height: auto;
    }

    .product-thumbnails {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 10px;
    }

    .product-thumbnails img {
        width: 60px;
        height: 50px;
        cursor: pointer;
        border: 2px solid transparent;
        border-radius: 5px;
    }

    .product-thumbnails img:hover {
        border-color: #007bff;
    }

    .product-info {
        flex: 1 1 300px;
        max-width: 400px;
        margin: 20px;
    }

    .product-info h2 {
        font-size: 1.8rem;
        color: #333;
        margin-bottom: 10px;
    }

    .product-info p {
        color: #555;
        margin: 10px 0;
        font-size: 1rem;
    }

    .price {
        font-size: 1.2rem;
        font-weight: bold;
        color: #007bff;
    }

    @media (max-width: 768px) {
        header h1 {
            font-size: 1.5rem;
        }

        .product-page {
            padding: 10px;
        }

        .product-thumbnails img {
            width: 50px;
            height: 40px;
        }

        .product-info h2 {
            font-size: 1.5rem;
        }
    }
</style>

<body>
    @include('sweetalert::alert')

    <header>
        <img src="/path/to/logo.png" alt="logo" class="logo">
        <h1>Product Details</h1>
        <p>Discover and purchase exquisite artwork</p>
    </header>

    @include('publicLayouts.navbar')

    <div class="product-page">
        <!-- Product Images Section -->
        <div class="product-images">
            <img 
                src="{{ asset('product_images/' . $product->product_images->first()->product_image_value) }}" 
                alt="Main Product Image" 
                id="mainImage"
            >

            <div class="product-thumbnails">
                @foreach($product->product_images as $image)
                    <img 
                        src="{{ asset('product_images/' . $image->product_image_value) }}" 
                        alt="Thumbnail {{ $loop->index + 1 }}" 
                        onclick="changeImage('{{ asset('product_images/' . $image->product_image_value) }}')"
                    >
                @endforeach
            </div>
        </div>

        <!-- Product Information Section -->
        <div class="product-info">
            <h2>{{$product->product_name}}</h2>
            <p>{{$product->product_description}}</p>
            @if($product->product_stock > 0)
            <p class="price">Stock: {{$product->product_stock}}</p>
            @else
            <p class="price text-danger">Out of Stock</p>
            @endif
            <p class="price">Price: ৳{{$product->product_discounted_price}}</p>
            <p class="price">Delivery Charge: ৳{{$product->delivery_charge}}</p>
            <p class="price">Total Price: ৳{{$product->product_discounted_price + $product->delivery_charge}}</p>

            @if($product->product_stock > 0)
            <a href="#" class="buy-button" data-bs-toggle="modal" data-bs-target="#buyModal">Buy Now</a>
            @else
            <a href="#" class="buy-button btn btn-secondary disabled">Out of Stock</a>
            @endif
        </div>
    </div>

    @include('publicLayouts.footer')

    @include('publicLayouts.js')

    <!-- Modal -->
    <div class="modal fade" id="buyModal" tabindex="-1" aria-labelledby="buyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buyModalLabel">Purchase Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="purchaseForm" action="{{ route('purchase.submit') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="purchase_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="purchase_name" name="purchase_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="purchase_phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="purchase_phone" name="purchase_phone" required>
                        </div>

                        <div class="mb-3">
                            <label for="purchase_address" class="form-label">Address</label>
                            <textarea class="form-control" id="purchase_address" name="purchase_address" rows="2" required></textarea>
                        </div>

                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">

                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                            <div>
                                <input type="radio" id="cod" name="payment_method" value="COD" onclick="toggleBkashField(false)" checked>
                                <label for="cod">Cash on Delivery</label>
                            </div>
                            <div>
                                <input type="radio" id="bkash" name="payment_method" value="Bkash" onclick="toggleBkashField(true)">
                                <label for="bkash">Bkash Send Money</label>
                                <p id="bkash-note" style="display: none; margin-top: 5px; color: #555;">
                                    Please use the "Send Money" option in Bkash and transfer the total price to <strong>{{$setting->bkash}}</strong>  first. And then input the Bkash phone number below.
                                </p>
                            </div>
                        </div>

                        <div class="mb-3" id="bkashField" style="display: none;">
                            <label for="purchase_bkash" class="form-label">Bkash Phone Number</label>
                            <input type="text" class="form-control" id="purchase_bkash" name="purchase_bkash">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="purchaseForm" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleBkashField(show) {
            // Toggle the note visibility
            const bkashNote = document.getElementById('bkash-note');
            bkashNote.style.display = show ? 'block' : 'none';

            // Toggle the input field visibility
            const bkashField = document.getElementById('bkashField');
            bkashField.style.display = show ? 'block' : 'none';
        }

        function changeImage(newSrc) {
            const mainImage = document.getElementById('mainImage');
            mainImage.src = newSrc;
        }
    </script>
</body>
</html>
