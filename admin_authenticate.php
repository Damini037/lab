<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection file
    include_once "db_connection.php";

    // Get username and password from the login form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // SQL query to check if the admin exists
    $sql = "SELECT * FROM admins WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Admin exists, verify password
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            // Password is correct, set session and redirect to admin dashboard
            $_SESSION['admin'] = $username;
            header("Location: admin_dashboard.php");
            exit();
        } else {
            // Password is incorrect, redirect back to login page with error message
            $_SESSION['login_error'] = "Invalid username or password.";
            header("Location: admin_login.html");
            exit();
        }
    } else {
        // Admin does not exist, redirect back to login page with error message
        $_SESSION['login_error'] = "Invalid username or password.";
        header("Location: admin_login.html");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirect back to login page if accessed directly
    header("Location: admin_login.html");
    exit();
}
?>
