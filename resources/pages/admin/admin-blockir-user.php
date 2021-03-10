<?php

session_start();
require '../../config/functions.php';

$email = $_GET["email"];

if (blockirUser($email) > 0) {
	header("Location: admin-manage-user.php");
	$_SESSION["blockirUser"] = true;
} else {
	echo mysqli_error($conn);
}
