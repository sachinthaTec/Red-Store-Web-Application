<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Profile | RED STore</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

                $email = $_SESSION["u"]["email"];

                $details_rs = Database::search("SELECT * FROM `users` INNER JOIN `gender` ON  
                                                users.gender_id=gender.id WHERE `email`='" . $email . "'");

                $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `users_email`='" . $email . "'");

                $address_rs = Database::search("SELECT * FROM `users_has_address` INNER JOIN `city` ON  
                                                users_has_address.city_city_id=city.city_id INNER JOIN 
                                                `district` ON city.district_district_id=district.district_id 
                                                INNER JOIN `province` ON 
                                                district.province_province_id=province.province_id 
                                                WHERE `users_email`='" . $email . "'");

                $details_data = $details_rs->fetch_assoc();
                $image_data = $image_rs->fetch_assoc();
                $address_data = $address_rs->fetch_assoc();

            ?>

                <div class="col-12" style="background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);">
                    <div class="row">

                        <div class="col-12 bg-body mt-4 mb-4">
                            <div class="row g-2">

                                <div class="col-12 ">
                                    <div class="d-flex flex-column align-items-center text-center p-1 py-1">

                                        <?php

                                        if (empty($image_data["path"])) {
                                        ?>
                                            <img src="resourses/profile_img.svg" class="rounded mt-5" style="width:220px;" />
                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?php echo $image_data["path"]; ?>" class="rounded mt-5" style="width:220px;" />
                                        <?php
                                        }

                                        ?>

                                        <br />

                                        <span class="fw-bold" style="font-size: 25px;"><?php echo $details_data["fname"] . " " . $details_data["Lname"]; ?></span>
                                        <span class="fw-bold text-black-50" style="font-size: 15px;"><?php echo $email; ?></span>

                                        <input type="file" class="d-none" id="profileImage" />
                                        <label for="profileImage" class="btn btn-primary mt-4">Update Profile Image</label>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
       



                                <div class="col-12 text-center p-3">
                                    <h2 class="h2 text-primary fw-bold">Profile Settings</h2>
                                </div>

                                <hr>

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12 col-lg-6 border-end border-success p-4 ">
                                            <div class="row">

                                                <div class="col-12">
                                                    <label class="form-label fw-bold" style="font-size: 20px;">First Name</label>
                                                </div>

                                                <div class="col-12">

                                                    <input type="text" id="fname" class="form-control" value="<?php echo $details_data["fname"]; ?>" />
                                                </div>

                                            </div>
                                        </div>



                                        <div class="col-12 col-lg-6 p-4">
                                            <div class="row">

                                                <div class="col-12">
                                                    <label class="form-label fw-bold" style="font-size: 20px;">Last Name</label>
                                                </div>

                                                <div class="col-12">

                                                    <input type="text" id="lname" class="form-control" value="<?php echo $details_data["Lname"]; ?>" />
                                                </div>

                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="row">

                                                <div class="col-12 col-lg-6 border-end border-success p-4 ">
                                                    <div class="row">

                                                        <div class="col-12">
                                                            <label class="form-label fw-bold" style="font-size: 20px;">Email</label>
                                                        </div>

                                                        <div class="col-12">

                                                            <input type="text" id="email" class="form-control" value="<?php echo $email; ?>" />
                                                        </div>

                                                    </div>
                                                </div>



                                                <div class="col-12 col-lg-6 p-4">
                                                    <div class="row">

                                                        <div class="col-12">
                                                            <label class="form-label fw-bold" style="font-size: 20px;">Password</label>
                                                        </div>

                                                        <div class="col-12">

                                                            <div class="input-group">
                                                                <input type="password" id="pw" value="<?php echo $details_data["password"]; ?>" class="form-control" aria-describedby="pwb">
                                                                <span class="input-group-text" id="pwb" onclick="showPassword3();"><i class="bi bi-eye-fill"></i></span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                                <div class="col-12">
                                                    <div class="row">

                                                        <div class="col-12 col-lg-6 border-end border-success p-4 ">
                                                            <div class="row">

                                                                <div class="col-12">
                                                                    <label class="form-label fw-bold" style="font-size: 20px;">Mobile Number</label>
                                                                </div>

                                                                <div class="col-12">

                                                                    <input type="text" id="mobile" class="form-control" value="<?php echo $details_data["mobile"]; ?>" />
                                                                </div>

                                                            </div>
                                                        </div>



                                                        <div class="col-12 col-lg-6 p-4">
                                                            <div class="row">

                                                                <div class="col-12">
                                                                    <label class="form-label fw-bold" style="font-size: 20px;">Registered Date</label>
                                                                </div>

                                                                <div class="col-12">

                                                                    <input type="text" class="form-control" readonly value="<?php echo $details_data["joined_date"]; ?>" />
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                        <?php

                                                        if (empty($address_data["line1"])) {
                                                        ?>

                                                            <div class="col-12">
                                                                <div class="row">

                                                                    <div class="col-12 col-lg-6 border-end border-success p-4 ">
                                                                        <div class="row">

                                                                            <div class="col-12">
                                                                                <label class="form-label fw-bold" style="font-size: 20px;">Address Line 01</label>
                                                                            </div>

                                                                            <div class="col-12">

                                                                                <input type="text" id="line1" class="form-control" placeholder="Enter Address Line 01" />
                                                                            </div>

                                                                        </div>
                                                                    </div>
              
                                                                <?php
                                                            } else {
                                                                ?>
                                                                    

                                                                            <div class="col-12 col-lg-6 p-4 border-end border-success p-4">
                                                                                <div class="row">

                                                                                    <div class="col-12">
                                                                                        <label class="form-label fw-bold" style="font-size: 20px;">Address Line 01</label>
                                                                                    </div>

                                                                                    <div class="col-12">

                                                                                        <input type="text" id="line1" class="form-control" value="<?php echo $address_data["line1"]; ?>" />
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        

                                                                        <?php
                                                                    }

                                                                    if (empty($address_data["line2"])) {
                                                                        ?>


                                                                    
                                                                            <div class="col-12 col-lg-6 ">
                                                                                <div class="row">

                                                                                    <div class="col-12">
                                                                                        <label class="form-label fw-bold" style="font-size: 20px;">Address Line 02</label>
                                                                                    </div>

                                                                                    <div class="col-12">

                                                                                        <input type="text" id="line2" class="form-control" placeholder="Enter Address Line 02" />
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        

                                                                        <?php
                                                                    } else {
                                                                        ?>

                                                                            <div class="col-12 col-lg-6 p-4 border-end border-success p-4">
                                                                                <div class="row">

                                                                                    <div class="col-12">
                                                                                        <label class="form-label fw-bold" style="font-size: 20px;">Address Line 02</label>
                                                                                    </div>

                                                                                    <div class="col-12">

                                                                                        <input type="text" id="line2" class="form-control" value="<?php echo $address_data["line2"]; ?>" />
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        
                                    

                                                                        <?php
                                                                    }

                                                                    $province_rs = Database::search("SELECT * FROM `province`");
                                                                    $district_rs = Database::search("SELECT * FROM `district`");
                                                                    $city_rs = Database::search("SELECT * FROM `city`");

                                                                    $province_num = $province_rs->num_rows;
                                                                    $district_num = $district_rs->num_rows;
                                                                    $city_num = $city_rs->num_rows;
                                                                        ?>



                                                                        <div class="col-12">
                                                                            <div class="row">

                                                                                <div class="col-12 col-lg-6 border-end border-success p-4 ">
                                                                                    <div class="row">

                                                                                        <div class="col-12">
                                                                                            <label class="form-label fw-bold" style="font-size: 20px;">Province</label>
                                                                                        </div>

                                                                                        <div class="col-12">

                                                                                            <select class="form-select" id="province">
                                                                                                <option value="0">Select Province</option>
                                                                                                <?php

                                                                                                for ($x = 0; $x < $province_num; $x++) {
                                                                                                    $province_data = $province_rs->fetch_assoc();
                                                                                                ?>
                                                                                                    <option value="<?php echo $province_data["province_id"]; ?>" <?php
                                                                                                                                                                    if (!empty($address_data["province_province_id"])) {
                                                                                                                                                                        if ($province_data["province_id"] == $address_data["province_province_id"]) {
                                                                                                                                                                    ?> selected <?php
                                                                                                                                                                        }
                                                                                                                                                                    }
                                                                                    ?>>
                                                                                                        <?php echo $province_data["province_name"]; ?>
                                                                                                    </option>
                                                                                                <?php
                                                                                                }

                                                                                                ?>

                                                                                            </select>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                            



                                                                                <div class="col-12 col-lg-6 p-4">
                                                                                    <div class="row">

                                                                                        <div class="col-12">
                                                                                            <label class="form-label fw-bold" style="font-size: 20px;">District</label>
                                                                                        </div>

                                                                                        <div class="col-12">

                                                                                            <select class="form-select" id="district">
                                                                                                <option value="0">Select District</option>
                                                                                                <?php

                                                                                                for ($x = 0; $x < $district_num; $x++) {
                                                                                                    $district_data = $district_rs->fetch_assoc();
                                                                                                ?>
                                                                                                    <option value="<?php echo $district_data["district_id"]; ?>" <?php
                                                                                                                                                                    if (!empty($address_data["district_district_id"])) {
                                                                                                                                                                        if ($district_data["district_id"] == $address_data["district_district_id"]) {
                                                                                                                                                                    ?>selected<?php
                                                                                                                                                                        }
                                                                                                                                                                    }
                                                                                                                                    ?>><?php echo $district_data["district_name"] ?></option>
                                                                                                <?php
                                                                                                }
                                                                                                ?>
                                                                                            </select>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                                <div class="col-12">
                                                                                    <div class="row">

                                                                                        <div class="col-12 col-lg-6 border-end border-success p-4 ">
                                                                                            <div class="row">

                                                                                                <div class="col-12">
                                                                                                    <label class="form-label fw-bold" style="font-size: 20px;">City</label>
                                                                                                </div>

                                                                                                <div class="col-12">

                                                                                                    <select class="form-select" id="city">
                                                                                                        <option value="0">Select City</option>
                                                                                                        <?php

                                                                                                        for ($x = 0; $x < $city_num; $x++) {
                                                                                                            $city_data = $city_rs->fetch_assoc();
                                                                                                        ?>
                                                                                                            <option value="<?php echo $city_data["city_id"]; ?>" <?php
                                                                                                                                                                    if (!empty($address_data["city_id"])) {
                                                                                                                                                                        if ($city_data["city_id"] == $address_data["city_city_id"]) {
                                                                                                                                                                    ?>selected<?php
                                                                                                                                                                        }
                                                                                                                                                                    }
                                                                        ?>><?php echo $city_data["city_name"] ?></option>
                                                                                                        <?php
                                                                                                        }
                                                                                                        ?>
                                                                                                    </select>
                                                                                                </div>

                                                                                            </div>
                                                                                        </div>


                                                                                        <?php

                                                                                        if (empty($address_data["postal_code"])) {
                                                                                        ?>

                                                                                            <div class="col-12 col-lg-6 p-4">
                                                                                                <div class="row">

                                                                                                    <div class="col-12">
                                                                                                        <label class="form-label fw-bold" style="font-size: 20px;">Postal Code</label>
                                                                                                    </div>

                                                                                                    <div class="col-12">

                                                                                                        <input type="text" id="pc" class="form-control" placeholder="Enter Your Postal Code" />
                                                                                                    </div>

                                                                                                </div>
                                                                                            </div>

                                                                                        <?php
                                                                                        } else {
                                                                                        ?>

                                                                                            <div class="col-12 col-lg-6 p-4">
                                                                                                <div class="row">

                                                                                                    <div class="col-12">
                                                                                                        <label class="form-label fw-bold" style="font-size: 20px;">Postal Code</label>
                                                                                                    </div>

                                                                                                    <div class="col-12">

                                                                                                        <input type="text" id="pc" class="form-control" value="<?php echo $address_data["postal_code"]; ?>" />
                                                                                                    </div>

                                                                                                </div>
                                                                                            </div>
                                                                                    </div>
                                                                                </div>

                                                                                        <?php
                                                                                        }

                                                                                        ?>


                                                                                        <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                                                                            <label class="form-label fw-bold" style="font-size: 20px;">Gender</label>
                                                                                            <input type="text" class="form-control" readonly value="<?php echo $details_data["gender_name"]; ?>" />
                                                                                        </div>

                                                                                        <hr>

                                                                                        <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                                                                            <button class="btn btn-primary" onclick="updateProfile();">Update My Profile</button>
                                                                                        </div>

                                    




                                                                                    <?php

                                                                                } else {
                                                                                }

                                                                                    ?>
                                    
                                                                              

                                                                                    <?php

                                                                                    require "footer.php";

                                                                                    ?>


                                  
                    </div>
                </div>
                
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
</body>

</html>