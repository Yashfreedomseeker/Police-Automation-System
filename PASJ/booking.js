const dashboardContent = document.getElementById('dashboard-content');
const prisonersContent = document.getElementById('prisoners-content');
const followUp = document.getElementById('follow-up-content');
const profileDetailsbooking = document.getElementById('my-profile-content');

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('view-bookings-link').addEventListener('click', function(e) {
        document.querySelector('#view-bookings-content').classList.remove('d-none');
        document.querySelector('#page-title').textContent = 'View Bookings';
        dashboardContent.classList.add('d-none');
        prisonersContent.classList.add('d-none');
        followUp.classList.add('d-none');
        profileDetailsbooking.classList.add('d-none');
        e.preventDefault();
        fetchBookings();
    });

    function fetchBookings() {
        fetch('fetchbookings.php')
            .then(response => response.json())
            .then(data => {
                const tbody = document.querySelector('#view-bookings-content tbody');
                tbody.innerHTML = '';
                data.forEach(booking => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${booking.id}</td>
                        <td>${booking.nic}</td>
                        <td>${booking.name}</td>
                        <td>${booking.date_time}</td>
                        <td>${booking.email}</td>
                    `;
                    tbody.appendChild(row);
                });
                document.querySelectorAll('.container > div').forEach(section => {
                    section.classList.add('d-none');
                });
            })
            .catch(error => console.error('Error fetching bookings:', error));
    }
});
