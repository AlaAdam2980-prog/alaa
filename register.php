<?php
include 'includes/db.php';
$message = '';

if ($_POST) {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $regno = mysqli_real_escape_string($conn, $_POST['regno']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $gender = $_POST['gender'];
    $deptid = $_POST['deptid'];
    $password = Password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO student (Fname, Lname, RegNo, Email, phone, Gender, DeptID, Password_hash) 
            VALUES ('$fname', '$lname', '$regno', '$email', '$phone', '$gender', '$deptid', '$password')";

    if (mysqli_query($conn, $sql)) {
        $message = "<div class='alert alert-success'>Registration successful! <a href='student_login.php'>Login here</a></div>";
    } else {
        $message = "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #e9f5ff; min-height: 100vh; display: flex; align-items: center; }
        .card { border-radius: 20px; max-width: 500px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 shadow">
                    <h3 class="text-center text-primary mb-4">Student Registration</h3>
                    <?php echo $message; ?>
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>First Name</label>
                                <input type="text" name="fname" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Last Name</label>
                                <input type="text" name="lname" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Reg No</label>
                            <input type="text" name="regno" class="form-control" placeholder="25/bit/076/xmc" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Gender</label>
                            <select name="gender" class="form-select" required>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Department</label>
                            <select name="deptid" class="form-select" required>
                                <?php
                                $dept_sql = "SELECT * FROM department";
                                $dept_result = mysqli_query($conn, $dept_sql);
                                while ($dept = mysqli_fetch_assoc($dept_result)) {
                                    echo "<option value='" . $dept['DeptID'] . "'>" . $dept['Dept_Name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="index.php" class="text-decoration-none">Back to Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>