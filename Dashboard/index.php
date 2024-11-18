<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bangladesh National Managment Portal</title>
  <style>
    /* Basic Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Body and Default Styles */
    body {
      font-family: Arial, sans-serif;
      line-height: 1.6;
    }

    /* Header and Navigation */
    .header {
      background-color: #f04;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem;
    }

    .logo {
      color: #fff;
      text-decoration: none;
      font-size: 1.5rem;
    }

    .nav-links {
      list-style: none;
      display: flex;
    }

    .nav-links li {
      margin-left: 20px;
    }

    .nav-links a {
      color: white;
      text-decoration: none;
    }

    /* Hide checkbox */
    input[type="checkbox"] {
      display: none;
    }

    /* Hamburger icon */
    .hamburger {
      display: none;
      flex-direction: column;
      cursor: pointer;
    }

    .hamburger span {
      width: 25px;
      height: 3px;
      background-color: white;
      margin: 4px;
    }

    
    .nav-links {
      flex-direction: row;
    }

    /* Hero Section */
    .hero {
      height: 100vh;
      background: url('img/bd_bg.jpg') no-repeat center center/cover;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .hero-content {
      color: white;
      text-align: center;
    }

    .cta-button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #333333;
      color: white;
      text-decoration: none;
      margin-top: 20px;
    }

    /* Cards Section */
    .cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 20px;
      padding: 40px;
    }

    .card {
      background-color: white;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
    }

    .card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .card h3 {
      padding: 10px;
    }

    .card p {
      padding: 0 10px;
    }

    .read-more {
      display: inline-block;
      margin: 10px;
      color: #f04;
      text-decoration: none;
    }

    /* Testimonial Section */
    .testimonials {
      padding: 40px;
      background-color: #f7f7f7;
      text-align: center;
    }

    .testimonial-slider {
      display: flex;
      justify-content: center;
      gap: 40px;
    }

    .testimonial-slider p {
      font-style: italic;
    }

    /* Footer Section */
    footer {
      background-color: #333;
      color: white;
      text-align: center;
      padding: 20px 0;
    }

    .social-links a {
      color: white;
      margin: 0 10px;
      text-decoration: none;
    }

    /* Mobile-specific styles */
    @media (max-width: 768px) {
      .hamburger {
        display: flex;
      }

      .nav-links {
        display: none;
        flex-direction: column;
        background-color: #333;
        position: absolute;
        top: 60px;
        right: 10px;
        width: 200px;
      }

      /* Toggle menu visibility */
      input[type="checkbox"]:checked ~ .nav-links {
        display: flex;
      }

      /* Prevent overlap hamburger menu */
      .nav-links a {
        padding: 10px;
        border-bottom: 1px solid #fff;
      }
    }
  </style>
</head>
<body>

  <!-- Header Section -->
  <header class="header">
    <nav class="navbar">
      <a href="#" class="logo">Bangladesh National Management portal</a>
      <!-- Checkbox input for hamburger menu toggle -->
      <input type="checkbox" id="menu-toggle">
      <label for="menu-toggle" class="hamburger">
        <span></span>
        <span></span>
        <span></span>
      </label>
      <ul class="nav-links">
        <li><a href="#home">Home</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#contact">Contact</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="login.php">Login</a></li>

      </ul>
    </nav>
  </header>

  <!-- Main Content Section -->
  <main>
    <!-- Hero Section -->
    <section class="hero">
      <div class="hero-content">
        <h1>Welcome to the Bangladesh Natinal Management portal</h1>
        <a href="#" class="cta-button">Get Started</a>
        <a href="#" class="cta-button">Login/SignUp</a>
      </div>
    </section>

    <!-- Cards Section -->
    <section class="cards">
      <div class="card">
        <img src="" alt="Card 1">
        <h3>Card  1</h3>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ullam, magni!</p>
        <a href="#" class="read-more">Read More</a>
      </div>
      <div class="card">
        <img src="" alt="Card 2">
        <h3>Card  2</h3>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempore, molestias?</p>
        <a href="#" class="read-more">Read More</a>
      </div>
      <div class="card">
        <img src="" alt="Card 3">
        <h3>Card  3</h3>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempore, molestias?</p>
        <a href="#" class="read-more">Read More</a>
      </div>
    </section>

    <!-- Testimonial Section -->
    <section class="testimonials">
      <h2>What Our Clients Say</h2>
      <div class="testimonial-slider">
        <p>"This is the best service I've ever used!"</p>
        <p>"Highly recommended, very professional and quick response!"</p>
        <p>"I would definitely use their services again."</p>
      </div>
    </section>
  </main>

  <!-- Footer Section -->
  <footer>
    <div class="social-links">
      <a href="#">Facebook</a>
      <a href="#">Twitter</a>
      <a href="#">Instagram</a>
    </div>
    <p>&copy; 2024 Your Brand. All rights reserved.</p>
  </footer>

</body>
</html>