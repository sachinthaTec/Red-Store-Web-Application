<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $user = $_SESSION["u"]["email"];

    $total = 0;
    $subtotal = 0;
    $shipping = 0;

?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Cart | RED STore</title>

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
                                    <P class="fs-1 text-black- fw-bold mt-3 pt-2">Cart</P>
                                </div>
                            
                            </div>
                            
                    </div>
                </div>
            </div>


                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                                        </ol>
                                    </nav>

                               


                                <div class="col-12">
                                            <hr class=" border-black border-3" />
                                        </div>


                                        <?php

$cart_rs = Database::search("SELECT * FROM `cart` WHERE `users_email`='" . $user . "'");
$cart_num = $cart_rs->num_rows;

if ($cart_num == 0) {
?>
    <!-- Empty View -->
    <div class="col-12">
        <div class="row">
            <div class="col-12 emptyCart"></div>
            <div class="col-12 text-center mb-2">
                <label class="form-label fs-1 fw-bold">
                    You have no items in your Cart yet.
                </label>
            </div>
            <div class="offset-lg-4 col-12 col-lg-4 mb-4 d-grid">
                <a href="home.php" class="btn btn-outline-info fs-3 fw-bold">
                    Start Shopping
                </a>
            </div>
        </div>
    </div>
    <!-- Empty View -->
<?php

} else {
?>
    <!-- products -->

    <div class="col-12 col-lg-9 ">
        <div class="row">

            <?php
            for ($x = 0; $x < $cart_num; $x++) {
                $cart_data = $cart_rs->fetch_assoc();

                $product_rs = Database::search("SELECT * FROM `product` WHERE 
            `id`='" . $cart_data["product_id"] . "'");
                $product_data = $product_rs->fetch_assoc();

                $total = $total + ($product_data['price'] * $cart_data["qty"]);

                $address_rs = Database::search("SELECT district.district_id AS `did` FROM 
            `users_has_address` INNER JOIN `city` ON 
            users_has_address.city_city_id=city.city_id INNER JOIN `district` ON 
            city.district_district_id=district.district_id  WHERE `users_email`='" . $user . "'");

                $address_data = $address_rs->fetch_assoc();

                $ship = 0;

                if ($address_data["did"] == 23) {
                    $ship = $product_data["delivery_fee_Colombo"];
                    $shipping =  $product_data["delivery_fee_Colombo"];
                } else {
                    $ship = $product_data["delivery_fee_other"];
                    $shipping = $product_data["delivery_fee_other"];
                }

                $seller_rs = Database::search("SELECT * FROM `users` WHERE 
                                        `email`='" . $product_data["users_email"] . "'");
                $seller_data = $seller_rs->fetch_assoc();
                $seller  = $seller_data["fname"] . " " . $seller_data["Lname"];

            ?>

                                        <div class="card mb-3 mx-0 col-12 wtlist ">
                                            <div class="row g-0 wtlist"  >
                                                <div class="col-md-12 mt-3 mb-3" >
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="fw-bold text-light fs-5">Seller :</span>&nbsp;
                                                            <span class="fw-bold text-light fs-5"><?php echo $seller ?></span>&nbsp;
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>
                                                <!-- popup -->
                                                <div class="col-md-4">

                                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $product_data["description"]; ?>" title="Product Description">
                                                    <?php
                                                    $img_rs =  Database::search("SELECT * FROM `product_img` WHERE `product_id`='".$cart_data["product_id"]."'");
                                                    $img_data = $img_rs->fetch_assoc();
                                                    
                                                    ?>
                                                        <img src="<?php echo $img_data["img_path"];?>" class="img-fluid rounded-start" style="max-width: 200px;">
                                                    </span>

                                                </div>
                                                <!-- popup -->
                                                <div class="col-md-5">
                                                    <div class="card-body">

                                                        <h3 class="card-title text-light"><?php echo $product_data["title"];?></h3>
                                                        <?php
                                                         $color_rs = Database::search("SELECT * FROM `color` WHERE 
                                                         `color_id`='".$product_data["color_color_id"]."'");

                                                            $color_data = $color_rs->fetch_assoc();

                                                            $condition_rs = Database::search("SELECT * FROM `condition` WHERE 
                                                            `condition_id`='".$product_data["condition_condition_id"]."'");
   
                                                               $condition_data = $condition_rs->fetch_assoc();

                                                        
                                                        ?>

                                                        <span class="fw-bold text-light">Colour : <?php echo $color_data["color_name"]; ?></span> &nbsp; |

                                                        &nbsp; <span class="fw-bold text-light">Condition :  <?php echo $condition_data["condition_name"]; ?></span>
                                                        <br>
                                                        <span class="fw-bold text-light fs-5">Price :</span>&nbsp;
                                                        <span class="fw-bold text-light fs-5">Rs. <?php echo $product_data["price"]; ?> .00</span>
                                                        <br>
                                                        <span class="fw-bold text-light fs-5">Quantity :</span>&nbsp;
                                                        <input type="number" class="mt-3 border border-2 border-secondary fs-4 fw-bold px-3 cardqtytext" 
                                                        value="<?php echo $cart_data["qty"]?>" min="1" max="<?php echo $product_data["qty"]?>">
                                                        <br><br>
                                                        <!--
                                                        <span class="fw-bold text-black-50 fs-5">Delivery Fee :</span>&nbsp;
                                                        <span class="fw-bold text-black fs-5">Rs.<?php echo $ship?>.00</span>-->
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="card-body d-grid">
                                                    <a href="<?php echo "singleProductView.php?id=". ($product_data["id"]); ?>" class="btn btn-success mb-2">Buy Now</a>
                                                        <a class="btn btn-danger mb-2" onclick="removeFromCart(<?php echo $cart_data['cart_id']; ?>);">Remove</a>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-6 col-md-6">
                                                            <span class="fw-bold fs-5 text-light">Requested Total <i class="bi bi-info-circle"></i></span>
                                                        </div>
                                                        <div class="col-6 col-md-6 text-end">
                                                            <span class="fw-bold fs-5 text-light">Rs.<?php echo ($product_data["price"] * $cart_data["qty"]) ?>.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                    }

                                    ?>


                
                                        

                                </div>
                            </div>

                            <!-- products -->

                            <!-- summary -->
                            <div class="col-12 col-lg-3 "  style="background-color: #eee;">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label fs-3 fw-bold">Summary</label>
                                    </div>

                                    <div class="col-12">
                                        <hr />
                                    </div>

                                    <div class="col-6 mb-3">
                                        <span class="fs-6 fw-bold">items (<?php echo $cart_num; ?>)</span>
                                    </div>

                                    <div class="col-6 text-end mb-3">
                                        <span class="fs-6 fw-bold">Rs. <?php echo $total; ?> .00</span>
                                    </div>

                                    <div class="col-6">
                                        <span class="fs-6 fw-bold">Shipping</span>
                                    </div>

                                    <div class="col-6 text-end">
                                        <span class="fs-6 fw-bold">Rs. <?php echo $shipping; ?> .00</span>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <hr />
                                    </div>

                                    <div class="col-6 mt-2">
                                        <span class="fs-4 fw-bold">Total</span>
                                    </div>

                                    <div class="col-6 mt-2 text-end">
                                        <span class="fs-4 fw-bold">Rs. <?php echo $total + $shipping; ?> .00</span>
                                    </div>

                                    <div class="col-12 mt-3 mb-3 d-grid">
                                        <button class="btn btn-primary fs-5 fw-bold" >CHECKOUT</button>
                                    </div>

                                </div>
                            </div>
                            <!-- summary -->
                        <?php
                        }

                        ?>







                    </div>
                </div>




            <?php include "footer.php"; ?>

        </div>
    </div>


<script src="bootstrap.bundle.js"></script>
<script src="script.js"></script>

<script>
var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl)
})
</script>
</body>

</html>


<?php
}

?>