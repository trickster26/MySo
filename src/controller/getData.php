<?php
// Sample data from the database (replace with actual data retrieval)
$cardData = [
    [
        "imageUrl" => "https://dummyimage.com/450x300/dee2e6/6c757d.jpg",
        "productName" => "Product 1",
        "rating" => 4.5,
        "price" => "$40.00",
    ],
    // Add more data as needed
];

foreach ($cardData as $data) {
    echo '<div class="col mb-5">';
    echo '<div class="card h-100">';
    echo '<img class="card-img-top" src="' . $data["imageUrl"] . '" alt="...">';
    echo '<div class="card-body p-4">';
    echo '<div class="text-center">';
    echo '<h5 class="fw-bolder">' . $data["productName"] . '</h5>';
    echo '<div class="d-flex justify-content-center small text-warning mb-2">';
    // Generate rating stars
    for ($i = 0; $i < 5; $i++) {
        if ($i < $data["rating"]) {
            echo '<div class="bi-star-fill"></div>';
        } else {
            echo '<div class="bi-star"></div>';
        }
    }
    echo '</div>';
    echo $data["price"];
    echo '</div>';
    echo '</div>';
    echo '<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">';
    echo '<div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
?>
