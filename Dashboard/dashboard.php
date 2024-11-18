<?php
require_once('includes/db.php');
?>


<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>National Portal of Bangladesh - Sample</title>
    <style>
        /* Reset and general styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f4;
            color: #333;
        }

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
        
        /* Banner styles */
        .banner {
            background: linear-gradient(90deg, #2f8f2f, #3cb043);
            color: #ffffff;
            text-align: center;
            padding: 4rem 0;
        }

        .banner-text h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .banner-text p {
            font-size: 1.2rem;
        }

        

        /* Footer styles */
        .footer {
            background: linear-gradient(90deg, #2f8f2f, #3cb043);
            color: #ffffff;
            text-align: center;
            padding: 1rem 0;
            margin-top: 2rem;
        }

        .footer p {
            margin: 0.5rem 0;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .navbar ul {
                flex-direction: column;
                gap: 1rem;
            }

            .service-cards {
                flex-direction: column;
            }

            .card {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 100%;
                right: 0;
                background: #2f8f2f;
                width: 100%;
            }

            .nav-links.active {
                display: flex;
            }

            .hamburger {
                display: flex;
            }
        }

        /* Testimonial Section */
        .testimonials {
            padding: 40px;
            background-color: #f7f7f7;
            text-align: center;
        }

        .testimonial-slider {
            display: flex;
            overflow: hidden;
            position: relative;
            max-width: 600px;
            margin: auto;
        }

        .testimonial {
            min-width: 100%;
            transition: transform 0.5s ease;
            opacity: 0;
        }

        .testimonial.active {
            opacity: 1;
        }

         /* Button */
         .btn {
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
            }

        .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
            }

        .btn:active {
            transform: scale(0.95);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

    </style>
</head>
<body>
    <!-- Header Section -->
    <header class="header">
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
    </header>

    <!-- Banner Section -->
    <section class="banner">
        <div class="banner-text">
            <h1>Welcome to the National Portal of Bangladesh</h1>
            <p>Your gateway to information and services in Bangladesh.</p>
        </div>
    </section>

    <!-- Main Content Section -->
    <main>
    <?php require_once('includes/department.php'); ?>

        <!-- Service Review Section -->
        <section class="testimonials">
            <h2>What Our Clients Say</h2>
            <div class="testimonial-slider">
                <div class="testimonial active">
                    <p>"This is the best service I've ever used!"</p>
                </div>
                <div class="testimonial">
                    <p>"Highly recommended, very professional and quick response!"</p> 
                </div>
                <div class="testimonial">
                    <p>"I would definitely use their services again."</p>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer Section -->
    <?php require_once('includes/footer.php'); ?>

    <script>
        // JavaScript for Testimonial Slider
        let currentIndex = 0;
        const testimonials = document.querySelectorAll('.testimonial');

        function showTestimonial(index) {
            testimonials.forEach((testimonial, i) => {
                testimonial.classList.remove('active');
                if (i === index) {
                    testimonial.classList.add('active');
                }
            });
        }

        function nextTestimonial() {
            currentIndex = (currentIndex + 1) % testimonials.length;
            showTestimonial(currentIndex);
        }

        // Automatically change testimonial every second
        setInterval(nextTestimonial, 1000);
    </script>
</body>
</html>
