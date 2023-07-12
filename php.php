<?php
// Connect to the database
$conn = new MongoClient("mongodb://localhost:27017");
$db = $conn->mydb;
$collection = $db->users;
// Check if the user is logged in
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}
// Check if the form is submitted
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Check if the username and password are valid
    $user = $collection->findOne(array('username' => $username, 'password' => $password));
    if ($user) {
        // The user is logged in
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit;
    } else {
        // The username and password are not valid
        echo "Invalid username or password.";
    }
}
?>
