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
            <img src="profile.jpeg" alt="Profile Picture" class="profile-pic" onclick="promptForNIC()">
           
                My Profile
        </div>
        
        <a href="policedashboard.php" id="dashboard-link">Dashboard</a>
        <a href="newcase.html" id="new-case-link">New Case</a>
        <a href="#" id="follow-up-link">Follow Up</a>
        <a href="#" id="prisoners-link">Prisoners</a>
        <a href="#" id="view-bookings-link">View Bookings</a>
        <button class="btn btn-secondary logout-btn" onclick="logoutAndRedirect()">Log out</button>

        <script>
        function logoutAndRedirect() {
            
            window.location.href = 'Police Automation System/Home page.html';
        }
        </script>

       
    </div>
    <div class="content">

    <center> <h2><img src="policelogo.png" alt="Police-logo-Picture" class="logopic">SRI LANKA POLICE</h2></center>
        <div class="container">
        
            <h2 id="page-title">Dashboard</h2>
            <div id="dashboard-content">

            
                <!--<div class="row">
                    <div class="col-md-4">
                        <div class="stat-box">New Case
                          <br>  
                          <a href="newcase.html"><img src="complaint1.jpeg" alt="Statistics 1" style="width: 200px;height:125px"></a>
                        </div>
                       
                    </div>
                    <div class="col-md-4">
                        <div class="stat-box">Follow Up
                        <br><img src="follow.jpeg" alt="Statistics 1" style="width: 200px;height:125px">
                    </div>
                        
                    </div>
                    <div class="col-md-4">
                        <div class="stat-box">Prisoners
                        <br><img src="jail.jpeg" alt="Statistics 1" style="width: 200px;height:125px">
                        </div>
                        
                    </div>

                    <div class="col-md-4">
                        <div class="stat-box">View Booking
                            <br><img src="book.jpeg" alt="Statistics 1" style="width: 200px;height:125px">
                        </div>
                        
                    </div>-->

                    
                      
                    
                </div>
                <button class="btn btn-primary mt-3"id="generate-report-btn">Generate Summary Report for OIC</button>
                    

            </div>
            <div id="new-case-content" class="d-none">
                
                
            </div>
            <br>
            <div id="follow-up-content" class="d-none">
               
                
                
                <form id="follow-up-form">
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
                    
                    <button type="submit" class="btn btn-primary">Submit Update</button>
                </form>

            
            </div>

            <div id="prisoners-content" class="d-none">
                
                <h3>Prisoner Details</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Prisoner ID</th>
                            <th>NIC</th>
                            <th>Name</th>
                            <th>Birthday</th>
                            <th>Date Imprisoned</th>
                            <th>Period of Imprisonment</th>
                            <th>Acquitted On</th>
                            <th>Responsible Crime</th>
                            <th>Case Reference No.</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Dynamic rows will be inserted here -->
                    </tbody>
                </table>

            </div>

            <div id="view-bookings-content" class="d-none">
            <h3> Bookings Deatails</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NIC</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Time</th>
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
                    <tr><th>Date Leaving</th><td id="profile-date-leaving"></td></tr>
                    <tr><th>Position</th><td id="profile-position"></td></tr>
                    <tr><th>Promotions</th><td id="profile-promotions"></td></tr>
                </table>
            </div>

        </div>
    </div>

    
    <script src="dashboard.js"></script>
    <script src="booking.js"></script>
    <script src="summaryreport.js"></script>
    <script src="profile.js"></script>
    <script src="followup.js"></script>
    
</body>
</html>
