<header>
    <div class="logo">
        <h3>GW<span>CS</span></h3>
    </div>
    <input type="checkbox" id="nav_check" hidden>
    <nav>
        <ul>
            <li id='search-bar'>
                <input type="text" placeholder="Search.."><button><i class="fa fa-search"></i></button>
            </li>
            <li>
                <a class="links" href="/index.php">Home</a>
            </li>
            <li>
                <a class="links" href="/contact.php">Contact</a>
            </li>
            <li>
                <a class="links" href="/information/index.php">information</a>
            </li>
            <li>
                <a class="links" href="/pitchTypes.php">Pitch-Types</a>
            </li>
            <li>
                <a class="links" href="/reviews.php">Reviews</a>
            </li>
            <li>
                <a class="links" href="/account.php">Account</a>
            </li>
        </ul>
    </nav>
    <label for="nav_check" class="hamburger">
        <div></div>
        <div></div>
        <div></div>
    </label>

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

            $(".logo").click(() => {
                window.location.href = '/';
            })
        });
    </script>
</header>