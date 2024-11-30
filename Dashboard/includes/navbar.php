


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
    /* From Uiverse.io by Galahhad */ 
  .ui-btn {
    --btn-default-bg: rgb(41, 41, 41);
    --btn-padding: 15px 20px;
    --btn-hover-bg: rgb(51, 51, 51);
    --btn-transition: .3s;
    --btn-letter-spacing: .1rem;
    --btn-animation-duration: 1.2s;
    --btn-shadow-color: rgba(0, 0, 0, 0.137);
    --btn-shadow: 0 2px 10px 0 var(--btn-shadow-color);
    --hover-btn-color: #FAC921;
    --default-btn-color: #fff;
    --font-size: 16px;
    /* 👆 this field should not be empty */
    --font-weight: 600;
    --font-family: Menlo,Roboto Mono,monospace;
    /* 👆 this field should not be empty */
  }

  /* button settings 👆 */

  .ui-btn {
    box-sizing: border-box;
    padding: .6em;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--hover-btn-color);
    font: var(--font-weight) var(--font-size) var(--font-family);
    background: var(--btn-default-bg);
    border: none;
    cursor: pointer;
    transition: var(--btn-transition);
    overflow: hidden;
    box-shadow: var(--btn-shadow);
    border-radius: 20px;
    margin-left: 20px;
  }

  .ui-btn span {
    letter-spacing: var(--btn-letter-spacing);
    transition: var(--btn-transition);
    box-sizing: border-box;
    position: relative;
    background: inherit;
  }

  .ui-btn span::before {
    box-sizing: border-box;
    position: absolute;
    content: "";
    background: inherit;
  }

  .ui-btn:hover, .ui-btn:focus {
    background: var(--btn-hover-bg);
  }

  .ui-btn:hover span, .ui-btn:focus span {
    color: var(--hover-btn-color);
  }

  .ui-btn:hover span::before, .ui-btn:focus span::before {
    animation: chitchat linear both var(--btn-animation-duration);
  }

  @keyframes chitchat {
    0% {
      content: "#";
    }

    5% {
      content: ".";
    }

    10% {
      content: "^{";
    }

    15% {
      content: "-!";
    }

    20% {
      content: "#$_";
    }

    25% {
      content: "№:0";
    }

    30% {
      content: "#{+.";
    }

    35% {
      content: "@}-?";
    }

    40% {
      content: "?{4@%";
    }

    45% {
      content: "=.,^!";
    }

    50% {
      content: "?2@%";
    }

    55% {
      content: "\;1}]";
    }

    60% {
      content: "?{%:%";
      right: 0;
    }

    65% {
      content: "|{f[4";
      right: 0;
    }

    70% {
      content: "{4%0%";
      right: 0;
    }

    75% {
      content: "'1_0<";
      right: 0;
    }

    80% {
      content: "{0%";
      right: 0;
    }

    85% {
      content: "]>'";
      right: 0;
    }

    90% {
      content: "4";
      right: 0;
    }

    95% {
      content: "2";
      right: 0;
    }

    100% {
      content: "";
      right: 0;
    }
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


    /* Modal Styles */
    .modal {
        display: none; /* Hidden by default */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .modal-content {
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        animation: fadeIn 0.3s ease;
    }

    .modal-content h2 {
        margin-bottom: 20px;
        font-size: 1.5rem;
        color: #333;
    }

    .modal-content .ui-btn {
        margin: 10px;
    }

    .modal .close-btn {
        background: #ff4d4d;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<!-- HTML Structure -->
<header class="header">
    <div class="nav_container">
        <div class="logo">
            <img src="img/BD_govt_logo.png" alt="National Logo">
        </div>
        <!-- Portal Button -->
        <button class="ui-btn" onclick="openModal()"> <span>Portal</span></button>

        <div id="portalModal" class="modal">
          <div class="modal-content">
              <h2>Select Portal</h2>
              <button class="ui-btn" onclick="window.location.href='official_login.php';">Officials Portal</button>
              <button class="ui-btn" onclick="window.location.href='user_signup.php';">User Portal</button>
              <button class="ui-btn close-btn" onclick="closeModal()">Close</button>
            </div>
        </div>




        <!-- Navbar -->
        <nav class="navbar">
            <div class="hamburger" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-links">
                <li><a href="#home" onclick="window.location.href='dashboard.php';">Home</a></li>
                <li><a href="#services" >Services</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="#about">About</a></li>
            </ul>
             <!-- Conditional Logout Button -->
              <?php
              $currentPage = basename($_SERVER['PHP_SELF']);
              if (in_array($currentPage, ['user.php', 'official_request_table.php', 'admin_request_table.php'])) {
                  echo '<button class="ui-btn" onclick="window.location.href=\'dashboard.php\';"><span> Sign out</span></button>';
              }
              ?>
        </nav>
    </div>
</header>

<!-- JavaScript for Toggle -->
<script>
    function toggleMenu() {
        const navLinks = document.querySelector('.nav-links');
        navLinks.classList.toggle('active');
    }

    function openModal() {
        const modal = document.getElementById('portalModal');
        modal.style.display = 'flex'; // Show the modal
    }

    function closeModal() {
        const modal = document.getElementById('portalModal');
        modal.style.display = 'none'; // Hide the modal
    }

    // Close modal when clicking outside content
    window.onclick = function(event) {
        const modal = document.getElementById('portalModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    }
</script>