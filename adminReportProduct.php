<?php

session_start();

include "connection.php";



   $rs = Database::search("SELECT * FROM `product`");

   $num = $rs->num_rows;


    ?>
    
    <!DOCTYPE html>
    <html lang="en" >

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product Report</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="icon" href="resourses/Rs-logo.svg.png" />
    </head>

    <body>
        
    <div class="container mt-5">
            <a href="adminReport.php"><img src="resourses/Rs-logo.svg.png" height="55"/></a>
        </div>

        <div class="container mt-3" id="printArea1">
            <h2 class="text-center">Product Report</h2>
            <table class="table border border-black table-hover mt-5">
                <thead>
                    <tr>
                        <th>Product Id</th>
                        <th>Product Name</th>
                        <th>QTY</th>
                        <th>Date</th>
                        <th>Price</th>
                    
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                <?php  
                for ($i=0; $i < $num; $i++) { 
                    $d = $rs->fetch_assoc();
                    ?>
                    <tr>
                        <td><?php echo $d["id"] ?></td>
                        <td><?php echo $d["title"] ?></td>
                        <td><?php echo $d["qty"] ?></td>
                        <td><?php echo $d["datetime_added"] ?></td>
                        <td><?php echo $d["price"] ?></td>
                

                        <?php
                            $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $d["id"] . "'");
                            $image_num = $image_rs->num_rows;
                            $image_data = $image_rs->fetch_assoc();
                            ?>
                        <td><img src="<?php echo $image_data["img_path"]; ?>" height="100" /></td>
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