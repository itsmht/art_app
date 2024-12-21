<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('setting_images/' . $setting->logo) }}" alt="Art Gallery Logo" style="width: 40px; height: 40px;"> {{$setting->name}}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                        @foreach($categories as $category)
                            <li>
                                <a class="dropdown-item" href="{{route('filter',['iden'=>$category->category_id, 'distinct_name'=>$category->category_name])}}">{{ $category->category_name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('about')}}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('contact')}}">Contact</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="trackDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Track Order
                    </a>
                    <div class="dropdown-menu p-3" aria-labelledby="trackDropdown" style="min-width: 300px;">
                        <form id="trackForm">
                            @csrf
                            <!-- Phone Input -->
                            <div class="mb-2">
                                <label for="purchase_phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="purchase_phone" name="purchase_phone" placeholder="Enter Phone Number" required>
                            </div>
                            <!-- Unique ID Input -->
                            <div class="mb-2">
                                <label for="purchase_unique_id" class="form-label">Order ID</label>
                                <input type="text" class="form-control" id="purchase_unique_id" name="purchase_unique_id" placeholder="Enter Order ID" required>
                            </div>
                            <button type="button" class="buy-button" onclick="trackOrder()">Track</button>
                        </form>
                        <div id="trackResult" class="mt-3"></div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    function trackOrder() {
        const phone = document.getElementById('purchase_phone').value;
        const uniqueId = document.getElementById('purchase_unique_id').value;
        const trackResult = document.getElementById('trackResult');

        if (!phone || !uniqueId) {
            trackResult.innerHTML = '<p class="text-danger">Please provide both Phone and Order ID.</p>';
            return;
        }

        fetch('{{ route('trackOrder') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ purchase_phone: phone, purchase_unique_id: uniqueId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                trackResult.innerHTML = `
                    <p class="text-success">Order Status: <strong>${data.status}</strong></p>
                `;
            } else {
                trackResult.innerHTML = `<p class="text-danger">${data.message}</p>`;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            trackResult.innerHTML = '<p class="text-danger">An error occurred while tracking your order.</p>';
        });
    }
</script>
