<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Products | Admins | RED STore</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resourses/Rs-logo.svg.png" />

</head>
<body class="adminBody">


<div class="container-fluid">
        <div class="row">

            <div class="col-12  text-center" style="background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);">
                <label class="form-label  fw-bold fs-1">Manage All Products</label>
            </div>


            <div class="row">
    <div class="offset-lg-1 col-12 col-lg-10 align-content-center text-center">
        <div class="row">


        <div class="col-12 mt-3">
                <div class="row">
                    <div class="offset-0 offset-lg-3 col-12 col-lg-6 mb-3">
                        <div class="row">
                            <div class="col-6">
                                <input type="text" class="form-control" />
                            </div>
                            <div class="col-3 d-grid">
                                <button class="btn btn-warning">Search User</button>
                            </div>

                            <div class="col-3 d-grid">
                            <a href="adminReportProduct.php"> <button class="btn btn-outline-warning">Products Reports</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12">
                                    <hr />
                                </div>


        <?php

            require "connection.php";
            $query = "SELECT * FROM `product`";
            $pageno;

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }

            $product_rs = Database::search($query);
            $product_num = $product_rs->num_rows;

            $results_per_page = 20;
            $number_of_pages = ceil($product_num / $results_per_page);

            $page_results = ($pageno - 1) * $results_per_page;
            $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

            $selected_num = $selected_rs->num_rows;

            for ($x = 0; $x < $selected_num; $x++) {
                $selected_data = $selected_rs->fetch_assoc();


?>


                <!-- card -->
       
                <div class="card col-12 col-lg-2 mt-2 mb-2" style="width: 18rem;  background-color:antiquewhite" >
                
                
                <?php
                            $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                            $image_num = $image_rs->num_rows;
                            if ($image_num == 0) {
                            ?>
                            <img src="resourses/mobile_images/iphone12.jpg" class="card-img-top img-thumbnail mt-2" style="height: 180px;" onclick="viewProductModal('<?php echo $selected_data['id']; ?>');" />
                            <?php
                            } else {
                                $image_data = $image_rs->fetch_assoc();
                            ?>

                            <img src="<?php echo $image_data["img_path"]; ?>" class="card-img-top img-thumbnail mt-2" style="height: 180px;" onclick="viewProductModal('<?php echo $selected_data['id']; ?>');" />
                            <?php
                            }

                            ?>
                            <div class="card-body ms-0 m-0 text-center">
                                <h5 class="card-title fw-bold fs-6"><?php echo $selected_data["title"]; ?></h5>
                                
                                <span class="card-text text-primary">Rs. <?php echo $selected_data["price"]; ?> .00</span><br />
                                <span class="card-text text-warning fw-bold"><?php echo $selected_data["qty"]; ?></span><br />
                                <span class="card-text text-success fw-bold"><?php echo $selected_data["datetime_added"]; ?></span><br />                               
                                
                                <?php

                                    if ($selected_data["status_id"] == 1) {
                                    ?>
                                        <button id="pb<?php echo $selected_data['id']; ?>" class="btn btn-danger" onclick="blockProduct('<?php echo $selected_data['id']; ?>');">Block</button>
                                    <?php
                                    } else {
                                    ?>
                                        <button id="pb<?php echo $selected_data['id']; ?>" class="btn btn-success" onclick="blockProduct('<?php echo $selected_data['id']; ?>');">Unblock</button>
                                    <?php

                                    }

                                    ?>

                       

                            </div>
                        </div>

                <!-- card -->


                <!-- modal 01 -->

              <?php
                
                $seller_rs = Database::search("SELECT * FROM `users` WHERE `email`='".$selected_data["users_email"]."'");
                $seller_data = $seller_rs->fetch_assoc();
                
                 ?>
                 <div class="modal" tabindex="-1" id="viewProductModal<?php echo $selected_data["id"]; ?>">
                     <div class="modal-dialog">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title fw-bold text-success"><?php echo $selected_data["title"]; ?></h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                             </div>
                             <div class="modal-body">
                                 <div class="offset-4 col-4">
                                     <img src="<?php echo $image_data["img_path"]; ?>" class="img-fluid" style="height: 150px;" />
                                 </div>
                                 <div class="col-12">
                                     <span class="fs-5 fw-bold">Price :</span>&nbsp;
                                     <span class="fs-5">Rs. <?php echo $selected_data["price"]; ?> .00</span><br />
                                     <span class="fs-5 fw-bold">Quantity :</span>&nbsp;
                                     <span class="fs-5"><?php echo $selected_data["qty"]; ?> Products left</span><br />
                                     <span class="fs-5 fw-bold">Seller :</span>&nbsp;
                                     <span class="fs-5"><?php echo $seller_data["fname"]." ".$seller_data["Lname"]; ?></span><br />
                                     <span class="fs-5 fw-bold">Description :</span>&nbsp;
                                     <span class="fs-5"><?php echo $selected_data["description"]; ?>.</span><br />
                                 </div>
                             </div>
                             <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!-- modal 01 -->


            <?php

            }

            ?>

              




</div>
    </div>

    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item">
                <a class="page-link" 
                                            <?php if ($pageno <= 1) {
                                                echo ("#");
                                            } else {
                                                ?>
                                                onclick="basicSearch(<?php echo ($pageno - 1)?>);"
                                                <?php
                                            } ?>
                                             aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <?php

            for ($y = 1; $y <= $number_of_pages; $y++) {
                if ($y == $pageno) {
            ?>
                    <li class="page-item active">
                        <a class="page-link" onclick="basicSearch(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="page-item">
                        <a class="page-link" onclick="basicSearch(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                    </li>
            <?php
                }
            }

            ?>





            <li class="page-item">
                <a class="page-link" 
                                            <?php if ($pageno >= $number_of_pages) {
                                                echo ("#");
                                            } else {
                                                ?>
                                                onclick="basicSearch(<?php echo ($pageno + 1)?>);"
                                                <?php
                                            } ?>
                                            aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
</div>


<!--  -->

<hr />

<div class="col-12 text-center">
    <h3 class="text-black-100 fw-bold text-light">Manage Categories</h3>
</div>

<div class="col-12 mb-3">
    <div class="row gap-1 justify-content-center">

        <?php
        $category_rs = Database::search("SELECT * FROM `category`");
        $category_num = $category_rs->num_rows;
        for ($x = 0; $x < $category_num; $x++) {
            $category_data = $category_rs->fetch_assoc();
        ?>
            <div class="col-12 col-lg-3 border border-danger rounded" style="height: 50px;">
                <div class="row">
                    <div class="col-8 mt-2 mb-2">
                        <label class="form-label fw-bold fs-5 text-light"><?php echo $category_data["cat_name"]; ?></label>
                    </div>
                    <div class="col-4 border-start border-secondary text-center mt-2 mb-2">
                        <label class="form-label fs-4 text-light"><i class="bi bi-trash3-fill text-danger"></i></label>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

        <div class="col-12 col-lg-3 border border-success rounded" style="height: 50px;" onclick="addNewCategory();">
            <div class="row">
                <div class="col-8 mt-2 mb-2">
                    <label class="form-label fw-bold fs-5 text-light">Add new Category</label>
                </div>
                <div class="col-4 border-start border-secondary text-center mt-2 mb-2">
                    <label class="form-label fs-4"><i class="bi bi-plus-square-fill text-success"></i></label>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- modal 2 -->
<div class="modal" tabindex="-1" id="addCategoryModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <label class="form-label">New Category Name : </label>
                    <input type="text" class="form-control" id="n"/>
                </div>
                <div class="col-12 mt-2">
                    <label class="form-label">Enter Your Email : </label>
                    <input type="text" class="form-control" id="e"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="verifyCategory();">Save New Category</button>
            </div>
        </div>
    </div>
</div>
<!-- modal 2 -->
<!-- modal 3 -->
<div class="modal" tabindex="-1" id="addCategoryVerificationModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Verification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12 mt-3 mb-3">
                    <label class="form-label">Enter Your Verification Code : </label>
                    <input type="text" class="form-control" id="txt"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveCategory();">Verify & Save</button>
            </div>
        </div>
    </div>
</div>
<!-- modal 3 -->



<script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>