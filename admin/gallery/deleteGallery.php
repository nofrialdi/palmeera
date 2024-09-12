<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}
include '../config.php';

$id = $_GET['id'];

$sql = "DELETE FROM gallery WHERE id = $id";

if (mysqli_query($koneksi, $sql)) {
    echo "<script>alert('Data deleted successfully!')</script>";
    echo "<script>window.location.href = '../gallery.php'</script>";
}

?>