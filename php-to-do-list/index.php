<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve tasks from the database
$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);

// Display tasks
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Task Name: " . $row["task_name"] . "<br>";
        echo "Task Description: " . $row["task_description"] . "<br>";
        echo "Created At: " . $row["created_at"] . "<br>";
        echo "Updated At: " . $row["updated_at"] . "<br>";
        echo "Completed: " . ($row["completed"] ? "Yes" : "No") . "<br><br>";
    }
} else {
    echo "No tasks found.";
}

$conn->close();
?>
