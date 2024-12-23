<?php
include 'header.php';

session_start();
$error = ''; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Create a new database connection
    $conn = new mysqli('localhost', 'root', '', 'Lab_5b');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user input
    $matric = $conn->real_escape_string($_POST['matric']);
    $password = $_POST['password'];

    // Query to find the user by matric
    $sql = "SELECT * FROM users WHERE matric='$matric'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $user['password'])) {
            $_SESSION['matric'] = $matric;
            header("Location: display.php");
            exit();
        } else {
            $error = "Invalid password!"; 
        }
    } else {
        $error = "User not found!"; 
    }

    $conn->close(); 
}
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h3>User Login</h3>
        </div>
        <div class="card-body">
            <!-- Login form -->
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="matric" class="form-label">Matric</label>
                    <input type="text" name="matric" class="form-control" id="matric" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <?php if (!empty($error)): ?>
                    <div class="error-message text-danger mb-3">
                        <p><?php echo $error; ?></p>
                    </div>
                <?php endif; ?>
                <button type="submit" class="btn btn-success">Login</button>
            </form>
        </div>
        <div class="card-footer">
            <p>Don't have an account? <a href="register.php">Register here</a>.</p>
        </div>
    </div>
</div>
