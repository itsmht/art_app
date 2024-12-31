<nav class="navbar">
    <button class="menu-toggle" aria-label="Toggle navigation"><span class="text">&#9776;</span>
         <!-- Hamburger Icon -->
    </button>
    <ul class="nav-links">
        <li><a href="{{route('home')}}" class="button"><span class="text">Home</span></a></li>
        <li class="dropdown">
            <a href="#" class="button"><span class="text">Categories</span></a>
            <ul class="dropdown-menu">
                @foreach($categories as $category)
              <li><a href="{{route('inventory',['iden'=>$category->category_id, 'distinct_name'=>$category->category_name])}}">{{$category->category_name}}</a></li>
              @endforeach
            </ul>
          </li>
        <li><a href="{{route('contact')}}" class="button"><span class="text">Contact</span></a></li>
        <li><a href="{{route('about')}}" class="button"><span class="text">About</span></a></li>
        <li class="dropdown">
            <a href="#" class="button"><span class="text">Find My Order</span></a>
            <div class="dropdown-content">
              <form id="trackOrderForm">
                <div>
                  <label for="purchase_phone">Phone Number:</label>
                  <input type="text" id="purchase_phone" name="purchase_phone" required />
                </div>
                <div>
                  <label for="purchase_unique_id">Unique ID:</label>
                  <input type="text" id="purchase_unique_id" name="purchase_unique_id" required />
                </div>
                <button type="submit"><span class="text">Find</span></button>
              </form>
              <div id="orderResult" style="margin-top: 10px; display: none;"></div>
            </div>
          </li>
          
    </ul>
</nav>
<script>
    document.getElementById("trackOrderForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const phone = document.getElementById("purchase_phone").value;
  const uniqueId = document.getElementById("purchase_unique_id").value;

  // Clear previous results
  const orderResult = document.getElementById("orderResult");
  orderResult.style.display = "none";
  orderResult.textContent = "";

  // Send AJAX request
  fetch("{{ route('trackOrder') }}", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": "{{ csrf_token() }}",
    },
    body: JSON.stringify({ purchase_phone: phone, purchase_unique_id: uniqueId }),
  })
    .then((response) => response.json())
    .then((data) => {
      orderResult.style.display = "block";
      if (data.success) {
        orderResult.textContent = `Order Status: ${data.status}`;
        orderResult.style.color = "green";
      } else {
        orderResult.textContent = data.message;
        orderResult.style.color = "red";
      }
    })
    .catch((error) => {
      orderResult.style.display = "block";
      orderResult.textContent = "An error occurred. Please try again.";
      orderResult.style.color = "red";
    });
});
</script>