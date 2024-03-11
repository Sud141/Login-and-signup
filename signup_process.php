<?php


// Redirect from page2.php to page1.php if the user accesses it directly without coming from page1.php
// if (!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] != "http://localhost/demo.php") {
//     header("Location: demo.php");
//     exit;
// }

// Retrieve form data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$gmail_id = $_POST['gmail_id'];
$mobile_no = $_POST['mobile_no'];
$password = $_POST['password'];

// Basic validation (you should add more robust validation)
if (empty($first_name) || empty($last_name) || empty($gmail_id) ||empty($mobile_no) || empty($password)) {
    echo "All fields are required.";
    exit;
}


// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "datab";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}


// If form is submitted, insert data into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $gmail_id = $_POST["gmail_id"];
    $mobile_no = $_POST["mobile_no"];
    $password = $_POST["password"];

    // SQL query to insert data into the database
    $sql = "INSERT INTO login (first_name,last_name, gmail_id, mobile_no, password ) 
                VALUES ('$first_name','$last_name', '$gmail_id','$mobile_no', '$password')";

if ($conn->query($sql) === TRUE) {
echo "New record created successfully";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
}
//Retrieve and display data from the database
$sql_select = "SELECT * FROM login";
$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
// Output data of each row
echo "<h2>User Records</h2>";
echo "<table border='1'><tr><th>First Name</th>
        <th>Last Name</th><th>Email ID</th><th>Mobile No.</th><th>Password</th></tr>";
while($row = $result->fetch_assoc()) {
echo "<tr><td>".$row["first_name"]."</td><td>".$row["last_name"]."</td><td>".$row["gmail_id"]."</td><td>".$row["mobile_no"]."</td><td>".$row["password"]."</td></tr>";
}
echo "</table>";
} else {
echo "0 results";
}
?>
