<?php
include 'header.php';

$conn = new mysqli('localhost', 'root', '', 'Lab_5b');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET matric='$matric', name='$name', role='$role' WHERE matric='$matric'";
    if ($conn->query($sql)) {
        header("Location: display.php");
        exit();
    } else {
        echo "Error: " . $conn->error; 
    }
} else {
    if (isset($_GET['matric'])) {
        $matric = $_GET['matric'];
        $result = $conn->query("SELECT * FROM users WHERE matric='$matric'");

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
        } else {
            echo "User not found.";
            exit();
        }
    } else {
        echo "No matric provided.";
        exit();
    }
}
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3>Update User</h3>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <input type="hidden" name="matric" value="<?php echo htmlspecialchars($user['matric']); ?>">

                <div class="mb-3">
                    <label for="matric" class="form-label">Matric</label>
                    <input type="text" name="matric" class="form-control" id="matric" value="<?php echo htmlspecialchars($user['matric']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="Student" <?php echo ($user['role'] == 'Student') ? 'selected' : ''; ?>>Student</option>
                        <option value="Teacher" <?php echo ($user['role'] == 'Teacher') ? 'selected' : ''; ?>>Teacher</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="display.php" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
