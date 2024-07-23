document.getElementById('generate-report-btn').addEventListener('click', function() {
    fetch('generate_summary_report.php')
        .then(response => response.json())
        .then(data => {
            displaySummaryReport(data);
        })
        .catch(error => console.error('Error fetching summary report:', error));
});

function displaySummaryReport(data) {
    const container = document.getElementById('summary-report-container');
    container.innerHTML = '';

    if (data.length === 0) {
        container.innerHTML = '<p>No summary report available.</p>';
        return;
    }

    const table = document.createElement('table');
    table.className = 'table table-bordered';

    const thead = document.createElement('thead');
    const headerRow = document.createElement('tr');
    ['Case Reference No.', 'Complainant ID', 'Case Type', 'Date and Time Happened', 'Evidences', 'Description'].forEach(text => {
        const th = document.createElement('th');
        th.textContent = text;
        headerRow.appendChild(th);
    });
    thead.appendChild(headerRow);
    table.appendChild(thead);

    const tbody = document.createElement('tbody');
    data.forEach(row => {
        const tr = document.createElement('tr');
        ['case_id', 'complainant_id', 'case_type', 'date_time', 'evidence', 'description'].forEach(key => {
            const td = document.createElement('td');
            td.textContent = row[key];
            tr.appendChild(td);
        });
        tbody.appendChild(tr);
    });
    table.appendChild(tbody);

    container.appendChild(table);
}
