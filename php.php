<?php
// Connect to the database
$conn = new MongoClient("mongodb://atlas-sql-64a7c3ba1874b22c74950fb8-z8l6n.a.query.mongodb.net/IMS?ssl=true&authSource=admin");
$db = $conn->IMS;
$collection = $db->user;
// Check if the user is logged in
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
// Check if the form is submitted
if (isset($_POST['user']) && isset($_POST['pass'])) {
    // Get the username and password from the form
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    // Check if the username and password are valid
    $user = $collection->findOne(array('user' => $user, 'pass' => $pass));
    if ($user) {
        // The user is logged in
        $_SESSION['user'] = $user;
        header("Location: index.php");
        exit;
    } else {
        // The username and password are not valid
        echo "Invalid username or password.";
    }
}
?>
