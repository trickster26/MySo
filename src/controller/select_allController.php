<?php
require('../../config/connection.php');
require('../../config/constant.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST);
    if (isset($_POST['selectedUsers']) && isset($_POST['status'])) {
        $selectedUsers = $_POST['selectedUsers'];
        $newStatus = $_POST['status'];
        $newRole = $_POST['newRole'];




        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        foreach ($selectedUsers as $userId) {
            $status = $newStatus[$userId];
            $role = $newRole[$userId];

            // Update the user's status and role in the database
            $query = "UPDATE user SET status = $newStatus WHERE id = $userId";
            $result = $conn->query($query);
            echo"$query";
            if($result){
                header("Location:". URL."/templates/dashboard.php");
                exit;
            }

            // Update the user's role in the user_role table
            // $query = "UPDATE user_role SET role_id = $role WHERE user_id = $userId";
            // $conn->query($query);
            // echo "$query";
        }

        // Close the database connection
        $conn->close();
        
        
    }
}
?>