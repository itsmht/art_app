<!DOCTYPE html>
<html lang="en">
@include('publicLayoutsV2.head')

<body>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Ensure responsiveness -->

    <!-- Navbar Section -->
    @include('publicLayoutsV2.navbar')

    <!-- Contact Form Section -->
    <section id="contact-form-section" style="padding: 20px; max-width: 600px; margin: auto;">
        <h2 style="text-align: center; font-size: 1.8rem; margin-bottom: 20px;">Contact Us</h2>
        <form id="contactForm" action="{{ route('contact.submit') }}" method="POST" style="background: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            @csrf
            <div style="margin-bottom: 15px;">
                <label for="name" style="display: block; font-weight: bold; margin-bottom: 5px;">Name:</label>
                <input type="text" id="name" name="name" required style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label for="phone" style="display: block; font-weight: bold; margin-bottom: 5px;">Phone:</label>
                <input type="text" id="phone" name="phone" required style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label for="email" style="display: block; font-weight: bold; margin-bottom: 5px;">Email:</label>
                <input type="email" id="email" name="email" required style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label for="subject" style="display: block; font-weight: bold; margin-bottom: 5px;">Subject:</label>
                <input type="text" id="subject" name="subject" required style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label for="message" style="display: block; font-weight: bold; margin-bottom: 5px;">Message:</label>
                <textarea id="message" name="message" required style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 4px; height: 100px;"></textarea>
            </div>
            <button type="submit" class="button"><span class="text">Submit</span></button>
        </form>
        <div id="formMessage" style="margin-top: 20px; display: none; text-align: center;"></div>
    </section>

    <!-- Footer Section -->
    @include('publicLayoutsV2.footer')

    <!-- Scripts -->
    @include('publicLayoutsV2.js')

    <script>
        document.querySelector('.menu-toggle').addEventListener('click', function () {
            const navLinks = document.querySelector('.nav-links');
            navLinks.classList.toggle('visible'); // Toggle the visible class
        });

        @if(session('success'))
            new Noty({
                type: 'success',
                layout: 'topRight',
                text: "{{ session('success') }}",
                timeout: 3000
            }).show();
        @endif
    </script>

    <!-- Responsive Styles -->
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #contact-form-section {
            margin: 20px auto;
            padding: 20px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            #contact-form-section {
                padding: 15px;
                margin: 10px;
            }

            h2 {
                font-size: 1.5rem;
            }

            button {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            h2 {
                font-size: 1.2rem;
            }

            form {
                padding: 15px;
            }

            input,
            textarea {
                padding: 8px;
                font-size: 0.9rem;
            }

            button {
                font-size: 0.85rem;
                padding: 8px 16px;
            }
        }
    </style>
</body>
</html>
