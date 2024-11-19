<style>
    /* Header styles */
    .header {
        background: linear-gradient(90deg, #1e6e1e, #2a7a2a);
        color: #ffffff;
        padding: .5rem 0;
    }

    .nav_container {
        width: 90%;
        max-width: 1200px;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .logo {
        display: flex;
        align-items: center;
    }

    .logo img {
        width: 35px;
        height: 35px;
    }

    .navbar {
        display: flex;
        align-items: center;
        flex-grow: 1;
        justify-content: flex-end;
        margin-left: 1rem;
    }

    .nav-links {
        display: flex;
        gap: 1.5rem;
        list-style: none;
    }

    .nav-links a {
        color: #ffffff;
        text-decoration: none;
        font-weight: bold;
    }

    .nav-links a:hover {
        text-decoration: underline;
    }

    /* Hamburger menu for mobile */
    .hamburger {
        display: none;
        flex-direction: column;
        cursor: pointer;
        gap: 0.3rem;
    }

    .hamburger span {
        width: 25px;
        height: 3px;
        background-color: #ffffff;
    }

    /* Button styles */
    .portal_btn {
        background: linear-gradient(#ffffff, #36A13A);
        border: none;
        color: white;
        padding: 8px 24px;
        font-size: 10px;
        font-weight: bold;
        border-radius: 30px;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-decoration: none;
    }

    .portal_btn:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
    }

    .portal_btn:active {
        transform: scale(0.95);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .nav-links {
            display: none;
            flex-direction: column;
            position: absolute;
            top: 100%;
            right: 0;
            background: #2f8f2f;
            width: 100%;
            text-align: center;
            padding: 1rem 0;
        }

        .nav-links.active {
            display: flex;
        }

        .hamburger {
            display: flex;
        }

        .nav_container {
            position: relative;
        }
    }
</style>

<!-- HTML Structure -->
<header class="header">
    <div class="nav_container">
        <div class="logo">
            <img src="img/BD_govt_logo.png" alt="National Logo">
        </div>
        <a class="portal_btn" href="signup.php">Portal</a>

        <nav class="navbar">
            <div class="hamburger" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="#about">About</a></li>
            </ul>
        </nav>
    </div>
</header>

<!-- JavaScript for Toggle -->
<script>
    function toggleMenu() {
        const navLinks = document.querySelector('.nav-links');
        navLinks.classList.toggle('active');
    }
</script>