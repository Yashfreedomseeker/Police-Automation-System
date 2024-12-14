function fetchPrisonerData(nic) {
    fetch(`http://localhost/police_Automation_System/PASJ/fetch_prisoners.php?nic=${nic}`)
        .then(response => response.json())
        .then(data => {
            if (Array.isArray(data) && data.length > 0) {
                const prisoner = data[0];  // Assuming only one prisoner will match the NIC

                // Update table with the prisoner details
                document.getElementById('pr-id').textContent = prisoner.id || 'N/A';
                document.getElementById('pr-nic').textContent = prisoner.nic || 'N/A';
                document.getElementById('pr-name').textContent = prisoner.name || 'N/A';
                document.getElementById('pr-bday').textContent = prisoner.birthday || 'N/A';
                document.getElementById('pr-date-imprisoned').textContent = prisoner.date_imprisoned || 'N/A';
                document.getElementById('pr-period-of-imprison').textContent = prisoner.period_of_imprisonment || 'N/A';
                document.getElementById('pr-acquitted').textContent = prisoner.acquitted_on || 'N/A';
                document.getElementById('pr-responsible-crime').textContent = prisoner.responsible_crime || 'N/A';
                document.getElementById('pr-case-ref').textContent = prisoner.case_reference_no || 'N/A';

                const imageElement = document.getElementById('pr-image');
                if (prisoner.image) {
                    imageElement.innerHTML = `<img src="${prisoner.image}" alt="Prisoner Image" id="pr-image">`;
                } else {
                    imageElement.textContent = 'No Image Available';
                }
            } else {
                // Handle the case where no prisoner data is returned
                alert("No prisoner found with this NIC.");
            }
        })
        .catch(error => {
            console.error('Error fetching prisoner data:', error);
        });
}




const followUpContent = document.getElementById('follow-up-content');
// const dashboardContent = document.getElementById('dashboard-content');
const booking = document.getElementById('view-bookings-content');
const profileDetailsprisoners = document.getElementById('my-profile-content');

// Add event listener to load prisoner data when the section is shown
document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('#prisoners-link').addEventListener('click', function() {
        document.querySelectorAll('.container > div').forEach(section => {
            section.classList.add('d-none');
        });
        document.querySelector('#prisoners-content').classList.remove('d-none');
        document.querySelector('#page-title').textContent = 'Prisoners';
        followUpContent.classList.add('d-none');
        booking.classList.add('d-none');
        profileDetailsprisoners.classList.add('d-none');
    });
});
const searchPrisoner = document.getElementById('search-button');
    searchPrisoner.addEventListener('click', () => {
        const nic = document.getElementById('nic-input').value.trim();  // Get NIC from input
        if (nic) {
            fetchPrisonerData(nic);  // Pass NIC to the function
        } else {
            alert("Please enter a NIC.");
        }
    }
);

