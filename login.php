<?php
if (isset($_COOKIE["type"]) ) {
    header("location:index.php");
}
if (isset($_POST["login"])) {
    $server_name = "bankingdb-hcmut.database.windows.net";
    $user_name = $_POST['user_email'];
    $password =  $_POST['user_password'];
    $connection = array("Database"=>"BankingDB", "UID"=>$user_name, "PWD"=>$password);

    $conn = sqlsrv_connect($server_name, $connection);

    if ($conn) {
        // For testing
        // echo "Connection established: " . $server_name;
        setcookie("type", $user_name, time() + 3600);
        header("location:index.php?page=home");
    }
    else {
        echo "<div class='alert alert-danger'>Wrong Email Address or Password!</div>";
        die(print_r(sqlsrv_errors(), true));
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Database Systems Assignment</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    <br />
    <div class="container">
        <h2 align="center">Bank Database</h2>
        <br />
        <div class="panel panel-default">

            <div class="panel-heading">Login</div>
            <div class="panel-body">
                <form method="post">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="user_email" id="user_email" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="user_password" id="user_password" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="submit" name="login" id="login" class="btn btn-info" value="Login" />
                    </div>
                </form>
            </div>
        </div>
        <br />
    </div>
</body>

</html>