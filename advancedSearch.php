<?php

session_start();
require "connection.php";

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Advanced Search | RED STore</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resourses/Rs-logo.svg.png" />

</head>


<body>

<div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-body mb-2">
                <?php include "header.php"; ?>
            </div>


             <!-- header -->
             <div class="col-12" style="background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);">
                <div class="row">
                    <div class="col-12 col-lg-10 mt-2 my-lg-4">
                                <h1 class="offset-lg-2 text-white fw-bold text-center">Advanced Search</h1>
                            </div>
                           
                        </div>
                    </div>

                </div>
            </div>
            <!-- header -->



            <div class="col-12">
                <div class="row">
                    <!-- filter -->
                    <div class="col-11 col-lg-3 mx-3 my-3 border border-primary rounded">
                        <div class="row">
                            <div class="col-12 mt-3 fs-5">
                                <div class="row">

                                <div class="col-12">
                                        <label class="form-label fw-bold">Search By Key Word</label>
                                    </div>
                                    <div class="col-11">
                                        <div class="row">
                                        <div class="col-12 col-lg-12 mt-2 mb-1">
                                            <input type="text" class="form-control" placeholder="Type keyword to search..." id="t"/>
                                        </div>
                                           
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr style="width: 80%;" />
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-bold">Search By Category</label>
                                    </div>
                                   
                                   
                                    <div class="col-12 col-lg-10 mb-3">
                                        <select class="form-select" id="c1">
                                            <option value="0">Select Category</option>
                                            <?php
                                            
                                            $category_rs = Database::search("SELECT * FROM `category`");
                                            $category_num = $category_rs->num_rows;

                                            for($x =0;$x < $category_num;$x++){
                                                $category_data = $category_rs->fetch_assoc();
                                                ?>
                                                <option value="<?php  echo $category_data["cat_id"] ?>"><?php  echo $category_data["cat_name"] ?></option>
                                                <?php
                                            }
                                            
                                            ?>
                                            
                                        </select>
                                    </div>



                                    <div class="col-12">
                                        <hr style="width: 80%;" />
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-bold">Search By Brand</label>
                                    </div>
                                   
                                   
                                    <div class="col-12 col-lg-10 mb-3">
                                        <select class="form-select" id="b1">
                                            <option value="0">Select Brand</option>

                                            <?php
                                            
                                            $brand_rs = Database::search("SELECT * FROM `brand`");
                                            $brand_num = $brand_rs->num_rows;

                                            for($x =0;$x < $brand_num;$x++){
                                                $brand_data = $brand_rs->fetch_assoc();
                                                ?>
                                                <option value="<?php  echo $brand_data["brand_id"] ?>"><?php  echo $brand_data["brand_name"] ?></option>
                                                <?php
                                            }
                                            
                                            ?>
                                            
                                        </select>
                                    </div>




                                    <div class="col-12">
                                        <hr style="width: 80%;" />
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-bold">Search By Model</label>
                                    </div>
                                   
                                   
                                    <div class="col-12 col-lg-10 mb-3">
                                        <select class="form-select" id="m">
                                            <option value="0">Select Model</option>

                                            <?php
                                            
                                            $model_rs = Database::search("SELECT * FROM `model`");
                                            $model_num = $model_rs->num_rows;

                                            for($x =0;$x < $model_num;$x++){
                                                $model_data = $model_rs->fetch_assoc();
                                                ?>
                                                <option value="<?php  echo $model_data["model_id"] ?>"><?php  echo $model_data["model_name"] ?></option>
                                                <?php
                                            }
                                            
                                            ?>
                                            
                                        </select>
                                    </div>



                                    <div class="col-12">
                                        <hr style="width: 80%;" />
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-bold">Search By Condition</label>
                                    </div>
                                   
                                   
                                    <div class="col-12 col-lg-10 mb-3">
                                        <select class="form-select" id="c2">
                                            <option value="0">Select Condition</option>

                                            <?php
                                            
                                            $condition_rs = Database::search("SELECT * FROM `condition`");
                                            $condition_num = $condition_rs->num_rows;

                                            for($x =0;$x < $condition_num;$x++){
                                                $condition_data = $condition_rs->fetch_assoc();
                                                ?>
                                                <option value="<?php  echo $condition_data["condition_id"] ?>"><?php  echo $condition_data["condition_name"] ?></option>
                                                <?php
                                            }
                                            
                                            ?>
                                           
                                        </select>
                                    </div>



                                    <div class="col-12">
                                        <hr style="width: 80%;" />
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-bold">Search By Color</label>
                                    </div>
                                   
                                   
                                    <div class="col-12 col-lg-10 mb-3">
                                        <select class="form-select" id="c3">
                                            <option value="0">Select Colour</option>

                                            <?php
                                            
                                            $color_rs = Database::search("SELECT * FROM `color`");
                                            $color_num = $color_rs->num_rows;

                                            for($x =0;$x < $color_num;$x++){
                                                $color_data = $color_rs->fetch_assoc();
                                                ?>
                                                <option value="<?php  echo $color_data["color_id"] ?>"><?php  echo $color_data["color_name"] ?></option>
                                                <?php
                                            }
                                            
                                            ?>
                                            
                                        </select>
                                    </div>


                                    <div class="col-12">
                                        <hr style="width: 80%;" />
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-bold">Search By Price Range</label>
                                    </div>
                                   
                                   
                                    <div class="col-12 col-lg-5 mb-3">
                                        <input type="text" class="form-control" placeholder="Price From..." id="pf"/>
                                    </div>

                                    <div class="col-12 col-lg-5 mb-3">
                                        <input type="text" class="form-control" placeholder="Price To..." id="pt"/>
                                    </div>






                                   

                                    <div class="col-12 text-center mt-3 mb-3">
                                        <div class="row g-2">
                                        <div class="col-12 col-lg-6 mt-2 mb-1 d-grid  ">
                                            <button class="btn btn-primary" onclick="advancedSearch(0);">Search</button>
                                        </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- filter -->

                    <div class="col-11 col-lg-8 mx-3 my-3 border border-primary rounded bg-info">
                        <div class="row">


                        <div class=" col-12 col-lg-12 bg-#eee rounded mb-2">
                            <div class="row">
                                <div class="offset-1 col-10 mt-2 mb-2">
                                    <select class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-dark" id="s">
                                        <option value="0">SORT BY</option>
                                        <option value="1">PRICE LOW TO HIGH</option>
                                        <option value="2">PRICE HIGH TO LOW</option>
                                        <option value="3">QUANTITY LOW TO HIGH</option>
                                        <option value="4">QUANTITY HIGH TO LOW</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                     




                    <div class=" col-12 col-lg-12 bg-body rounded mb-8">
                        <div class="row">
                            <div class=" col-12 col-lg-12 text-center">
                                <div class="row" id="view_area">
                                    <div class="offset-5 col-2 mt-5">
                                        <span class="fw-bold text-black-50"><i class="bi bi-search h1" style="font-size: 100px;"></i></span>
                                    </div>
                                    <div class="offset-3 col-6 mt-3 mb-5">
                                        <span class="h1 text-black-50 fw-bold">No Items Searched Yet...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


                    
                
           





            
            <?php include "footer.php"; ?>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>