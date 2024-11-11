<?php
include_once 'database.php';

/**
 * Verifikasi login pengguna
 * @param string $username
 * @param string $password
 * @return bool
 */
function verifyLogin($username, $password) {
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            return true;
        }
    }

    return false;
}

/**
 * Dapatkan daftar novel dari database
 * @return array
 */
function getNovelList() {
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT * FROM novels");
    $stmt->execute();
    $result = $stmt->get_result();

    $novels = [];
    while ($row = $result->fetch_assoc()) {
        $novels[] = $row;
    }

    return $novels;
}

/**
 * Dapatkan daftar genre
 * @return array
 */
function getGenres() {
    return [
        ['code' => 'FT', 'name' => 'Fantasy'],
        ['code' => 'HR', 'name' => 'Horror'],
        ['code' => 'MS', 'name' => 'Mystery'],
        ['code' => 'RM', 'name' => 'Romance']
    ];
}

/**
 * Buat kode unik berdasarkan genre dan urutan
 * @param string $genre
 * @return string
 */
function generateUniqueCode($genre) {
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM novels WHERE genre = ?");
    $stmt->bind_param("s", $genre);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $count = $row['count'] + 1;
    return sprintf("%s%03d", $genre, $count);
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
    $conn = getConnection();
    $stmt = $conn->prepare("INSERT INTO novels (title, genre, amount, code) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $title, $genre, $amount, $code);
    return $stmt->execute();
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