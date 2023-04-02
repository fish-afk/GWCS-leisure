<header class="header-area">
    <script type="text/javascript" src="../js/jquery.js"></script>


    <div class="header-container">
        <div class="site-logo">
            <a href="/">GW<span>SC</span></a>
        </div>
        <div class="mobile-nav">
            <i class="fas fa-bars"></i>
        </div>
        <div class="site-nav-menu">
            <ul class="primary-menu">
                <li><a href="/" class="links active">Home</a></li>
                <li><a href="#" class="links">Contact Us</a></li>
                <li><a href="#" class="links">Information</a></li>
                <li><a href="#" class="links acc"><i class="fa fa-user"></i></a></li>

            </ul>
        </div>
    </div>

    <script>
        const links = document.querySelectorAll('.links');

        links.forEach(link => {
            link.addEventListener('click', (event) => {
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