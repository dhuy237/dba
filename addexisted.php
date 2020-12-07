<?php 
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

$customer_code = $_POST['customer_code'];
$account_check = $_POST['account_type'];
$date_input = $_POST['date_input'];
$balance = $_POST['balance'];
$ins_rate = $_POST['ins_rate'];

$sql = "EXEC [dbo].[SP_InsertAccount] @acc_type = ?, @date = ?, @c_code = ?, @balance = ?, @insRate = ?";

$params = array(
    array($account_check, SQLSRV_PARAM_IN),
    array($date_input, SQLSRV_PARAM_IN),
    array($customer_code, SQLSRV_PARAM_IN),
    array($balance, SQLSRV_PARAM_IN),
    array($ins_rate, SQLSRV_PARAM_IN)
);
$stmt = sqlsrv_query($conn, $sql, $params);
// $stmt = sqlsrv_prepare($conn, $sql);
if ($stmt === false) {
    echo "Something wrong, try again!";
    die;
}
header("location:index.php?page=addExistedDone");

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

?>