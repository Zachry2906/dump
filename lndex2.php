<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include "includes/header.php";
include "includes/database.php";

// Dapatkan daftar novel dari database
$novels = getNovelList();
?>

<div class="container">
    <h1>Novel List</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Code</th>
                <th>Title</th>
                <th>Genre</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($novels as $novel) { ?>
                <tr>
                    <td><?php echo $novel['code']; ?></td>
                    <td><?php echo $novel['title']; ?></td>
                    <td><?php echo getGenreName($novel['genre']); ?></td>
                    <td><?php echo $novel['amount']; ?></td>
                    <td>
                        <a href="edit_novel.php?id=<?php echo $novel['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="delete_novel.php?id=<?php echo $novel['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="add_novel.php" class="btn btn-success">Add Novel</a>
</div>

<?php include "includes/footer.php"; ?>