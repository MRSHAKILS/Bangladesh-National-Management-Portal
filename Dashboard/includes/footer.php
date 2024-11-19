<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<style>
    /* Footer styles */
    .footer {
        background: linear-gradient(135deg, #000000, #1C1B1F, #38343D, #45404C);
        color: #e0e0e0;
        text-align: center;
        padding: 2rem 0;
        margin-top: 2rem;
        font-family: 'Arial', sans-serif;
        font-size: 1rem;
    }

    .footer p {
        margin: 0.5rem 0;
        font-weight: 400;
    }

    .footer a {
        color: #a9f3a9;
        text-decoration: none;
        font-weight: bold;
        transition: color 0.3s ease, text-decoration 0.3s ease;
    }

    .footer a:hover {
        color: #ffffff;
        text-decoration: underline;
    }

    .footer-icons {
        margin-top: 1rem;
        display: flex;
        justify-content: center;
        gap: 1.5rem;
    }

    .footer-icons a {
        color: #a9f3a9;
        font-size: 1.5rem;
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .footer-icons a:hover {
        color: #ffffff;
        transform: scale(1.2);
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .footer p {
            font-size: 0.9rem;
        }
        .footer-icons a {
            font-size: 1.2rem;
        }
    }
</style>

<footer class="footer">
    <div class="container">
        <p>&copy; 2024 National Portal of Bangladesh by Shakil Ahmed</p>
        <p>All rights reserved| <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
        <div class="footer-icons">
            <a href="https://www.facebook.com/shakillinit/"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="https://www.linkedin.com/in/shakil-ahmed-cs/"><i class="fab fa-linkedin"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
    </div>
</footer>
