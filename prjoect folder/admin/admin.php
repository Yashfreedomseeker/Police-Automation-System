<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost/police_Automation_System/policefinal/homepage.php"); // Redirect to login if not logged in
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
    <title>Sri Lanka Police</title>
    <link rel="stylesheet" href="admin.css">
    <style>
        .form-section {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="admin">
                <img src="profile.jpeg" alt="Profile Picture" class="profilepic" onclick=toggleProfileDetails()><br>
                <h3 id = "pname"><?php echo htmlspecialchars($username); ?>'s Profile</h3> 
                <script>
                function toggleProfileDetails() {
                    const profileDetails = document.getElementById("viewAdmin");
                    // Toggle visibility
                    if (profileDetails.style.display === "none" || profileDetails.style.display === "") {
                        profileDetails.style.display = "block";  // Show the profile details
                    } else {
                        profileDetails.style.display = "none";  // Hide the profile details
                    }
                }
                </script>

            </div>
            <nav>
                <label for="menu">Menu</label>
                <select id="menu" onchange="location = this.value;">
                    <option value="http://localhost/police_Automation_System/admin/admin.php">Dashboard</option>
                    <option value="javascript:showForm('addAdmin')">Add Admin</option>
                    <!-- <option value="javascript:showForm('searchComplaints')">Search Complaints</option> -->
                </select>
                <label for="menu">Police</label>
                <select id="menu" onchange="location = this.value;" label="Police">
                    <option value="javascript:showForm('addPolice')">Add Police</option>
                    <option value="javascript:showForm('updatePolice')">Update Police</option>
                    <option value="javascript:showForm('deletePolice')">Delete Police</option>
                    <option value="javascript:showForm('searchPolice')">Search Police</option>
                </select>
                <label for="menu">Prisoner</label>
                <select id="menu" onchange="location = this.value;" label="Prisoner">
                    <option value="javascript:showForm('addPrisoner')">Add Prisoner</option>
                    <option value="javascript:showForm('updatePrisoner')">Update Prisoner</option>
                    <option value="javascript:showForm('deletePrisoner')">Delete Prisoner</option>
                    <option value="javascript:showForm('searchPrisoner')">Search Prisoner</option>
                </select>
            </nav>
            <button class="logout" onclick="logoutAndRedirect()">Log out</button> 

            <script>
            function logoutAndRedirect() {
                fetch('logout.php')  // Send a request to the logout script
                    .then(() => {
                        window.location.href = 'http://localhost/police_Automation_System/policefinal/homepage.php';  // Redirect to homepage
                    });
            }
            </script>
        </aside>
        <main class="main-content">
            <header>
                <h1>SRI LANKA POLICE</h1>
            </header>
            <section class="cards">

                <!-- Search Complaints Form -->

                <!-- <div class="card form-section" id="searchComplaints">
                    <h2>Search Complaints</h2>

                    <form id="searchComplaintsForm">
                        <input type="text" id="referenceNo" placeholder="Enter Reference No." required>
                        <button type="submit">Search Complaints</button>
                    </form>
                    <table border = "1" cellspacing = "0" id="complaintsTable">
                        <tbody id="complaintsTableBody">
                            <tr><th>Complaint ID</th><td id="c_refno"></td></tr>
                            <tr><th>Complainer NIC</th><td id="c_nic"></td></tr>
                            <tr><th>Complainer name</th><td id="c_name"></td></tr>
                            <tr><th>Complainer address</th><td id="c_address"></td></tr>
                            <tr><th>Email</th><td id="c_email"></td></tr>
                            <tr><th>contact_no</th><td id="c_contact"></td></tr>
                            <tr><th>District</th><td id="_district"></td></tr>
                            <tr><th>police station</th><td id="c_pstation"></td></tr>
                            <tr><th>contact_no</th><td id="c_contact"></td></tr>
                        </tbody>
                    </table>
                    <script src="searchcomplint.js"></script>
                </div> -->

                <!-- Add Admin -->
                <div class="card form-section" id="addAdmin">
                    <h2>Add Admin</h2>
                    <form action="add_admin.php" method="POST">
                        <input type="text" name="nic" placeholder="NIC" required>
                        <input type="text" name="name" placeholder="Name" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <input type="password" name="confirm" placeholder="Confirm Password" required>
                        <br><button type="submit">Add Admin</button>
                    </form>
                </div>

                <!-- view admin -->
                <div id="viewAdmin" class="d-none" >
                    <center><h3 class="heading">Your Profile Details</h3></center>
                    <table id="tableadmin">
                        <tr><th>Admin ID</th><td id="profile-admin-id"></td></tr>
                        <tr><th>NIC</th><td id="profile-admin-nic"></td></tr>
                        <tr><th>Name</th><td id="profile-admin-name"></td></tr>
                    </table>
                </div>

                 <!-- Add Police Form -->
                <div class="card form-section" id="addPolice">
                    <h2>Add Police Officer</h2>
                    <form action="add_police.php" method="POST">
                        
                        <input type="text" name="nic" placeholder="NIC" required>
                        <input type="text" name="name" placeholder="Name" required>
                        <input type="text" name="mobile" placeholder="Contact no." required>
                        <br><label class="justtext">Date of birth</label></br><input type="date" name="dob" placeholder="Date of Birth" required>
                        <br><label class="justtext">Date of Enrolled</label></br><input type="date" name="date_of_enrolled" placeholder="Date of Enrolled" required>
                        <input type="text" name="position" placeholder="Position" required>
                        <input type="text" name="promotion_details" placeholder="Promotion Details" required>
                        <textarea name="address" placeholder="Address" required></textarea>
                        <input type="password" name="password" placeholder="Password" required>
                        <input type="password" name="confirm" placeholder="Confirm Password" required>
                        <br><button type="submit" name="submit">Add Police Officer</button>
                    </form>
                </div>
                
                <div class="card form-section" id="updatePolice">
                    <h2>Update Police Officer</h2>
                
                    <!-- Checkbox list to select which fields to update -->
                    <h3>Select fields to update:</h3>
                    <div class="field-selection">
                        <input type="checkbox" id="selectNIC" onchange="toggleField('nicField')"> <label for="selectNIC">NIC</label><br>
                        <input type="checkbox" id="selectName" onchange="toggleField('nameField')"> <label for="selectName">Name</label><br>
                        <input type="checkbox" id="selectDob" onchange="toggleField('dobField')"> <label for="selectDob">Date of Birth</label><br>
                        <input type="checkbox" id="selectDoe" onchange="toggleField('doeField')"> <label for="selectDoe">Date of Enrollment</label><br>
                        <input type="checkbox" id="selectPosition" onchange="toggleField('positionField')"> <label for="selectPosition">Position</label><br>
                        <input type="checkbox" id="selectContact" onchange="toggleField('contactField')"> <label for="selectContact">Contact No.</label><br>
                        <input type="checkbox" id="selectPromotion" onchange="toggleField('promotionField')"> <label for="selectPromotion">Promotion Details</label><br>
                        <input type="checkbox" id="selectAddress" onchange="toggleField('addressField')"> <label for="selectAddress">Address</label><br>
                    </div>
                
                    <!-- Form to update police officer information -->
                    <form action="update_police.php" method="POST">
                        <input type="text" name="id" placeholder="Police Officer ID to Update" required>
                
                        <!-- Input fields hidden by default and shown when corresponding checkbox is selected -->
                        <div id="nicField" class="input-field" style="display: none;">
                            <input type="text" name="nic" placeholder="Updating NIC">
                        </div>

                        <div id="nameField" class="input-field" style="display: none;">
                            <input type="text" name="name" placeholder="New Name">
                        </div>
                
                        <div id="dobField" class="input-field" style="display: none;">
                            <input type="date" name="dob" placeholder="New Date of Birth">
                        </div>
                
                        <div id="doeField" class="input-field" style="display: none;">
                            <input type="date" name="doe" placeholder="New Date of Enrollment">
                        </div>
                
                        <div id="positionField" class="input-field" style="display: none;">
                            <input type="text" name="position" placeholder="New Position">
                        </div>
                
                        <div id="branchField" class="input-field" style="display: none;">
                            <input type="text" name="branch" placeholder="New Current Branch">
                        </div>
                
                        <div id="contactField" class="input-field" style="display: none;">
                            <input type="text" name="contact" placeholder="New Contact No.">
                        </div>
                
                        <div id="promotionField" class="input-field" style="display: none;">
                            <input type="text" name="promotion" placeholder="New Promotion Details">
                        </div>
                
                        <div id="addressField" class="input-field" style="display: none;">
                            <input type="text" name="address" placeholder="New Address">
                        </div>
                
                        <button type="submit">Update Police Officer</button>
                    </form>
                
                    <script>
                        // Function to toggle the visibility of input fields based on checkbox selection
                        function toggleField(fieldId) {
                            var field = document.getElementById(fieldId);
                            field.style.display = field.style.display === 'none' ? 'block' : 'none';
                        }
                    </script>
                </div>
                
                <!-- Delete Police Form -->
                <div class="card form-section" id="deletePolice">
                    <h2>Delete Police Officer</h2>
                    <form action="delete_police.php" method="POST">
                        <input type="text" name="nic" placeholder="NIC of Police Officer to Delete" required>
                        <button type="submit">Delete Police Officer</button>
                    </form>
                </div>

                <!-- Search Police Form -->
                <div class="card form-section" id="searchPolice">
                    <h2>Search Police Officer</h2>
                    <form action="search_police.php" method="POST">
                        <input type="text" name="nic" placeholder="NIC of Police Officer to Search" required>
                        <button type="submit">Search Police Officer</button>
                    </form>
                </div>

                <!-- Add Prisoner Form -->
                <div class="card form-section" id="addPrisoner">
                    <h2>Add Prisoner</h2>
                    <form action="add_prisoner.php" method="POST" enctype="multipart/form-data">
                        <input type="text" name="nic" placeholder="NIC" required>
                        <input type="text" name="name" placeholder="Name" required>
                        <br><label class="justtext">Date of Birth</label></br><input type="date" name="dob" placeholder="Date of Birth" required>
                        <br><label class="justtext">Date of Imprisonment</br><input type="date" name="doi" placeholder="Date of Imprisonment" required>
                        <input type="number" name="period" placeholder="Period of Imprisonment (days)" required>
                        <br><label class="justtext">Date of Acquittal</label></br><input type="date" name="doa" placeholder="date of aquittal" required>
                        <input type="text" name="crime" placeholder="Responsible Crime" required>
                        <input type="text" name="caseref" placeholder="Case Reference No." required>
                        <br><label class="justtext">Prisoner Image</br><input type="file" name="image" required>
                        <br><button type="submit" name="submitprisoner">Add Prisoner</button>
                    </form>
                </div>

                <!-- Update Prisoner Form -->
                <div class="card form-section" id="updatePrisoner">
                    <h2>Update Prisoner</h2>

                    <!-- Checkbox list to select which fields to update -->
                    <h3>Select fields to update:</h3>
                    <div class="field-selection">
                        <input type="checkbox" id="selectNIC" onchange="toggleField('NICField')"> <label for="selectNIC">NIC</label><br>
                        <input type="checkbox" id="selectName" onchange="toggleField('NameField')"> <label for="selectName">Name</label><br>
                        <input type="checkbox" id="selectDob" onchange="toggleField('DobField')"> <label for="selectDob">Date of Birth</label><br>
                        <input type="checkbox" id="selectDoi" onchange="toggleField('DoiField')"> <label for="selectDoi">Date of Imprisonment</label><br>
                        <input type="checkbox" id="selectPeriod" onchange="toggleField('PeriodField')"> <label for="selectPeriod">Period of Imprisonment</label><br>
                        <input type="checkbox" id="selectAcquittal" onchange="toggleField('acquittedField')"> <label for="selectAcquittal">Date of acquittal</label><br>
                        <input type="checkbox" id="selectCrime" onchange="toggleField('CrimeField')"> <label for="selectCrime">Responsible Crime</label><br>
                        <input type="checkbox" id="selectRef" onchange="toggleField('RefField')"> <label for="selectRef">Case Reference No.</label><br>
                    </div>

                    <!-- Form to update prisoner information -->
                    <form action="update_prisoner.php" method="POST">
                        <input type="text" name="id" placeholder="ID of Prisoner to Update" required>
                        
                        <!-- Input fields hidden by default and shown when corresponding checkbox is selected -->
                        <div id="NICField" class="input-field" style="display: none;">
                            <input type="text" name="nic" placeholder="Update NIC">
                        </div>

                        <div id="NameField" class="input-field" style="display: none;">
                            <input type="text" name="name" placeholder="New Name">
                        </div>

                        <div id="DobField" class="input-field" style="display: none;">
                            <input type="date" name="dob" placeholder="New Date of Birth">
                        </div>

                        <div id="DoiField" class="input-field" style="display: none;">
                            <input type="date" name="doi" placeholder="New Date of Imprisonment">
                        </div>

                        <div id="PeriodField" class="input-field" style="display: none;">
                            <input type="text" name="period" placeholder="New Period of Imprisonment">
                        </div>

                        <div id="acquittedField" class="input-field" style="display: none;">
                            <input type="date" name="acquittal" placeholder="New Date of Acquittal">
                        </div>

                        <div id="CrimeField" class="input-field" style="display: none;">
                            <input type="text" name="crime" placeholder="New Responsible Crime">
                        </div>

                        <div id="RefField" class="input-field" style="display: none;">
                            <input type="text" name="ref" placeholder="New Case Reference No.">
                        </div>

                        <button type="submit">Update Prisoner</button>
                    </form>

                    <script>
                        // Function to toggle the visibility of input fields based on checkbox selection
                        function toggleField(fieldId){
                            const field = document.getElementById(fieldId);
                            if (field.style.display === "none") {
                                field.style.display = "block";  // Show the field
                            } else {
                                field.style.display = "none";   // Hide the field
                                alert('the field is not displaying');
                            }
                        }
                    </script>
                </div>
               

                <!-- Delete Prisoner Form -->
                <div class="card form-section" id="deletePrisoner">
                    <h2>Delete Prisoner</h2>
                    <form action="delete_prisoner.php" method="POST">
                        <input type="text" name="id" placeholder="ID of Prisoner to Delete" required>
                        <button type="submit">Delete Prisoner</button>
                    </form>
                </div>

                <!-- Search Prisoner Form -->
                <div class="card form-section" id="searchPrisoner">
                    <h2>Search Prisoner</h2>
                    <form action="search_prisoner.php" method="POST">
                        <input type="text" name="id" placeholder="ID of Prisoner to Search" required>
                        <button type="submit">Search Prisoner</button>
                    </form>
                </div>

            </section>
        </main>
    </div>

    <script>
        function showForm(formId) {
            // Hide all forms
            var forms = document.querySelectorAll('.form-section');
            forms.forEach(function(form) {
                form.style.display = 'none';
            });

            // Show the selected form
            document.getElementById(formId).style.display = 'block';
        }
    </script>
    <script src="http://localhost/police_Automation_System/PASJ/profile.js"></script>


    

</body>
</html>
