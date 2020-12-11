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
        session_start();
        $_SESSION['user_name'] = $user_name;
        $_SESSION['password'] = $password;
        setcookie("type", $user_name, time() + 3600);
        header("location:index.php?page=home");
    }
    else {
        echo "
            <div class=\"text-center\" style=\"margin:1%;\">
            <div class=\"card\" style=\"width: 25rem; margin-left: auto; margin-right: auto;\">
                <div class=\"card-body\">
                <h5 class=\"card-title\">Incorrect Username or Password!</h5> 
                </div>
            </div>
            </div>";
        // die(print_r(sqlsrv_errors(), true));
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Database Systems Assignment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <br />
    <div class="card">
        <div class="col-lg-4 col-lg-offset-4" style=" margin:1%; margin-left: auto; margin-right: auto;">
            <br />
            <div class="panel panel-default">
                <h4>Log in to Bank Database</h4>
                <div class="panel-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="user_email" id="user_email" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="user_password" id="user_password" class="form-control" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="login" id="login" class="btn btn-primary" value="Login" />
                        </div>
                    </form>
                </div>
            </div>
            <br />
        </div>
    </div>
    <script type="text/javascript" src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>