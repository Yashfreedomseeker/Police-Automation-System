document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('searchComplaintsForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission
        
        // Fetch complaint data via AJAX
        const referenceNo = document.getElementById('referenceNo').value;
        
        // Example AJAX request to fetch complaints from PHP
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'fetch_complaints.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        
        // Handle the response
        xhr.onload = function() {
            if (xhr.status === 200) {
                var complaints = JSON.parse(xhr.responseText); // Assuming response is JSON
                displayComplaints(complaints);
            } else {
                alert('Failed to fetch complaints. Try again.');
            }
        };
        // Send the request with reference number
        xhr.send('referenceNo=' + referenceNo);
    });
});


// Function to display complaints in a table
function displayComplaints(complaints) {
    var tableBody = document.getElementById('complaintsTableBody');
    tableBody.innerHTML = ''; // Clear existing rows

    complaints.forEach(function(complaint) {
        var row = document.createElement('tr');
        
        // Create table cells
        var idCell = document.createElement('td');
        idCell.textContent = complaint.Complain_ID;
        
        var nameCell = document.createElement('td');
        nameCell.textContent = complaint.Complainer_Name;
        
        var refNoCell = document.createElement('td');
        refNoCell.textContent = complaint.Reference_No;
        
        var detailsCell = document.createElement('td');
        detailsCell.textContent = complaint.Complaint_Details;
        
        var dateCell = document.createElement('td');
        dateCell.textContent = complaint.Date;
        
        var categoryCell = document.createElement('td');
        categoryCell.textContent = complaint.Category;
        
        // Append cells to row
        row.appendChild(idCell);
        row.appendChild(nameCell);
        row.appendChild(refNoCell);
        row.appendChild(detailsCell);
        row.appendChild(dateCell);
        row.appendChild(categoryCell);
        
        // Append row to table body
        tableBody.appendChild(row);
    });
}
