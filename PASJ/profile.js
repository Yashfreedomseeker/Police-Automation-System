let user = null;  // Initialize the global user variable
let usernameInput;
let passwordInput;

document.addEventListener('DOMContentLoaded', function() {
    console.log("DOMloaded");
    // Ensure that usernameInput and passwordInput are available after DOM is fully loaded
    usernameInput = document.getElementById('username');
    passwordInput = document.getElementById('password');

});

function addProfilePicListener() {
    const followUpContentprofile = document.getElementById('follow-up-content');
    const dashboardContentprofile = document.getElementById('dashboard-content');
    const followUpFormprofile = document.getElementById('follow-up-form');
    const bookingContentprofile = document.getElementById('view-bookings-content');
    const prisonersContentprofile = document.getElementById('prisoners-content');

    const profilePic = document.querySelector('.profile-pic');
    if (profilePic) {
        profilePic.addEventListener('click', function(event) {
            document.querySelector('#page-title').textContent = 'My Profile';
            followUpContentprofile.classList.add('d-none');
            dashboardContentprofile.classList.add('d-none');
            followUpFormprofile.classList.add('d-none');
            bookingContentprofile.classList.add('d-none');
            prisonersContentprofile.classList.add('d-none');
            event.preventDefault();
    
            let profileNameText = document.getElementById('pname').textContent;
            user = profileNameText.split("'s")[0];
            console.log('user ',user);
            if (user) {
                console.log('Fetching profile data for user:', user);
                fetchProfileData(user);  // Use the global 'user' variable
            } else {
                alert("Please log in first.");
            }
        });
    } else {
        console.error('Profile picture element not found.');
    }
}

const pp = document.querySelector('.profilepic');
    if (pp) {
        pp.addEventListener('click', function(event) {
            event.preventDefault();
            let profileNameText = document.getElementById('pname').textContent;
            user = profileNameText.split("'s")[0];
            console.log('user ',user);
            if (user) {
                console.log('Fetching profile data for user:', user);
                fetchProfileData(user);  // Use the global 'user' variable
            } else {
                alert("Please log in first.");
            }
        });
    } else {
        console.error('Profile picture element not found.');
    }


function fetchProfileData(user) {
    // Fetch user profile data from getProfile.php
    fetch(`http://localhost/police_Automation_System/PASJ/getProfile.php?user=${user}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json(); // Parse the response body as JSON
        })
        .then(data => {
            if (data.success) {
                const profileData = data.data;
                // Check the role from the fetched data
                if (data.role === 'police') {
                    // Populate police profile data
                    document.getElementById('profile-police-id').textContent = profileData.police_id;
                    document.getElementById('profile-nic').textContent = profileData.nic;
                    document.getElementById('profile-name').textContent = profileData.name;
                    document.getElementById('profile-mobile').textContent = profileData.mobile;
                    document.getElementById('profile-birthday').textContent = profileData.birthday;
                    document.getElementById('profile-address').textContent = profileData.address;
                    document.getElementById('profile-date-joined').textContent = profileData.date_joined;
                    document.getElementById('profile-position').textContent = profileData.position;
                    document.getElementById('profile-promotions').textContent = profileData.promotions;
                    document.getElementById('my-profile-content').classList.remove('d-none');
                } else if (data.role === 'admin') {
                    // Populate admin profile data
                    document.getElementById('viewAdmin').classList.remove('d-none');
                    document.getElementById('profile-admin-id').textContent = profileData.id;
                    document.getElementById('profile-admin-nic').textContent = profileData.nic;
                    document.getElementById('profile-admin-name').textContent = profileData.name;
                } else {
                    alert("Invalid user role.");
                }
            } else {
                alert("No profile data found for the entered ID.");
                console.log('User: ', user);
                console.log('Response data:', data);
            }
        })
        .catch(error => {
            console.error('Error fetching profile data:', error);
        });
}