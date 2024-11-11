<?php
include "functions.php";
include "database.php";


if (!isset($_GET['id'])) {
    header("Location: main.php");
    exit;
} else {
    $id = $_GET['id'];
    $query = "DELETE FROM novels WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: main.php");
        exit;
    } else {
        echo "Terjadi kesalahan saat menghapus data novel.";
    }
}