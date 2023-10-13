<?php
require("../config/connection.php");
include_once("navbar.php");

// Check if the user is authenticated (you should implement user authentication)
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirect to the login page
    exit;
}

// Check if the address ID is provided as a query parameter
if (isset($_GET['id'])) {
    $addressId = $_GET['id'];
} else {
    header("Location: http://localhost:8000/templates/addresses.php"); // Redirect to your addresses page
    exit;
}

// Check if the form is submitted for address deletion
if (isset($_POST['deleteAddress'])) {
    // Delete the address from the database
    $deleteQuery = "DELETE FROM address WHERE id = $addressId AND user_id = ".$_SESSION['id'];

    if ($conn->query($deleteQuery)) {
        // Address deleted successfully
        header("Location: http://localhost:8000/templates/addresses.php"); // Redirect to your addresses page
        exit;
    } else {
        echo "Error deleting address: " . $conn->error;
    }
}

// Retrieve the current address details
$query = "SELECT * FROM `address` WHERE id = $addressId AND user_id = ".$_SESSION['id'];
$result = $conn->query($query);

if ($result->num_rows === 1) {
    $address = $result->fetch_assoc();
} else {
    echo "Address not found or unauthorized access.";
    exit;
}
?>

<div class="container">
    <h2>Delete Address</h2>
    <p>Are you sure you want to delete this address?</p>
    <p>Street Address: <?php echo $address['street_address']; ?></p>
    
    <form method="POST" action=" http://localhost:8000/templates/delete-address.php?id=<?php echo $addressId; ?>">
        <button type="submit" name="deleteAddress" class="btn btn-danger">Delete Address</button>
    </form>
</div>
