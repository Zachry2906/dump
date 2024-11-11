<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include "includes/header.php";
include "includes/database.php";

// Tangani proses penambahan novel
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $genre = $_POST["genre"];
    $amount = $_POST["amount"];

    // Buat kode unik berdasarkan genre dan urutan
    $code = generateUniqueCode($genre);

    // Simpan data novel ke database
    if (addNovel($title, $genre, $amount, $code)) {
        // Redirect ke halaman utama setelah berhasil
        header("Location: index.php");
        exit;
    } else {
        $error_message = "Terjadi kesalahan saat menyimpan novel.";
    }
}

// Dapatkan daftar genre
$genres = getGenres();
?>

<div class="container">
    <h1>Add Novel</h1>
    <?php if (isset($error_message)) { ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="genre">Genre:</label>
            <select class="form-control" id="genre" name="genre" required>
                <option value="">Select Genre</option>
                <?php foreach ($genres as $genre) { ?>
                    <option value="<?php echo $genre['code']; ?>"><?php echo $genre['name']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="amount">Amount:</label>
            <input type="number" class="form-control" id="amount" name="amount" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Novel</button>
    </form>
</div>

<?php include "includes/footer.php"; ?>