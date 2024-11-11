<?php
session_start();

// Cek apakah pengguna sudah login
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Tangani proses login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Verifikasi username dan password
    if (verifyLogin($username, $password)) {
        // Simpan data pengguna ke session
        $_SESSION["user_id"] = $username;
        header("Location: index.php");
        exit;
    } else {
        $error_message = "Username atau password salah.";
    }
}

include "includes/header.php";
?>

<div class="container">
    <h1>Login</h1>
    <?php if (isset($error_message)) { ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<?php include "includes/footer.php"; ?>