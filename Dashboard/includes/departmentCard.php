<style>
    /* Services section */
    .services {
        padding: 2rem 0;
        background-color: #ffffff;
    }

    .services h2 {
        text-align: center;
        margin-bottom: 1.5rem;
        color: #2f8f2f;
    }

    .service-cards {
        display: flex;
        gap: 1.5rem;
        justify-content: center;
    }

    .card {
        background-color: #f9f9f9;
        padding: 1.5rem;
        width: 30%;
        text-align: center;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card img {
        width: 100%;
        height: auto;
        border-radius: 8px;
        margin-bottom: 1rem;
    }

    .card h3 {
        margin-bottom: 0.5rem;
        color: #2f8f2f;
    }

    .card p {
        color: #666;
    }

    .card .read-more {
        margin-top: 1rem;
        display: inline-block;
        padding: 0.5rem 1rem;
        color: #fff;
        background-color: #2f8f2f;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .card .read-more:hover {
        background-color: #1e6e1e;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .service-cards {
            flex-direction: column;
            align-items: center;
        }

        .card {
            width: 80%;
        }
    }
</style>

<!-- Services Section -->
<section id="services" class="services">
    <h2>Our Services</h2>
    <div class="service-cards">
        <!-- Card 1 -->
        <div class="card">
            <img src="img/dept_1.jpg" alt="Service 1">
            <h3>Department of Passport</h3>
            <p>Immigration and Passport</p>
            <a href="#" class="read-more">Read More</a>
        </div>
        <!-- Card 2 -->
        <div class="card">
            <img src="img/dept_2.jpg" alt="Service 2">
            <h3>Department of Transport</h3>
            <p>Transport</p>
            <a href="#" class="read-more">Read More</a>
        </div>
        <!-- Card 3 -->
        <div class="card">
            <img src="img/dept_3.jpg" alt="Service 3">
            <h3>Department of Citizenship</h3>
            <p>Citizenship</p>
            <a href="#" class="read-more">Read More</a>
        </div>
    </div>
</section>
