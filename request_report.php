<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

// Connect to MySQL database (assuming you already have a database set up)
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "library_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve book requests for the logged-in user
$sql = "SELECT * FROM book_requests WHERE username = '" . $_SESSION['username'] . "'";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Request Report</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="report-container">
    <h2>Book Request Report for <?php echo $_SESSION['username']; ?></h2>
    <?php
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Book Title</th><th>Author</th><th>ISBN</th></tr>";
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["book_title"]."</td><td>".$row["author"]."</td><td>".$row["isbn"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No book requests found.";
    }
    $conn->close();
    ?>
    <a href="submit_request.html">Submit Another Request</a>
  </div>
</body>
</html>
