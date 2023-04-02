<header class="header-area">
    <script type="text/javascript" src="../js/jquery.js"></script>


    <div class="header-container">
        <div class="site-logo">
            <a href="#">GW<span>SC</span></a>
        </div>
        <div class="mobile-nav">
            <i class="fas fa-bars"></i>
        </div>
        <div class="site-nav-menu">
            <ul class="primary-menu">
                <li><a href="#" class="links">Home</a></li>
                <li><a href="#" class="links">About</a></li>
                <li><a href="#" class="links">Works</a></li>
                <li><a href="#" class="links">Services</a></li>
                <li><a href="#" class="links">Blog</a></li>
                <li><a href="#" class="links">Contact</a></li>
            </ul>
        </div>
    </div>

    <script>
        const links = document.querySelectorAll('.links');

        links.forEach(link => {
            link.addEventListener('click', (event) => {
                event.preventDefault(); // Prevent the link from navigating to a new page
                const currentActiveLink = document.querySelector('.active');
                if (currentActiveLink) {
                    currentActiveLink.classList.remove('active');
                }
                link.classList.add('active');
            });
        });


        $(document).ready(function() {
            $(".mobile-nav i").click(function() {
                $(".site-nav-menu").toggleClass("mobile-menu");
            });
        });
    </script>
</header>