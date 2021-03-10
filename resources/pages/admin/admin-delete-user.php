<?php

session_start();
require '../../config/functions.php';

$email = $_GET["email"];

if (deleteUser($email) > 0) {
	header("Location: admin-manage-user.php");
	$_SESSION["deleteUser"] = true;
} else {
	echo "
			<script>
				alert('data gagal dihapus');
			</script>
		";
}
