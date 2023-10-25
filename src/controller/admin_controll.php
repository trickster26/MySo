<?php
require('../../config/connection.php');
require('../../config/constant.php');
var_dump($_POST);
var_dump(isset($_POST['processChanges']));
exit;
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {

    $userId = $_GET["id"];

    $updateSql = "UPDATE user SET status = 2 WHERE id = $userId";


    if ($conn->query($updateSql) === TRUE) {
        $_SESSION['delete-success'] = "Deleted Successfully!";
        header("Location:". URL."/templates/dashboard.php");
        exit();
    }
    else {
        echo "Error updating status: " . $conn->error;
    }

    
}else if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"]) && isset($_POST["new_status"])){

    $userId = $_POST["user_id"];
    $newStatus = $_POST["new_status"];

    $updateSql = "UPDATE user SET status = $newStatus WHERE id = $userId";

    if ($conn->query($updateSql) === TRUE) {
        header("Location:".URL."/templates/dashboard.php");
        exit();
    } else {
        echo "Error updating status: " . $conn->error;
    }


}else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"]) && isset($_POST["new_role"])) {
    $userId = $_POST["user_id"];
    $newRole = $_POST["new_role"];
    if($newRole != 1){
        var_dump($newRole);
        $updateSql = "UPDATE user_role SET role_id = '$newRole' WHERE user_id = '$userId'";

        if ($conn->query($updateSql) === TRUE) {
            header("Location:".URL."/templates/dashboard.php");
            exit();
        } else {
            echo "Error updating role: " . $conn->error;
        }
    }else{
        header("Location:". URL."/templates/dashboard.php");
        exit;
    }
} else if (isset($_POST['processChanges'])) {
    $selectedUsers = $_POST['selectedUsers'];
    $newStatus = $_POST['status'];
    $newRole = $_POST['newRole'];
    var_dump($_POST['selectedUsers']);
    var_dump($_POST['status']);
    exit;
    // Perform the necessary database updates
    if (!empty($selectedUsers)) {
        // Connect to your database (modify this according to your setup)
        $conn = new mysqli('your_host', 'your_username', 'your_password', 'your_database');

        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        foreach ($selectedUsers as $userId) {
            $status = $newStatus[$userId];
            $role = $newRole[$userId];

            // Update the user's status and role in the database
            $query = "UPDATE user SET status = $status WHERE id = $userId";
            $conn->query($query);

            // Update the user's role in the user_role table
            $query = "UPDATE user_role SET role_id = $role WHERE user_id = $userId";
            $conn->query($query);
        }

        // Close the database connection
        $conn->close();
    }
    header('Location: your_page.php');
    exit;
}
 else {
    echo "Invalid request.";
}


    


?>