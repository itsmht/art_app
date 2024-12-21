<!DOCTYPE html>
<html lang="en">
    
@include('publicLayouts.head')
<body>
    @include('sweetalert::alert')
    @include('publicLayouts.preloader')

    <header>
        <img src="C:\Users\iamta\Downloads\n-n-artistry-logo-zip-file\png\logo-no-background.png" alt="logo" class="logo">
        <h1>Welcome to the NN Artistry</h1>
        <p>Discover and purchase exquisite artwork</p>
    </header>

    <!-- Navbar -->
    @include('publicLayouts.navbar')

    <!-- About Us Section -->
    <section class="about-us">
        <div class="container">
            <h2>About Us</h2>
            <p>At NN Artistry, we bring to life beautiful and unique works of art that elevate your space and express individuality. Our vision is to make art accessible to everyone while ensuring top-notch quality and exceptional craftsmanship.</p>
            <p>Founded by passionate artists, NN Artistry curates a diverse collection of artwork that spans across various styles and mediums. Whether you’re looking for contemporary paintings, classic sculptures, or digital art, we have something that will resonate with you.</p>
            <p>We believe in the power of art to inspire, evoke emotions, and create lasting impressions. Our commitment to excellence and attention to detail is reflected in every piece we create or curate for our valued customers.</p>
            <h3>Our Mission</h3>
            <p>Our mission is to offer a platform where art lovers, collectors, and first-time buyers can find the perfect piece to enrich their environment. We aim to empower artists and give them a platform to showcase their work to the world.</p>
            <h3>Why Choose Us?</h3>
            <ul>
                <li><strong>High-Quality Artworks:</strong> We ensure that every piece of art is made with the finest materials and the utmost attention to detail.</li>
                <li><strong>Customer Satisfaction:</strong> We value our customers and strive to provide excellent service, fast shipping, and a seamless shopping experience.</li>
                <li><strong>Diverse Collection:</strong> From modern abstract art to traditional oil paintings, our collection is rich and varied to meet every preference.</li>
                <li><strong>Secure and Easy Shopping:</strong> Enjoy a hassle-free, secure shopping experience with easy online payment options.</li>
            </ul>
        </div>
    </section>

    <!-- Footer -->
    @include('publicLayouts.footer')

    @include('publicLayouts.js')

</body>
</html>
