<?php
include 'header.php';

session_start();
if (!isset($_SESSION['matric'])) {
    echo "<div class='alert alert-warning mt-5'>
            <strong>Please log in to view this page.</strong>
            <a href='login.php' class='btn btn-primary ml-3'>Login</a>
          </div>";
    exit();
}


$conn = new mysqli('localhost', 'root', '', 'Lab_5b');
$result = $conn->query("SELECT matric, name, role FROM users");

if (!$result) {
    die("Error retrieving data: " . $conn->error);
}
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between mb-4">
        <h2>User List</h2>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Matric</th>
                <th>Name</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Display each row from the database
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['matric']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['role']}</td>
                        <td>
                            <a href='update.php?matric={$row['matric']}' class='btn btn-warning btn-sm'>
                                <i class='fas fa-edit'></i> Update
                            </a>
                            <a href='delete.php?matric={$row['matric']}' class='btn btn-danger btn-sm'>
                                <i class='fas fa-trash'></i> Delete
                            </a>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
