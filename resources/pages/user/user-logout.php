<?php

session_start();

if (isset($_SESSION['notif'])) {
    echo "<script>
        alert('test');
    </script>";
}

session_destroy();
session_unset();
$_SESSION = [];

header("Location: ../../../index.php");
