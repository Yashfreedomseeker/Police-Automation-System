// profile.js

document.addEventListener('DOMContentLoaded', function() {
    // No need to fetch profile data on load, we'll do it on logo click
});

function promptForNIC() {
    const nic = prompt("Please enter the NIC:");
    if (nic) {
        fetchProfileData(nic);
    } else {
        alert("NIC is required to fetch profile details.");
    }
}

function fetchProfileData(nic) {
    fetch(`http://localhost/policeautomationsystem/getProfile.php?nic=${nic}`)
        .then(response => response.json())
        .then(data => {
            if (data.police_id) {
                
                document.getElementById('profile-police-id').textContent = data.police_id;
                document.getElementById('profile-nic').textContent = data.nic;
                document.getElementById('profile-name').textContent = data.name;
                document.getElementById('profile-mobile').textContent = data.mobile;
                document.getElementById('profile-birthday').textContent = data.birthday;
                document.getElementById('profile-address').textContent = data.address;
                document.getElementById('profile-date-joined').textContent = data.date_joined;
                document.getElementById('profile-date-leaving').textContent = data.date_leaving;
                document.getElementById('profile-position').textContent = data.position;
                document.getElementById('profile-promotions').textContent = data.promotions;
                document.getElementById('my-profile-content').classList.remove('d-none');
            } else {
                alert("No profile data found for the entered NIC.");
            }
        })
        .catch(error => console.error('Error fetching profile data:', error));
}
