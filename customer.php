<?php
// Test connection
$server_name = "bankingdb-hcmut.database.windows.net";
$connection = array("Database"=>"BankingDatabase", "UID"=>"bankowner", "PWD"=>"Test1234");

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
    // Customer Information
    $sql = "SELECT C_Code, C_FirstName, C_LastName, C_Email FROM Customer WHERE C_code = $id;";
    $query = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($query);
    if (!empty($row)) {
        echo "
        <div class=\"card\" style=\"width: 25rem; margin-left: auto; margin-right: auto;\">
            <div class=\"card-body\">
                <h5 class=\"card-title\">Customer Information</h5>";
        echo "<p class=\"card-text\">C_code: " . $row['C_Code'] . "</p>";
        echo "<p class=\"card-text\">C_Name: " . $row['C_FirstName'] . " " . $row['C_LastName'] . "</p>";
        echo "<p class=\"card-text\">C_Email: " . $row['C_Email'] . "</p>";
        echo "
            </div>
        </div>";
    }

    // Customer Account
    $sql2 = "SELECT C_Code, C_FirstName, C_LastName, C_Email, Acc_Type, Acc_Date 
            FROM Customer, CheckingAccount
            WHERE C_Code = Acc_Code AND C_code = $id;";
    $query2 = sqlsrv_query($conn, $sql2);
    echo "<table style=\"margin-left: auto; margin-right: auto;\">
    <tr>
        <th>C_code</th>
        <th>C_Name</th>
        <th>C_Email</th>
    </tr>";
    while($row = sqlsrv_fetch_array($query2))
    {
        echo "<tr>";
        echo "<td>" . $row['C_Code'] . "</td>";
        echo "<td>" . $row['C_FirstName'] . " " . $row['C_LastName'] . "</td>";
        echo "<td>" . $row['C_Email'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
}
sqlsrv_close($conn);
