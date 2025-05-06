<?php

include "connection.php";
session_start();
$user = $_SESSION["u"];

if (isset($_POST["payment"])) {
    
    $payment = json_decode($_POST["payment"], true);

    $date = new DateTime();
    $date->setTimezone(new DateTimeZone("Asia/Colombo"));
    $time = $date->format("Y-m-d H-i-s");

    $rs = Database::search("SELECT * FROM `cart` WHERE `users_email` = '" . $user["id"] . "'");
    $num =  $rs->num_rows;

    for ($i=0; $i < $num; $i++) { 
        $d = $rs->fetch_assoc();

        $rs2 = Database::search("SELECT * FROM `product` WHERE `id` = '" . $d["stock_stock_id"] . "'");
        $d2 = $rs2->fetch_assoc();

        $newQty = $d2["qty"] - $d["qty"];
        Database::iud("UPDATE `product` SET `qty` = '" . $newQty . "' WHERE `id` = '" . $d["stock_stock_id"] . "'");

    }

    Database::iud("INSERT INTO `invoice`(`order_id`,`date`,`total`,`qty`,`status`,`product_id`,`users_email`) VALUES
    ('".$order_id."','".$time."','".$payment["amount"]."','". $d["cart_qty"]."','0','". $d["stock_stock_id"]."','". $user["id"]."')");

    $orderHistoryId = Database::$connection->insert_id;

   

    

    Database::iud("DELETE FROM `cart` WHERE `users_email` = '" . $user["id"] . "'");
    echo ("Success");

}

?>