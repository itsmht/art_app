<footer>
    <div class="footer-container">
        <!-- Logo and Company Name -->
        <div class="footer-logo">
            <img src="{{ asset('setting_images/' . $setting->logo) }}" alt="Logo" class="footer-logo-img" style="width: 150px; height: auto;">

            <h3>{{$setting->name}}</h3>
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
            <ul>
                <li><a href="https://www.facebook.com/nnartistry.world" target="_blank">Facebook</a></li>
                <li><a href="https://www.instagram.com/nnartistry/" target="_blank">Instagram</a></li>
                <li><a href="https://twitter.com/nnartistry/" target="_blank">Twitter</a></li>
                
            </ul>
        </div>
        <style>
            ul {
                list-style-type: none; /* Removes the default list bullets */
                padding: 0; /* Removes the default padding */
                margin: 0; /* Removes the default margin */
            }
        
            ul li {
                margin-bottom: 10px; /* Optional: Adds space between list items */
            }
        </style>
    </div>

    <!-- Copyright Notice -->
    <p>&copy; 2020 - <?php echo date("Y"); ?> {{$setting->name}}. All rights reserved. Made with ❤️ by Talha</p>
</footer>
