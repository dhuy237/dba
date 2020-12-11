<?php 
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

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email_address = $_POST['email_address'];
$home_address = $_POST['home_address'];
$office_address = !empty($_POST['office_address'])?$_POST['office_address']:NULL;
$phone_number = $_POST['phone_number'];
$account_check = $_POST['account_type'];
$date_input = $_POST['date_input'];
$balance = !empty($_POST['balance'])?$_POST['balance']:NULL;
$ins_rate = !empty($_POST['ins_rate'])?$_POST['ins_rate']:NULL;

$sql = "EXEC [dbo].[SP_InsertCustomer] @c_firstname = ?, @c_lastname = ?, @c_email = ?, @c_homeaddress = ?, @c_officeAddress = ?, @c_phone = ?, @acc_type = ?, @date = ?, @balance = ?, @insRate = ?";

$params = array(
    array($first_name, SQLSRV_PARAM_IN),
    array($last_name, SQLSRV_PARAM_IN),
    array($email_address, SQLSRV_PARAM_IN),
    array($home_address, SQLSRV_PARAM_IN),
    array($office_address, SQLSRV_PARAM_IN),
    array($phone_number, SQLSRV_PARAM_IN),
    array($account_check, SQLSRV_PARAM_IN),
    array($date_input, SQLSRV_PARAM_IN),
    array($balance, SQLSRV_PARAM_IN),
    array($ins_rate, SQLSRV_PARAM_IN)
);
$stmt = sqlsrv_query($conn, $sql, $params);
// $stmt = sqlsrv_prepare($conn, $sql);
if ($stmt === false) {
    // if( ($errors = sqlsrv_errors() ) != null) {
    //     // Get detailed error messages
    //     foreach( $errors as $error ) {
    //         echo "SQLSTATE: ".$error['SQLSTATE']."<br />";
    //         echo "code: ".$error['code']."<br />";
    //         echo "message: ".$error['message']."<br />";
    //     }
    // }
    
    header("location:index.php?page=addError");
    die;
}
header("location:index.php?page=addNewDone");

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

?>