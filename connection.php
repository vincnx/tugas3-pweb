<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_tugas3";
// $port = 3306;

//KONEKSI KE DATABASE
$con = mysqli_connect($hostname, $username, $password, $database);


//QUERY
function loginUser($email, $password)
{
    global $con;

    $stmt = mysqli_prepare($con, "SELECT * FROM user WHERE email = ?");
    mysqli_stmt_bind_param($stmt, 's', $email);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $user['password'])) {
            return $user;
        }
    }

    return false;
}

function registerUser($email, $password)
{
    global $con;

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = mysqli_prepare($con, "INSERT INTO user (email, password) VALUES (?, ?)");

    mysqli_stmt_bind_param($stmt, 'ss', $email, $hashedPassword);

    if (mysqli_stmt_execute($stmt)) {
        return true;
    } else {
        return false;
    }
}

function isiDataDiri($userId, $nama, $alamat, $tempatLahir, $tanggalLahir, $nomorHp)
{
    global $con;

    $stmt = mysqli_prepare($con, "INSERT INTO user_data (id, nama, alamat, tempat_lahir, tanggal_lahir, nomor_hp) VALUES (?, ?, ?, ?, ?, ?)");

    mysqli_stmt_bind_param($stmt, 'isssss', $userId, $nama, $alamat, $tempatLahir, $tanggalLahir, $nomorHp);

    if (mysqli_stmt_execute($stmt)) {
        return true;
    } else {
        return false;
    }
}

function getDataDiriBySession()
{
    global $con;

    $userId = $_SESSION['user_id'];

    $stmt = mysqli_prepare($con, "SELECT * FROM user_data WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $userId);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($data = mysqli_fetch_assoc($result)) {
        return $data;
    }

    return false;
}

function getDataAkunBySession()
{
    global $con;

    $userId = $_SESSION['user_id'];

    $stmt = mysqli_prepare($con, "SELECT email FROM user WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $userId);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($data = mysqli_fetch_assoc($result)) {
        return $data;
    }

    return false;
}

function updateDataDiri($userId, $nama, $alamat, $tempatLahir, $tanggalLahir, $nomorHp, $grade)
{
    global $con;

    $stmt = mysqli_prepare($con, "UPDATE user_data SET nama = ?, alamat = ?, tempat_lahir = ?, tanggal_lahir = ?, nomor_hp = ?, grade = ? WHERE id = ?");

    mysqli_stmt_bind_param($stmt, 'ssssssi', $nama, $alamat, $tempatLahir, $tanggalLahir, $nomorHp, $grade, $userId);

    if (mysqli_stmt_execute($stmt)) {
        return true;
    } else {
        return false;
    }
}

function updateDataAkun($userId, $email, $password = null)
{
    global $con;

    $query = "UPDATE user SET email = ?";

    if ($password !== null) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query .= ", password = ?";
    }

    $query .= " WHERE id = ?";

    $stmt = mysqli_prepare($con, $query);

    if ($password !== null) {
        mysqli_stmt_bind_param($stmt, 'ssi', $email, $hashedPassword, $userId);
    } else {
        mysqli_stmt_bind_param($stmt, 'si', $email, $userId);
    }

    if (mysqli_stmt_execute($stmt)) {
        return true;
    } else {
        return false;
    }
}

function deleteAkun($userId)
{
    global $con;

    mysqli_begin_transaction($con);

    try {
        $stmt1 = mysqli_prepare($con, "DELETE FROM user_data WHERE id = ?");
        mysqli_stmt_bind_param($stmt1, 'i', $userId);
        mysqli_stmt_execute($stmt1);

        $stmt2 = mysqli_prepare($con, "DELETE FROM user WHERE id = ?");
        mysqli_stmt_bind_param($stmt2, 'i', $userId);
        mysqli_stmt_execute($stmt2);

        mysqli_commit($con);
        return true;
    } catch (Exception $e) {
        mysqli_rollback($con);
        return false;
    }
}
