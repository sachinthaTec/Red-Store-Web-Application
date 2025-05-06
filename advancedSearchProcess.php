<?php

require "connection.php";

$search_txt = $_POST["t"];
$category = $_POST["cat"];
$brand = $_POST["b"];
$model = $_POST["mo"];
$condition = $_POST["con"];
$color = $_POST["col"];
$from = $_POST["pf"];
$to = $_POST["pt"];
$sort = $_POST["s"];


$query = "SELECT * FROM `product`";
$status = 0;

if($sort == 0){

    if(!empty($search_txt)){
        $query .= " WHERE `title` LIKE '%".$search_txt."%'";
        $status = 1;
    }

    if($category != 0 && $status == 0){
        $query .= " WHERE `category_id`='".$category."'";
        $status = 1;
    }else if($category != 0 && $status == 0){
        $query .= " AND `category_id`='".$category."'";
    }


    $pid = 0;

    if($brand != 0 && $model == 0){
        $modelHasBrand_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `brand_brand_id`='".$brand."'");

        $modelHasBrand_num =  $modelHasBrand_rs->num_rows;

        for($x = 0;$x <  $modelHasBrand_num;$x++){
            $modelHasBrand_data =  $modelHasBrand_rs->fetch_assoc();
            $pid = $modelHasBrand_data["id"];
        }

        if($status == 0){
            $query .= " WHERE `brand_has_model_id`='".$pid."'";
            $status = 1;

        }else if($status != 0){
            $query .= " AND `brand_has_model_id`='".$pid."'";

        }

    }
     if($brand == 0 && $model != 0){

        $modelHasBrand_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `model_model_id`='".$model."'");
        $modelHasBrand_num = $modelHasBrand_rs->num_rows;

        for($x = 0;$x < $modelHasBrand_num;$x++){
            $modelHasBrand_data = $modelHasBrand_rs->fetch_assoc();
            $pid = $modelHasBrand_data["id"];
        }

        if($status == 0){
            $query .= " WHERE `brand_has_model_id`='".$pid."'";
            $status = 1;

        }else if($status != 0){
            $query .= " AND `brand_has_model_id`='".$pid."'";

        }
    


    }
     if($brand != 0 && $model != 0){

        $modelHasBrand_rs = Database::search("SELECT * FROM `brand_has_model` WHERE 
                                            `model_model_id`='".$model."' AND `brand_brand_id`='".$brand."'");
        $modelHasBrand_num = $modelHasBrand_rs->num_rows;

        for($x = 0;$x < $modelHasBrand_num;$x++){
            $modelHasBrand_data = $modelHasBrand_rs->fetch_assoc();
            $pid = $modelHasBrand_data["id"];
        }

        if($status == 0){
            $query .= " WHERE `brand_has_model_id`='".$pid."'";
            $status = 1;

        }else if($status != 0){
            $query .= " AND `brand_has_model_id`='".$pid."'";

        }
    }


        if($condition != 0 && $status == 0){
            $query .= " WHERE `condition_condition_id`='".$condition."'";
            $status = 1;
            
        }else if($condition != 0 && $status != 0){
            $query .= " AND `condition_condition_id`='".$condition."'";

        }


        if($color != 0 && $status == 0){
            $query .= " WHERE `color_color_id`='".$color."'";
            $status = 1;
            
        }else if($color != 0 && $status != 0){
            $query .= " AND `color_color_id`='".$color."'";

        }


        if(!empty($from) && empty($to)){
            if($status == 0){
                $query .= " WHERE `price` >= '".$from."'";
                $status = 1;
            }else if($status != 0){
                $query .= " AND `price` >= '".$from."'";
            }

        }else if(empty($from) && !empty($to)){
            if($status == 0){
                $query .= " WHERE `price` <= '".$to."'";
                $status = 1;
            }else if($status != 0){
                $query .= " AND `price` <= '".$to."'";
            }

        }else if(!empty($from) && !empty($to)){
            if($status == 0){
                $query .= " WHERE `price` BETWEEN  '".$from."' AND '".$to."' ";
                $status = 1;
            }else if($status != 0){
                $query .= " AND `price` BETWEEN  '".$from."' AND '".$to."' ";
            }
            
        }

    



    }else if($sort == 1){
        if(!empty($search_txt)){
            $query .= " WHERE `title` LIKE '%".$search_txt."%' ORDER BY `price` ASC";
            $status = 1;
        }
    
         if($category != 0 && $status == 0){
            $query .= " WHERE `category_id`='".$category."' ORDER BY `price` ASC";
            $status = 1;
        }else if($category != 0 && $status == 0){
            $query .= " AND `category_id`='".$category."' ORDER BY `price` ASC";
        }
    
    
        $pid = 0;
    
        if($brand != 0 && $model == 0){
            $modelHasBrand_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `brand_brand_id`='".$brand."'");
    
            $modelHasBrand_num =  $modelHasBrand_rs->num_rows;
    
            for($x = 0;$x <  $modelHasBrand_num;$x++){
                $modelHasBrand_data =  $modelHasBrand_rs->fetch_assoc();
                $pid = $modelHasBrand_data["id"];
            }
    
            if($status == 0){
                $query .= " WHERE `brand_has_model_id`='".$pid."' ORDER BY `price` ASC";
                $status = 1;
    
            }else if($status != 0){
                $query .= " AND `brand_has_model_id`='".$pid."' ORDER BY `price` ASC";
    
            }
    
        }
         if($brand == 0 && $model != 0){
    
            $modelHasBrand_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `model_model_id`='".$model."'");
            $modelHasBrand_num = $modelHasBrand_rs->num_rows;
    
            for($x = 0;$x < $modelHasBrand_num;$x++){
                $modelHasBrand_data = $modelHasBrand_rs->fetch_assoc();
                $pid = $modelHasBrand_data["id"];
            }
    
            if($status == 0){
                $query .= " WHERE `brand_has_model_id`='".$pid."' ORDER BY `price` ASC";
                $status = 1;
    
            }else if($status != 0){
                $query .= " AND `brand_has_model_id`='".$pid."' ORDER BY `price` ASC";
    
            }
        
    
    
        }
         if($brand != 0 && $model != 0){
    
            $modelHasBrand_rs = Database::search("SELECT * FROM `brand_has_model` WHERE 
                                                `model_model_id`='".$model."' AND `brand_brand_id`='".$brand."'");
            $modelHasBrand_num = $modelHasBrand_rs->num_rows;
    
            for($x = 0;$x < $modelHasBrand_num;$x++){
                $modelHasBrand_data = $modelHasBrand_rs->fetch_assoc();
                $pid = $modelHasBrand_data["id"];
            }
    
            if($status == 0){
                $query .= " WHERE `brand_has_model_id`='".$pid."' ORDER BY `price` ASC";
                $status = 1;
    
            }else if($status != 0){
                $query .= " AND `brand_has_model_id`='".$pid."' ORDER BY `price` ASC";
    
            }
        }
    
    
            if($condition != 0 && $status == 0){
                $query .= " WHERE `condition_condition_id`='".$condition."' ORDER BY `price` ASC";
                $status = 1;
                
            }else if($condition != 0 && $status != 0){
                $query .= " AND `condition_condition_id`='".$condition."' ORDER BY `price` ASC";
    
            }
    
    
            if($color != 0 && $status == 0){
                $query .= " WHERE `color_color_id`='".$color."' ORDER BY `price` ASC";
                $status = 1;
                
            }else if($color != 0 && $status != 0){
                $query .= " AND `color_color_id`='".$color."' ORDER BY `price` ASC";
    
            }
    
    
            if(!empty($from) && empty($to)){
                if($status == 0){
                    $query .= " WHERE `price` >= '".$from."' ORDER BY `price` ASC";
                    $status = 1;
                }else if($status != 0){
                    $query .= " AND `price` >= '".$from."' ORDER BY `price` ASC";
                }
    
            }else if(empty($from) && !empty($to)){
                if($status == 0){
                    $query .= " WHERE `price` <= '".$to."' ORDER BY `price` ASC";
                    $status = 1;
                }else if($status != 0){
                    $query .= " AND `price` <= '".$to."' ORDER BY `price` ASC";
                }
    
            }else if(!empty($from) && !empty($to)){
                if($status == 0){
                    $query .= " WHERE `price` BETWEEN  '".$from."' AND '".$to."' ORDER BY `price` ASC";
                    $status = 1;
                }else if($status != 0){
                    $query .= " AND `price` BETWEEN  '".$from."' AND '".$to."' ORDER BY `price` ASC ";
                }
                
            }
    
    
    
    }else if($sort == 2){
        if(!empty($search_txt)){
            $query .= " WHERE `title` LIKE '%".$search_txt."%' ORDER BY `price` DESC";
            $status = 1;
        }
    
         if($category != 0 && $status == 0){
            $query .= " WHERE `category_id`='".$category."' ORDER BY `price` DESC";
            $status = 1;
        }else if($category != 0 && $status == 0){
            $query .= " AND `category_id`='".$category."' ORDER BY `price` DESC";
        }
    
    
        $pid = 0;
    
        if($brand != 0 && $model == 0){
            $modelHasBrand_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `brand_brand_id`='".$brand."'");
    
            $modelHasBrand_num =  $modelHasBrand_rs->num_rows;
    
            for($x = 0;$x <  $modelHasBrand_num;$x++){
                $modelHasBrand_data =  $modelHasBrand_rs->fetch_assoc();
                $pid = $modelHasBrand_data["id"];
            }
    
            if($status == 0){
                $query .= " WHERE `brand_has_model_id`='".$pid."' ORDER BY `price` DESC";
                $status = 1;
    
            }else if($status != 0){
                $query .= " AND `brand_has_model_id`='".$pid."' ORDER BY `price` DESC";
    
            }
    
        }
         if($brand == 0 && $model != 0){
    
            $modelHasBrand_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `model_model_id`='".$model."'");
            $modelHasBrand_num = $modelHasBrand_rs->num_rows;
    
            for($x = 0;$x < $modelHasBrand_num;$x++){
                $modelHasBrand_data = $modelHasBrand_rs->fetch_assoc();
                $pid = $modelHasBrand_data["id"];
            }
    
            if($status == 0){
                $query .= " WHERE `brand_has_model_id`='".$pid."' ORDER BY `price` DESC";
                $status = 1;
    
            }else if($status != 0){
                $query .= " AND `brand_has_model_id`='".$pid."' ORDER BY `price` DESC";
    
            }
        
    
    
        }
         if($brand != 0 && $model != 0){
    
            $modelHasBrand_rs = Database::search("SELECT * FROM `brand_has_model` WHERE 
                                                `model_model_id`='".$model."' AND `brand_brand_id`='".$brand."'");
            $modelHasBrand_num = $modelHasBrand_rs->num_rows;
    
            for($x = 0;$x < $modelHasBrand_num;$x++){
                $modelHasBrand_data = $modelHasBrand_rs->fetch_assoc();
                $pid = $modelHasBrand_data["id"];
            }
    
            if($status == 0){
                $query .= " WHERE `brand_has_model_id`='".$pid."' ORDER BY `price` DESC";
                $status = 1;
    
            }else if($status != 0){
                $query .= " AND `brand_has_model_id`='".$pid."' ORDER BY `price` DESC";
    
            }
        }
    
    
            if($condition != 0 && $status == 0){
                $query .= " WHERE `condition_condition_id`='".$condition."' ORDER BY `price` DESC";
                $status = 1;
                
            }else if($condition != 0 && $status != 0){
                $query .= " AND `condition_condition_id`='".$condition."' ORDER BY `price` DESC";
    
            }
    
    
            if($color != 0 && $status == 0){
                $query .= " WHERE `color_color_id`='".$color."' ORDER BY `price` DESC";
                $status = 1;
                
            }else if($color != 0 && $status != 0){
                $query .= " AND `color_color_id`='".$color."' ORDER BY `price` DESC";
    
            }
    
    
            if(!empty($from) && empty($to)){
                if($status == 0){
                    $query .= " WHERE `price` >= '".$from."' ORDER BY `price` DESC";
                    $status = 1;
                }else if($status != 0){
                    $query .= " AND `price` >= '".$from."' ORDER BY `price` DESC";
                }
    
            }else if(empty($from) && !empty($to)){
                if($status == 0){
                    $query .= " WHERE `price` <= '".$to."' ORDER BY `price` DESC";
                    $status = 1;
                }else if($status != 0){
                    $query .= " AND `price` <= '".$to."' ORDER BY `price` DESC";
                }
    
            }else if(!empty($from) && !empty($to)){
                if($status == 0){
                    $query .= " WHERE `price` BETWEEN  '".$from."' AND '".$to."' ORDER BY `price` DESC";
                    $status = 1;
                }else if($status != 0){
                    $query .= " AND `price` BETWEEN  '".$from."' AND '".$to."' ORDER BY `price` DESC ";
                }
                
            }
        
        }else if($sort == 3){

            if(!empty($search_txt)){
                $query .= " WHERE `title` LIKE '%".$search_txt."%' ORDER BY `qty` ASC";
                $status = 1;
            }
        
            if($category != 0 && $status == 0){
                $query .= " WHERE `category_id`='".$category."' ORDER BY `qty` ASC";
                $status = 1;
            }else if($category != 0 && $status == 0){
                $query .= " AND `category_id`='".$category."' ORDER BY `qty` ASC";
            }
        
        
            $pid = 0;
        
            if($brand != 0 && $model == 0){
                $modelHasBrand_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `brand_brand_id`='".$brand."'");
        
                $modelHasBrand_num =  $modelHasBrand_rs->num_rows;
        
                for($x = 0;$x <  $modelHasBrand_num;$x++){
                    $modelHasBrand_data =  $modelHasBrand_rs->fetch_assoc();
                    $pid = $modelHasBrand_data["id"];
                }
        
                if($status == 0){
                    $query .= " WHERE `brand_has_model_id`='".$pid."' ORDER BY `qty` ASC";
                    $status = 1;
        
                }else if($status != 0){
                    $query .= " AND `brand_has_model_id`='".$pid."' ORDER BY `qty` ASC";
        
                }
        
            }
             if($brand == 0 && $model != 0){
        
                $modelHasBrand_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `model_model_id`='".$model."'");
                $modelHasBrand_num = $modelHasBrand_rs->num_rows;
        
                for($x = 0;$x < $modelHasBrand_num;$x++){
                    $modelHasBrand_data = $modelHasBrand_rs->fetch_assoc();
                    $pid = $modelHasBrand_data["id"];
                }
        
                if($status == 0){
                    $query .= " WHERE `brand_has_model_id`='".$pid."' ORDER BY `qty` ASC";
                    $status = 1;
        
                }else if($status != 0){
                    $query .= " AND `brand_has_model_id`='".$pid."' ORDER BY `qty` ASC";
        
                }
            
        
        
            }
             if($brand != 0 && $model != 0){
        
                $modelHasBrand_rs = Database::search("SELECT * FROM `brand_has_model` WHERE 
                                                    `model_model_id`='".$model."' AND `brand_brand_id`='".$brand."'");
                $modelHasBrand_num = $modelHasBrand_rs->num_rows;
        
                for($x = 0;$x < $modelHasBrand_num;$x++){
                    $modelHasBrand_data = $modelHasBrand_rs->fetch_assoc();
                    $pid = $modelHasBrand_data["id"];
                }
        
                if($status == 0){
                    $query .= " WHERE `brand_has_model_id`='".$pid."' ORDER BY `qty` ASC";
                    $status = 1;
        
                }else if($status != 0){
                    $query .= " AND `brand_has_model_id`='".$pid."' ORDER BY `qty` ASC";
        
                }
            }
        
        
                if($condition != 0 && $status == 0){
                    $query .= " WHERE `condition_condition_id`='".$condition."' ORDER BY `qty` ASC";
                    $status = 1;
                    
                }else if($condition != 0 && $status != 0){
                    $query .= " AND `condition_condition_id`='".$condition."' ORDER BY `qty` ASC";
        
                }
        
        
                if($color != 0 && $status == 0){
                    $query .= " WHERE `color_color_id`='".$color."' ORDER BY `qty` ASC";
                    $status = 1;
                    
                }else if($color != 0 && $status != 0){
                    $query .= " AND `color_color_id`='".$color."' ORDER BY `qty` ASC";
        
                }
        
        
                if(!empty($from) && empty($to)){
                    if($status == 0){
                        $query .= " WHERE `price` >= '".$from."' ORDER BY `qty` ASC";
                        $status = 1;
                    }else if($status != 0){
                        $query .= " AND `price` >= '".$from."' ORDER BY `qty` ASC";
                    }
        
                }else if(empty($from) && !empty($to)){
                    if($status == 0){
                        $query .= " WHERE `price` <= '".$to."' ORDER BY `qty` ASC";
                        $status = 1;
                    }else if($status != 0){
                        $query .= " AND `price` <= '".$to."' ORDER BY `qty` ASC";
                    }
        
                }else if(!empty($from) && !empty($to)){
                    if($status == 0){
                        $query .= " WHERE `price` BETWEEN  '".$from."' AND '".$to."' ORDER BY `qty` ASC";
                        $status = 1;
                    }else if($status != 0){
                        $query .= " AND `price` BETWEEN  '".$from."' AND '".$to."' ORDER BY `qty` ASC ";
                    }
                    
                }
        
            }else if($sort == 4){

                if(!empty($search_txt)){
                    $query .= " WHERE `title` LIKE '%".$search_txt."%' ORDER BY `qty` DESC";
                    $status = 1;
                }
            
                if($category != 0 && $status == 0){
                    $query .= " WHERE `category_id`='".$category."' ORDER BY `qty` DESC";
                    $status = 1;
                }else if($category != 0 && $status == 0){
                    $query .= " AND `category_id`='".$category."' ORDER BY `qty` DESC";
                }
            
            
                $pid = 0;
            
                if($brand != 0 && $model == 0){
                    $modelHasBrand_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `brand_brand_id`='".$brand."'");
            
                    $modelHasBrand_num =  $modelHasBrand_rs->num_rows;
            
                    for($x = 0;$x <  $modelHasBrand_num;$x++){
                        $modelHasBrand_data =  $modelHasBrand_rs->fetch_assoc();
                        $pid = $modelHasBrand_data["id"];
                    }
            
                    if($status == 0){
                        $query .= " WHERE `brand_has_model_id`='".$pid."' ORDER BY `qty` DESC";
                        $status = 1;
            
                    }else if($status != 0){
                        $query .= " AND `brand_has_model_id`='".$pid."' ORDER BY `qty` DESC";
            
                    }
            
                }
                 if($brand == 0 && $model != 0){
            
                    $modelHasBrand_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `model_model_id`='".$model."'");
                    $modelHasBrand_num = $modelHasBrand_rs->num_rows;
            
                    for($x = 0;$x < $modelHasBrand_num;$x++){
                        $modelHasBrand_data = $modelHasBrand_rs->fetch_assoc();
                        $pid = $modelHasBrand_data["id"];
                    }
            
                    if($status == 0){
                        $query .= " WHERE `brand_has_model_id`='".$pid."' ORDER BY `qty` DESC";
                        $status = 1;
            
                    }else if($status != 0){
                        $query .= " AND `brand_has_model_id`='".$pid."' ORDER BY `qty` DESC";
            
                    }
                
            
            
                }
                 if($brand != 0 && $model != 0){
            
                    $modelHasBrand_rs = Database::search("SELECT * FROM `brand_has_model` WHERE 
                                                        `model_model_id`='".$model."' AND `brand_brand_id`='".$brand."'");
                    $modelHasBrand_num = $modelHasBrand_rs->num_rows;
            
                    for($x = 0;$x < $modelHasBrand_num;$x++){
                        $modelHasBrand_data = $modelHasBrand_rs->fetch_assoc();
                        $pid = $modelHasBrand_data["id"];
                    }
            
                    if($status == 0){
                        $query .= " WHERE `brand_has_model_id`='".$pid."' ORDER BY `qty` DESC";
                        $status = 1;
            
                    }else if($status != 0){
                        $query .= " AND `brand_has_model_id`='".$pid."' ORDER BY `qty` DESC";
            
                    }
                }
            
            
                    if($condition != 0 && $status == 0){
                        $query .= " WHERE `condition_condition_id`='".$condition."' ORDER BY `qty` DESC";
                        $status = 1;
                        
                    }else if($condition != 0 && $status != 0){
                        $query .= " AND `condition_condition_id`='".$condition."' ORDER BY `qty` DESC";
            
                    }
            
            
                    if($color != 0 && $status == 0){
                        $query .= " WHERE `color_color_id`='".$color."' ORDER BY `qty` DESC";
                        $status = 1;
                        
                    }else if($color != 0 && $status != 0){
                        $query .= " AND `color_color_id`='".$color."' ORDER BY `qty` DESC";
            
                    }
            
            
                    if(!empty($from) && empty($to)){
                        if($status == 0){
                            $query .= " WHERE `price` >= '".$from."' ORDER BY `qty` DESC";
                            $status = 1;
                        }else if($status != 0){
                            $query .= " AND `price` >= '".$from."' ORDER BY `qty` DESC";
                        }
            
                    }else if(empty($from) && !empty($to)){
                        if($status == 0){
                            $query .= " WHERE `price` <= '".$to."' ORDER BY `qty` DESC";
                            $status = 1;
                        }else if($status != 0){
                            $query .= " AND `price` <= '".$to."' ORDER BY `qty` DESC";
                        }
            
                    }else if(!empty($from) && !empty($to)){
                        if($status == 0){
                            $query .= " WHERE `price` BETWEEN  '".$from."' AND '".$to."' ORDER BY `qty` DESC";
                            $status = 1;
                        }else if($status != 0){
                            $query .= " AND `price` BETWEEN  '".$from."' AND '".$to."' ORDER BY `qty` DESC ";
                        }
                        
                    }
                
            }

?>



<div class="row">
    <div class="offset-lg-1 col-12 col-lg-12 text-center">
        <div class="row">

            <?php

            if ("0" != $_POST["page"]) {
                $pageno = $_POST["page"];
            } else {
                $pageno = 1;
            }

            $product_rs = Database::search($query);
            $product_num = $product_rs->num_rows;

            $results_per_page = 8;
            $number_of_pages = ceil($product_num / $results_per_page);

            $page_results = ($pageno - 1) * $results_per_page;

            $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");


            $selected_num = $selected_rs->num_rows;

            for ($x = 0; $x < $selected_num; $x++) {
                $selected_data = $selected_rs->fetch_assoc();

                $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE 
                                        `product_id`='" . $selected_data["id"] . "'");
                $product_img_data = $product_img_rs->fetch_assoc();

            ?>


                <!-- card -->

                <div class="card col-12 col-lg-2 mt-2 mb-2" style="width: 18rem;  background-color:antiquewhite">

                                           

                                                <img src="<?php echo $product_img_data["img_path"]; ?>" class="card-img-top img-thumbnail mt-2" style="height: 180px;" />
                                                <div class="card-body ms-0 m-0 text-center">
                                                    <h5 class="card-title fw-bold fs-6"><?php echo $selected_data["title"]; ?></h5>
                                                    <span class="badge rounded-pill text-bg-info">New</span><br />
                                                    <span class="card-text text-primary">Rs. <?php echo $selected_data["price"]; ?> .00</span><br />
                                                    <span class="card-text text-warning fw-bold">In Stock</span><br />
                                                    <span class="card-text text-success fw-bold"><?php echo $selected_data["qty"]; ?> Items Available</span><br />                               
                                                    <a href="<?php echo "singleProductView.php?id=". ($selected_data["id"]); ?>" class="col-12 btn btn-success">Buy Now</a>
                                                    <button onclick="addToCart(<?php echo $selected_data['id']; ?>);" class="col-6 btn btn-dark mt-2">
                                                        <i class="bi bi-cart4 text-white fs-5"></i>
                                                    </button>
                                                    <button onclick="addToWatchlist(<?php echo $selected_data['id']; ?>);" class="col-6 btn btn-outline-light mt-2 border border-warning">
                                                        <i class="bi bi-heart-fill text-dark fs-5"></i>
                                                    </button>
                                            
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
                <a class="page-link" 
                                            <?php if ($pageno <= 1) {
                                                echo ("#");
                                            } else {
                                                ?>
                                                onclick="advancedSearch(<?php echo ($pageno - 1)?>);"
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
                        <a class="page-link" onclick="advancedSearch(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="page-item">
                        <a class="page-link" onclick="advancedSearch(<?php echo ($y); ?>);"><?php echo $y; ?></a>
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
                                                onclick="advancedSearch(<?php echo ($pageno + 1)?>);"
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