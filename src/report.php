<?php
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

if (!empty($_GET['customer_id'])){
    // 'id' input from the user
    $id = $_GET['customer_id'];
    // Search id = $_GET['employee_id']
    $sql = "SELECT e.EmployeeName, e.EmployeeCode, e.BranchName, e.DoB, e.Email, e.Address, s.Date 
    FROM View_Employee e, Service s
    WHERE s.E_Code = e.EmployeeCode and s.C_Code = $id";

    $query = sqlsrv_query($conn, $sql);

    // Customer Information
    $sql2 = "SELECT c.CustomerName, c.CustomerCode, c.Email, c.HomeAddress, c.OfficeAddress, cp.C_Phone
    FROM View_Customer c LEFT JOIN CustomerPhone cp
    ON cp.C_code = c.CustomerCode
	WHERE c.CustomerCode = $id";

    $query2 = sqlsrv_query($conn, $sql2);
    $row2 = sqlsrv_fetch_array($query2);

    if (!empty($row2)){
        echo "
        <div id =\"customer_id_2\" class=\"row\">
        <!-- Begin report -->
        <div class=\"col-xs-12\">
            <div class=\"grid invoice\">
                <div class=\"grid-body\">
                    <div class=\"invoice-title\">
                        <div class=\"row\">
                            <div class=\"col-xs-12\">
                                <img src=\"images/1.png\" alt=\"\" height=\"35\">
                            </div>
                        </div>
                        <br>
                        <div class=\"row\">
                            <div class=\"col-xs-12\">
                                <h2>Service Report<br>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class=\"row\">
                        <div class=\"col-xs-6\">
                            <address>";
        echo "<strong>Customer Information</strong><br>";
        echo "CC: " . $row2['CustomerCode'] . "<br>";
        echo $row2['CustomerName'] . "<br>";
        echo $row2['Email'] . "<br>";
        echo $row2['HomeAddress'] ."<br>";
        echo "P: " . $row2['C_Phone'];
        while($row2 = sqlsrv_fetch_array($query2)){
            // For multiple phone number
            echo  " | ". $row2['C_Phone'] . "</p>";
        }
        echo "<br>";
        echo "</address>
            </div>
        </div>";
        echo "
        <div class=\"row\">
                        <div class=\"col-md-12\">
                            <h4>Service Information</h4>
                            <table class=\"table table-striped\">
                                <thead>
                                    <tr class=\"line\">
                                        <td><strong>#</strong></td>
                                        <td class=\"text-center\"><strong>Branch</strong></td>
                                        <td class=\"text-center\"><strong>Employee Code</strong></td>
                                        <td class=\"text-center\"><strong>Name</strong></td>
                                        <td class=\"text-center\"><strong>Date of Birth</strong></td>
                                        <td class=\"text-center\"><strong>Email</strong></td>
                                        <td class=\"text-center\"><strong>Address</strong></td>
                                        <td class=\"text-center\"><strong>Date</strong></td>
                                    </tr>
                                </thead>
                                <tbody>";

        $count = 1;
        while($row = sqlsrv_fetch_array($query))
        {
            echo "<tr>";
            echo "<td>" . $count++ ."</td>";
            echo "<td>" . $row['BranchName'] . "</td>";
            echo "<td class=\"text-center\">" . $row['EmployeeCode'] ."</td>";
            echo "<td class=\"text-left\">" . $row['EmployeeName'] . "</td>";
            echo "<td class=\"text-center\">" . $row['DoB']->format('Y-m-d') ."</td>";
            echo "<td class=\"text-center\">" . $row['Email'] . "</td>";
            echo "<td class=\"text-left\">" . $row['Address'] . "</td>";
            echo "<td class=\"text-center\">" . $row['Date']->format('Y-m-d') . "</td>";
            echo "</tr>";
        }

        echo "</tbody>
                </table>
            </div>									
            </div>
            </div>
            </div>
            </div>
            <!-- End report -->
            </div>";
    }
    else {
        echo "
            <div class=\"text-center\" style=\"margin:1%;\">
            <div class=\"card\" style=\"width: 25rem; margin-left: auto; margin-right: auto;\">
                <div class=\"card-body\">
                <h5 class=\"card-title\">Customer Not Available!</h5> 
                </div>
            </div>
            <button type=\"button\" class=\"btn btn-secondary btn-lg\" id=\"existed_customer\" onclick=\"location.href='index.php?page=report'\" style=\"margin: 1%;\">Try Again</button>
            </div>";
    }
}
sqlsrv_close($conn);
?>