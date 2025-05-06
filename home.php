<?php

session_start();

require "connection.php";

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>HOME | RED STore</title>
      <link rel="icon" href="resourses/Rs-logo.svg.png">
      <link rel="stylesheet" href="bootstrap.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
      <link rel="stylesheet" href="style.css">


</head>

<body>

<div class="container-fluid">
        <div class="row">

            <?php include "header.php"; ?>

            <hr />

            
            <div class="col-12 justify-content-center bg-dark" >
                <div class="row mb-3">

                    <div class="offset-4 offset-lg-1 col-4 col-lg-1 logo" style="height: 60px;"></div>

                    <div class="col-12 col-lg-6">

                        <div class="input-group border-2 border-black mb-3 mt-3">
                            <input type="text" id="kw" class="form-control " aria-label="Text input with dropdown button" />

                            <select id="c" class="form-select" style="max-width: 250px;">
                                <option value="0">All Categories</option>

                                <?php

                                $category_rs = Database::search("SELECT * FROM `category`");
                                $category_num = $category_rs->num_rows;

                                for ($x = 0; $x < $category_num; $x++) {

                                    $category_data = $category_rs->fetch_assoc();

                                ?>

                                    <option value="<?php echo $category_data["cat_id"]; ?>">
                                        <?php echo $category_data["cat_name"]; ?>
                                    </option>

                                <?php

                                }

                                ?>

                            </select>

                        </div>

                    </div>

                    <div class="col-12 col-lg-2 d-grid">
                        <button class="btn btn-outline-info mt-3 mb-3" onclick="basicSearch(0);">Search</button>
                    </div>

                    <div class="col-12 col-lg-2 mt-2 mt-lg-4 text-center text-lg-start ">
                        <a href="advancedSearch.php" class="text-decoration-none link-secondary text-light fw-bold">Advanced</a>
                    </div>

                </div>
            </div>

            <hr />


            <div class="col-12 "  id="basicSearchResult">
                <div class="row">

                    <!-- Carousel -->

                    <div id="carouselExampleCaptions" class="offset-2 col-8 carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="1000">
                                <img src="resourses/slider images/ss11.jpg" class="d-block poster-img-1" />
                                <div class="carousel-caption d-none d-md-block poster-caption">
                                    <h5 class="poster-title">Welcome to RED STore</h5>
                                    <p class="poster-txt">The World's Best Online Store By One Click.</p>
                                </div>

                            </div>
                            <div class="carousel-item" data-bs-interval="1000">
                                <img src="resourses/slider images/posterimg2.png" class="d-block poster-img-1" />
                            </div>
                            <div class="carousel-item" data-bs-interval="1000">
                                <img src="resourses/slider images/ss12.jpg" class="d-block poster-img-1" />
                                <div class="carousel-caption d-none d-md-block poster-caption-1">
                                    <h5 class="poster-title">Be Free.....</h5>
                                    <p class="poster-txt">Experience the Lowest Delivery Costs With Us.</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
                    <!-- Carousel -->




                <div class="col-12" style="background-color: #eee;">
                    <div class="offset-2 col-10" >
                
                        <div class="row">
                        
                                    <div class="col-md-4">
                                        <div class="item">
                                            <div class="photo"><img src="resourses/SERVICE/service-5.png"></div>
                                            <h3>Easy Returns</h3>
                                            <p>
                                            Return any item before 15 days!  
                                            </p>
                                        </div>
                                    </div>

                                    

                                    <div class="col-md-4">
                                        <div class="item">
                                            <div class="photo"><img src="resourses/SERVICE/service-6.png"></div>
                                            <h3>Free Shipping</h3>
                                            <p>
                                            Enjoy free shipping inside US.  
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="item">
                                            <div class="photo"><img src="resourses/SERVICE/service-7.png"></div>
                                            <h3>Fast Shipping</h3>
                                            <p>
                                            Items are shipped within 24 hours.  
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="item">
                                            <div class="photo"><img src="resourses/SERVICE/service-8.png"></div>
                                            <h3>Satisfaction Guarantee</h3>
                                            <p>
                                            We guarantee you with our quality satisfaction.  
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="item">
                                            <div class="photo"><img src="resourses/SERVICE/service-9.png"></div>
                                            <h3>Secure Checkout</h3>
                                            <p>
                                            Providing Secure Checkout Options for all  
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="item">
                                            <div class="photo"><img src="resourses/SERVICE/service-10.png"></div>
                                            <h3>Money Back Guarantee</h3>
                                            <p>
                                            Offer money back guarantee on our products  
                                            </p>
                                        </div>
                                    </div>
                        </div>
                    </div>
                   
                </div>





                    <?php

                    $c_rs = Database::search("SELECT * FROM `category`");
                    $c_num = $c_rs->num_rows;

                    for ($y = 0; $y < $c_num; $y++) {

                        $c_data = $c_rs->fetch_assoc();

                    ?>

                        <!-- category names -->
                        <div class="col-12 text-center" style="background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);">
                            <a href="#" class="text-decoration-none fs-3 fw-bold" style="color:black;">
                                <?php echo $c_data["cat_name"]; ?>
                            </a>&nbsp;&nbsp;
                            <a href="#" class="text-decoration-none text-dark fs-6">See All &nbsp;&rarr;</a>
                        </div>
                        <!-- category names -->
                        <!-- products -->
                        <div class="col-12 mb-3"  >
                            <div class="row border border-warning">

                                <div class="col-12">
                                    <div class="row justify-content-center gap-4">

                                        <?php

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE 
                                    `category_id`='" . $c_data['cat_id'] . "' AND `status_id`='1' ORDER BY 
                                    `datetime_added` DESC LIMIT 5 OFFSET 0");

                                        $product_num = $product_rs->num_rows;

                                        for ($x = 0; $x < $product_num;$x++) {
                                            $product_data = $product_rs->fetch_assoc();

                                        ?>

                                            <div class="card cardtran col-12 col-lg-2 mt-2 mb-2" style="width: 18rem; box-shadow: 0px 0px 10px 0px #dd3675;   background-color:antiquewhite">

                                            <?php
                                            
                                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE 
                                            `product_id`='".$product_data['id']."'");

                                            $img_data = $img_rs->fetch_assoc();
                                            
                                            ?>

                                                <img src="<?php echo $img_data["img_path"]; ?>" class="card-img-top img-thumbnail mt-2" style="height: 180px;" />
                                                <div class="card-body ms-0 m-0 text-center">
                                                    <h5 class="card-title fw-bold fs-6"><?php echo $product_data["title"]; ?></h5>
                                                    <span class="badge rounded-pill text-bg-info">New</span><br />
                                                    <span class="card-text text-primary">Rs. <?php echo $product_data["price"]; ?> .00</span><br />
                                                    <span class="card-text text-warning fw-bold">In Stock</span><br />
                                                    <span class="card-text text-success fw-bold"><?php echo $product_data["qty"]; ?> Items Available</span><br />                               
                                                    <a href="<?php echo "singleProductView.php?id=". ($product_data["id"]); ?>" class="col-12 btn btn-success">Buy Now</a>
                                                    <button onclick="addToCart(<?php echo $product_data['id']; ?>);" class="col-6 btn btn-dark mt-2">
                                                        <i class="bi bi-cart4 text-white fs-5"></i>
                                                    </button>
                                                    <button onclick="addToWatchlist(<?php echo $product_data['id']; ?>);" class="col-6 btn btn-outline-light mt-2 border border-warning">
                                                        <i class="bi bi-heart-fill text-dark fs-5"></i>
                                                    </button>
                                            
                                                </div>
                                            </div>

                                        <?php

                                        }

                                        ?>



                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- products -->

                    <?php

                    }

                    ?>









                    <!-------Brands----->
            <div class="col-12 mb-3">
                <div class="row border border-warning">

                    <div class="col-12">
                        <div class="row justify-content-center gap-5 offset-1">
        
                            <div class="row">
                                <div class="col-12 col-lg-3 ">
                                    <img src="resourses/brand-1.jpg">
                                </div>
                                <div class="col-12 col-lg-3 ">
                                    <img src="resourses/brand-2.jpg">
                                </div>
                                <div class="col-12 col-lg-3">
                                    <img src="resourses/brand-3.jpg">
                                </div>
                                
                                <div class="col-12 col-lg-3 ">
                                    <img src="resourses/brand-5.jpg">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>

            <?php include "footer.php"; ?>
        </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
</body>

</html>