<?php

include("../config/connection.php");
include("../templates/navbar.php");


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pagination settings
$itemsPerPage = 3;
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($currentPage - 1) * $itemsPerPage;

// Fetch total number of products
$sqlCount = "SELECT COUNT(*) as total FROM product";
$resultCount = $conn->query($sqlCount);
$totalItems = $resultCount->fetch_assoc()['total'];

// Calculate total pages
$totalPages = ceil($totalItems / $itemsPerPage);

// Fetch products for the current page
$sql = "SELECT * FROM product LIMIT $itemsPerPage OFFSET $offset";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display the product list
    echo '<section class="py-5">';
    echo '<div class="container px-4 px-lg-5 mt-5">';
    echo '<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">';
    while ($row = $result->fetch_assoc()) {
        if($row['visibility']=='1'){
           
        echo '<div class="col mb-5">';
        echo '<div class="card h-100">';
        echo '<img style="height:70%; max-height:300px; width:100%;" class="card-img-top" src="../assets/images/product_images/' . $row['id'] . '/' . $row['image'] . '.' . explode(".", $row['image'])[1] . '" alt="' . $row['product_name'] . '">';
        echo '<div class="card-body p-4">';        
        echo '<div class="text-center">';
        echo '<h5 class="fw-bolder">' . $row['product_name'] . '</h5>';
 
        // echo '$' . $row['min_price'] . ' - $' . $row['max_price'];
        // var_dump($row);
        echo 'Rs. ';
        if($row['discount'] > 0 ){ echo $row['product_price'] - ($row['discount']*$row['product_price'])/100;}else{ echo  $row['product_price'];};
        echo '</div>';
        echo '</div>';
        echo '<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">';
        echo '<div class="text-center"><a class="btn btn-outline-dark mt-auto" href="http://localhost:8000/templates/single-item.php?id='.$row['id'].'">View product</a></div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        }
    }
    echo '</div>';
    echo '</div>';
    echo '</section>';

    // Display pagination controls
    echo '<div class="pagination d-flex justify-content-center">';
    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<a class="btn btn-outline-secondary mx-2" href="/templates/items.php?page=' . $i . '">' . $i . '</a>';
    }
    echo '</div>';
} else {
    echo "No products found.";
}


?> 