<?php

session_start();
require '../../config/functions.php';

$id = $_GET["user_item"];

if (deleteItem($id) > 0) {
    header("Location: user-market.php");
    $_SESSION["deleteItem"] = true;
} else {
    echo "
			<script>
				alert('data gagal dihapus');
			</script>
		";
}
