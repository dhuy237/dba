<?php
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

if (!empty($_GET['customer_id'])){
    // 'id' input from the user
    $id = $_GET['customer_id'];
    // Search id like $_GET['employee_id']
    // $sql = "SELECT B_name, E_code, E_FirstName, E_LastName, E_DateOfBirth FROM Employee WHERE E_code LIKE '" . $id . "%';";

    $sql = "SELECT S.C_Code, S.Date, E.B_name, E.E_Code, E.E_FirstName, E.E_LastName, E.E_DateOfBirth, E.E_Email, E.E_No, E.E_Street, E.E_District, E.E_City
    FROM Employee as E, Service as S
    WHERE E.E_Code = S.E_Code
    AND S.C_Code = $id;";

    $query = sqlsrv_query($conn, $sql);

    while($row = sqlsrv_fetch_array($query))
    {
        echo "
        <div class=\"card\" style=\"width: 25rem; margin-left: auto; margin-right: auto;\">
            <div class=\"card-body\">
                <h5 class=\"card-title\">Service Information</h5>";
        echo "<h6 class=\"card-subtitle mb-2 text-muted\">Date: " . $row['Date']->format('Y-m-d'). "</h6>";
        echo "<p class=\"card-text\">C_code: " . $row['C_Code'] . "</p>";
        echo "<p class=\"card-text\">B_name: " . $row['B_name'] . "</p>";
        echo "<p class=\"card-text\">E_Code: " . $row['E_Code'] . "</p>";
        echo "<p class=\"card-text\">E_Name: " . $row['E_FirstName'] . " " . $row['E_LastName'] . "</p>";
        echo "<p class=\"card-text\">E_DateOfBirth: " . $row['E_DateOfBirth']->format('Y-m-d') . "</p>";
        echo "<p class=\"card-text\">E_Email: " . $row['E_Email'] . "</p>";
        echo "<p class=\"card-text\">E_No: " . $row['E_No'] . "</p>";
        echo "<p class=\"card-text\">E_Address: " . $row['E_Street'] . ", " . $row['E_District'] . ", " . $row['E_City'] . "</p>";
        echo "
            </div>
        </div>";
    }
}
sqlsrv_close($conn);
?>