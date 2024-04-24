<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    include_once "db_connection.php";

    // Get username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare SQL statement to fetch admin data
    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $username="root";
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Admin found, verify password
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            // Password correct, set session variable and redirect to admin dashboard
            $_SESSION['admin'] = $username;
            header("Location: admin_dashboard.php");
            exit();
        } else {
            // Password incorrect
            $error = "Invalid username or password.";
        }
    } else {
        // Admin not found
        $error = "Invalid username or password.";
    }

    $stmt->close();
    $conn->close();
}
?>
