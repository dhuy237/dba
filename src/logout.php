<?php
setcookie("type", "", time() - 3600);
// Clear all $_SESSION variable
session_unset();
session_destroy();
header("location:index.php");
?>