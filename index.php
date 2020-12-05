<?php
    include "header.html";

    if (isset($_GET['page'])){
        $page = $_GET['page'];
        if ($page == "test_db"){
            include "$page.php";
        }else {
            include "$page.html";
        }
    }
?>