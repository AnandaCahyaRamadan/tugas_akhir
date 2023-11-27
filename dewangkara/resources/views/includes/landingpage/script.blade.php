    <!-- Theme mode -->
    <script>
        let mode = window.localStorage.getItem("mode"),
            root = document.getElementsByTagName("html")[0];
        if (mode !== null && mode === "dark") {
            root.classList.add("dark-mode");
        } else {
            root.classList.remove("dark-mode");
        }
    </script>

    <!-- Page loading scripts -->
    <script>
        (function () {
            window.onload = function () {
                const preloader = document.querySelector(".page-loading");
                preloader.classList.remove("active");
                setTimeout(function () {
                    preloader.remove();
                }, 1000);
            };
        })();
    </script>
 <!-- Vendor Scripts -->
 <script src="{{ asset ('template1/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset ('template1/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
 <script src="{{ asset ('template1/vendor/parallax-js/dist/parallax.min.js') }}"></script>
 <script src="{{ asset ('template1/vendor/rellax/rellax.min.js') }}"></script>
 <script src="{{ asset ('template1/js/src/components/carousel.js') }}"></script>
 <script src="{{ asset ('template1/vendor/swiper/swiper-bundle.min.js') }}"></script>
 <!-- Main Theme Script -->
 <script src="{{ asset ('template1/js/theme.min.js') }}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#data-table').DataTable();
});
</script>
