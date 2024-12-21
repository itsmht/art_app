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
                                    <h3 class="section-title">Update User</h3>
                                    <p>Please insert the user information correctly.</p>
                                </div>
                                <div class="card">
                                    <h5 class="card-header">Form</h5>
                                    <div class="card-body">
                                        <form action="{{route('addProductRequest')}}" method="POST" enctype="multipart/form-data">
                                            {{@csrf_field()}}
                                            <input id="account_id" name= "account_id" type="hidden" class="form-control">
                                            <div class="form-group">
                                                <label for="account_name" class="col-form-label">Name</label>
                                                <input id="account_name" name= "product_name" type="text" class="form-control" disabled>
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
                                                <label for="product_actual_price" class="col-form-label">Price (Input the price in Taka. It will be converted to Quirky Coins)</label>
                                                <input id="product_actual_price" name="product_actual_price" type="number" class="form-control" placeholder="1 Quirky Coin = 100 BDT">
                                                @error('product_actual_price')
                                                    <span class="text-danger">{{$message}}</span><br>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="product_discount_percentage" class="col-form-label">Discount Percentage</label>
                                                <input id="product_discount_percentage" name="product_discount_percentage" type="number" class="form-control" placeholder="Percentage">
                                            </div>
                                            <div class="form-group">
                                                <label for="product_brand" class="col-form-label">Brand Name</label>
                                                <input id="product_brand" name= "product_brand" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="product_shop" class="col-form-label">Shop Name</label>
                                                <input id="product_shop" name= "product_shop" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="product_min_buy_quantity" class="col-form-label">Minimum Buy Quantity</label>
                                                <input id="product_min_buy_quantity" name= "product_min_buy_quantity" type="number" class="form-control">
                                                @error('product_min_buy_quantity')
                                                    <span class="text-danger">{{$message}}</span><br>
                                                @enderror
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