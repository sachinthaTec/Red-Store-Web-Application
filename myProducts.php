<?php

session_start();

require "connection.php";

if(isset($_SESSION["u"])){

    $email = $_SESSION["u"]["email"];

    $pageno;


?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Products | RED STore</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resourses/Rs-logo.svg.png" />

</head>




<body class="bg-dark-subtle">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-body mb-2">
                <?php include "header.php"; ?>
            </div>

            <div class="col-12 bg-body mb-2" style="background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);">
                <div class="row">
                    
                
                <div class="offset-lg-4 col-12 col-lg-4">
                        <div class="row">
                           
                            <div class="col-12 text-center">
                                <P class="fs-1 text-black-100 fw-bold mt-3 pt-2">My Product</P>
                            </div>
                           
                        </div>
                        
                    </div>
                </div>
            </div>


           

                            
                   

            <div class=" offset-lg-1 col-12 col-lg-10 mb-3  rounded" style="background-color: #eee;">
                <div class="row">

                            <div class="col-12 text-center">
                                <P class="fs-3 text-black-100 fw-bold mt-2 pt-2">Sort Products</P>
                            </div>

                </div>
            </div>


            <div class=" offset-lg-1 col-12 col-lg-10 mb-3  rounded" style="background-color: #eee;">
                <div class="row">

                                    <div class="col-12 mb-1 mt-2">
                                        <div class="row">
                                            <div class="col-10">
                                                <input type="text" placeholder="Search..." class="form-control" id="s" />
                                            </div>
                                            <div class="col-1 p-1">
                                                <label class="form-label"><i class="bi bi-search fs-5"></i></label>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                <div class="col-12 col-lg-4 border-end border-success">
                    <div class="row">

                                    <div class="col-12 mt-3">
                                    
                                        <label class="form-label fw-bold">Active Time</label>
                                    </div>
                                    <div class="col-12">
                                        <hr style="width: 80%;" />
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="r1" id="n">
                                            <label class="form-check-label" for="n">
                                                Newest to oldest
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="r1" id="o">
                                            <label class="form-check-label" for="o">
                                                Oldest to newest
                                            </label>
                                        </div>
                                    </div>
                    </div>
                </div>




                <div class="col-12 col-lg-4 border-end border-success">
                    <div class="row">

                                <div class="col-12 mt-3">
                                        <label class="form-label fw-bold">By quantity</label>
                                    </div>
                                    <div class="col-12">
                                        <hr style="width: 80%;" />
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="r2" id="h">
                                            <label class="form-check-label" for="h">
                                                High to low
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="r2" id="l">
                                            <label class="form-check-label" for="l">
                                                Low to high
                                            </label>
                                        </div>
                                    </div>
                    </div>
                </div>



                <div class="col-12 col-lg-4">
                    <div class="row">

                                <div class="col-12 mt-3">
                                        <label class="form-label fw-bold">By condition</label>
                                    </div>
                                    <div class="col-12">
                                        <hr style="width: 80%;" />
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="r3" id="b">
                                            <label class="form-check-label" for="b">
                                                Brandnew
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="r3" id="u">
                                            <label class="form-check-label" for="u">
                                                Used
                                            </label>
                                        </div>
                                    </div>
                    </div>
                </div>

                                <div class="col-12">
                                    <hr class="border-black border-3" />
                                </div>

                <div class="offset-lg-2 col-12 col-lg-8 bg-body rounded mb-3">
                    <div class="row">
                                    <div class="col-12 text-center mt-3 mb-3">
                                        <div class="row g-2">
                                            <div class="col-12 col-lg-6 d-grid">
                                                <button class="btn btn-success fw-bold" onclick="sort(0);">Sort</button>
                                            </div>
                                            <div class="col-12 col-lg-6 d-grid">
                                                <button class="btn btn-primary fw-bold" onclick="clearSort();">Clear</button>
                                            </div>
                                        </div>
                                    </div>

                    </div>
                </div>


                </div>
            </div>


            <div class=" col-12 col-lg-12 bg-body rounded mb-3">
                <div class="row">



                    <div class="col-12 col-lg-12 mt-3 mb-3 bg-white">
                        <div class="row" id="sort">

                            <div class="offset-1 col-10 text-center">
                                <div class="row justify-content-center">

                                <?php
                                
                                if(isset($_GET["page"])){
                                    $pageno = $_GET["page"];
                                }else{
                                    $pageno = 1;
                                }
                                
                                $product_rs = Database::search("SELECT * FROM `product` WHERE `users_email`='".$email."'");
                                $product_num = $product_rs->num_rows;

                                $results_per_page = 4;
                                $number_of_pages = ceil($product_num / $results_per_page);

                                $page_results = ($pageno - 1) * $results_per_page;

                                $selected_rs = Database::search("SELECT * FROM `product` WHERE `users_email`='".$email."'
                                                LIMIT ".$results_per_page." OFFSET ".$page_results." ");

                                $selected_num = $selected_rs->num_rows;

                                for($x = 0;$x < $selected_num; $x++){
                                    $selected_data = $selected_rs->fetch_assoc();

                                    ?>


                                    <!-- card -->
                                    <div class="card mb-3 mt-3 col-12 col-lg-6">
                                        <div class="row">
                                            <div class="col-md-4 mt-4">

                                            <?php
                                            
                                            $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE 
                                                                `product_id`='".$selected_data["id"]."'");
                                            $product_img_data = $product_img_rs->fetch_assoc();
                                            
                                            ?>

                                                <img src="<?php echo $product_img_data["img_path"]; ?>" class="img-fluid rounded-start" />
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title fw-bold"><?php echo $selected_data["title"]; ?></h5>
                                                    <span class="card-text fw-bold text-primary">Rs. <?php echo $selected_data["price"]; ?> .00</span><br />
                                                    <span class="card-text fw-bold text-success"><?php echo $selected_data["qty"]; ?> Items left</span>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" 
                                                        id="<?php echo $selected_data["id"]; ?>" 
                                                        onchange="changeStatus(<?php echo $selected_data['id']; ?>);"
                                                        <?php if($selected_data["status_id"] == 2){ ?> checked <?php } ?>/>
                                                        <label class="form-check-label fw-bold text-info" for="<?php echo $selected_data["id"]; ?>">
                                                        <?php if($selected_data["status_id"] == 2){ ?> 
                                                                Activate Your product 
                                                                <?php }else{
                                                                    ?>
                                                                    Deactivate Product
                                                                    <?php

                                                                } ?>
                                                           
                                                        </label>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="row g-1">
                                                                <div class="col-12 col-lg-6 d-grid">
                                                                    <button class="btn btn-success fw-bold" onclick="sendId(<?php echo $selected_data['id']; ?>);">Update</button>
                                                                </div>
                                                                <div class="col-12 col-lg-6 d-grid">
                                                                    <button class="btn btn-danger fw-bold">Delete</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- card -->

                                    
                                    <?php

                                }

                                ?>
                                    

                                </div>
                            </div>

                            <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination pagination-lg justify-content-center">
                                        <li class="page-item">
                                            <a class="page-link" href="
                                            <?php if($pageno <= 1){
                                                echo ("#");
                                            }else{
                                                echo "?page=". ($pageno - 1);
                                            } ?>
                                            " aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>

                                        <?php
                                        
                                        for($y = 1; $y <= $number_of_pages; $y++){
                                            if($y == $pageno){
                                                ?>
                                                    <li class="page-item active">
                                                        <a class="page-link" href="<?php echo "?page=". ($y); ?>"><?php echo $y; ?></a>
                                                    </li>
                                                <?php
                                            }else{
                                                ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="<?php echo "?page=". ($y); ?>"><?php echo $y; ?></a>
                                                    </li>
                                                <?php
                                            }
                                        }
                                        
                                        ?>

                                       

                                       

                                        <li class="page-item">
                                            <a class="page-link" href="
                                            <?php if($pageno >= $number_of_pages){
                                                echo ("#");
                                            }else{
                                                echo "?page=". ($pageno + 1);
                                            } ?>
                                            " aria-label="Next">
                                                <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>

                        </div>
                    </div>
                    <!-- product -->

                </div>
            </div>




            <?php

                }

            ?>
            
            <?php include "footer.php"; ?>

        </div>
    </div>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>

