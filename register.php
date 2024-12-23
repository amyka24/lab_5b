<?php
include 'header.php';
$error = ''; 
$successMessage = ''; // Variable to store success message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'Lab_5b');

    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (matric, name, role, password) VALUES ('$matric', '$name', '$role', '$password')";
    if ($conn->query($sql)) {
        $successMessage = "Registration successful!"; // Store success message
    } else {
        $error = "Error: " . $conn->error; // Store error message
    }
    $conn->close();
}
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3>Register User</h3>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="matric" class="form-label">Matric</label>
                    <input type="text" name="matric" class="form-control" id="matric" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="" disabled selected>Select a role</option>
                        <option value="Student">Student</option>
                        <option value="Teacher">Teacher</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>

                <!-- Display the success message above the register button -->
                <?php if (!empty($successMessage)): ?>
                    <div class="success-message text-success mb-3">
                        <p><?php echo $successMessage; ?></p>
                    </div>
                <?php endif; ?>

                <!-- Display the error message below the form fields -->
                <?php if (!empty($error)): ?>
                    <div class="error-message text-danger mb-3">
                        <p><?php echo $error; ?></p>
                    </div>
                <?php endif; ?>

                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</div>
