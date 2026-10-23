<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MIU Unified Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        body {
            background: linear-gradient(135deg, #1e3c72, #2a9d8f);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: white;
            border-radius: 25px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            padding: 2.5rem;
            max-width: 500px;
            width: 100%;
        }
        .btn-login {
            background: #1e3c72;
            color: white;
            font-weight: 600;
            border: none;
            padding: 0.75rem;
        }
        .btn-social {
            border: 1px solid #ddd;
            color: #333;
            font-weight: 500;
            padding: 0.75rem;
        }
        .btn-google { background: #fff; }
        .btn-facebook { background: #fff; }
        .logo { width: 60px; height: 60px; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="text-center mb-4">
           <img src="miu-logo.png" alt="MIU Logo" style="width: 90px; height: 90px; border-radius: 50%;">
            <h4 class="text-primary">Log in to your Account</h4>
            <p class="text-muted">Welcome back to MIU Select your role...</p>
        </div>

        <div class="d-grid gap-2 mb-3">
            <a href="student_login.php" class="btn btn-login w-100">Student</a>
            <a href="admin_login.php" class="btn btn-login w-100">Admin</a>
            <a href="instructor_login.php" class="btn btn-login w-100">Instructor</a>
        </div>

        <div class="text-center mb-3">
            <p class="text-muted small">or continue with</p>
        </div>

        <div class="d-grid gap-2">
            <button type="button" class="btn btn-google w-100 mb-2">
                <i class="bi bi-google"></i> Continue with Google
            </button>
            <button type="button" class="btn btn-facebook w-100">
                <i class="bi bi-facebook"></i> Continue with Facebook
            </button>
        </div>

        <div class="text-center mt-3">
            <a href="register.php" class="text-decoration-none text-primary">Create an account</a>
        </div>
    </div>
</body>
</html>