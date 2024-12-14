<?php
include('errors.php');

$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "policeautomation";

// Enable mysqli exceptions for error handling
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Create a new database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Query to get the count of complaints
    $stmtComplaints = $conn->prepare("SELECT COUNT(*) AS complaint_count FROM lodgecomplains");
    $stmtComplaints->execute();
    $resultComplaints = $stmtComplaints->get_result();
    $complaintCount = $resultComplaints->fetch_assoc()['complaint_count'];
    $stmtComplaints->close();

    // Query to get the count of prisoners
    $stmtPrisoners = $conn->prepare("SELECT COUNT(*) AS prisoner_count FROM prisoners");
    $stmtPrisoners->execute();
    $resultPrisoners = $stmtPrisoners->get_result();
    $prisonerCount = $resultPrisoners->fetch_assoc()['prisoner_count'];
    $stmtPrisoners->close();

    // Query to get the count of cases
    $stmtCases = $conn->prepare("SELECT COUNT(*) AS case_count FROM cases");
    $stmtCases->execute();
    $resultCases = $stmtCases->get_result();
    $caseCount = $resultCases->fetch_assoc()['case_count'];
    $stmtCases->close();

    // Query to get the count of unresolved cases
    $stmtUnresolved = $conn->prepare("SELECT COUNT(*) AS unresolved_count FROM cases WHERE case_status = 'in progress'");
    $stmtUnresolved->execute();
    $resultUnresolved = $stmtUnresolved->get_result();
    $unresolvedCount = $resultUnresolved->fetch_assoc()['unresolved_count'];
    $stmtUnresolved->close();

    // Query to get the unresolved cases
    $stmtUnresolvedCases = $conn->prepare("SELECT case_id, case_type FROM cases WHERE case_status = 'in progress'");
    $stmtUnresolvedCases->execute();
    $resultUnresolvedCases = $stmtUnresolvedCases->get_result();

    // HTML output for displaying the stats
    echo "<div class='graphbox2'>";

    // Display complaint count
    echo "<div class='box3' id='complaintCountText'>";
    echo "<div><h4>Testing</h4><p>This is a test output</p></div>";
    echo "<h4>Complaints Count</h4>";
    echo "<p>Total Complaints: $complaintCount</p>";
    echo "<button><a href='view-complaints.php' class='button'>View Complaints</a></button>"; // Updated to link directly
    echo "</div>";

    // Display prisoner count
    echo "<div class='box3' id='prisonerCountText'>";
    echo "<h4>Prisoners Count</h4>";
    echo "<p>Total Prisoners: $prisonerCount</p>";
    echo "</div>";

    // Display case count
    echo "<div class='box3' id='caseCountText'>";
    echo "<h4>Cases Count</h4>";
    echo "<p>Total Cases: $caseCount</p>";
    echo "<button><a href='view-cases.php' class='button'>View Cases</a></button>"; // Updated to link directly
    echo "</div>";

    // Display unresolved case count
    echo "<div class='box3' id='unresolvedCountText'>";
    echo "<h4>Unresolved Cases</h4>";
    echo "<p>Unresolved Cases: $unresolvedCount</p>";

    if ($unresolvedCount > 0) {
        echo "<ul id='unresolvedCasesList'>";
        while ($row = $resultUnresolvedCases->fetch_assoc()) {
            echo "<li>" . $row['case_id'] . "</li>";

            $unresolvedCases[] = [
                'case_id' => $row['case_id'],
            ];
        }
        echo "</ul>";
    } else {
        echo "<p>No unresolved cases at the moment.</p>";
    }
    echo "</div>"; // End of unresolved cases box

    echo "</div>"; // End of graphbox

    $data = [
        'complaintCount' => $complaintCount,
        'prisonerCount' => $prisonerCount,
        'caseCount' => $caseCount,
        'unresolvedCount' => $unresolvedCount
    ];
    echo '<script>var countData = ' . json_encode($data) . ';</script>';

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->close();
    }
}
?>

HTML Part
<div id="content"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // Load the complaints PHP content
    $('#view-complaints').click(function() {
        $.ajax({
            url: 'view-complaints.php', // The PHP file to include dynamically
            method: 'POST',
            success: function(response) {
                // Inject the PHP response into the #content div
                $('#content').html(response);
            },
            error: function() {
                alert("An error occurred while loading the complaints.");
            }
        });
    });

    // Load the cases PHP content
    $('#view-cases').click(function() {
        $.ajax({
            url: 'view-cases.php', // The PHP file to include dynamically
            method: 'POST',
            success: function(response) {
                // Inject the PHP response into the #content div
                $('#content').html(response);
            },
            error: function() {
                alert("An error occurred while loading the cases.");
            }
        });
    });
</script>
