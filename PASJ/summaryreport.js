const ctx2 = document.getElementById('crimeCategoriesChart').getContext('2d');

// Prepare the data for the pie chart (you can adjust these mappings as needed)
const crimeCategoriesData = {
    'Theft': 120,    // Example value, you can fetch the actual value from SQL if available
    'Assault': 80,
    'Vandalism': 50,
    'Robbery': 40,
    'Homicide': 10
};

// Now initialize the chart using the data
const crimeCategoriesChart = new Chart(ctx2, {
    type: 'pie',
    data: {
        labels: Object.keys(crimeCategoriesData),  // Labels are the keys
        datasets: [{
            label: 'Crime Categories',
            data: Object.values(crimeCategoriesData),  // Data are the values
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true
    }
});

if (typeof countData !== 'undefined') {
    const { prisonerCount, complaintCount, caseCount, unresolvedCount } = countData;
    
    // Populate HTML elements with the PHP data
    document.getElementById('prisonerCountText').innerText = prisonerCount;
    document.getElementById('complaintCountText').innerText = complaintCount;
    document.getElementById('caseCountText').innerText = caseCount;
    document.getElementById('unresolvedCountText').innerText = unresolvedCount;
// Add functionality to generate PDF report with the chart and statistics
    document.getElementById('generate-report-btn').addEventListener('click', function() {
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF();

        // Add chart image to PDF
        const imgData = crimeCategoriesChart.toBase64Image();
        pdf.addImage(imgData, 'PNG', 10, 10, 180, 100);

        // Add report details
        pdf.setFontSize(18);
        pdf.text('Summary Report', 10, 120);

        // Add prisoner count
        pdf.setFontSize(12);
        pdf.text('Prisoners Count: ' + prisonerCount, 10, 130);

        // Add complaint count
        pdf.text('Complaints Count: ' + complaintCount, 10, 140);

        // Add case count
        pdf.text('Cases Count: ' + caseCount, 10, 150);

        // Add unresolved case count
        pdf.text('Unresolved Cases Count: ' + unresolvedCount, 10, 160);

        // if (unresolvedCases.length > 0) {
        //     pdf.text('Unresolved Case IDs:', 10, 170);
        //     unresolvedCases.forEach((caseItem, index) => {
        //         pdf.text(caseItem.case_id + ' - ' + caseItem.case_type, 10, 180 + (index * 10));
        //     });
        // } else {
        //     pdf.text('No unresolved cases.', 10, 170);
        // }

        // Save the PDF
        pdf.save("summary_report.pdf");
    });
}