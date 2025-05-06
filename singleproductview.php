<?php

session_start();
require "connection.php";

if (isset($_GET["id"])) {
    $pid = $_GET["id"];

    

    $product_rs = Database::search("SELECT product.id,product.price,product.qty,product.description,product.title,
                product.datetime_added,product.delivery_fee_Colombo,product.delivery_fee_other,product.category_id,
                product.brand_has_model_id,product.color_color_id,product.status_id,product.condition_condition_id,
                product.users_email,model.model_name AS mname,brand.brand_name AS bname FROM `product` INNER JOIN
                `brand_has_model` ON brand_has_model.id=product.brand_has_model_id INNER JOIN `brand` ON
                brand.brand_id=brand_has_model.brand_brand_id INNER JOIN `model` ON 
                model.model_id=brand_has_model.model_model_id WHERE product.id='" . $pid . "'");

    $product_num = $product_rs->num_rows;
    if ($product_num == 1) {
        $product_data = $product_rs->fetch_assoc();

?>

        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title><?php echo $product_data["title"]; ?> | RED STore</title>

            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
            <link rel="stylesheet" href="style.css" />

            <link rel="icon" href="resourses/Rs-logo.svg.png" />
        </head>

        <body>

        <div class="container-fluid">
            <div class="row">
                <?php include "header.php"; ?>

                                                <div class="row border-bottom border-dark">
                                                    <nav aria-label="breadcrumb">
                                                        <ol class="breadcrumb">
                                                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                                            <li class="breadcrumb-item active" aria-current="page">Single Product View</li>
                                                        </ol>
                                                    </nav>
                                                </div>


                    <div class="col-12 mt-0 bg-white singleProduct " >
                        <div class="row" style="background-color: #eee;">
                            <div class="col-12" style="padding: 10px; ">
                                <div class="row  ">


                                <div class="col-12 col-lg-2 order-2 order-lg-1 ">
                                        <ul>

                                            <?php
                                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $pid . "'");
                                            $img_num = $img_rs->num_rows;
                                            $img_list = array();

                                            if ($img_num != 0) {
                                                for ($x = 0; $x < $img_num; $x++) {
                                                    $img_data = $img_rs->fetch_assoc();
                                                    $img_list[$x] = $img_data["img_path"];

                                            ?>

                                                    <li class="d-flex flex-column justify-content-center align-items-center 
                                border border-1 border-secondary mb-1">
                                                        <img src="<?php echo $img_list[$x];  ?>" id="product_img<?php echo $x; ?>" onclick="changeMainImg(<?php echo $x; ?>);" class="img-thumbnail mt-1 mb-1" />
                                                </li>

                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <li class="d-flex flex-column justify-content-center align-items-center 
                                border border-1 border-secondary mb-1">
                                                    <img src="resourses/emp.jpg" class="img-thumbnail mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center 
                                border border-1 border-secondary mb-1">
                                                    <img src="resourses/emp.jpg" class="img-thumbnail mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center 
                                border border-1 border-secondary mb-1">
                                                    <img src="resourses/emp.jpg" class="img-thumbnail mt-1 mb-1" />
                                            </li>
                                            <?php
                                            }

                                            ?>

                                        </ul>
                                    </div>


                                <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block ">
                                        <div class="row">
                                            <div class="col-12 align-items-center border border-1 
                                border-secondary">
                                                <div class="mainImg" id="mainImg"></div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    

                                


                                    <div class="col-12 col-lg-6 order-3  ">
                                        <div class="row">
                                            <div class="col-12">

                                            <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-3 fw-bold text-info"><?php echo $product_data["title"]; ?></span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label fs-4 fw-bold">Brand: </label>
                                            </div>
                                            <div class="col-9">
                                                <label class="form-label fs-4"><?php echo $product_data["bname"]; ?></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label fs-4 fw-bold">Model: </label>
                                            </div>
                                            <div class="col-9">
                                                <label class="form-label fs-4"><?php echo $product_data["mname"]; ?></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fs-4 fw-bold">Description: </label>
                                            </div>
                                            <div class="col-12">
                                                <textarea cols="50" rows="5" class="form-control" readonly><?php echo $product_data["description"]; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                            <hr class=" border-black border-3" />
                                        </div>

                                        <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="badge">
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>

                                                            &nbsp;&nbsp;&nbsp;

                                                            <label class="fs-5 text-dark fw-bold">4.5 Stars | 39 Reviews and Ratings</label>
                                                        </span>
                                                    </div>
                                                </div>

                                   

                                                <?php

                                                    $price = $product_data["price"];
                                                    $add = ($price / 100) * 10;
                                                    $new_price = $price + $add;
                                                    $diff = $new_price - $price;
                                                    $percent = ($diff / $price) * 100;

                                                    ?>


                                                    <div class="row border-bottom border-dark">
                                                        <div class="col-12 my-2">
                                                            <span class="fs-4 text-dark fw-bold">Rs.<?php echo $price; ?> .00</span>
                                                            &nbsp;&nbsp; | &nbsp;&nbsp;
                                                            <span class="fs-4 text-danger fw-bold text-decoration-line-through">Rs. <?php echo $new_price; ?> .00</span>
                                                            &nbsp;&nbsp; | &nbsp;&nbsp;
                                                            <span class="fs-4 fw-bold text-black-50">Save Rs. <?php echo $diff; ?> .00 (<?php echo $percent; ?>%)</span>
                                                        </div>
                                                    </div>



                                                    <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="my-2 offset-lg-2 col-12 col-lg-8 border border-2 border-danger rounded">
                                                                <div class="row">
                                                                    <div class="col-3 col-lg-2 border-end border-2 border-danger">
                                                                        <img src="resourses/pricetag.png" />
                                                                    </div>
                                                                    <div class="col-9 col-lg-10">
                                                                        <span class="fs-5 text-danger fw-bold">
                                                                            Stand a chance to get 5% discount by using VISA or MASTER
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="offset-0 offset-lg-2 col-2 pm pm1"></div>
                                                        <div class="col-2 pm pm2"></div>
                                                        <div class="col-2 pm pm3"></div>
                                                        <div class="col-2 pm pm4"></div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-12 my-2">
                                                                <div class="row g-2">

                                                                    <div class="border border-1 border-secondary rounded overflow-hidden 
                                                        float-left mt-1 position-relative product-qty">
                                                                        <div class="col-12">
                                                                            <span>Quantity : </span>
                                                                            <input type="text" class="border-0 fs-5 fw-bold text-start" style="outline: none; background-color: #eee;" pattern="[0-9]" value="1" onkeyup='check_value(<?php echo $product_data["qty"]; ?>);' id="qty_input" />

                                                                            <div class="position-absolute qty-buttons">
                                                                                <div class="justify-content-center d-flex flex-column align-items-center 
                                                                border border-1 border-secondary qty-inc">
                                                                                    <i class="bi bi-caret-up-fill text-primary fs-5" onclick='qty_inc(<?php echo $product_data["qty"]; ?>);'></i>
                                                                                </div>
                                                                                <div class="justify-content-center d-flex flex-column align-items-center 
                                                                border border-1 border-secondary qty-dec">
                                                                                    <i class="bi bi-caret-down-fill text-primary fs-5" onclick='qty_dec();'></i>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-12 mt-5">
                                                                            <div class="row">
                                                                                <div class="col-4 d-grid">                                                                                   
                                                                                    <button class="btn btn-success" type="submit" id="payhere-payment" 
                                                                                    onclick="paynow(<?php echo $pid;?>);">Pay Now</button>
                                                                                </div>
                                                                                <div class="col-4 d-grid">
                                                                                    <button class="btn btn-primary">Add To Cart</button>
                                                                                </div>
                                                                                <div class="col-4 d-grid">
                                                                                    <button class="btn btn-secondary">
                                                                                        <i class="bi bi-heart-fill fs-4 text-danger"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                                                                <div class="col-12">
                                                                    <hr class=" border-black border-3" />
                                                                </div>

                                                                <div class="row ">
                                                                    <div class="col-6 my-2">
                                                                        <div class="row">
                                                                            <div class="col-6 col-lg-4 border border-1 border-dark text-center">
                                                                                <?php
                                                                                $user_rs = Database::search("SELECT * FROM `users` WHERE 
                                                                                `email`='" . $product_data["users_email"] . "'");
                                                                                $user_data = $user_rs->fetch_assoc();
                                                                                ?>
                                                                                <span class="fs-5 text-primary"><b>Seller : </b><?php echo $user_data["fname"]; ?></span>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                               

                                                                <div class="row ">
                                                                    <div class="col-12 my-2">
                                                                        <span class="fs-5 text-primary"><b>Warrenty : </b>6 Months Warrenty</span><br />
                                                                        <span class="fs-5 text-primary"><b>Return Policy : </b>1 Months Return Policy</span><br />
                                                                        <span class="fs-5 text-primary"><b>In Stock : </b><?php echo $product_data["qty"]; ?> Items Available</span>
                                                                    </div>
                                                                </div>

                                                

                    <div class="col-12 bg-info-subtle">
                                <div class="row d-block me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                                    <div class="col-12">
                                        <span class="fs-3 fw-bold">Related Items</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 bg-white">
                                <div class="row g-2">
                                    <div class="col-12">
                                        <div class="row justify-content-center g-2">

                                            <?php
                                            $related_rs = Database::search("SELECT * FROM `product` WHERE 
                                                `brand_has_model_id`='" . $product_data["brand_has_model_id"] . "' LIMIT 4");
                                            $related_num = $related_rs->num_rows;

                                            for ($x = 0; $x < $related_num; $x++) {
                                                $related_data = $related_rs->fetch_assoc();
                                            ?>
                                                <div class="offset-lg-0 col-4 col-lg-3">
                                                    <div class="card cardtran col-6 col-lg-2 mt-2 mb-2" style="width: 18rem; box-shadow: 0px 0px 10px 0px #dd3675;   background-color:antiquewhite">

                                                        <?php

                                                        $related_img = array();

                                                        $related_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $related_data["id"] . "'");
                                                        $related_img_data = $related_img_rs->fetch_assoc();

                                                        ?>
                                                        <img src="<?php echo $related_img_data["img_path"]; ?>" class="card-img-top img-thumbnail mt-2" style="height: 180px;" />
                                                        <div class="card-body ms-0 m-0 text-center">
                                                    <h5 class="card-title fw-bold fs-6"><?php echo $related_data["title"]; ?></h5>
                                                    <span class="badge rounded-pill text-bg-info">New</span><br />
                                                    <span class="card-text text-primary">Rs. <?php echo $related_data["price"]; ?> .00</span><br />
                                                    <span class="card-text text-warning fw-bold">In Stock</span><br />
                                                    <span class="card-text text-success fw-bold"><?php echo $related_data["qty"]; ?> Items Available</span><br />
                                                    <a href="<?php echo "singleProductView.php?id=". ($product_data["id"]); ?>" class="col-12 btn btn-success">Buy Now</a>
                                                    <button onclick="addToCart(<?php echo $product_data['id']; ?>);" class="col-6 btn btn-dark mt-2">
                                                        <i class="bi bi-cart4 text-white fs-5"></i>
                                                    </button>
                                                    <button onclick="addToWatchlist(<?php echo $product_data['id']; ?>);" class="col-6 btn btn-outline-light mt-2 border border-warning">
                                                        <i class="bi bi-heart-fill text-dark fs-5"></i>
                                                    </button>
                                                </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                        <div class="row d-block me-0 mt-4 mb-3 border-bottom border-end border-1 border-start border-dark border-top bg-info-subtle">
                                            <div class="col-12">
                                                <span class="fs-4 fw-bold">Feedbacks</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12 col-lg-12">
                                <div class="row border border-1 border-dark rounded overflow-scroll me-0" style="height: 300px;">

                                    <?php

                                    $feedback_rs = Database::search("SELECT * FROM `feedback` WHERE `product_id`='" . $pid . "'");
                                    $feedback_num = $feedback_rs->num_rows;

                                    for ($x = 0; $x < $feedback_num; $x++) {
                                        $feedback_data = $feedback_rs->fetch_assoc();
                                    ?>
                                        <div class="col-12 mt-1 mb-1 mx-1">
                                            <div class="row border border-1 border-dark rounded me-0">
                                                <?php
                                                
                                                $user_rs = Database::search("SELECT * FROM `users` WHERE `email`='".$feedback_data["users_email"]."'");
                                                $user_data = $user_rs->fetch_assoc();
                                                
                                                ?>
                                                <div class="col-10 mt-1 mb-1 ms-0 fs-5"><?php echo $user_data["fname"]." ".$user_data["Lname"];?></div>
                                                <div class="col-2 mt-1 mb-1 me-0">
                                                    <?php
                                                    if($feedback_data["type"] == 1){
                                                        ?>
                                                        <span class="badge fs-6 bg-success">Positive</span></div>
                                                        <?php
                                                    }else if($feedback_data["type"] == 2){
                                                        ?>
                                                        <span class="badge fs-6 bg-warning">Neutral</span></div>
                                                        <?php
                                                    }else if($feedback_data["type"] == 3){
                                                        ?>
                                                        <span class="badge fs-6 bg-danger">Negative</span></div>
                                                        <?php
                                                    }
                                                    ?>
                                                    
                                                <div class="col-12">
                                                    <b>
                                                        <?php echo $feedback_data["feedback"]; ?>
                                                    </b>
                                                </div>
                                                <div class="offset-6 col-6 text-end">
                                                    <label class="form-label fs-6 text-black-50"><?php echo $feedback_data["date"]; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }

                                    ?>


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
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

        </body>

        </html>


    <?php
    } else {
    ?>
        <script>
            alert("Something went wroung");
        </script>
<?php
    }
}

?>