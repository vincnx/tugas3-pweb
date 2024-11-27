<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require("./connection.php");
session_start();

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $user = loginUser($email, $password);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: dashboard.php");
        exit();
    } else {
        header("Location: login.php");
        exit();
    }
}

if (isset($_POST["register"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (registerUser($email, $password)) {
        $user = loginUser($email, $password);
        $_SESSION['user_id'] = $user['id'];
        header('Location: newUser.php');
        exit;
    } else {
        echo 'Error registering user.';
    }
}

if (isset($_POST["isiDataDiri"])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tempatLahir = $_POST['tempatLahir'];
    $tanggalLahir = $_POST['tanggalLahir'];
    $nomorHp = $_POST['nomorHp'];
    $userId = $_SESSION['user_id'];

    if (isiDataDiri($userId, $nama, $alamat, $tempatLahir, $tanggalLahir, $nomorHp)) {
        header('Location: dashboard.php');
        exit;
    } else {
        echo 'Error inserting data.';
    }
}

if (isset($_POST["ubahDataDiri"])) {
    $userId = $_SESSION['user_id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tempatLahir = $_POST['tempatLahir'];
    $tanggalLahir = $_POST['tanggalLahir'];
    $nomorHp = $_POST['nomorHp'];
    $grade = $_POST['grade'];

    if (updateDataDiri($userId, $nama, $alamat, $tempatLahir, $tanggalLahir, $nomorHp, $grade)) {
        header('Location: dashboard.php');
        exit;
    } else {
        echo 'Error updating data.';
    }
}

if (isset($_POST['ubahDataAkun'])) {
    $userId = $_SESSION['user_id'];
    $email = $_POST['email'];
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    if (updateDataAkun($userId, $email, $password)) {
        header('Location: dashboard.php');
        exit;
    } else {
        echo 'Error updating account information.';
    }
}

if (isset($_POST['hapusAkun'])) {
    $userId = $_SESSION['user_id'];

    if (deleteAkun($userId)) {
        session_destroy();
        header('Location: login.php');
        exit;
    } else {
        echo 'Error deleting account.';
    }
}

if (isset($_POST['logout'])) {
    session_start();
    session_destroy();
    header("Location: login.php");
    exit();
}
