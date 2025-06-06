<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Purchasing History | RED STore</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resourses/Rs-logo.svg.png" />
</head>

<body>

    <div class="container-fluid">
        <div class="row">

        <?php

        session_start();

        require "header.php";

        require "connection.php";

            if (isset($_SESSION["u"])) {

                $mail = $_SESSION["u"]["email"];

                $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `users_email`='" . $mail . "'");
                $invoice_num = $invoice_rs->num_rows;
            ?>




            <div class="col-12 bg-body mb-2" style="background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);">
                <div class="row">
                    
                
                    <div class="offset-lg-4 col-12 col-lg-4">
                            <div class="row">
                            
                                <div class="col-12 text-center">
                                    <P class="fs-1 text-black- fw-bold mt-3 pt-2">Purchasing History</P>
                                </div>
                            
                            </div>
                            
                    </div>
                </div>
            </div>


                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Purchasing History</li>
                                        </ol>
                                    </nav>



                                    <?php
                if ($invoice_num == 0) {

                ?>
                    <div class="col-12 text-center bg-body" style="height: 450px;">
                        <span class="fs-1 fw-bold text-black-50 d-block" style="margin-top: 200px;">
                            You have not purchased any item yet...
                        </span>
                    </div>
                <?php

                } else {
                ?>
                    <div class="col-12">
                        <div class="row">

                            <div class="col-12 d-none d-lg-block ">
                                <div class="row ">
                                    <div class="col-1 bg-info-subtle">
                                        <label class="form-label fw-bold">Invoice No</label>
                                    </div>
                                    <div class="col-3 bg-info-subtle">
                                        <label class="form-label fw-bold">Order Details</label>
                                    </div>
                                    <div class="col-1 bg-info-subtle text-end">
                                        <label class="form-label fw-bold">Quantity</label>
                                    </div>
                                    <div class="col-2 bg-info-subtle text-end">
                                        <label class="form-label fw-bold">Amount</label>
                                    </div>
                                    <div class="col-2 bg-info-subtle text-end">
                                        <label class="form-label fw-bold">Purchased Date & Time</label>
                                    </div>
                                    <div class="col-2 bg-info-subtle"></div>
                                    <div class="col-12">
                                        <hr />
                                    </div>
                                </div>
                            </div>

                            <?php

                            for ($x = 0; $x < $invoice_num; $x++) {
                                $invoice_data = $invoice_rs->fetch_assoc();
                            ?>
                                <div class="col-12 cardtran ">
                                    <div class="row ">

                                        <div class="col-12 col-lg-1  text-center text-lg-start " style="background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);">
                                            <label class="form-label text-white fs-6 py-5"><?php echo $invoice_data["id"]; ?></label>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class="row bg-info-subtle">
                                                <div class="card mx-0 mx-lg-3 my-3" style="max-width: 540px; background-color: #fcbb6b;">
                                                    <div class="row g-0">
                                                        <div class="col-md-4">
                                                            <?php
                                                            $pid = $invoice_data["product_id"];
                                                            $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $pid . "' ");
                                                            $image_data = $image_rs->fetch_assoc();
                                                            ?>
                                                            <img src="<?php echo $image_data["img_path"]; ?>" class="img-fluid rounded-start" />
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card-body">
                                                                <?php
                                                                $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "' ");
                                                                $product_data = $product_rs->fetch_assoc();

                                                                $seller_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $product_data["users_email"] . "' ");
                                                                $seller_data = $seller_rs->fetch_assoc();
                                                                ?>
                                                                <h5 class="card-title"><?php echo $product_data["title"]; ?></h5>
                                                                <p class="card-text"><b>Seller : </b><?php echo $seller_data["fname"] . " " . $seller_data["fname"]; ?></p>
                                                                <p class="card-text"><b>Price : </b>Rs. <?php echo $product_data["price"]; ?> .00</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-1 text-center bg-info-subtle text-lg-end">
                                            <label class="form-label fs-4 py-5"><?php echo $invoice_data["qty"]; ?></label>
                                        </div>
                                        <div class="col-12 col-lg-2 text-centerbg-info-subtle text-lg-end" style="background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);">
                                            <label class="form-label fs-5 py-5 text-white">Rs. <?php echo $invoice_data["total"]; ?> .00</label>
                                        </div>
                                        <div class="col-12 col-lg-2 text-center bg-info-subtle text-lg-end">
                                            <label class="form-label fs-5 px-3 py-5"><?php echo $invoice_data["date"]; ?></label>
                                        </div>
                                        <div class="col-12 col-lg-2 bg-info-subtle">
                                            <div class="row ">
                                                <div class="col-12 d-grid ">
                                                    <button class="btn btn-outline-secondary rounded border border-1 border-primary mt-3 fs-5" onclick="addFeedback(<?php echo $invoice_data['product_id']; ?>);">
                                                        <i class="bi bi-info-circle-fill"></i> Feedback
                                                    </button>
                                                </div>
                                                <div class="col-12 d-grid ">
                                                    <?php
                                                    if ($invoice_data["status"] == 1){
                                                        ?>
                                                        <button class="btn btn-warning fw-bold mt-2 mb-1" >Packing</button>
                                                        <?php
                                                    } else if ($invoice_data["status"] == 2){
                                                        ?>
                                                        <button class="btn btn-info fw-bold mt-2 mb-1" >Dispatch</button>
                                                        <?php
                                                    } else if ($invoice_data["status"] == 3){
                                                        ?>
                                                        <button class="btn btn-primary fw-bold mt-2 mb-1" >Shipping</button>
                                                        <?php
                                                    }  else if ($invoice_data["status"] == 4){
                                                            ?>
                                                            <button class="btn btn-danger fw-bold mt-2 mb-1" >Delivered</button>
                                                            <?php
                                                    }
                                                    ?>
                                                </div>
                                                
                                               
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <?php
                            }

                            ?>

                            <div class="col-12">
                                <hr />
                            </div>

                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="offset-lg-10 col-12 col-lg-2 d-grid">
                                        <button class="btn btn-danger rounded mt-5 fs-5">
                                            <i class="bi bi-trash3-fill"></i> Delete All Records
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- model -->
                            <div class="modal" tabindex="-1" id="feedbackModal<?php echo $pid; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold">Add New Feedback</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label class="form-label fw-bold">Type</label>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="type" id="type1"/>
                                                                    <label class="form-check-label text-success fw-bold" for="type1">
                                                                        Positive
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="type" id="type2" checked/>
                                                                    <label class="form-check-label text-warning fw-bold" for="type2">
                                                                        Neutral
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="type" id="type3"/>
                                                                    <label class="form-check-label text-danger fw-bold" for="type3">
                                                                        Negative
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label class="form-label fw-bold">User's Email</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" class="form-control" id="mail" 
                                                                value="<?php echo $mail; ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-2">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label class="form-label fw-bold">Feedback</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <textarea class="form-control" cols="50" rows="8" id="feed"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-outline-primary" onclick="saveFeedback(<?php echo $pid; ?>);">Save Feedback</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- model -->

                        </div>
                    </div>




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