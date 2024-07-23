function fetchPrisonerData() {
    fetch('http://localhost/policeautomationsystem/fetch_prisoners.php')  // Replace with the correct path to your PHP file
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector('#prisoners-content tbody');
            tbody.innerHTML = '';  // Clear existing content

            data.forEach(prisoner => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${prisoner.id}</td>
                    <td>${prisoner.nic}</td>
                    <td>${prisoner.name}</td>
                    <td>${prisoner.birthday}</td>
                    <td>${prisoner.date_imprisoned}</td>
                    <td>${prisoner.period_of_imprisonment}</td>
                    <td>${prisoner.acquitted_on || 'N/A'}</td>
                    <td>${prisoner.responsible_crime}</td>
                    <td>${prisoner.case_reference_no}</td>
                    <td><img src="${prisoner.image}" alt="Prisoner Image" width="100"></td>
                `;
                tbody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error fetching prisoner data:', error);
            // Handle error appropriately (e.g., show a message to the user)
        });
}

// Add event listener to load prisoner data when the section is shown
document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('#prisoners-link').addEventListener('click', function() {
        document.querySelectorAll('.container > div').forEach(section => {
            section.classList.add('d-none');
        });
        document.querySelector('#prisoners-content').classList.remove('d-none');
        document.querySelector('#page-title').textContent = 'Prisoners';

        fetchPrisonerData();  // Fetch data when section is shown
    });
});
