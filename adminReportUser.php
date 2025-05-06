<?php

session_start();

include "connection.php";



    $rs =  Database::search("SELECT * FROM `users`");
    $num = $rs->num_rows;


    ?>
    
    <!DOCTYPE html>
    <html lang="en" >

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Report</title>
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="icon" href="resourses/Rs-logo.svg.png" />
    </head>

    <body>
        
    

    <div class="container mt-5">
            <a href="adminReport.php"><img src="resourses/Rs-logo.svg.png" height="55"/></a>
        </div>

        <div class="container mt-3" id="printArea">
            <h2 class="text-center">User Report</h2>
            <table class="table border border-black table-hover mt-5">
                <thead>
                    <tr>
                        
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Mobile No</th>
                        <th>Statues</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php  
                for ($i=0; $i < $num; $i++) { 
                    $d = $rs->fetch_assoc();
                    ?>
                    <tr>
                        
                        <td><?php echo $d["fname"] ?></td>
                        <td><?php echo $d["Lname"] ?></td>
                        <td><?php echo $d["email"] ?></td>
                        <td><?php echo $d["mobile"] ?></td>
                        
                        <td>
                            <?php
                            if ($d["status"] == 1) {
                                echo ("Active");
                            } else {
                                echo ("Deactive");
                            }
                            
                            
                            ?>
                        </td>
                    </tr>
                    <?php
                }              
                ?>
                </tbody>
            </table>

            
        </div>

        <div class="d-flex justify-content-end container mt-5 mb-5">
            <button class="btn btn-warning col-2" onclick="printDiv();">Print</button>
        </div>
 
        <script src="script.js"></script>
    </body>

    </html>
  
    <?php




?>