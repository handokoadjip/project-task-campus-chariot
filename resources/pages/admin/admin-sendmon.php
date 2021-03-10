<?php

session_start();
require '../../config/functions.php';

$id_transaksi = $_GET["id_transaksi"];

if (sendMon($id_transaksi) == 1) {
    header("Location: admin-manage-item.php");
    $_SESSION['sucItem'] = true;
} elseif (sendMon($id_transaksi) == 2) {
    $_SESSION['acptItem'] = true;
    header("Location: admin-manage-item.php");
} elseif (sendMon($id_transaksi) == 3) {
    $_SESSION['kirtItem'] = true;
    header("Location: admin-manage-item.php");
}
