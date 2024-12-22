<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>
    <script>
        // Preloader functionality
        window.addEventListener("load", function () {
            const preloader = document.getElementById("preloader");
            setTimeout(() => {
                preloader.style.opacity = "0";
                setTimeout(() => {
                    preloader.style.display = "none";
                    document.body.style.overflow = "auto";
                }, 500);
            }, 2000);
        });

        // Add a fade-in effect to the gallery items
        document.addEventListener("DOMContentLoaded", function () {
            const galleryItems = document.querySelectorAll(".art-item");
            galleryItems.forEach((item, index) => {
                item.style.opacity = 0;
                item.style.transition = "opacity 1s ease-in-out";
                setTimeout(() => {
                    item.style.opacity = 1;
                }, index * 200);
            });
        });

        // Add a hover effect with dynamic shadow colors
        const artItems = document.querySelectorAll(".art-item");
        artItems.forEach(item => {
            item.addEventListener("mouseover", () => {
                item.style.boxShadow = "0 8px 20px rgba(233, 69, 96, 0.5)";
            });
            item.addEventListener("mouseout", () => {
                item.style.boxShadow = "0 8px 20px rgba(0, 0, 0, 0.1)";
            });
        });
    </script>