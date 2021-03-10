<?php

session_start();
require '../../config/functions.php';

$id_transaksi = $_GET["id_transaksi"];

if (confirmPayment($id_transaksi) > 0) {
	header("Location: admin-manage-item.php");
} else {
	echo "
			<script>
				alert('data gagal dihapus');
			</script>
		";
}
