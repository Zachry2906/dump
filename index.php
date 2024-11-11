<?php

include "database.php";
include "functions.php";

// Tangani proses login

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (verifyLogin($username, $password)) {
        // Login berhasil
        session_start();
        $_SESSION['user_id'] = $username;
        header("Location: main.php");
        exit;
    } else {
        $error_message = "Username or password is incorrect.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
        }
        .split-layout {
            display: flex;
            height: 100vh;
        }
        .image-section {
            flex: 0 0 40%;
            overflow: hidden;
        }
        .image-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .login-section {
            flex: 0 0 60%;
            background-color: #0a192f;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
        }
        .login-title {
            margin-bottom: 0.5rem;
        }
        .login-success {
            color: #888;
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <div class="split-layout">
        <!-- Image Section -->
        <div class="image-section">
            <img src="https://images.unsplash.com/photo-1554906493-4812e307243d?q=80&w=386&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                 alt="Books">
        </div>

        <!-- Login Section -->
        <div class="login-section">
            <div class="login-container ">
                <h1 class="login-title text-center">Login</h1>
                <?php if (isset($success_message)) { ?>
                    <p class="login-success text-center">Login Success!</p>
                <?php } ?>
                
                <?php if (isset($error_message)) { ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php } ?>

                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" 
                               placeholder="Username" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" 
                               placeholder="Password" required>
                    </div>
                    
                    <button type="submit" class="btn login-btn w-25 bg-success text-white">Login</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>