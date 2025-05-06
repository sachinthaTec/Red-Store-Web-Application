<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Product | RED STore</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resourses/Rs-logo.svg.png" />

</head>

<body>

    <div class="container-fluid">
        <div class="row gy-3">

            <?php

            session_start();

            include "header.php";

            if (isset($_SESSION["u"])) {

            ?>




                <div class="col-12 bg-primary" style="background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);">
                    <div class="row">

                    

                        <div class="col-12 bg-body mt-4 mb-4" >
                            <div class="row g-2">

                            <div class="col-12 text-center" style="background-color: #eee;">
                            <h1 class="h2 text-Black fw-bold">Add New Product</h1>
                            </div>

                            <hr class="border-black border-3">

                                <div class="col-md-5 border-end  border-4" style="background-color: #eee;">
                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                                       

                                    <div class="row">
                                        
                                    <div class="col-12">
                                        <label class="form-label fw-bold" style="font-size: 20px;">Add Product Images</label>
                                    </div>
                                                <div class="col-4 border border-primary rounded">
                                                    <img src="resourses/emp.jpg" class="img-fluid" style="width: 250px;" id="i0"/>
                                                </div>
                                                <div class="col-4 border border-primary rounded">
                                                    <img src="resourses/emp.jpg" class="img-fluid" style="width: 250px;" id="i1"/>
                                                </div>
                                                <div class="col-4 border border-primary rounded">
                                                    <img src="resourses/emp.jpg" class="img-fluid" style="width: 250px;" id="i2"/>
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-6 d-grid mt-3">
                                            <input type="file" class="d-none" id="imageuploader" multiple />
                                            <label for="imageuploader" class="col-12 btn btn-primary" onclick="changeProductImage();">Upload Images</label>
                                        </div>

                                    </div>


                                    <div class="col-12">
                                            <hr class=" border-black border-3" />
                                        </div>

                                        <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">Product Description</label>
                                        </div>
                                        <div class="col-12">
                                            <textarea cols="30" rows="15" class="form-control" id="desc"></textarea>
                                        </div>
                                    </div>
                                </div>


                               



                                </div>

                                <div class="col-md-7 " style="background-color: #eee;">
                                    <div class="p-3 py-5">

                                        

                                        <div class="row mt-4">

                                        <div class="col-12 col-lg-6 border-end border-success">
                                    <div class="row">

                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">Select Product Category</label>
                                        </div>

                                        <div class="col-12">
                                            <select class="form-select text-center" id="category" onchange="loadBrands();">
                                                <option value="0">Select Category</option>
                                                <?php

                                                require "connection.php";

                                                $category_rs = Database::search("SELECT * FROM `category`");
                                                $category_num = $category_rs->num_rows;

                                                for ($x = 0; $x < $category_num; $x++) {
                                                    $category_data = $category_rs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $category_data["cat_id"]; ?>"><?php echo $category_data["cat_name"]; ?></option>

                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                        </div>



                                        <div class="col-12 col-lg-6 ">
                                    <div class="row">

                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">Select Product Brand</label>
                                        </div>

                                        <div class="col-12">
                                            <select class="form-select text-center" id="brand">
                                                <option value="0">Select Brand</option>
                                                <?php

                                                $brand_rs = Database::search("SELECT * FROM `brand`");
                                                $brand_num = $brand_rs->num_rows;

                                                for ($x = 0; $x < $brand_num; $x++) {
                                                    $brand_data = $brand_rs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $brand_data["brand_id"]; ?>"><?php echo $brand_data["brand_name"]; ?></option>

                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>



                                <div class="col-12">
                                    <hr class="border-black border-3" />
                                </div>



                                <div class="col-12 col-lg-6 border-end border-success">
                                    <div class="row">

                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">Select Product Model</label>
                                        </div>

                                        <div class="col-12">
                                            <select class="form-select text-center" id="model">
                                                <option value="0">Select Model</option>
                                                <?php

                                                $model_rs = Database::search("SELECT * FROM `model`");
                                                $model_num = $model_rs->num_rows;

                                                for ($x = 0; $x < $model_num; $x++) {
                                                    $model_data = $model_rs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo $model_data["model_id"]; ?>"><?php echo $model_data["model_name"]; ?></option>

                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold" style="font-size: 20px;">Select Product Condition</label>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check form-check-inline mx-5">
                                                        <input class="form-check-input" type="radio" id="b" name="c" checked />
                                                        <label class="form-check-label fw-bold" for="b">Brandnew</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" id="u" name="c" />
                                                        <label class="form-check-label fw-bold" for="u">Used</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <hr class="border-black border-3" />
                                        </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">
                                                Add a Title to your Product
                                            </label>
                                        </div>
                                        <div class="offset-0 offset-lg-0 col-12 col-lg-12">
                                            <input type="text" class="form-control" id="title"/>
                                        </div>
                                    </div>
                                </div>


                                        <div class="col-12">
                                            <hr class="border-black border-3" />
                                        </div>



                                        <div class="col-12 col-lg-6 border-end border-success">
                                            <div class="row">

                                                <div class="col-12">
                                                    <label class="form-label fw-bold" style="font-size: 20px;">Select Product Colour</label>
                                                </div>

                                                <div class="col-12">

                                                    <select class="col-12 form-select" id="clr">
                                                        <option value="0">Select Colour</option>
                                                        <?php

                                                        $clr_rs = Database::search("SELECT * FROM `color`");
                                                        $clr_num = $clr_rs->num_rows;

                                                        for ($x = 0; $x < $clr_num; $x++) {
                                                            $clr_data = $clr_rs->fetch_assoc();
                                                        ?>

                                                            <option value="<?php echo $clr_data["color_id"]; ?>"><?php echo $clr_data["color_name"]; ?></option>

                                                        <?php
                                                        }

                                                        ?>
                                                    </select>

                                                </div>

                                                <div class="col-12">
                                                    <div class="input-group mt-2 mb-2">
                                                        <input type="text" class="form-control" placeholder="Add new Colour" id="clr_in"/>
                                                        <button class="btn btn-outline-primary" type="button" id="button-addon2">+ Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-6">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold" style="font-size: 20px;">Add Product Quantity</label>
                                                </div>
                                                <div class="col-12">
                                                    <input type="number" class="form-control" value="0" min="0" id="qty"/>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <hr class="border-black border-3" />
                                        </div>



                                        <div class="col-12 ">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold" style="font-size: 20px;">Cost Per Item</label>
                                                </div>
                                                <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                    <div class="input-group mb-2 mt-2">
                                                        <span class="input-group-text">Rs.</span>
                                                        <input type="text" class="form-control" id="cost"/>
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-12">
                                            <hr class="border-black border-3" />
                                        </div>


                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">Delivery Cost</label>
                                        </div>
                                        <div class="col-12 col-lg-6 border-end border-success">
                                            <div class="row">
                                                <div class="col-12 offset-lg-1 col-lg-3">
                                                    <label class="form-label">Delivery cost Within Colombo</label>
                                                </div>
                                                <div class="col-12 col-lg-8">
                                                    <div class="input-group mb-2 mt-2">
                                                        <span class="input-group-text">Rs.</span>
                                                        <input type="text" class="form-control" id="dwc"/>
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="row">
                                                <div class="col-12 offset-lg-1 col-lg-3">
                                                    <label class="form-label">Delivery cost out of Colombo</label>
                                                </div>
                                                <div class="col-12 col-lg-8">
                                                    <div class="input-group mb-2 mt-2">
                                                        <span class="input-group-text">Rs.</span>
                                                        <input type="text" class="form-control" id="doc"/>
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-12">
                                            <hr class="border-black border-3" />
                                        </div>



                                        <div class="col-12">
                                                    <label class="form-label fw-bold" style="font-size: 20px;">Approved Payment Methods</label>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="offset-0 offset-lg-2 col-2 pm pm1"></div>
                                                        <div class="col-2 pm pm2"></div>
                                                        <div class="col-2 pm pm3"></div>
                                                        <div class="col-2 pm pm4"></div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                            <hr class=" border-black border-3" />
                                        </div>


                                <div class="col-12">
                                    <label class="form-label fw-bold" style="font-size: 20px;">Notice...</label><br />
                                    <label class="form-label">
                                        We are taking 5% of the product from price from every
                                        product as a service charge.
                                    </label>
                                </div>



                                        </div>
                                    </div>
                                </div>
                                <hr class="border-black border-3">


                                <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                    <button class="btn btn-success" onclick="addProduct();">Save Product</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
     


                <?php
        
                    } else {
                        header("Location:home.php");
                    }

                ?>
        
    
    


             <?php include "footer.php"; ?>
        
             </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>