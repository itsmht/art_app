<!DOCTYPE html>
<html lang="en">
@include('publicLayoutsV2.head')
<body>
    <!-- Navbar Section -->
    @include('publicLayoutsV2.navbar')

    <!-- Products Section -->
    <section id="products" class="products">
        <div class="container">
            <div class="filter-section">
                <h3>Filter</h3>
                <form id="filterForm">
                    <div class="filter-category">
                        <label for="category">Category</label>
                        <select name="category" id="category">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-price">
                        <label for="price">Price</label>
                        <select name="price" id="price">
                            <option value="">Select Price Range</option>
                            <option value="0-1000">Below ৳1000</option>
                            <option value="1001-5000">৳1000 - ৳5000</option>
                            <option value="5001-10000">৳5000 - ৳10000</option>
                            <option value="10001-100000">Above ৳10000</option>
                        </select>
                    </div>

                    <button type="submit" class="button" id="filterButton"><span class="text">Apply Filter</span></button>
                </form>
            </div>

            <div class="product-section">
                <h2>Our Art Collection</h2>
                <div id="productGrid" class="product-grid">
                    @foreach ($products as $product)
                        <div class="product-card">
                            <img src="{{ asset('product_images/' . $product->product_images->first()->product_image_value) }}" alt="{{$product->product_name}}">
                            <p>{{$product->product_name}}</p>
                            <p>৳{{$product->product_discounted_price}}</p>
                            <a href="{{route('productDetails',['iden'=>$product->product_id, 'distinct_name'=>$product->product_name])}}" class="button"><span class="text">View</span></a>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div id="pagination">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    @include('publicLayoutsV2.footer')

    <!-- Scripts -->
    @include('publicLayoutsV2.js')

    <script>
        $(document).ready(function() {
            // Handle filter form submission with AJAX
            $('#filterForm').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                // Get form data
                var category = $('#category').val();
                var price = $('#price').val();

                // Send AJAX request
                $.ajax({
                    url: "{{ route('filter') }}",
                    method: 'GET',
                    data: {
                        category: category,
                        price: price,
                    },
                    success: function(response) {
                        // Check if the response contains products
                        if (response.products.trim() === '') {
                            $('#productGrid').html('<p>No products found.</p>');
                        } else {
                            // Update the product grid with new products
                            $('#productGrid').html(response.products);
                        }

                        // Update pagination links
                        $('#pagination').html(response.pagination);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error: " + error);
                    }
                });
            });
        });
    </script>
</body>
</html>
