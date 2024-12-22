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

        <!-- Visitor Counts -->
        <div class="footer-visitors">
            <h4>Website Statistics</h4>
            <p><strong>Total Visitors:</strong> {{ $totalVisitors }}</p>
            <p><strong>Currently Active:</strong> {{ $activeVisitors }}</p>
        </div>
    </div>

    <p>&copy; 2020 - {{ date('Y') }} {{ $setting->name }}. All rights reserved. Made with ❤️ by Talha</p>
</footer>
