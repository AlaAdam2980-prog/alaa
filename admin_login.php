<?php
session_start();
include 'includes/db.php';
$message = '';

if ($_POST) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Default admin: username = admin, password = admin123
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['role'] = 'admin';
        $_SESSION['user_name'] = 'Admin';
        header("Location: admin/dashboard.php");
        exit();
    } else {
        $message = "<div class='alert alert-danger'>Invalid username or password!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8d7da; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card { border-radius: 20px; max-width: 380px; width: 100%; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-4 shadow">
                    <h3 class="text-center text-danger mb-4">Admin Login</h3>
                    <?php echo $message; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-danger w-100">Login</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="index.php" class="text-decoration-none">Back to Roles</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>