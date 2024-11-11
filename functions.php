<?php

include "database.php";

function verifyLogin($username, $password) {
    global $conn;
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    $cek = mysqli_num_rows($result);
    return $cek;
}

function getNovelList() {
    global $conn;
    $query = "SELECT * FROM novels";
    $result = mysqli_query($conn, $query);
    $novels = [];
    while ($novel = mysqli_fetch_assoc($result)) {
        $novels[] = $novel;
    }
    return $novels;
}

function getGenres() {
    return [
        ['code' => 'FT', 'name' => 'Fantasy'],
        ['code' => 'HR', 'name' => 'Horror'],
        ['code' => 'MS', 'name' => 'Mystery'],
        ['code' => 'RM', 'name' => 'Romance']
    ];
}

function generateUniqueCode($genre) {
    global $conn;

    // Ambil semua nomor kode yang sudah ada untuk genre ini
    $query = "SELECT code FROM novels WHERE genre = '$genre' ORDER BY code";
    $result = mysqli_query($conn, $query);

    $usedNumbers = [];
    while ($row = mysqli_fetch_assoc($result)) {
        // Ekstrak nomor dari kode, misalnya FT001 -> 1
        $number = (int) substr($row['code'], 2);
        $usedNumbers[] = $number;
    }

    // Cari nomor terkecil yang belum digunakan
    $newNumber = 1;
    while (in_array($newNumber, $usedNumbers)) {
        $newNumber++;
    }

    // Format kode sesuai genre dan nomor yang tersedia
    return sprintf("%s%03d", $genre, $newNumber);
}

/**
 * Tambahkan novel baru ke database
 * @param string $title
 * @param string $genre
 * @param int $amount
 * @param string $code
 * @return bool
 */
function addNovel($title, $genre, $amount, $code) {
    global $conn;
    $query = "INSERT INTO novels (title, genre, amount, code) VALUES ('$title', '$genre', $amount, '$code')";
    return mysqli_query($conn, $query);
}

/**
 * Dapatkan nama genre berdasarkan kode
 * @param string $genreCode
 * @return string
 */
function getGenreName($genreCode) {
    $genres = getGenres();
    foreach ($genres as $genre) {
        if ($genre['code'] == $genreCode) {
            return $genre['name'];
        }
    }
    return '';
}

function deleteNovel($id) {
    global $conn;
    $query = "DELETE FROM novels WHERE id = $id";
    return mysqli_query($conn, $query);
}

function getNovelById($id) {
    global $conn;
    $query = "SELECT * FROM novels WHERE id = $id";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

function updateNovel($id, $title, $genre, $amount) {
    global $conn;
    $query = "UPDATE novels SET title = '$title', genre = '$genre', amount = $amount WHERE id = $id";
    return mysqli_query($conn, $query);
}