@include('layouts.header')
@include('layouts.topbar')
@include('layouts.sidebar')
<div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                    
                    <!-- basic form  -->
                        <!-- ============================================================== -->
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="section-block" id="basicform">
                                    <h3 class="section-title">Add Product</h3>
                                    <p>Please insert the product information correctly.</p>
                                </div>
                                <div class="card">
                                    <h5 class="card-header">Add Product</h5>
                                    <div class="card-body">
                                        <form action="{{route('addProductRequest')}}" method="POST" enctype="multipart/form-data">
                                            {{@csrf_field()}}
                                            <div class="form-group">
                                                <label for="product_name" class="col-form-label">Product Name</label>
                                                <input id="product_name" name= "product_name" type="text" class="form-control">
                                                @error('product_name')
                                                    <span class="text-danger">{{$message}}</span><br>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="category_id">Category</label>
                                                <select class="form-control" name="category_id" id="category_id">
                                                    <option value="">Please Select Category</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{$category->category_id}}" {{$category->category == $category->category_id  ? 'selected' : ''}}>{{$category->category_name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <span class="text-danger">{{$message}}</span><br>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="product_actual_price" class="col-form-label">Price (Input the price in Taka.)</label>
                                                <input id="product_actual_price" name="product_actual_price" type="number" class="form-control" placeholder="Price">
                                                @error('product_actual_price')
                                                    <span class="text-danger">{{$message}}</span><br>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="delivery_charge" class="col-form-label">Delivery Charge (Input the price in Taka.)</label>
                                                <input id="delivery_charge" name="delivery_charge" type="number" class="form-control" placeholder="Delivery Charge">
            
                                            </div>
                                            <div class="form-group">
                                                <label for="product_discount_percentage" class="col-form-label">Discount Percentage</label>
                                                <input id="product_discount_percentage" name="product_discount_percentage" type="number" class="form-control" placeholder="Percentage">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="product_stock" class="col-form-label">Stock</label>
                                                <input id="product_stock" name= "product_stock" type="number" class="form-control">
                                                @error('product_stock')
                                                    <span class="text-danger">{{$message}}</span><br>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="product_images" class="col-form-label">Product Images</label>
                                                <div class="custom-file">
                                                    <input type="file" name="product_images[]" class="custom-file-input" id="product_images" multiple onchange="displaySelectedFiles()">
                                                    <label class="custom-file-label" for="product_images">Choose Files</label>
                                                </div>
                                                <small class="form-text text-muted">Accepted formats are JPG, PNG, and JPEG</small>
                                            </div>
                                            <div id="selectedFiles" style="white-space: nowrap;"></div>
                                            <div class="form-group">
                                                <label for="product_description">Description</label>
                                                <textarea class="form-control" name="product_description" id="product_description" rows="3"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary ">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end basic form  -->
                    @include('layouts.footer')
                    </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    
              <script>
    function displaySelectedFiles() {
        const input = document.getElementById('product_images');
        const output = document.getElementById('selectedFiles');
        output.innerHTML = '';

        for (let i = 0; i < input.files.length; ++i) {
            const file = input.files[i];

            // Create container div for each image
            const container = document.createElement('div');
            container.className = 'image-container';

            // Create image element
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.alt = file.name;
            img.className = 'uploaded-image';

            // Create delete button with Font Awesome icon
            const deleteBtn = document.createElement('button');
            deleteBtn.innerHTML = '<i class="fas fa-trash"></i>';
            deleteBtn.type = 'button';
            deleteBtn.className = 'delete-button';
            deleteBtn.onclick = function() {
                container.remove(); // Remove the container (image + button) when delete is clicked
            };

            // Append image and delete button to the container
            container.appendChild(img);
            container.appendChild(deleteBtn);

            // Append the container to the display area
            output.appendChild(container);
        }
    }
</script>

<style>
    .image-container {
        display: inline-block;
        margin-right: 10px;
        position: relative;
    }

    .uploaded-image {
        max-width: 100px;
        border-radius: 5px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .delete-button {
        position: absolute;
        top: 5px;
        right: 5px;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 18px;
        color: #ff4d4d;
    }
</style>
    @include('layouts.js')