<?php 
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - Ninja Pizza</title>
    <link rel="stylesheet" type="text/css" href="css/homepage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        html { scroll-behavior: smooth; }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom right, #b62020, #000);
            color: #fff; 
        }
        .nav-separator { margin: 0 10px; color: white; }
        .section-separator { height: 2px; background-color: #ccc; margin: 20px 0; }
        .about-us-title { font-size: 1.8em; margin-top: 20px; text-align: center; color: #fff; }
        .about-us-paragraph {
            padding: 15px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 10px auto;
        }
        .video-container { display:flex; justify-content: center; align-items: center; height: 100vh; }
        video { max-width: 60%; max-height: 80vh; }

        .carousel {
            position: relative;
            max-width: 100%;
            margin: 40px auto;
            overflow: hidden;
            border-radius: 10px;
        }
        .carousel-inner {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .carousel-item {
            min-width: 100%;
            box-sizing: border-box;
        }
        .carousel-item img {
            width: 100%;
            height: auto;
        }
        .carousel-control {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            cursor: pointer;
            padding: 10px;
            border-radius: 50%;
            box-shadow: 0px 2px 5px rgba(0,0,0,0.3);
        }
        .prev { left: 20px; }
        .next { right: 20px; }
        .carousel-indicators {
            text-align: center;
            margin-top: 10px;
        }
        .dot {
            display: inline-block;
            height: 12px;
            width: 12px;
            margin: 0 5px;
            background-color: #bbb;
            border-radius: 50%;
            cursor: pointer;
        }
        .dot.active { background-color: #ff0000; }

        body, h1, h2, p {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8; 
            color: #333; 
        }

        .header-logo {
            max-width: 150px; 
            height: 50px;
            margin-right: 60%;
            margin-left: 5%;
        }

        header {
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            text-align: center;
        }

        header h1 {
            font-size: 2.0em;
            margin-bottom: 10px;
            text-align: left;
        }

        .header-container {
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            padding: 20px;
            text-align: right;
        }
        nav {
            flex-grow: 1; 
        }

        nav ul {
            list-style-type: none; 
            padding: 0;
        }

        nav ul li {
            display: inline; 
            margin-right: 20px;
        }

        nav ul li a {
            color: #ff0000; 
            text-decoration: none; 
            font-weight: bold;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        main {
            padding: 20px;
        }

        .hero {
            background-color: #b62020; 
            color: white;
            padding: 25px;
            text-align: center;
            border-radius: 20px;
        }

        .hero h2 {
            font-size: 2em;
        }

        .hero p {
            font-size: 1.2em;
        }

        .cta-button {
            display: inline-block;
            background-color: rgb(0, 0, 0); 
            color: white; 
            padding: 20px 30px;
            border-radius: 30px;
            text-decoration: none; 
            font-weight: bold;
        }

        .cta-button:hover {
            background-color: #444; 
        }

        .features {
            margin-top: 40px;
            color: #ffff;
        }

        .features h2 {
            font-size: 1.8em;
            color:#fff;
        }

        .features ul {
            list-style-type: none;
            color: #ffff;
        }

        .features ul li {
            background-color: rgba(255, 0, 0, 0.1); 
            margin-bottom: 10px;
            padding: 10px;
            color: #ffff;
        }

        .testimonials {
           margin-top: 40px;
           color: #ffff;
        }

        .testimonials h2 {
           font-size: 1.8em;
           color: #ffff;
        }

        blockquote {
           border-left: 4px solid red; 
           padding-left: 20px;
           margin-bottom: 20px;
           color:#ffff;
        }

        footer {
           background-color:rgba(0, 0, 0, 0.8); 
           color: rgb(255, 255, 255); 
           text-align: center;
           padding: 10px;
           color: #ffff;
        }

        .socials {
           background-color: #f8f8f8; 
           padding: 20px;
           text-align: center;
           color: #ffff;
        }

        .socialHeader {
           font-size: 1.8em;
           margin-bottom: 10px;
           color: #ffff;
        }

        .socialText {
           margin-bottom: 15px;
           color: #ffff;
        }

        .socialIconsContainer {
           display: flex;
           justify-content: center;
        }

        .socialIconsContainer a {
           margin: 0 10px; 
           color: #ffff; 
        }

        .socialIconsContainer a:hover {
           color: red; 
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0px;
            padding: 0;
        }

        .carousel {
            position: relative;
            max-width: 600px;
            margin: 40px auto; 
            overflow: hidden;
            border-radius: 10px; 
        }

        .carousel-inner {
            display: flex;
        }

        .carousel-item {
            min-width: 100%;
            transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out; /* Smooth transition */
        }

        .slide-in-left {
            animation: slideInLeft 0.5s forwards;
        }

        .slide-in-right {
            animation: slideInRight 0.5s forwards;
        }

        @keyframes slideInLeft {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .carousel-control {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(255, 255, 255, 0.8); 
            border: none;
            cursor: pointer;
            padding: 10px;
            border-radius: 50%;
            box-shadow: 0px 2px 5px rgba(0,0,0,0.3); 
        }

        .prev {
            left: 20px; 
        }

        .next {
            right: 20px; 
        }

        .carousel-indicators {
            text-align: center;
            margin-top: 10px;
        }

        .dot {
            display: inline-block;
            height: 12px;
            width: 12px;
            margin: 0 5px;
            background-color: #bbb;
            border-radius: 50%;
            cursor: pointer;
        }

        .dot.active {
            background-color: #ff0000; 
        }

        .carousel-item {
            transition: transform 0.5s ease, opacity 0.5s ease;
        }
    </style>
</head>
<body>

<header>
    <div class="header-container">
        <h1>Welcome to Ninja Pizza!</h1>
        <nav>
            <ul>
                <li><a href="menu.html">Menu</a></li>
                <span class="nav-separator">|</span>
                <li><a href="#socials">Contact</a></li>
                <span class="nav-separator">|</span>
                <li><a href="#features">About Us</a></li>
                <span class="nav-separator">|</span>
                <li><a class="btn" href="Logout.php">Logout</a></li>
            </ul>
            <div>
                <img src="/login/images/njpz1.png" alt="Ninja Pizza Logo" class="header-logo">
            </div>
        </nav>
    </div>
</header>

<main>
    <section class="hero">
        <h2>Your Favorite Pizza Delivered Fast!</h2>
        <p>Explore our delicious menu and place your order online.</p>
        <a href="order.php" class="cta-button">Order Now</a>
    </section>

    <div class="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/login/images/mainp1.jpg" alt="Image 1">
            </div>
            <div class="carousel-item">
                <img src="/login/images/mainp2.jpg" alt="Image 2">
            </div>
        </div>

        <button class="carousel-control prev" onclick="moveSlide(-1)">&#10094;</button>
        <button class="carousel-control next" onclick="moveSlide(1)">&#10095;</button>

        <div class="carousel-indicators">
            <span class="dot active" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
        </div>
    </div>

    <div class="video-container">
      <video autoplay muted loop>
          <source src="/login/videos/pizzavid.mp4" type="video/mp4">
          Your browser does not support the video tag.
      </video>
    </div>

    <section class="features" id="features">
        <h2>Why Choose Us?</h2>
        <ul>
            <li>Ready to cook</li>
            <li>Fast Delivery</li>
            <li>Easy to process payment</li>
            <li>Special Offers and Discounts</li>
        </ul>

        <h3 class="about-us-title">About Us:</h3>
        <p class="about-us-paragraph">Ninja Pizza has been serving delicious pizzas for over a decade. Our commitment to quality ingredients and exceptional customer service sets us apart from the competition. Whether you're looking for a quick bite or a family meal, we have something for everyone. Join us in experiencing the best pizza in town!</p>
    </section>

    <section class="testimonials">
        <h2>What Our Customers Say</h2>
        <blockquote>"The best pizza in town! Highly recommend!" - Jane D.</blockquote>
        <blockquote>"Fast delivery and great service!" - John S.</blockquote>
    </section>

    <div id="socials">
        <div class="homepageContainer">
            <h3 class="socialHeader">Say Hi & Get In Touch</h3>
            <p class="socialText">Contact Us</p>

            <div class="socialIconsContainer">
                <a href="https://twitter.com" target="_blank"><i class="fa fa-twitter"></i></a>
                <a href="https://www.facebook.com/ninjapizza17" target="_blank"><i class="fa fa-facebook"></i></a>
            </div> 
        </div> 
    </div> 
</main>


<footer id="#contact"> 
   <p>&copy;2024 Ninja Pizza. All rights reserved.</p> 
   <p>Email: ninjapizza@gmail.com | Phone: +09603117943</p> 
</footer>

<script>
let currentIndex = 0;

function moveSlide(direction) {
    const slides = document.querySelectorAll('.carousel-item');
    const totalSlides = slides.length;

    currentIndex = (currentIndex + direction + totalSlides) % totalSlides;

    document.querySelector('.carousel-inner').style.transform = 'translateX(' + (-currentIndex * 100) + '%)';
    updateIndicators();
}

function currentSlide(index) {
    currentIndex = index - 1; 
    moveSlide(0); 
}

function updateIndicators() {
    const dots = document.querySelectorAll('.dot');
    dots.forEach((dot, index) => {
        dot.classList.remove('active');
        if (index === currentIndex) {
            dot.classList.add('active');
        }
    });
}
</script>

</body>
</html>
