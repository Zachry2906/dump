<?php
include "functions.php";
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include "header.php";
include "database.php";

// Dapatkan daftar novel dari database
$novels = getNovelList();
$i = 0;
?>

<body style="background-color: #072640;">
<div class="container mt-5 px-4">
        <div class="card-header">
            <div class="text-center mb-5">
                <h1 class="mb-3 text-white">Novel List</h4>
                    <a href="addnovel.php" class="btn btn-dark btn-sm me-2 text-primary border border-primary ">Add Novel</a>
                    <a href="logout.php" class="btn btn-dark btn-sm text-warning border border-warning">Logout</a>
            </div>
        </div>
        <div class="row gx-5">
        <div class="col-8 bg-white">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Num.</th>
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
                                <td><?php echo ++$i; ?></td>
                                <td><?php echo $novel['code']; ?></td>
                                <td><?php echo $novel['title']; ?></td>
                                <td><?php echo getGenreName($novel['genre']); ?></td>
                                <td><?php echo $novel['amount']; ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $novel['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                    <a href="delete.php?id=<?php echo $novel['id']; ?>" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col">
        <img src="https://images.unsplash.com/photo-1554906493-4812e307243d?q=80&w=386&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" style="margin-left: 200px;" class=" w-50" alt="Responsive image">
        </div>
        </div>
</div>
</body>

<?php include "footer.php"; ?>