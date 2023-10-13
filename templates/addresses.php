<?php
require("../config/connection.php");
include_once("navbar.php");
$id = $_SESSION['id'];


// Define the number of addresses to display per page
$addressesPerPage = 4;

try {
    $query = "SELECT * FROM `address` WHERE user_id = '$id'";
    $result = $conn->query($query);
    $totalAddresses = $result->num_rows;

    // Calculate the total number of pages
    $totalPages = ceil($totalAddresses / $addressesPerPage);

    // Get the current page number from the URL or set it to 1
    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $currentPage = intval($_GET['page']);
    } else {
        $currentPage = 1;
    }

    // Calculate the offset to retrieve the appropriate addresses for the current page
    $offset = ($currentPage - 1) * $addressesPerPage;

    // Query the database again to get addresses for the current page
    $query = "SELECT * FROM `address` WHERE user_id = '$id' LIMIT $offset, $addressesPerPage";
    $result = $conn->query($query);
    $exist = array();

    while ($row = mysqli_fetch_assoc($result)) {
        array_push($exist, $row);
    }
} catch (PDOException $e) {
    echo "Error fetching data: " . $e->getMessage();
}

if (isset($_SESSION['edit-address'])) {
    echo '<div class="alert alert-success">' . $_SESSION['edit-address'] . ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
    unset($_SESSION['edit-address']);
}

if (isset($_SESSION['address-error'])) {
    echo '<div class="alert alert-danger">' . $_SESSION['address-error'] . ' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
    unset($_SESSION['address-error']);
}

?>

<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap-extended.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/fonts/simple-line-icons/style.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/colors.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

<div class="grey-bg container-fluid">
    <section id="minimal-statistics">
        <div class="row">
            <div class="col-12 mt-3 mb-1">
                <h4 class="text-uppercase">Your Addresses</h4>
                <p>Do what you want to Do.</p>
            </div>
        </div>
        <div class="row">
            <?php foreach ($exist as $address) { ?>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        
                                    </div>
                                    <div class="media-body">
                                        <h3><span>Street:</span><?php echo $address['street_address']; ?></h3>
                                        <p><span>PIN Code:</span><?php echo $address['pin_code']; ?></p>
                                        <p><span>Country:</span><?php echo $address['country']; ?></p>
                                        <p><span>State:</span><?php echo $address['state']; ?></p>
                                        <p><span>City:</span><?php echo $address['city']; ?></p>
                                        <p><span>Created At:</span><?php echo $address['created_at']; ?></p>
                                        <p><span>Updated At:</span><?php echo $address['updated_at']; ?></p>
                                        <div class="mt-3">
                                            <a href="http://localhost:8000/templates/edit-address.php?id=<?php echo $address['id']; ?>" >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="green" class="bi bi-pencil" viewBox="0 0 16 16">
                                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                </svg>
                                            </a>
                                            <a href="http://localhost:8000/templates/delete-address.php?id=<?php echo $address['id']; ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="red" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <div class="row">
        <div class="col-12">
            <ul class="pagination justify-content-center">
                <?php if ($totalPages > 1) { ?>
                    <?php if ($currentPage > 1) { ?>
                        <li class="page-item">
                            <a class="page-link" href="http://localhost:8000/templates/addresses.php?page=<?php echo $currentPage - 1; ?>">Previous</a>
                        </li>
                    <?php } ?>
                    <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                        <li class="page-item <?php echo ($i === $currentPage) ? 'active' : ''; ?>">
                            <a class="page-link" href="http://localhost:8000/templates/addresses.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php } ?>
                    <?php if ($currentPage < $totalPages) { ?>
                        <li class="page-item">
                            <a class="page-link" href="http://localhost:8000/templates/addresses.php?page=<?php echo $currentPage + 1; ?>">Next</a>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>










<?php include("./footer.php") ?>