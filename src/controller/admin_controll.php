<?php
require('../../config/connection.php');
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {

    $userId = $_GET["id"];

    $updateSql = "UPDATE user SET status = 2 WHERE id = $userId";


    if ($conn->query($updateSql) === TRUE) {
        $_SESSION['delete-success'] = "Deleted Successfully!";
        header("Location: http://localhost:8000/templates/dashboard.php");
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
        header("Location: http://localhost:8000/templates/dashboard.php");
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
            header("Location: http://localhost:8000/templates/dashboard.php");
            exit();
        } else {
            echo "Error updating role: " . $conn->error;
        }
    }else{
        header("Location: http://localhost:8000/templates/dashboard.php");
        exit;
    }
} else {
    echo "Invalid request.";
}


    


?>