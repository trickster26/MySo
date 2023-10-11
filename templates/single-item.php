<?php
// session_start();
require("../src/model/Models.php");
// echo "iuiui";
include_once("navbar.php"); 
// echo "AMAN";
?>

<?php
$model = new Models();
    if (isset($_SESSION['product-id'])) {
        $result = $model->singleProduct($_SESSION["product-id"]);
        
        $pid= $_SESSION['product-id'];
        $productData = $result['productData'];
        $productImages = $result['productImages'];
        unset($_SESSION['product-id']);
    }
    else{
        $pid = $_GET['id'];
        $result = $model->singleProduct($pid);
        $productData = $result['productData'];
        $productImages = $result['productImages'];
    }

?>
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <!-- <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="https://dummyimage.com/600x700/dee2e6/6c757d.jpg" alt="..."></div> -->
            <?php if(isset($productImages)){?>
            <div class="col-md-6">
                <div id="carouselExampleRide" class="carousel slide" data-bs-ride="true">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img style="height: 450px; width: 300px;" src="../assets/images/product_images/<?php echo $pid; ?>/<?php echo $productData['image']; ?>.<?php echo explode(".",$productData['image'])[1]; ?>" class="d-block w-100" alt="...">
                        </div>
                        <?php
                    
                        foreach ($productImages as $key => $imageName) { $extension = explode(".",$imageName['image'])[1]; ?>

                        <div class="carousel-item ">
                            <img style="height: 450px; width: 300px;" src="../assets/images/product_images/<?php echo $pid; ?>/<?php echo $imageName['image']; ?>.<?php echo $extension;?>" class="d-block w-100" alt="...">
                        </div>
                        <?php } ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <?php } ?>

            
            <div class="col-md-6">
                <div class="small mb-1">PEF-<?php echo $productData['id']; ?></div>
                <h1 class="display-5 fw-bolder"><?php echo $productData["product_name"]; ?></h1>
                <div class="fs-5 mb-5">
                    <span><?php if($productData['discount'] > 0 ){?>
                        <span class="text-decoration-line-through"><?php echo  $productData['product_price'];?></span>
                        <span><?php echo $productData['product_price'] - ($productData['discount']*$productData['product_price'])/100; ?></span>
                        <?php }else{echo  $productData['product_price'];}; ?></span>
                </div>
                <p class="lead"><?php echo $productData['description']; ?></p>
                <div class="d-flex">
                    <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem">
                    <button class="btn btn-outline-dark flex-shrink-0" type="button">
                        <i class="bi-cart-fill me-1"></i>
                        Add to cart
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include_once("footer.php"); ?>