<style>
    /* Header styles */
    .header {
            background: linear-gradient(90deg, #1e6e1e, #2a7a2a);
            color: #ffffff;
            padding: 1rem 0;            
        }

        .container {
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
            width: 50px;
            height: auto;
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
        
</style>


<div class="container">
            <div class="logo">
                <img src="img/BD_govt_logo.png" alt="National Logo">
            </div>
            <a class="btn" href="signup.php">Portal</a>

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