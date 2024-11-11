<?php
session_start();
include "functions.php";

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include "header.php";
include "database.php";

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
        header("Location: main.php");
        exit;
    } else {
        $error_message = "Terjadi kesalahan saat menyimpan novel.";
    }
}

// Dapatkan daftar genre
$genres = getGenres();
?>
<body style="background-color: #072640;">

<div class="container mt-5 text-white ">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-container text-center">
                    <h1 class="title-text">Add Novel</h2>
                    <p class="subtitle-text">Fill in all the data</p>
                    
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="genre" class="form-label">Novel Genre</label>
                            <select class="form-control" id="genre" name="genre" required>
                                <option value="">Open Novel Genre</option>
                                <?php foreach ($genres as $genre) { ?>
                                    <option value="<?php echo $genre['code']; ?>"><?php echo $genre['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>
                        
                        <button type="submit" class="btn btn-update bg-success color-white w-25 text-white">Add Novel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

<?php include "footer.php"; ?>