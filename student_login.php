<?php
session_start();
include 'includes/db.php';
$message = '';

if ($_POST) {
    $regno = mysqli_real_escape_string($conn, $_POST['regno']);
    $password = $_POST['password'];

    $sql = "SELECT studentID, Fname, Lname, Password_hash FROM student WHERE RegNo = '$regno'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $student = mysqli_fetch_assoc($result);
        if (password_verify($password, $student['Password_hash'])) {
            $_SESSION['user_id'] = $student['studentID'];
            $_SESSION['user_name'] = $student['Fname'] . ' ' . $student['Lname'];
            $_SESSION['role'] = 'student';
            header("Location: student/dashboard.php");
            exit();
        } else {
            $message = "<div class='alert alert-danger'>Wrong password!</div>";
        }
    } else {
        $message = "<div class='alert alert-danger'>Invalid Reg No!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #e3f2fd; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card { border-radius: 20px; max-width: 380px; width: 100%; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-4 shadow">
                    <h3 class="text-center text-primary mb-4">Student Login</h3>
                    <?php echo $message; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label>Reg No</label>
                            <input type="text" name="regno" class="form-control" placeholder="25/bit/076/xmc" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="forgot_password.php" class="text-decoration-none text-danger small">Forgot Password?</a>
                    </div>
                    <div class="text-center mt-2">
                        <a href="index.php" class="text-decoration-none">Back to Roles</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>