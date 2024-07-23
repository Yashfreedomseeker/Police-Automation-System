document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('view-bookings-link').addEventListener('click', function(e) {
        e.preventDefault();
        fetchBookings();
    });

    function fetchBookings() {
        fetch('fetch_bookings.php')
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
                        <td>${booking.date}</td>
                        <td>${booking.time}</td>
                    `;
                    tbody.appendChild(row);
                });
                document.querySelectorAll('.container > div').forEach(section => {
                    section.classList.add('d-none');
                });
                document.querySelector('#view-bookings-content').classList.remove('d-none');
                document.querySelector('#page-title').textContent = 'View Bookings';
            })
            .catch(error => console.error('Error fetching bookings:', error));
    }
});
