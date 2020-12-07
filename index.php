<?php
    if (!isset($_COOKIE["type"])) {
        header("location:login.php");
    }

    // include "header.php";

    if (isset($_GET['page'])){
        $page = $_GET['page'];
        if ($page == "test_db" or $page == "logout"){
            include "$page.php";
        }else {
            include "$page.html";
        }
    }
?>