<?php

function validEndDate($aDate){
    // Check if "EndDate" is null or not
    if ($aDate == null){
        return "Present";
    } 
    else {
        return $aDate->format('Y-m-d');
    }
}

// Test connection
session_start();
$server_name = "bankingdb-hcmut.database.windows.net";
$connection = array("Database"=>"BankingDB", "UID"=>$_SESSION['user_name'], "PWD"=>$_SESSION['password']);
$conn = sqlsrv_connect($server_name, $connection);

if ($conn) {
    // For testing
    // echo "Connection established: " . $server_name;
}
else {
    echo "Connection could not be established";
    die(print_r(sqlsrv_errors(), true));
}

if (!empty($_GET['employee_id'])) {
    // 'id' input from the user
    $id = $_GET['employee_id'];
    // Search id like $_GET['employee_id']
    $sql = "SELECT EmployeeName, EmployeeCode, BranchName, DoB, Email, Address
    FROM View_Employee WHERE EmployeeCode = $id;";
    $query = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($query);
    if (!empty($row)) {
        echo "
        <div class=\"card\" style=\"width: 25rem; margin-left: auto; margin-right: auto;\">
            <div class=\"card-body\">
                <h5 class=\"card-title\">Employee Information</h5>";
        echo "<p class=\"card-text\">Branch Name: " . $row['BranchName'] . "</p>";
        echo "<p class=\"card-text\">Name: " . $row['EmployeeName'] . "</p>";
        echo "<p class=\"card-text\">Employee Code: " . $row['EmployeeCode'] . "</p>";
        echo "<p class=\"card-text\">Date Of Birth: " . $row['DoB']->format('Y-m-d') . "</p>";
        echo "<p class=\"card-text\">Email: " . $row['Email'] . "</p>";
        echo "
            </div>
        </div>"; 

        // For management information
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
            while($row2 = sqlsrv_fetch_array($query2)){
                // For multiple phone number
                echo "<li><p>" . $row2['StartDate']->format('Y-m-d') . " - " . validEndDate($row2['EndDate']). "</p>";
                echo "<p>" . $row2['B_name'] . "</p></li>";
            }
            echo "
                        </ul>
                </div>
            </div>";
        }
    }
    else {
        echo "
            <div class=\"text-center\" style=\"margin:1%;\">
            <div class=\"card\" style=\"width: 25rem; margin-left: auto; margin-right: auto;\">
                <div class=\"card-body\">
                <h5 class=\"card-title\">Employee Not Available!</h5> 
                </div>
            </div>
            <button type=\"button\" class=\"btn btn-secondary btn-lg\" id=\"existed_customer\" onclick=\"location.href='index.php?page=employee'\" style=\"margin: 1%;\">Go to Search</button>
            </div>
        ";
    }
}
sqlsrv_close($conn);
?>