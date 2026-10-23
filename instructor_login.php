<?php
session_start();
include 'includes/db.php';
$message = '';

if ($_POST) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Use backticks to handle any case (instructor, INSTRUCTOR, Instructor)
    $sql = "SELECT InstructorID, Fname, Lname, Password_hash FROM `instructor` WHERE Email = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Check if password is hashed OR plain text (for your old data)
        if (password_verify($password, $user['Password_hash']) || $user['Password_hash'] === $password) {
            $_SESSION['user_id'] = $user['InstructorID'];
            $_SESSION['user_name'] = $user['Fname'] . ' ' . $user['Lname'];
            $_SESSION['role'] = 'instructor';
            header("Location: instructor/dashboard.php");
            exit();
        } else {
            $message = "<div class='alert alert-danger'>Wrong password!</div>";
        }
    } else {
        $message = "<div class='alert alert-danger'>Email not found!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background:light green ); min-height: 100vh; display: flex; align-items: center; }
        .login-card { max-width: 420px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); }
        .btn-login { background: #28a745; border: none; font-weight: bold; }
        .btn-login:hover { background: #218838; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card login-card p-4">
                    <div class="text-center mb-4">
                        <h3 class="text-success fw-bold">Instructor Portal</h3>
                        <p class="text-muted">Login to manage your sections</p>
                    </div>

                    <?php echo $message; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label text-dark">Email Address</label>
                            <input type="email" name="email" class="form-control form-control-lg" 
                                   placeholder="abc@gmail.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-dark">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg" 
                                   placeholder="Enter password" required>
                        </div>
                        <button type="submit" class="btn btn-success btn-login w-100 btn-lg">
                            Login Now
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <a href="index.php" class="text-decoration-none text-muted">
                            Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>