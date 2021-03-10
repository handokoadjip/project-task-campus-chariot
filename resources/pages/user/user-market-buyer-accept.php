<?php

session_start();
require '../../config/functions.php';

$id_transaksi = $_GET["id_transaksi"];

if (accptItem($id_transaksi) > 0) {
    header("Location: user-history-delivery.php");
    $_SESSION['accpt'] = true;
} else {
    header("Location: user-history-delivery.php");
}
