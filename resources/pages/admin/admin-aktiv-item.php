<?php

session_start();
require '../../config/functions.php';

$id_item = $_GET["id_item"];

if (aktivItem($id_item) > 0) {
    header("Location: admin-index.php");
    $_SESSION["aktivItem"] = true;
} else {
    echo mysqli_error($conn);
}
