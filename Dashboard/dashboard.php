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

         

    </style>
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        <?php require_once('includes/navbar.php'); ?>
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
    <?php require_once('includes/departmentCard.php'); ?>

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
