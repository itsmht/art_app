<!DOCTYPE html>
<html lang="en">

@include('publicLayouts.head')

<style>
    body, html {
        margin: 0;
        padding: 0;
        width: 100%;
        height: auto; /* Ensure height adjusts based on content */
        overflow-y: auto; /* Enable vertical scrolling */
    }

    .contact-section {
        padding: 50px;
        max-width: 800px; /* Optional: Limit width for better readability */
        margin: 0 auto; /* Center the form horizontally */
    }
</style>

<body>
    @include('sweetalert::alert')

    <header>
        <img src="C:\Users\iamta\Downloads\n-n-artistry-logo-zip-file\png\logo-no-background.png" alt="logo" class="logo">
        <h1>Welcome to NN Artistry</h1>
        <p>Get in touch with us</p>
    </header>

    <!-- Navbar -->
    @include('publicLayouts.navbar')

    <!-- Contact Us Section -->
    <div class="contact-section">
        <h2>Contact Us</h2>
        <form action="{{ route('contactSubmit') }}" method="POST">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label for="phone" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <!-- Phone -->
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <!-- Subject -->
            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>

            <!-- Message -->
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            </div>

            <!-- Submit Button -->
            <button class="btn btn-danger buy-button" type="submit">Send Message</button>
        </form>
    </div>

    <!-- Footer -->
    @include('publicLayouts.footer')

    @include('publicLayouts.js')

</body>

</html>
