<?php

session_start();
require '../../config/functions.php';

$email = $_GET["email"];

if (aktivUser($email) > 0) {
	header("Location: admin-manage-user.php");
	$_SESSION["aktivUser"] = true;
} else {
	echo mysqli_error($conn);
}
