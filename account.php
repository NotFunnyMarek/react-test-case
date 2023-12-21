<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>TradeSmart</title>
</head>
<body>
    <header>
        <div class="logo">
	<h2 class="logotext">TradeSmart</h2>
	</div>
        <div class="coin-box">Balance (if you need to future): <?php echo number_format($_SESSION['coins'], 2) ?></div>
        <div class="expand-btn" id="sidebar-toggle">&#9776;</div>
        <h2><?php echo $_SESSION['user_name'] ?></h2>
        <button onclick="window.location.href = 'logout.php'" class="button-register">Logout</button>
    </header>
    <div id="loader">
    <div class="loader-content">
        <img src="load.gif" alt="Loading...">
    </div>
</div>

<div class="sidebar" id="sidebar">
    <div class="searchbar">
        <input type="text" placeholder="Search here">
    </div>
    <div class="dropdown active">
        <button class="dropbtn">TradeSmart</button>
        <div class="dropdown-content">
            <button class="sidebar-button" data-target="Features">
               Features
            </button>
            <button class="sidebar-button" data-target="Pricing">
                Pricing
            </button>
            <button class="sidebar-button" data-target="Reviews">
                Reviews
            </button>
            <button class="sidebar-button" data-target="Trades">
                Trades
            </button>
            <button class="sidebar-button" data-target="Legal">
                Legal
            </button>
            <button class="sidebar-button" data-target="Disclaimer">
                Disclaimer
            </button>
        </div>
    </div>
    <div class="dropdown active">
        <button class="dropbtn">VIP</button>
        <div class="dropdown-content">
            <button class="sidebar-button" data-target="/NA/">
                /NA/
            </button>
            <button class="sidebar-button" data-target="/NA/">
                /NA/
            </button>
        </div>
    </div>
    <div class="dropdown active">
        <button class="dropbtn">Offers</button>
        <div class="dropdown-content">
            <button class="sidebar-button" data-target="affiliate">
                Affiliate Program
            </button>
            <button class="sidebar-button" data-target="referral">
                Referral Code
            </button>
        </div>
    </div>
</div>

<div id="Features" class="content-container">

<h1 class="logotext">Features page<h1>
     <img src="load.gif" alt="Loading...">

</div>

<div id="Pricing" class="content-container">
<h1 class="logotext">Pricing page<h1>
     <img src="load.gif" alt="Loading...">
</div>

<div id="Reviews" class="content-container">
<h1 class="logotext">Reviews page<h1>
     <img src="load.gif" alt="Loading...">
</div>

<div id="Trades" class="content-container">
<h1 class="logotext">Trades page<h1>
     <img src="load.gif" alt="Loading...">
</div>

<div id="Legal" class="content-container">
<h1 class="logotext">Legal page<h1>
     <img src="load.gif" alt="Loading...">
</div>

<div id="Disclaimer" class="content-container">
<h1 class="logotext">Disclaimer page<h1>
     <img src="load.gif" alt="Loading...">
</div>

<div id="/NA/" class="content-container">
<h1 class="logotext">/NA/ page<h1>
     <img src="load.gif" alt="Loading...">
</div>

<div id="/NA/" class="content-container">
<h1 class="logotext">/NA/ page<h1>
     <img src="load.gif" alt="Loading...">
</div>

<div id="affiliate" class="content-container">
<h1 class="logotext">Affiliate page<h1>
     <img src="load.gif" alt="Loading...">
</div>

<div id="referral" class="content-container">
<h1 class="logotext">Referral page<h1>
     <img src="load.gif" alt="Loading...">
</div>

<div id="promo" class="content-container">
<h1 class="logotext">Promo page<h1>
     <img src="load.gif" alt="Loading...">
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const sidebarButtons = document.querySelectorAll('.sidebar-button');
  const contentContainers = document.querySelectorAll('.content-container');

  sidebarButtons.forEach(button => {
    button.addEventListener('click', () => {
      const target = button.getAttribute('data-target');

      contentContainers.forEach(container => {
        container.classList.remove('show');
      });

      sidebarButtons.forEach(btn => {
        btn.classList.remove('active-button');
      });

      const targetContainer = document.getElementById(target);
      targetContainer.classList.add('show');
      button.classList.add('active-button');
    });
  });
});

</script>
    <script src="script2.js"></script>
</body>
</html>