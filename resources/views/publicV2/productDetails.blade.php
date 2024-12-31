<!DOCTYPE html>
<html lang="en">
@include('publicLayoutsV2.head')
@include('sweetalert::alert')
<body>
    <!-- Navbar Section -->
    
    @include('publicLayoutsV2.navbar')

    <!-- Products Section -->
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
            <a href="#" class="button" onclick="openModal()"><span class="text">Buy Now</span></a>
            @else
            <a href="#" class="button btn btn-secondary disabled">Out of Stock</a>
            @endif
        </div>
    </div>

    <!-- Footer Section -->
    @include('publicLayoutsV2.footer')
    <!-- Scripts -->
    @include('publicLayoutsV2.js')
    <script>
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.classList.toggle('visible'); // Toggle the visible class
        });
    </script>
    <script>
        // Function to open the modal with a smooth transition
function openModal() {
    const modalOverlay = document.getElementById('customModal');
    const modalContent = modalOverlay.querySelector('.modal-content');

    // Show the modal and apply the transition
    modalOverlay.style.display = 'flex'; // Make the modal visible
    setTimeout(() => {
        modalOverlay.style.opacity = '1'; // Fade in the overlay
        modalContent.style.opacity = '1'; // Fade in the modal content
        modalContent.style.transform = 'translateY(0)'; // Slide down the modal content
    }, 10); // Small delay to allow the display change to take effect
}

// Function to close the modal with a smooth transition
function closeModal() {
    const modalOverlay = document.getElementById('customModal');
    const modalContent = modalOverlay.querySelector('.modal-content');

    // Start the fade-out and slide-up transition
    modalOverlay.style.opacity = '0';
    modalContent.style.opacity = '0';
    modalContent.style.transform = 'translateY(-50px)'; // Slide the modal content up

    // After the transition is finished, hide the modal completely
    setTimeout(() => {
        modalOverlay.style.display = 'none'; // Hide the modal
    }, 300); // Match the transition duration (300ms)
}
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


<!-- Modal Overlay and Content -->
<div id="customModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h5>Purchase Product</h5>
            <button type="button" class="close-btn" onclick="closeModal()">X</button>
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
                            Please use the "Send Money" option in Bkash and transfer the total price to <strong>{{$setting->bkash}}</strong> first. Then input the Bkash phone number below.
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
            <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
            <button type="submit" form="purchaseForm" class="btn btn-primary">Submit</button>
        </div>
    </div>
</div>
<script>
    @if(session('success'))
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: "{{ session('success') }}",
            timeout: 3000
        }).show();
    @endif
</script>
</body>
</html>
