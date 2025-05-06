<?php

require "connection.php";
session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Users | Admins | RED STore</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resourses/Rs-logo.svg.png" />

</head>
<body class="adminBody">


<div class="container-fluid ">
        <div class="row ">

            <div class="col-12  text-center" style="background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);">
                <label class="form-label  fw-bold fs-1">Manage All Users</label>
            </div>


            <div class="row">
    <div class=" col-12 col-lg-12 text-center">
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
                            <a href="adminReportUser.php"> <button class="btn btn-outline-warning">User Reports</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12">
                                    <hr />
                                </div>


        <?php

$query = "SELECT * FROM `users`";
$pageno;

if (isset($_GET["page"])) {
    $pageno = $_GET["page"];
} else {
    $pageno = 1;
}

$user_rs = Database::search($query);
$user_num = $user_rs->num_rows;


$results_per_page = 20;
$number_of_pages = ceil($user_num / $results_per_page);

$page_results = ($pageno - 1) * $results_per_page;
$selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

$selected_num = $selected_rs->num_rows;

for ($x = 0; $x < $selected_num; $x++) {
    $selected_data = $selected_rs->fetch_assoc();

?>

     
    
           
                <!-- card -->
                
                <div class="card col-12 col-lg-3 mt-2 mb-2 gap-5" style="width: 350px;  background-color:antiquewhite" onclick="viewMsgModal('<?php echo $selected_data['email']; ?>');">
                
                
                            <img src="resourses/new_user.svg" class="card-img-top img-thumbnail mt-2" style="height: 180px;"  />
                            
                            <div class="card-body ms-0 m-0 text-center">
                                <h5 class="card-title fw-bold fs-6"><?php echo $selected_data["fname"] . " " . $selected_data["Lname"]; ?></h5>
                                
                                <span class="card-text text-primary"><?php echo $selected_data["email"]; ?></span><br />
                                <span class="card-text text-warning fw-bold"><?php echo $selected_data["mobile"]; ?></span><br />
                                <span class="card-text text-success fw-bold"><?php echo $selected_data["joined_date"]; ?></span><br />                               
                                
                            <?php

                            if ($selected_data["status"] == 1) {
                            ?>
                                <button id="ub<?php echo $selected_data['email']; ?>" class="btn btn-danger" onclick="blockUser('<?php echo $selected_data['email']; ?>');">Block</button>
                            <?php
                            } else {
                            ?>
                                <button id="ub<?php echo $selected_data['email']; ?>" class="btn btn-success" onclick="blockUser('<?php echo $selected_data['email']; ?>');">Unblock</button>
                            <?php

                            }

                            ?>

                       

                            </div>
                        </div>
                        
       
        
                <!-- card -->


            <?php

            }

            ?>

            <!-- msg modal -->
            <div class="modal" tabindex="-1" id="userMsgModal<?php echo $selected_data["email"]; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><?php echo $selected_data["fname"] . " " . $selected_data["Lname"]; ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body overflow-scroll">
                                <?php
                                
                                $chat_rs = Database::search("SELECT * FROM `chat` WHERE `from`='".$_SESSION["u"]["email"]."'
                                OR `to`='".$_SESSION["u"]["email"]."' ORDER BY `date_time` ASC");
                                $chat_num = $chat_rs->num_rows;

                                for ($y = 0; $y < $chat_num; $y++){
                                    $chat_data = $chat_rs->fetch_assoc();

                                    if($chat_data["from"] == $selected_data["email"]){
                                
                                
                                ?>
                                <!-- received -->
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <div class="col-8 rounded bg-success">
                                            <div class="row">
                                                <div class="col-12 pt-2">
                                                    <span class="text-white fw-bold fs-4 " id="re"><?php echo $chat_data["content"]; ?></span>
                                                </div>
                                                <div class="col-12 text-end pb-2">
                                                <span class="text-white fs-6"><?php echo $chat_data["date_time"]; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- received -->
                                <?php
                                    }else if ($chat_data["to"] == $selected_data["email"]){
                                ?>
                                <!-- sent -->
                                <div class="col-12 mt-2">
                                    <div class="row">
                                        <div class="offset-4 col-8 rounded bg-primary">
                                            <div class="row">
                                                <div class="col-12 pt-2">
                                                    <span class="text-white fw-bold fs-4"><?php echo $chat_data["content"]; ?></span>
                                                </div>
                                                <div class="col-12 text-end pb-2">
                                                <span class="text-white fs-6"><?php echo $chat_data["date_time"]; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- sent -->
                                <?php
                                    }
                                }
                                ?>

                            </div>
                            <div class="modal-footer">

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-9">
                                            <input type="text" class="form-control" id="msgtxt"/>
                                        </div>
                                        <div class="col-3 d-grid">
                                            <button type="button" class="btn btn-primary" onclick="sendAdminMsg('<?php echo $selected_data['email']; ?>');">Send</button>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- msg modal -->


        </di>
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



<script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>