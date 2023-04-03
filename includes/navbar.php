<header class="header-area">
    <script type="text/javascript" src="../js/jquery.js"></script>

    <div class="header-container">
        <div class="site-logo">
            <a href="/">GW<span>CS</span></a>
        </div>
        <div class="mobile-nav">
            <i class="fas fa-bars"></i>
        </div>
        <div class="site-nav-menu">
            <ul class="primary-menu">
                <li><a href="/" class="links">Home</a></li>
                <li><a href="/contact.php" class="links">Contact Us</a></li>
                <li><a href="#" class="links">Information</a></li>
                <li><a href="#" class="links">Updates</a></li>
                <li><a href="/account.php" class="links"><i class="fa fa-user"></i> Account</a></li>

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