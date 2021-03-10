<?php

// KONEKSI DATABASE

$host = 'localhost';
$username = 'root';
$password = '';
$database = '2019_campus_chariot';

$conn = mysqli_connect($host, $username, $password, $database);

function query($query)
{

    global $conn;

    $result = mysqli_query($conn, $query);

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function regis($data)
{

    global $conn;

    $name = strtolower(stripcslashes($data['name']));
    $gender = stripcslashes($data['gender']);
    $image = 'default.png';
    $email = strtolower(stripcslashes($data['email']));
    $birth = strtolower($data['birth']);
    $no_telp = strtolower(stripcslashes($data['no_telp']));
    $address = stripcslashes($data["address"]);

    $password1 = mysqli_real_escape_string($conn, $data["password1"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    $role_id = 2;
    $is_active = 1;
    $date_created = time();

    $result = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
				alert('Email sudah dipakai!');
			</script>";
        return false;
    }

    if ($password1 !== $password2) {
        echo "<script>
				alert('Konfirmasi password tidak sesuai');
			</script>";
        return false;
    }

    $password = password_hash($password1, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user VALUES('$name', '$image', '$gender', '$email', '$birth', '$no_telp', '$address', '$password', '$role_id', '$is_active', '$date_created' )";

    mysqli_query($conn, $sql);

    return mysqli_affected_rows($conn);
}

function login($data)
{
    global $conn;

    $email_login = $data["email-login"];
    $password_login = $data["password-login"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email_login'");

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row["is_active"] == 1) {
            if (password_verify($password_login, $row["password"])) {

                // set session
                $_SESSION["login"] = true;
                $_SESSION["email"] = $email_login;
                $_SESSION["role_id"] = $row["role_id"];

                if (isset($data["remember"])) {
                    setcookie('key', $row["name"], time() + 60 * 60 * 24 * 1);
                    setcookie('user', hash("sha256", $row["email"]), time() + 60 * 60 * 24 * 1);
                }

                if ($row["role_id"] == 1) {
                    $_SESSION["login"] = true;
                    $_SESSION["email"] = $email_login;
                    $_SESSION["role_id"] = $row["role_id"];
                    header("Location: ../admin/admin-index.php");
                } elseif ($row["role_id"] == 2) {
                    $_SESSION["login"] = true;
                    $_SESSION["email"] = $email_login;
                    $_SESSION["role_id"] = $row["role_id"];
                    header("Location: ../user/user-index.php");
                }

                return mysqli_affected_rows($conn);
                exit;
            } else {
                return 3;
            }
        } else {
            return 2;
        }
    } else {
        return 1;
    }
}

function uploadMarket()
{

    $namaFile = $_FILES["market_image"]["name"];
    $ukuranFile = $_FILES["market_image"]["size"];
    $errorFile = $_FILES["market_image"]["error"];
    $tmpName = $_FILES["market_image"]["tmp_name"];

    if ($errorFile == 4) {
        $_SESSION['emptyImg'] = true;
        return false;
    }

    $ekstensiValid = ['jpg', 'jpeg', 'png'];
    $ekstensiFile = explode('.', $namaFile);
    $ekstensiFile = strtolower(end($ekstensiFile));

    if (!in_array($ekstensiFile, $ekstensiValid)) {
        $_SESSION['fileEkstensi'] = true;
        return false;
    }

    if ($ukuranFile > 2000000) {
        $_SESSION['fileSize'] = true;
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiFile;

    move_uploaded_file($tmpName, '../../../public_html/images/market/' . $namaFileBaru);
    return $namaFileBaru;
}

function uploadBukti()
{
    $namaFile = $_FILES["bukti_transaksi"]["name"];
    $ukuranFile = $_FILES["bukti_transaksi"]["size"];
    $errorFile = $_FILES["bukti_transaksi"]["error"];
    $tmpName = $_FILES["bukti_transaksi"]["tmp_name"];

    if ($errorFile == 4) {
        $_SESSION['emptyImg'] = true;
        return false;
    }

    $ekstensiValid = ['jpg', 'jpeg', 'png'];
    $ekstensiFile = explode('.', $namaFile);
    $ekstensiFile = strtolower(end($ekstensiFile));

    if (!in_array($ekstensiFile, $ekstensiValid)) {
        $_SESSION['fileEkstensi'] = true;
        return false;
    }

    if ($ukuranFile > 2000000) {
        $_SESSION['fileSize'] = true;
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiFile;

    move_uploaded_file($tmpName, '../../../public_html/images/bukti/' . $namaFileBaru);
    return $namaFileBaru;
}

function bukti($id_transaksi)
{
    global $conn;

    $id_transaksi = $id_transaksi['id_transaksi'];
    $bukti_image = uploadBukti();

    $sql = "UPDATE user_transaksi SET bukti_transaksi = '$bukti_image' WHERE id_transaksi = '$id_transaksi'";

    mysqli_query($conn, $sql);

    return mysqli_affected_rows($conn);
}

function createdMarket($data)
{
    global $conn;

    $email = $_SESSION['email'];
    $market_name = stripslashes($data['market_name']);
    $market_rek = stripslashes($data['market_rek']);
    $market_address = stripcslashes($data['market_address']);
    $market_image = uploadMarket();
    $market_created = time();

    if (!$market_image) {
        return false;
    }

    $sql = "INSERT INTO user_market VALUES('', '$email', '$market_name', '$market_address',  '$market_rek', '$market_image', '$market_created')";

    mysqli_query($conn, $sql);

    return mysqli_affected_rows($conn);
}

function market()
{
    global $conn;

    $email = $_SESSION['email'];
    $query = mysqli_query($conn, "SELECT * FROM user_market WHERE email = '$email'");
    $result = mysqli_num_rows($query);

    return $result;
}

function uploadItem()
{

    $namaFile = $_FILES["item_image"]["name"];
    $ukuranFile = $_FILES["item_image"]["size"];
    $errorFile = $_FILES["item_image"]["error"];
    $tmpName = $_FILES["item_image"]["tmp_name"];

    if ($errorFile == 4) {
        $_SESSION['emptyImg'] = true;
        return false;
    }

    $ekstensiValid = ['jpg', 'jpeg', 'png'];
    $ekstensiFile = explode('.', $namaFile);
    $ekstensiFile = strtolower(end($ekstensiFile));

    if (!in_array($ekstensiFile, $ekstensiValid)) {
        $_SESSION['fileEkstensi'] = true;
        return false;
    }

    if ($ukuranFile > 2000000) {
        $_SESSION['fileSize'] = true;
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiFile;

    move_uploaded_file($tmpName, '../../../public_html/images/item/' . $namaFileBaru);
    return $namaFileBaru;
}

function addItem($data)
{
    global $conn;

    $id_market = $_SESSION['id_market'];
    $item_name = $data['item_name'];
    $item_image = uploadItem();
    $item_type = $data['item_type'];
    $item_price = $data['item_price'];
    $item_stock = $data['item_stock'];
    $item_category = $data['item_category'];
    $item_description = $data['item_des'];
    $is_active = 1;
    $item_created = time();

    if (!$item_image) {
        return false;
    }

    $sql = "INSERT INTO item_market VALUES('', '$id_market', '$item_name', '$item_image', '$item_type', '$item_price', '$item_stock', '$item_category', '$item_description', '$is_active','$item_created')";

    mysqli_query($conn, $sql);

    return mysqli_affected_rows($conn);
}

function waktu_lalu($timestamp)
{
    $selisih = time() - $timestamp;

    $detik = $selisih;
    $menit = round($selisih / 60);
    $jam = round($selisih / 3600);
    $hari = round($selisih / 86400);
    $minggu = round($selisih / 604800);
    $bulan = round($selisih / 2419200);
    $tahun = round($selisih / 29030400);

    if ($detik <= 60) {
        $waktu = $detik . ' detik yang lalu';
    } else if ($menit <= 60) {
        $waktu = $menit . ' menit yang lalu';
    } else if ($jam <=  24) {
        $waktu =  $jam . ' jam yang lalu';
    } else if ($hari <=  7) {
        $waktu = $hari . ' hari yang lalu';
    } else if ($minggu <= 4) {
        $waktu = $minggu . ' minggu yang lalu';
    } else if ($bulan <= 12) {
        $waktu =  $bulan . ' bulan yang lalu';
    } else {
        $waktu  =  $tahun . ' tahun yang lalu';
    }
    return $waktu;
}

function changePassword($data)
{
    global $conn;

    $old_password = $data['password1'];
    $new_password = $data['password2'];
    $repeat_password = $data['password3'];

    if ($new_password !== $repeat_password) {
        return 4;
    }

    $email = $_SESSION['email'];

    $user = query("SELECT * FROM user WHERE email = '$email'")[0];

    if (!password_verify($old_password, $user['password'])) {
        return 1;
    } else {
        if ($old_password == $new_password) {
            return 2;
        } else {
            $passwordHash = password_hash($new_password, PASSWORD_DEFAULT);

            $sql = "UPDATE user SET password = '$passwordHash' WHERE email = '$email'";
            mysqli_query($conn, $sql);

            return 3;
        }
    }
}

function uploadProfile()
{

    $namaFile = $_FILES["image_user"]["name"];
    $ukuranFile = $_FILES["image_user"]["size"];
    $errorFile = $_FILES["image_user"]["error"];
    $tmpName = $_FILES["image_user"]["tmp_name"];

    if ($errorFile == 4) {
        $_SESSION['emptyImg'] = true;
        return false;
    }


    $ekstensiValid = ['jpg', 'jpeg', 'png'];
    $ekstensiFile = explode('.', $namaFile);
    $ekstensiFile = strtolower(end($ekstensiFile));

    if (!in_array($ekstensiFile, $ekstensiValid)) {
        $_SESSION['fileEkstensi'] = true;
        return false;
    }

    if ($ukuranFile > 2000000) {
        $_SESSION['fileSize'] = true;
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiFile;

    move_uploaded_file($tmpName, '../../../public_html/images/profile/' . $namaFileBaru);
    return $namaFileBaru;
}

function editProfile()
{
    global $conn;

    $email = $_SESSION['email'];

    $name = stripcslashes($_POST['name_user']);
    $oldImage = stripcslashes($_POST['old_image']);


    if ($_FILES['image_user']['error'] === 4) {
        $newImage = $oldImage;
    } else {
        $newImage = uploadProfile();
    }

    if (!$newImage) {
        return false;
    }

    $gender = stripcslashes($_POST['gender_user']);
    $email = stripcslashes($_POST['email_user']);
    $birth = stripcslashes($_POST['birth_user']);
    $no = stripcslashes($_POST['no_user']);
    $address = stripcslashes($_POST['address_user']);
    $password = stripcslashes($_POST['password_user']);
    $role = stripcslashes($_POST['role_user']);
    $active = stripcslashes($_POST['active_user']);
    $date = stripcslashes($_POST['date_user']);

    $query = "UPDATE user SET name = '$name', image = '$newImage', gender = '$gender', email = '$email', birth = '$birth', no_telp = '$no', address = '$address', password = '$password', role_id = '$role', is_active = '$active', date_created = '$date' WHERE email = '$email'";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function editMarket($data)
{
    global $conn;

    $id_market = $data['id_market'];
    $email = $data['email'];
    $market_name = $data['market_name'];
    $market_address = $data['market_address'];
    $market_image = $data['market_image'];


    if ($_FILES['market_image']['error'] === 4) {
        $market_image_new = $market_image;
    } else {
        $market_image_new = uploadMarket();
    }

    if (!$market_image_new) {
        return false;
    }

    $market_created = $data['market_created'];

    $query = "UPDATE user_market SET id_market = '$id_market', email = '$email', market_address = '$market_address', market_name = '$market_name', market_image = '$market_image_new', market_created = '$market_created' WHERE email = '$email'";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function editItem($data)
{
    global $conn;

    $id_item = stripcslashes($data['id_item']);
    $id_market = stripcslashes($data['id_market']);
    $item_name = stripcslashes($data['item_name']);
    $item_image_old = stripcslashes($data['item_image_old']);

    if ($_FILES['item_image']['error'] === 4) {
        $item_image = $item_image_old;
    } else {
        $item_image = uploadItem();
    }

    if (!$item_image) {
        return false;
    }

    $item_type = stripcslashes($data['item_type']);
    $item_price = stripcslashes($data['item_price']);
    $item_stock = stripcslashes($data['item_stock']);
    $item_category = stripcslashes($data['item_category']);
    $item_description = stripcslashes($data['item_description']);
    $item_created = stripcslashes($data['item_created']);

    $query = "UPDATE item_market SET id_item = '$id_item', id_market = '$id_market', item_name = '$item_name', item_image = '$item_image', item_type = '$item_type', item_price = '$item_price', item_stock = '$item_stock', item_category = '$item_category', item_description = '$item_description', item_created = '$item_created' WHERE id_item = '$id_item'";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function deleteItem($id)
{

    global $conn;

    mysqli_query($conn, "DELETE FROM item_market WHERE id_item = '$id'");

    return mysqli_affected_rows($conn);
}

function order()
{
    if (empty($_POST['info'])) {
        return $_SESSION['info_transaksi'] = 'tanpa keterangan tambahan';
    } else {
        return $_SESSION['info_transaksi'] = $_POST['info'];
    }
}

function payment()
{
    global $conn;

    // file user item detail
    $id_market = $_SESSION['id_market'];
    $id_item = $_SESSION['id_item'];

    // file function
    $email = $_SESSION['email'];

    // file user-payment-struk
    $date_transaksi = $_SESSION['date_transaksi'];

    // $name_transaksi = $_SESSION['name_transaksi'];
    // $address_transaksi = $_SESSION['address_transaksi'];
    // $telp_transaksi = $_SESSION['telp_transaksi'];
    // $item_transaksi = $_SESSION['item_transaksi'];
    // $market_transaksi = $_SESSION['market_transaksi'];

    // file user item detail
    $many_transaksi = $_SESSION['many_transaksi'];
    $info_transaksi = $_SESSION['info_transaksi'];

    // file user payment struk
    $price_transaksi = $_SESSION['price_transaksi'];
    $method_transaksi = $_SESSION['method_transaksi'];

    $bukti_transaksi = '-';
    $payment_transaksi = 'pending';
    $item_transaksi = 'pending';
    $status_transaksi = 'pending';

    $sql = "INSERT INTO user_transaksi VALUES('', '$id_market', '$id_item', '$email', '$date_transaksi', '$many_transaksi', '$price_transaksi', '$info_transaksi', '$method_transaksi', '$bukti_transaksi', '$payment_transaksi','$item_transaksi', '$status_transaksi')";

    mysqli_query($conn, $sql);

    return mysqli_affected_rows($conn);
}

function updateItem()
{
    global $conn;

    // user-payment-struk
    $many_transaksi = $_SESSION['many_transaksi'];
    // user-item-detail
    $item_stock = $_SESSION['item_stock'];
    $id_item = $_SESSION['id_item'];


    $item_stock_update = $item_stock - $many_transaksi;
    $update = "UPDATE item_market SET item_stock = '$item_stock_update' WHERE id_item = '$id_item'";
    mysqli_query($conn, $update);

    return mysqli_affected_rows($conn);
}

function deleteUser($email)
{

    global $conn;

    mysqli_query($conn, "DELETE FROM user WHERE email = '$email'");

    return mysqli_affected_rows($conn);
}

function blockirUser($email)
{

    global $conn;

    $blockir = 2;
    mysqli_query($conn, "UPDATE user SET is_active = '$blockir' WHERE email = '$email'");

    return mysqli_affected_rows($conn);
}

function blockirItem($id_item)
{

    global $conn;

    $blockir = 2;
    mysqli_query($conn, "UPDATE item_market SET is_active = '$blockir' WHERE id_item = '$id_item'");

    return mysqli_affected_rows($conn);
}

function aktivUser($email)
{
    global $conn;

    $aktiv = 1;
    mysqli_query($conn, "UPDATE user SET is_active = '$aktiv' WHERE email = '$email'");

    return mysqli_affected_rows($conn);
}

function aktivItem($id_item)
{
    global $conn;

    $aktiv = 1;
    mysqli_query($conn, "UPDATE item_market SET is_active = '$aktiv' WHERE id_item = '$id_item'");

    return mysqli_affected_rows($conn);
}

function confirmPayment($id_transaksi)
{

    global $conn;

    $bayar = 'bayar';
    mysqli_query($conn, "UPDATE user_transaksi SET payment_transaksi = '$bayar' WHERE id_transaksi = '$id_transaksi'");

    return mysqli_affected_rows($conn);
}

function sendingItem($id_transaksi)
{

    global $conn;

    $bayar = 'dikirim';

    $user = query("SELECT payment_transaksi FROM user_transaksi WHERE id_transaksi = '$id_transaksi'")[0];

    if ($user['payment_transaksi'] == 'pending') {
        return false;
    } else {
        mysqli_query($conn, "UPDATE user_transaksi SET item_transaksi = '$bayar' WHERE id_transaksi = '$id_transaksi'");
    }


    return mysqli_affected_rows($conn);
}

function accptItem($id_transaksi)
{
    global $conn;

    $diterima = 'diterima';

    mysqli_query($conn, "UPDATE user_transaksi SET item_transaksi = '$diterima' WHERE id_transaksi = '$id_transaksi'");

    return mysqli_affected_rows($conn);
}

function sendMon($id_transaksi)
{
    global $conn;

    $sukses = 'sukses';
    $user = query("SELECT item_transaksi FROM user_transaksi WHERE id_transaksi = '$id_transaksi'")[0];

    if ($user['item_transaksi'] == 'diterima') {
        mysqli_query($conn, "UPDATE user_transaksi SET status_transaksi = '$sukses' WHERE id_transaksi = '$id_transaksi'");
        return 1;
    } else if ($user['item_transaksi'] == 'dikirim') {
        return 2;
    } else {
        return 3;
    }
}
