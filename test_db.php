<?php
// Test connection
$server_name = "bankingdb-hcmut.database.windows.net";
$connection = array("Database"=>"BankingDatabase", "UID"=>"hieu", "PWD"=>"Test1234!!!");

$conn = sqlsrv_connect($server_name, $connection);

if ($conn) {
    echo "Connection established: " . $server_name;
}
else {
    echo "Connection could not be established";
    die(print_r(sqlsrv_errors(), true));
}

// Simple select query
$sql = "SELECT B_name, E_code, E_FirstName, E_LastName, E_DateOfBirth FROM Employee";
    $result = sqlsrv_query($conn, $sql);

    echo "<table>
    <tr>
        <th>B_name</th>
        <th>E_code</th>
        <th>E_FirstName</th>
        <th>E_LastName</th>
        <th>E_DateOfBirth</th>
    </tr>";

    while($row = sqlsrv_fetch_array($result))
    {
        echo "<tr>";
        echo "<td>" . $row['B_name'] . "</td>";
        echo "<td>" . $row['E_code'] . "</td>";
        echo "<td>" . $row['E_FirstName'] . "</td>";
        echo "<td>" . $row['E_LastName'] . "</td>";
        echo "<td>" . $row['E_DateOfBirth']->format('Y-m-d') . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    sqlsrv_close($conn);
?>