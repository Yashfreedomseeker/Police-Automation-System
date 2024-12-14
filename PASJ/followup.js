document.addEventListener('DOMContentLoaded', function () {
    const followUpLink = document.getElementById('follow-up-link');
    const followUpContent = document.getElementById('follow-up-content');
    const dashboardContent = document.getElementById('dashboard-content');
    const followUpForm = document.getElementById('follow-up-form');
    const bookingContent = document.getElementById('view-bookings-content');
    const prisonersContent = document.getElementById('prisoners-content');
    const profileDetailsfollowup = document.getElementById('my-profile-content');
    console.log("dom fully loaded");

    followUpLink.addEventListener('click', function (e) {
        followUpContent.classList.remove('d-none');
        followUpForm.classList.remove('d-none');
        document.querySelector('#page-title').textContent = 'Follow up';
        dashboardContent.classList.add('d-none');
        prisonersContent.classList.add('d-none');
        bookingContent.classList.add('d-none');
        profileDetailsfollowup.classList.add('d-none');
        e.preventDefault();
        followup(followUpForm);
    });

});

function followup(followUpForm){
    const formData = new FormData(followUpForm);
    fetch('http://localhost/police_Automation_System/PASJ/record_update.php', {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Network response was not ok (${response.status})`);
            }
            return response.text();  // Use text instead of json to capture all responses
        })
    //         .then(text => {
    //             try {
    //                 // Try to parse the response as JSON
    //                 const data = JSON.parse(text);
                
    //                 // Check if the server response indicates success
    //                 if (data.success) {
    //                     alert('Update recorded successfully!');
    //                     followUpForm.reset();
    //                     followUpContent.classList.add('d-none');
    //                     dashboardContent.classList.remove('d-none');
    //                 } else {
    //                     alert('Failed to record update: ' + (data.message || 'Unknown error.'));
    //                 }
    //             } catch (error) {
    //                 // If parsing fails, log the raw response and alert the user
    //                 console.error('Error parsing JSON:', error);
    //                 console.log('Server response:', text);  // Log the raw response for debugging
    //                 alert('Unexpected server response. Check the console for more details.');
    //             }
    //         })
    .catch(error => {
            // Handle fetch/network errors
        console.error('Fetch error:', error);
        alert('Error submitting form: ' + error.message);
    });
};