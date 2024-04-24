<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "library_db";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $book_titles = $_POST["book_title"];
    $authors = $_POST["author"];
    $isbns = $_POST["isbn"];
    $publications = $_POST["publication"];
    $editions = $_POST["edition"];
    $quantitys = $_POST["quantity"];
    $class = $_POST["class"];
    $department = $_POST["department"];
    
    $num_books = count($book_titles);

    $stmt = $conn->prepare("INSERT INTO book_requests (username, book_title, author, isbn, publication, edition, quantity, class, department) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssiss", $_SESSION['username'], $book_title, $author, $isbn, $publication, $edition, $quantity, $class, $department);

    for ($i = 0; $i < $num_books; $i++) {
        $book_title = $book_titles[$i];
        $author = $authors[$i];
        $isbn = $isbns[$i];
        $publication = $publications[$i];
        $edition = $editions[$i];
        $quantity = $quantitys[$i];

        if (!$stmt->execute()) {
            echo "Error submitting book request: " . $stmt->error;
            break;
        }
    }

    echo "Book requests submitted successfully!";

    $stmt->close();
    $conn->close();
}
?>
