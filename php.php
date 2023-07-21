

<?php
use Exception;
use MongoDB\Client;
use MongoDB\Driver\ServerApi;
// Connect to the database
$conn = new MongoClient("mongodb+srv://ivancarito2002:CArito009@cluster0.qpf78xw.mongodb.net/IMS?retryWrites=true&w=majority");
$db = $conn->IMS;
$collection = $db->user;
// Specify Stable API version 1
$apiVersion = new ServerApi(ServerApi::V1);

// Create a new client and connect to the server
$client = new MongoDB\Client($uri, [], ['serverApi' => $apiVersion]);
// Check if the user is logged in
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}
// Check if the form is submitted
if (isset($_POST['user']) && isset($_POST['pass'])) {
    // Get the username and password from the form
    $username = $_POST['user'];
    $password = $_POST['pass'];
    // Check if the username and password are valid
    $user = $collection->findOne(array('user' => $username, 'pass' => $password));
    if ($user) {
        // The user is logged in
        $_SESSION['user'] = $username;
        header("Location: index.php");
        exit;
    } else {
        // The username and password are not valid
        echo "Invalid username or password.";
    }
}
?>
