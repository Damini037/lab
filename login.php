<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    include_once "db_connection.php";

    // Get username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare SQL statement to fetch user data
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $username ="root";
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // User found, verify password
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Password correct, set session variables and redirect to dashboard
            $_SESSION['username'] = $username;
            header("Location: submit_request.php");
            exit();
        } else {
            // Password incorrect
            $error = "Invalid username or password.";
        }
    } else {
        // User not found
        $error = "Invalid username or password.";
    }

    $stmt->close();
    $conn->close();
}
?>

