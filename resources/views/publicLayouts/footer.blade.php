<footer>
    <div class="footer-container">
        <!-- Logo and Company Name -->
        <div class="footer-logo">
            <img src="{{ asset('setting_images/' . $setting->logo) }}" alt="Logo" class="footer-logo-img" style="width: 150px; height: auto;">
            <h3>{{ $setting->name }}</h3>
        </div>

        <!-- Contact Information -->
        <div class="footer-contact">
            <h4>Contact Us</h4>
            <p><strong>Address:</strong> Dhaka, Bangladesh</p>
            <p><strong>Email:</strong> info@nnartistry.com</p>
            <p><strong>Phone:</strong> +880 199 7722283</p>
        </div>

        <!-- Social Media Links -->
        <div class="footer-social">
            <h4>Follow Us</h4>
            <ul style="list-style-type: none; padding: 0; margin: 0;">
                <li><a href="https://www.facebook.com/nnartistry.world" target="_blank">Facebook</a></li>
                <li><a href="https://www.instagram.com/nnartistry/" target="_blank">Instagram</a></li>
                <li><a href="https://twitter.com/nnartistry/" target="_blank">Twitter</a></li>
            </ul>
        </div>

        <div class="footer-visitors">
            <h4>Website Statistics</h4>
            <p><strong>Total Visitors:</strong> <span id="totalVisitors" class="count-container" style="color:#e94560">0</span></p>
            <p><strong>Currently Active:</strong> <span id="activeVisitors" class="count-container" style="color:#e94560">0</span></p>
        </div>
    </div>

    <p>&copy; 2020 - {{ date('Y') }} {{ $setting->name }}. All rights reserved. Made with ❤️ by Talha</p>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function updateVisitorStats() {
        $.ajax({
            url: '{{ route("visitor.counts") }}', // Ensure this route exists and is correct
            method: 'GET',
            success: function (data) {
                console.log("AJAX Success:", data); // Log the response data

                // Ensure the data contains the expected properties
                if (data.totalVisitors !== undefined && data.active !== undefined) {
                    // Update the total visitors count with sliding animation
                    updateCountWithSlide('#totalVisitors', data.totalVisitors);

                    // Update the active visitors count with sliding animation
                    updateCountWithSlide('#activeVisitors', data.active);
                } else {
                    console.error("Unexpected data format:", data);
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error); // Log any AJAX errors
            }
        });
    }

    function updateCountWithSlide(selector, newValue) {
        const element = $(selector);
        const currentValue = element.text().trim();

        // Exit if the value hasn't changed
        if (currentValue == newValue) {
            return;
        }

        // Create a container for the new value
        const newValueElement = $('<div class="slide-new"></div>').text(newValue);
        const currentHeight = element.height(); // Capture the current height for consistent alignment

        // Set the initial state of the new value (below the visible area)
        newValueElement.css({
            position: 'absolute',
            top: currentHeight + 'px',
            left: 0,
            width: '100%',
        });

        // Append the new value to the element
        element.append(newValueElement);

        // Animate the new value sliding into view
        newValueElement.animate({ top: '0px' }, 300, function () {
            // Replace the old value with the new value after the animation
            element.text(newValue);
        });
    }

    // Update the visitor stats every 3 seconds
    setInterval(updateVisitorStats, 3000);
</script>
