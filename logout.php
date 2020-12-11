<?php
setcookie("type", "", time() - 3600);
session_unset();
session_destroy();
header("location:index.php");
?>