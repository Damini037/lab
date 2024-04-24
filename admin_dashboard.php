<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Add your CSS file or inline styles here -->
    <style>
        /* Your CSS styles here */
    </style>
</head>
<body>
    <div class="container">
        <h2>Book Requests</h2>
        <table class="request-table">
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Publication</th>
                    <th>Edition</th>
                    <th>Quantity</th>
                    <th>Class</th>
                    <th>Department</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include your database connection file
                include_once "db_connection.php";

                // Fetch book requests from the database
                $sql = "SELECT * FROM book_requests";
                $result = $conn->query($sql);

                // Display book requests in the table
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["book_title"] . "</td>
                                <td>" . $row["author"] . "</td>
                                <td>" . $row["isbn"] . "</td>
                                <td>" . $row["publication"] . "</td>
                                <td>" . $row["edition"] . "</td>
                                <td>" . $row["quantity"] . "</td>
                                <td>" . $row["class"] . "</td>
                                <td>" . $row["department"] . "</td>
                                <td>" . $row["username"] . "</td>
                                <td><button class='approve-btn'>Approve</button></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No book requests found</td></tr>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
