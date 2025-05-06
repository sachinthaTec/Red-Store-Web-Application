<?php

session_start();

include "connection.php";


    $selected_rs = Database::search("SELECT * FROM `invoice` ");

    $selected_num = $selected_rs->num_rows;


    ?>
    
    <!DOCTYPE html>
    <html lang="en" >

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product Report</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
    </head>

    <body>
        
        <div class="container mt-3">
            <a href="adminReport.php"><img src="resourses/Rs-logo.svg.png" height="55"/></a>
        </div>

        <div class="container mt-3" id="printArea1">
            <h2 class="text-center text-danger">Product Report</h2>
            <table class="table table-hover mt-5">
                <thead>
                    <tr>
                        <th>Invoice ID</th>
                        <th>Product Name</th>
                        <th>Buyer</th>
                        <th>Amount</th>
                        <th>Quantity</th>
                        
                        
                    </tr>
                </thead>
                <tbody>
                <?php  
                for ($i=0; $i < $selected_num; $i++) { 
                    $selected_data = $selected_rs->fetch_assoc();
                    ?>
                    <tr>
                        <td><?php echo $selected_data["id"] ?></td>

                        <?php
                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$selected_data["product_id"]."'");
                        $product_data = $product_rs->fetch_assoc();
                        ?>
                        <td><?php echo $product_data["title"] ?></td>

                        <?php
                        $user_rs = Database::search("SELECT * FROM `users` WHERE `email`='".$selected_data["users_email"]."'");
                        $user_data = $user_rs->fetch_assoc();
                        ?>

                        <td><?php echo $user_data["fname"]." ".$user_data["Lname"]; ?></td>
                        <td>Rs. <?php echo $selected_data["total"]; ?> .00</td>
                        <td><?php echo $selected_data["qty"]; ?></td>
                        
                        
                    </tr>
                    <?php
                }              
                ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end container mt-5 mb-5">
            <button class="btn btn-warning col-2" onclick="printDiv1();">Print</button>
        </div>
 
        <script src="script.js"></script>
    </body>

    </html>
  
    <?php


?>