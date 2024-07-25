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
                <li><a href="#complaint_form">Lodge complains</a></li>
                <li><a href="#Clearence_Reports">Clearence reports</a></li>
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
        <p>forgot password? <a href="#">click here</a></p>
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

<section class="course" id="complaint_form">

<?php include 'connection.php'; ?>

</section>
    <!-- <div class="form-container">
        <h1 class="heading">Lodge Complains</h1>    

        <h2>Complaints Status</h2>
        <form action="connection.php" method="post" enctype="multipart/form-data">
            <label for="district">Your District</label>
            <select id="district" name="district">
                <option value="">Select District</option>
            </select>

            <label for="police-station">Nearest Police Station</label>
            <select id="police-station" name="police-station">
                <option value="">Select Police Station</option>
            </select>

            <label for="complaint-category">Complaint Category</label>
            <select id="complaint-category" name="complaint-category">
                <option value="">Select Complaint Category</option>
            </select>

            <label for="name">Your Name</label>
            <input type="text" id="name" name="name">

            <label for="address">Address</label>
            <textarea id="address" name="address"></textarea>

            <label for="nic-number">NIC Number</label>
            <input type="text" id="nic-number" name="nic-number">

            <label for="contact-number">Contact Number</label>
            <input type="text" id="contact-number" name="contact-number">

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email">

            <label for="complaint">Complaint</label>
            <textarea id="complaint" name="complaint"></textarea>

            <label for="complaint-subject">Complaint Subject</label>
            <input type="text" id="complaint-subject" name="complaint-subject">

            <label>
                <input type="checkbox" name="notification">
                I need notification about the status of the complaint
            </label>

            <label for="attachment">Attachment (Max size 5MB)</label>
            <input type="file" id="attachment" name="attachment">

            <label for="captcha">Enter Captcha</label>
            <input type="text" id="captcha" name="captcha">

            <button type="submit">Submit</button>
        </form>
    </div> -->



<!-- Lodge complains section ends -->

<!-- Clearence reports section starts  -->
<section class="Clearence Reports" id="Clearence_Reports">
<div class="container">
    <h2>Application</h2>
    <p>If you need to get an extended clearance certificate for a previously approved one, then please select renewal. The clearance period has to be same as the previous certificate. A new certificate for the same period but for a different country also can be obtained through the renewal. Application charges are applicable.
    <br>An application can be renewed within one year from the date the clearance certificate was issued.</p>
    
    <form action="submit_clearance_report.php" method="post">
        <label for="applicationType">Application Type</label>
        <select id="applicationType" name="applicationType">
            <option value="NEW">New Application</option>
            <option value="RNW">Renewal</option>
        </select>

        <label for="name">Your Name</label>
        <input type="text" id="name" name="name">

        <label for="nationality">Nationality:</label>
        <select id="nationality" name="nationality">
            <option value="" disabled selected>Please select</option>
            <option value="Sinhala">Sinhala</option>
            <option value="Sri Lankan Tamil">Sri Lankan Tamil</option>
            <option value="Indian Tamil">Indian Tamil</option>
            <option value="Muslim">Muslim</option>
            <option value="Burgher">Burgher</option>
            <option value="Malay">Malay</option>
            <option value="Veddah">Veddah</option>
            <option value="Other">Other</option>
        </select>

        <label for="citizenOfSriLanka">Were you a citizen of Sri Lanka?</label>
        <select id="citizenOfSriLanka" name="citizenOfSriLanka">
            <option value="yes">Yes</option>
            <option value="no">No</option>
        </select>

        <label for="dob">Date Of Birth</label>
        <input type="date" id="dob" name="dob">

        <label for="leftSriLanka">Did you leave Sri Lanka before the age 16?</label>
        <select id="leftSriLanka" name="leftSriLanka">
            <option value="yes">Yes</option>
            <option value="no">No</option>
        </select>

        <label for="age">Age in years:</label>
        <input type="number" id="age" name="age">

        <label for="nicNo">NIC No:</label>
        <input type="text" id="nicNo" name="nicNo">

        <label for="confirmNicNo">Confirm NIC No:</label>
        <input type="text" id="confirmNicNo" name="confirmNicNo">

        <label for="newNicNo">New NIC No: (if any)</label>
        <input type="text" id="newNicNo" name="newNicNo">

        <label for="confirmNewNicNo">Confirm New NIC No:</label>
        <input type="text" id="confirmNewNicNo" name="confirmNewNicNo">

        <label for="passportNo">Passport No:</label>
        <input type="text" id="passportNo" name="passportNo">

        <label for="confirmPassportNo">Confirm Passport No:</label>
        <input type="text" id="confirmPassportNo" name="confirmPassportNo">

        <label for="mail"> Email:</label>
        <input type="email" id="mail" name="mail">

        <label for="country">Country:</label>
        <select id="country" name="country">
            <option value="" disabled selected>Please select</option>
            <option value="Sri Lanka">Sri Lanka</option>
            <option value="India">India</option>
            <option value="United States">United States</option>
            <option value="United Kingdom">United Kingdom</option>
            <option value="Australia">Australia</option>
            <option value="Canada">Canada</option>
            <option value="Maldives">Maldives</option>
            <option value="Singapore">Singapore</option>
            <option value="Malaysia">Malaysia</option>
            <option value="United Arab Emirates">United Arab Emirates</option>
            <option value="Saudi Arabia">Saudi Arabia</option>
            <option value="Qatar">Qatar</option>
            <option value="Kuwait">Kuwait</option>
            <option value="Oman">Oman</option>
            <option value="France">France</option>
            <option value="Germany">Germany</option>
            <option value="Italy">Italy</option>
            <option value="New Zealand">New Zealand</option>
            <option value="South Africa">South Africa</option>
            <option value="Japan">Japan</option>
            <option value="South Korea">South Korea</option>
            <option value="China">China</option>
            <option value="Thailand">Thailand</option>
            <option value="Indonesia">Indonesia</option>
            <option value="Other">Other</option>
        </select>

        <label for="highCommission">High Commission/Embassy/Consulate Name (Addressee & the Name of the Authority):</label>
        <input type="text" id="highCommission" name="highCommission" placeholder="e.g. H. E. THE HIGH COMMISSIONER, SRI LANKAN HIGH COMMISSION">

        <label for="address">Indicate address of the High Commission/Embassy/Consulate to which the certificate should be addressed to:</label>
        <input type="text" id="address" name="address">

        

        <button type="submit">Verify</button>
    </form>
</div>

<!-- clearence report section ends -->

<!-- Lost mobiles section starts  -->

<div class="contact-container">

    <section class="contact" id="contact">

       
        
        </div>
        
        </section>

</div>

<!-- Lost Mobiles section ends -->

<!-- Bookings sectionn start here  -->

<div class="Bookings-container">

    <section class="Bookings" id="Booking">

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