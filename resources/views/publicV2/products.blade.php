<!DOCTYPE html>
<html lang="en">
@include('publicLayoutsV2.head')
<body>
    <!-- Navbar Section -->
    @include('publicLayoutsV2.navbar')

    <!-- Products Section -->
    <section id="products" class="products">
        <h2>Our Art Collection</h2>
        <div class="product-grid">
            <div class="product-card">
                <img src="mystry.jpg" alt="Abstract Painting">
                <p>Abstract Painting</p>
                <a href="#" class="button"><span class="text">View</span></a>
            </div>
            <div class="product-card">
                <img src="nature.jpg" alt="Modern Sculpture">
                <p>Modern Sculpture</p>
                <a href="#" class="button"><span class="text">View</span></a>
            </div>
            <div class="product-card">
                <img src="village.jpg" alt="Handmade Vase">
                <p>Handmade Vase</p>
                <a href="#" class="button"><span class="text">View</span></a>
            </div>
            <div class="product-card">
                <img src="window.jpg" alt="Canvas Art">
                <p>Canvas Art</p>
                <a href="#" class="button"><span class="text">View</span></a>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    @include('publicLayoutsV2.footer')
    <!-- Scripts -->
    @include('publicLayoutsV2.js')

</body>
</html>
