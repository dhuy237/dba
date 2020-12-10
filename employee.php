<?php

function validEndDate($aDate){
    if ($aDate == null){
        return "Present";
    } else {
        return $aDate->format('Y-m-d');
    }
 }

// Test connection
$server_name = "bankingdb-hcmut.database.windows.net";
$connection = array("Database"=>"BankingDB", "UID"=>"bankowner", "PWD"=>"Test1234");

$conn = sqlsrv_connect($server_name, $connection);

if ($conn) {
    // For testing
    // echo "Connection established: " . $server_name;
}
else {
    echo "Connection could not be established";
    die(print_r(sqlsrv_errors(), true));
}

if (!empty($_GET['employee_id'])){
    // 'id' input from the user
    $id = $_GET['employee_id'];
    // Search id like $_GET['employee_id']
    $sql = "SELECT B_name, E_Code, E_FirstName, E_LastName, E_DateOfBirth FROM Employee WHERE E_code = $id;";
    $query = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($query);
    if (!empty($row)) {
        echo "
        <div class=\"card\" style=\"width: 25rem; margin-left: auto; margin-right: auto;\">
            <div class=\"card-body\">
                <h5 class=\"card-title\">Customer Information</h5>";
        echo "<p class=\"card-text\">B_name: " . $row['B_name'] . "</p>";
        echo "<p class=\"card-text\">E_Name: " . $row['E_FirstName'] . " " . $row['E_LastName'] . "</p>";
        echo "<p class=\"card-text\">E_Code: " . $row['E_Code'] . "</p>";
        echo "<p class=\"card-text\">E_DateOfBirth: " . $row['E_DateOfBirth']->format('Y-m-d') . "</p>";
        echo "
            </div>
        </div>"; 
    }

    $sql2 = "SELECT B_name, E_Code, StartDate, EndDate FROM BranchManager WHERE E_Code = $id ORDER BY StartDate DESC";
    $query2 = sqlsrv_query($conn, $sql2);
    $row2 = sqlsrv_fetch_array($query2);
    if (!empty($row2)) {
        echo "<div class=\"card\" style=\"width: 25rem; margin-left: auto; margin-right: auto;\">
            <div class=\"card-body\">
                    <h5>Management Timeline</h5>
                    <ul class=\"timeline\">";
        echo "<li><p>" . $row2['StartDate']->format('Y-m-d') . " - " . validEndDate($row2['EndDate']). "</p>";
        echo "<p>" . $row2['B_name'] . "</p></li>";
        echo "
                    </ul>
            </div>
        </div>";
    }
}
sqlsrv_close($conn);
?>