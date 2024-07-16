<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Police Automation System</title>

    <!-- google fonts cdn link  -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

    <!--form java script file-->
    <!-- <script src="form.js" defer></script> -->

    

</head>
<body>
   
<!-- header section starts  -->

<header>
	

    <section class="flex">
	<!-- logo is goes here -->
		<img src="images/policelogo.png" alt="Logo" class="logo">

        <div id="menu" class="fas fa-bars"></div>

        <nav class="navbar">
            <ul>
                <li><a class="active" href="#home">home</a></li>
                <li><a href="#about">about</a></li>
                <li><a href="#course">Lodge complains</a></li>
                <li><a href="#teacher">Clearence reports</a></li>
                <li><a href="#contact">Lost mobiles</a></li>
                <li><a href="#Booking">Bookings</a></li>
            </ul>
        </nav>

        <div id="login" class="fas fa-user-circle"></div>

    </section>

</header>

<!-- header section ends -->

<!-- login form  -->

<div class="login-form">

    <form action="">
        <h3>Welcome To Sri Lanka Police</h3>
        <input type="email" placeholder="username" class="box">
        <input type="password" placeholder="password" class="box">
        <p>forget password? <a href="#">click here</a></p>
        <p>don't have an account? <a href="#">register now</a></p>
        <input type="submit" class="btn" value="login">
        <i class="fas fa-times"></i>
    </form>

</div>

<!-- home section starts  -->

<div class="home-container">

    <section class="home" id="home">

        <h1>Welcome To Sri Lanka Police</h1>
        <p>“uphold and enforce the law of the land, to preserve the public order, prevent crime and Terrorism with prejudice to none – equity to all.”</p>
        <a href="#"><button class="btn">get started</button></a>
        
    </section>

    <div class=""></div>

</div>

<!-- home section ends -->

<!-- about section starts  -->

<section class="about" id="about">

    <div class="image">
        <img src="images/about.jpg" alt="">
    </div>

    <div class="content">
        <h3>About us</h3>
        <h2>Our Vision</h2>
        <p> Towards a Peaceful environment to live with confidence, without fear of Crime and Violence.</p>
        <h2>Our Mission</h2>
        <p>Sri Lanka Police is committed and confident to uphold and enforce the law of the land, to preserve the public order, prevent crime and Terrorism with prejudice to none – equity to all..</p>
        <a href="#"><button class="btn">learn more</button></a>

        
    </div>

</section>

<!-- about section ends -->

<!-- Lodge complains section starts  -->

<section class="course" id="course">

<?php include 'connection.php'; ?>
    

</section>

<!-- cLodge complains section ends -->

<!-- clearence reports section starts  -->

<div class="teachers-container">

    <section class="teacher" id="teacher">

        <h1 class="heading">expert teachers</h1>
    
        <p>Here are the best teachers for modules.specilly the teachers are from 
		foriegn countries like Japan,Affrica,India & Pakisthan so we are happy to 
		they are the best teachers for your skillful child.you can contact our teachers 
		for the modules details after registering.</p>
    
        <a href="#"><button class="btn">learn more</button></a>
    
    </section>

</div>

<!-- clearence report section ends -->

<!-- Lost mobiles section starts  -->

<div class="contact-container">

    <section class="contact" id="contact">

        <h1 class="heading">contact us</h1>
        
        <div class="row">
        
            <form action="">
                <input type="text" placeholder="full name" class="box">
                <input type="email" placeholder="your email" class="box">
                <input type="password" placeholder="your password" class="box">
                <input type="number" placeholder="your number" class="box">
                <textarea name="" id="" cols="30" rows="10" class="box address" placeholder="your address"></textarea>
                <input type="submit" class="btn" value="send now">
            </form>
        
            <div class="image">
                <img src="images/contact-img.png" alt="">
            </div>
        
        </div>
        
        </section>

</div>

<!-- Lost Mobiles section ends -->

<!-- Bookings sectionn start here  -->

<div class="Bookings-container">

    <section class="Bookings " id="Bookings ">

        <h1 class="heading">Bookings</h1>
        
        <div class="row">
        
            <form action="">
                <input type="text" placeholder="full name" class="box">
                <input type="email" placeholder="your email" class="box">
                <input type="password" placeholder="your password" class="box">
                <input type="number" placeholder="your number" class="box">
                <textarea name="" id="" cols="30" rows="10" class="box address" placeholder="your address"></textarea>
                <input type="submit" class="btn" value="send now">
            </form>
        
            <div class="image">
                <img src="images/contact-img.png" alt="">
            </div>
        
        </div>
        
        </section>

</div>

<!-- booking  section ends -->

<!-- footer section starts  -->

<div class="footer">

    <div class="box-container">

        <div class="box">
            <h3>branch locations</h3>
            <a href="#">Colombo</a>
            <a href="#">Negambo</a>
            <a href="#">Jaffna</a>
            <a href="#">Kandy</a>
        </div>

        <div class="box">
            <h3>quick links</h3>
            <a href="#">home</a>
            <a href="#">about</a>
            <a href="#">Lodge Complains</a>
            <a href="#">Clearence Reports</a>
            <a href="#">Lost Mobiles</a>
        </div>

        <div class="box">
            <h3>contact info</h3>
            <p> <i class="fas fa-map-marker-alt"></i> Maharagama, Sri Lanka. </p>
            <p> <i class="fas fa-envelope"></i> info@cymjdev.com </p>
            <p> <i class="fas fa-phone"></i> +94-71-695-7527 </p>
        </div>

    </div>

    <h1 class="credit">created by <a href="#">CYMJ Developers</a> all rights reserved. </h1>

</div>

<!-- footer section ends -->

<!-- jquery file link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>