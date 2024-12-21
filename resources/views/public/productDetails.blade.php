<!DOCTYPE html>
<html lang="en">
@include('publicLayouts.head')

<style>
    body, html {
        margin: 0;
        padding: 0;
        overflow-y: auto; /* Allow vertical scrolling */
        height: auto; /* Ensure it adjusts based on content height */
    }
</style>

<body>
    @include('sweetalert::alert')

    <header>
        <img src="C:\Users\iamta\Downloads\n-n-artistry-logo-zip-file\png\logo-no-background.png" alt="logo" class="logo">
        <h1>Product Details</h1>
        <p>Discover and purchase exquisite artwork</p>
    </header>
    <!-- Navbar -->
    @include('publicLayouts.navbar')

    <div class="product-page">
        <!-- Product Images Section -->
        <div class="product-images">
            {{-- Main Product Image --}}
            <img 
                src="{{ asset('product_images/' . $product->product_images->first()->product_image_value) }}" 
                alt="Main Product Image" 
                id="mainImage"
                style="width: 250px; height: 200px;"
            >
            
            {{-- Product Thumbnails --}}
            <div class="product-thumbnails">
                @foreach($product->product_images as $image)
                    <img 
                        src="{{ asset('product_images/' . $image->product_image_value) }}" 
                        alt="Thumbnail {{ $loop->index + 1 }}" 
                        onclick="changeImage('{{ asset('product_images/' . $image->product_image_value) }}')"
                        style="cursor: pointer; width: 80px; height: 60px;" 
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
            <p class="price fw-bold text-danger">Out of Stock</p>
            @endif
            <p class="price">Price: ৳{{$product->product_discounted_price}}</p>
            <p class="price">Delivery Charge: ৳{{$product->delivery_charge}}</p>
            <p class="price">Total Price: ৳{{$product->product_discounted_price + $product->delivery_charge}}</p>
            <!-- Buy Button -->
            @if($product->product_stock > 0)
            <a href="#" class="buy-button" data-bs-toggle="modal" data-bs-target="#buyModal">Buy Now</a>
            @else
            <a href="#" class="buy-button btn btn-secondary" style="opacity: 0.7;" data-bs-toggle="modal">Buy Now</a>
            @endif
        </div>
    </div>

    @include('publicLayouts.footer')

    @include('publicLayouts.js')

    <!-- Modal -->
    <div class="modal fade" id="buyModal" tabindex="-1" aria-labelledby="buyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="buyModalLabel">Purchase Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="purchaseForm" action="{{ route('purchase.submit') }}" method="POST">
                        @csrf
                        
                        <!-- Purchase Name -->
                        <div class="mb-3">
                            <label for="purchase_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="purchase_name" name="purchase_name" required>
                        </div>

                        <!-- Purchase Phone -->
                        <div class="mb-3">
                            <label for="purchase_phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="purchase_phone" name="purchase_phone" required>
                        </div>

                        <!-- Purchase Address -->
                        <div class="mb-3">
                            <label for="purchase_address" class="form-label">Address</label>
                            <textarea class="form-control" id="purchase_address" name="purchase_address" rows="2" required></textarea>
                        </div>
                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                        <!-- Payment Method -->
                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                            <div>
                                <input type="radio" id="cod" name="payment_method" value="COD" onclick="toggleBkashField(false)" checked>
                                <label for="cod">Cash on Delivery</label>
                            </div>
                            <div>
                                <input type="radio" id="bkash" name="payment_method" value="Bkash" onclick="toggleBkashField(true)">
                                <label for="bkash">Bkash Send Money</label>
                            </div>
                        </div>

                        <!-- Bkash Number Field (Hidden by Default) -->
                        <div class="mb-3" id="bkashField" style="display: none;">
                            <label for="purchase_bkash" class="form-label">Bkash Phone Number</label>
                            <input type="text" class="form-control" id="purchase_bkash" name="purchase_bkash">
                        </div>

                    </form>
                </div>
                
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="purchaseForm" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <script>
    function toggleBkashField(show) {
        const bkashField = document.getElementById('bkashField');
        if (show) {
            bkashField.style.display = 'block'; // Show Bkash field
        } else {
            bkashField.style.display = 'none'; // Hide Bkash field
        }
    }
    </script>
    <script>
        function changeImage(newSrc) {
            const mainImage = document.getElementById('mainImage');
            mainImage.src = newSrc; // Update the main image's src with the clicked thumbnail's src
        }
        </script>
        

</body>
</html>
