<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){
    ?>
    
    <!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Watchlist | RED STore</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resourses/Rs-logo.svg.png" />
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php";

            ?>


            <div class="col-12 bg-body mb-2" style="background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);">
                <div class="row">
                    
                
                    <div class="offset-lg-4 col-12 col-lg-4">
                            <div class="row">
                            
                                <div class="col-12 text-center">
                                    <P class="fs-1 text-black- fw-bold mt-3 pt-2">Watchlist</P>
                                </div>
                            
                            </div>
                            
                    </div>
                </div>
            </div>


                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Watchlist</li>
                                        </ol>
                                    </nav>

                                


                                <div class="col-12">
                                            <hr class=" border-black border-3" />
                                        </div>



                                        <?php
                                
                                $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE 
                                `users_email`='" . $_SESSION["u"]["email"] . "'");
                                $watchlist_num = $watchlist_rs->num_rows;

                                if ($watchlist_num == 0) {
                                    ?>
                               
                                    
                                     <!-- empty view -->
                                     <div class="col-12 col-lg-12">
                                        <div class="row">
                                            <div class="col-12 emptyView"></div>
                                            <div class="col-12 text-center">
                                                <label class="form-label fs-1 fw-bold">You have no items in your Watchlist yet.</label>
                                            </div>
                                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                                <a href="home.php" class="btn btn-warning fs-3 fw-bold">Start Shopping</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- empty view -->

                                     <!-- empty view -->
                                    
                                     <?php

                                    } else {
                                        for ($x = 0;$x < $watchlist_num;$x++) {
                                            $watchlist_data = $watchlist_rs->fetch_assoc();
                                        

                                        ?>
                                        
                                        <!-- have products -->

                                        <?php
                                        $product_rs = Database::search("SELECT * FROM `product` WHERE 
                                        `id`='".$watchlist_data["product_id"]."' ");
                                        $product_data = $product_rs->fetch_assoc();
                                        
                                        
                                        ?>

                                            
                                <div class="col-12 col-lg-10 offset-1">
                                        <div class="row">
                                            
                                                <div class="card wtlist cardtran mb-3 mx-0 mx-lg-2 col-12 ">
                                                    <div class="row g-0">
                                                        <div class="col-md-4">

                                                        <?php
                                                        
                                                        $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='".$watchlist_data["product_id"]."'");
                                                        $image_data = $image_rs->fetch_assoc();
                                                        
                                                        ?>
                                                            
                                                            <img src="<?php echo $image_data["img_path"]; ?>" class="img-fluid rounded-start" style="height: 200px;" />
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="card-body ">
                                                           
                                                                <h5 class="card-title fs-2 fw-bold text-primary"><?php echo $product_data["title"]?></h5>

                                                                <?php
                                                                    $color_rs = Database::search("SELECT * FROM `color` WHERE 
                                                                    `color_id`='".$product_data["color_color_id"]."'");

                                                                        $color_data = $color_rs->fetch_assoc();

                                                                    $condition_rs = Database::search("SELECT * FROM `condition` WHERE 
                                                                    `condition_id`='".$product_data["condition_condition_id"]."'");
   
                                                                        $condition_data = $condition_rs->fetch_assoc();

                                                        
                                                                ?>
                                                                
                                                                <span class="fs-5 fw-bold text-light">Colour : <?php echo $color_data["color_name"]; ?></span>
                                                                &nbsp;&nbsp; | &nbsp;&nbsp;
                                                                
                                                                <span class="fs-5 fw-bold text-light">Condition : <?php echo $condition_data["condition_name"]; ?></span>
                                                                <br />
                                                                <span class="fs-5 fw-bold text-light">Price :</span>&nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-light">Rs. <?php echo $product_data["price"]?> .00</span>
                                                                <br />
                                                                <span class="fs-5 fw-bold text-light">Quantity :</span>&nbsp;&nbsp;
                                                                <span class="fs-5 fw-bold text-light"><?php echo $product_data["qty"]?> Items available</span>
                                                                <br />
                                                                <span class="fs-5 fw-bold text-light">Seller :</span>
                                                                <br />
                                                                <?php
                                                                 $seller_rs = Database::search("SELECT * FROM `users` WHERE 
                                                                 `email`='" . $product_data["users_email"] . "'");
                                                                 $seller_data = $seller_rs->fetch_assoc();
                                                                 $seller  = $seller_data["fname"] . " " . $seller_data["Lname"];
                                                                
                                                                ?>
                                                                <span class="fs-5 fw-bold text-light"><?php echo $seller ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mt-5">
                                                            <div class="card-body d-lg-grid">
                                                            <a href="<?php echo "singleProductView.php?id=". ($product_data["id"]); ?>" class="btn btn-success mb-2">Buy Now</a>
                                                                <a href="#"  class="btn btn-warning mb-2">Add to Cart</a>
                                                                <a href="#" onclick="removedFromWatchlist(<?php echo $watchlist_data['id']; ?>);" 
                                                                class="btn btn-danger" >Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        </div>
                                    </div>

                                
                                        <!-- have products -->
                                    
                                    <?php
                                    }

                                }
                                
                                ?>
                                    
                                  






            <?php include "footer.php"; ?>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>
    
    <?php
}

?>