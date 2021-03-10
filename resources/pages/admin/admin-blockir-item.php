<?php

session_start();
require '../../config/functions.php';

$id_item = $_GET["id_item"];

if (blockirItem($id_item) > 0) {
    header("Location: admin-index.php");
    $_SESSION["blockirItem"] = true;
} else {
    echo mysqli_error($conn);
}
