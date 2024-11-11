<?php
session_start();
include "functions.php";
include "database.php";

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Cek apakah ID novel tersedia
if (!isset($_GET['id'])) {
    header("Location: main.php");
    exit;
}

$id = $_GET['id'];
$novel = getNovelById($id);

// Tangani proses update novel
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $genre = $_POST["genre"];
    $amount = $_POST["amount"];

    if (updateNovel($id, $title, $genre, $amount)) {
        // Redirect ke halaman utama setelah berhasil update
        header("Location: main.php");
        exit;
    } else {
        $error_message = "Terjadi kesalahan saat memperbarui novel.";
    }
}

// Dapatkan daftar genre
$genres = getGenres();
?>

<?php include "header.php"; ?>
<body style="background-color: #072640;">

<div class="container mt-5 w-25 text-white text-center">
    <h1 class="text-center">Edit Novel</h2>
    <p class="text-center">Fill in all the data</p>
    <?php if (isset($error_message)) { ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php } ?>
    <form method="post" action="">
        <div class="form-group">
            <label for="title" class=" mb-2">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($novel['title']); ?>" required>
        </div>
        <div class="form-group mt-3">
            <label for="genre" class=" mb-2">Novel Genre</label>
            <select class="form-control" id="genre" name="genre" required>
                <?php foreach ($genres as $genre) { ?>
                    <option value="<?php echo $genre['code']; ?>" <?php if ($novel['genre'] == $genre['code']) echo 'selected'; ?>>
                        <?php echo $genre['name']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="amount" class=" mb-2">Amount</label>
            <input type="number" class="form-control" id="amount" name="amount" value="<?php echo htmlspecialchars($novel['amount']); ?>" required>
        </div>
        <button type="submit" class="btn btn-success btn-block w-50 mx-auto mt-4">Update Novel</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
