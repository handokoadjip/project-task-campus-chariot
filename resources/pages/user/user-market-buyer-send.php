<?php

session_start();
require '../../config/functions.php';

$id_transaksi = $_GET["id_transaksi"];

if (sendingItem($id_transaksi) > 0) {
    header("Location: user-market-buyer.php");
    $_SESSION['send'] = true;
} else {
    header("Location: user-market-buyer.php");
    $_SESSION['errorSend'] = true;
}
