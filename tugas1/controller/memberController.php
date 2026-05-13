<?php
session_start();
include_once '../koneksi.php';
include_once '../models/Member.php';

$uname    = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$data = [$uname, $password];

$obj_member = new Member();
$rs = $obj_member->cekLogin($data);

if (!empty($rs)) {
    $_SESSION['MEMBER'] = $rs;
    header('location: ../index.php?hal=home');
} else {
    echo '<script>alert("Username/Password Anda Salah!!!");history.go(-1);</script>';
}
?>
