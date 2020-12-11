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
    // Customer Information
    $sql = "SELECT c.CustomerName, c.CustomerCode, c.Email, c.HomeAddress, c.OfficeAddress, cp.C_Phone
    FROM View_Customer c LEFT JOIN CustomerPhone cp
    ON cp.C_code = c.CustomerCode
	WHERE c.CustomerCode = $id";

    $query = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($query);
    if (!empty($row)) {
        echo "
        <div class=\"card\" style=\"width: 25rem; margin-left: auto; margin-right: auto;\">
            <div class=\"card-body\">
                <h5 class=\"card-title\">Customer Information</h5>";
        echo "<p class=\"card-text\">Customer Code: " . $row['CustomerCode'] . "</p>";
        echo "<p class=\"card-text\">Name: " . $row['CustomerName'] . "</p>";
        echo "<p class=\"card-text\">Email: " . $row['Email'] . "</p>";
        echo "<p class=\"card-text\">Home Address: " . $row['HomeAddress'] . "</p>";
        echo "<p class=\"card-text\">Office Address: " . $row['OfficeAddress'] . "</p>";
        echo "<p class=\"card-text\">Phone Number: " . $row['C_Phone'] . "</p>";
        while($row = sqlsrv_fetch_array($query)){
            // For multiple phone number
            echo "<p class=\"card-text\">" . str_repeat('&nbsp;', 27) . $row['C_Phone'] . "</p>";
        }
        echo "
            </div>
        </div>"; 

        // Get Customer Account
        // Checking Account
        $sql2 = "SELECT Account.Acc_Number, [dbo].[Func_Account_GetNameAccType](Account.Acc_Type) as AccountType, Account.Date, CheckingAccount.Balance
        FROM Account, CheckingAccount
        WHERE Account.Acc_Number = CheckingAccount.Acc_Number and Account.C_code = $id;";

        $query2 = sqlsrv_query($conn, $sql2);
        $row2 = sqlsrv_fetch_array($query2);
        if (!empty($row2)) {
            echo "
            <div class=\"card\" style=\"width: 25rem; margin-left: auto; margin-right: auto;\">
                <div class=\"card-body\">
                    <h5 class=\"card-title\">Checking Account Information</h5>";
            echo "<p class=\"card-text\">Account Number: " . $row2['Acc_Number'] . "</p>";
            echo "<p class=\"card-text\">Date: " . $row2['Date']->format('Y-m-d') . "</p>";
            echo "<p class=\"card-text\">Balance: " . $row2['Balance'] . "</p>";
            echo "
                </div>
            </div>";
        }
        // Loan Account
        $sql3 = "SELECT C_Code, Account.Acc_Number, [dbo].[Func_Account_GetNameAccType](Account.Acc_Type) as AccountType, Account.Date, LoanAccount.Balance, LoanAccount.InsRate
        FROM Account, LoanAccount
        WHERE Account.Acc_Number = LoanAccount.Acc_Number and Account.C_code = $id;";
        $query3 = sqlsrv_query($conn, $sql3);
        $row3 = sqlsrv_fetch_array($query3);
        if (!empty($row3)) {
            echo "
            <div class=\"card\" style=\"width: 25rem; margin-left: auto; margin-right: auto;\">
                <div class=\"card-body\">
                    <h5 class=\"card-title\"> Loan Account Information</h5>";
            echo "<p class=\"card-text\">Account Number: " . $row3['Acc_Number'] . "</p>";
            echo "<p class=\"card-text\">Date: " . $row3['Date']->format('Y-m-d') . "</p>";
            echo "<p class=\"card-text\">Balance: " . $row3['Balance'] . "</p>";
            echo "<p class=\"card-text\">InsRate: " . $row3['InsRate'] . "</p>";
            echo "
                </div>
            </div>";
        }
        // Saving Account
        $sql4 = "SELECT C_Code, Account.Acc_Number, [dbo].[Func_Account_GetNameAccType](Account.Acc_Type) as AccountType, Account.Date, SavingAccount.Balance, SavingAccount.InsRate
        FROM Account, SavingAccount
        WHERE Account.Acc_Number = SavingAccount.Acc_Number and Account.C_code = $id;";
        $query4 = sqlsrv_query($conn, $sql4);
        $row4 = sqlsrv_fetch_array($query4);
        if (!empty($row4)) {
            echo "
            <div class=\"card\" style=\"width: 25rem; margin-left: auto; margin-right: auto;\">
                <div class=\"card-body\">
                    <h5 class=\"card-title\">Saving Account Information</h5>";
            echo "<p class=\"card-text\">Account Number: " . $row4['Acc_Number'] . "</p>";
            echo "<p class=\"card-text\">Date: " . $row4['Date']->format('Y-m-d') . "</p>";
            echo "<p class=\"card-text\">Balance: " . $row4['Balance'] . "</p>";
            echo "<p class=\"card-text\">InsRate: " . $row4['InsRate'] . "</p>";
            echo "
                </div>
            </div>";
        }
    }
    else {
        echo "
            <div class=\"text-center\" style=\"margin:1%;\">
            <div class=\"card\" style=\"width: 25rem; margin-left: auto; margin-right: auto;\">
                <div class=\"card-body\">
                <h5 class=\"card-title\">Customer Not Available!</h5> 
                </div>
            </div>
            <button type=\"button\" class=\"btn btn-secondary btn-lg\" id=\"existed_customer\" onclick=\"location.href='index.php?page=customer'\" style=\"margin: 1%;\">Go to Search</button>
            </div>";
    }
}
sqlsrv_close($conn);
?>