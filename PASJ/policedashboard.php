<?php
include('errors.php');

session_start();
if (!isset($_SESSION['user_id'])) {
    echo($_SESSION['user_id']);
    //header("Location: http://localhost/police_Automation_System/policefinal/homepage.php"); // Redirect to login if not logged in
    exit();
}
// Retrieve the username from the session
$username = $_SESSION['user_id'];
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Police Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <div class="sidebar">
        <div class="profile-section">
            <img src="profile.jpeg" alt="Profile Picture" class="profile-pic" onclick=addProfilePicListener()><br>
            <h6 id = "pname"><?php echo htmlspecialchars($username); ?>'s Profile</h6>
        </div>
        
        <a href="policedashboard.php" id="dashboard-link">Dashboard</a>
        <a href="newcase.php" id="new-case-link">New Case</a>
        <a href="#" id="follow-up-link">Follow Up</a>
        <a href="#" id="prisoners-link" onclick="fetchPrisonerData()">Prisoners</a>
        <a href="#" id="view-bookings-link">View Bookings</a>
        <button class="btn btn-secondary logout-btn" onclick="logoutAndRedirect()">Log out</button>

        <script>
        function logoutAndRedirect() {
            fetch('logout.php')  // Send a request to the logout script
                .then(() => {
                    window.location.href = 'http://localhost/police_Automation_System/policefinal/homepage.php';  // Redirect to homepage
                });
        }
        </script>

       
    </div>
    <div class="content">

    <center><h2><img src="policelogo.png" alt="Police-logo-Picture" class="logopic">SRI LANKA POLICE</h2></center>
        <div class="container">
            <h2 id="page-title">Welcome!</h2>
            <div id="dashboard-content">
                <div class="graphbox2"><?php include 'countdisplay.php'; ?></div>
                <div class="graphbox"> 
                    <!-- changed --> 
                    <?php include 'upcoming_bookings.php'; ?> 
                    <div class="box"><canvas id="crimeCategoriesChart"></canvas></div>
                </div>
                    <button class="btn btn-primary mt-3"id="generate-report-btn">Generate Summary Report for OIC</button>
                </div>
                
            </div>
            <div id="new-case-content" class="d-none">
            </div>
            <br>
            <div id="follow-up-content" class="d-none">
               
                <form action = "record_update.php" method = "post" enctype="multipart/form-data" id="follow-up-form" >
                   <center> <h5>Follow-up details and updates will be recorded here.</h5> </center>
                   
                    <div class="form-group">
                        <label for="case-id">Case ID</label>
                        <input type="text" class="form-control" id="case-id" name="case_id" required>
                    </div>
                    <div class="form-group">
                        <label for="case-status">Case Status</label>
                        <input type="text" class="form-control" id="case-status" name="case_status" required>
                    </div>
                    <div class="form-group">
                        <label for="evidence">Evidence</label>
                        <input type="file" class="form-control" id="evidence" name="evidence" required>
                    </div>
                    
                    <button type="submit" class="submit" name = "submitupdate">Submit Update</button>
                </form>
            
            </div>
            
            <div id="prisoners-content" class="d-none">
                <h3>Prisoner Details</h3>
                    <div id="search-prisoner">
                        <h5>Search Prisoner by NIC</h5>
                        <input type="text" id="nic-input" placeholder="Enter NIC">
                        <button id="search-button">Search</button>
                    </div>
                    <table class="table table-bordered">
                        <tbody>
                            <tr><th>Prisoner ID</th><td id="pr-id"></td></tr>
                            <tr><th>NIC</th><td id="pr-nic"></td></tr>
                            <tr><th>Name</th><td id="pr-name"></td></tr>
                            <tr><th>Birthday</th><td id="pr-bday"></td></tr>
                            <tr><th>Date Imprisoned</th><td id="pr-date-imprisoned"></td></tr>
                            <tr><th>Period of Imprisonment</th><td id="pr-period-of-imprison"></td></tr>
                            <tr><th>Acquitted On</th><td id="pr-acquitted"></td></tr>
                            <tr><th>Responsible Crime</th><td id="pr-responsible-crime"></td></tr>
                            <tr><th>Case Reference No.</th><td id="pr-case-ref"></td></tr>
                            <tr><th>Image</th><td id="pr-image"></td></tr>
                        </tbody>
                    </table>
            </div>

            <div id="view-bookings-content" class="d-none">
                <h3> Bookings Details</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NIC</th>
                                <th>Name</th>
                                <th>Date & Time</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dynamic rows will be inserted here -->
                        </tbody>
                    </table>
            </div>

            <div id="summary-report-container" class="mt-3">  
            </div>

            <div id="my-profile-content" class="d-none">
                
                <h3>Your Profile Details</h3>
                <table class="table table-bordered">
                    <tr><th>Police ID</th><td id="profile-police-id"></td></tr>
                    <tr><th>NIC</th><td id="profile-nic"></td></tr>
                    <tr><th>Name</th><td id="profile-name"></td></tr>
                    <tr><th>Mobile No.</th><td id="profile-mobile"></td></tr>
                    <tr><th>Birthday</th><td id="profile-birthday"></td></tr>
                    <tr><th>Address</th><td id="profile-address"></td></tr>
                    <tr><th>Date Joined</th><td id="profile-date-joined"></td></tr>
                    <tr><th>Position</th><td id="profile-position"></td></tr>
                    <tr><th>Promotions</th><td id="profile-promotions"></td></tr>
                    <tr><th>Password</th><td id="profile-password"></td></tr>
                </table>
            </div>

        </div>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="summaryreport.js"></script>
    <script src="dashboard.js"></script>
    <script src="booking.js"></script>
    <script src="followup.js"></script>
    <script src="profile.js"></script>
</body>
</html>
