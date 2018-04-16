<?php

require('./includes/config.inc.php');
require(MYSQL);
include('./includes/header.html');

//Encode the URL
$current_url = urlencode($url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

//Get the searched id from the URL. If an id is not set, then default the category to diet
if(isset($_GET['id'])){
  $category_name = $_GET['id']; 
}else if(isset($_GET['search-term'])){
    $category_name = $_GET['search-term'];
}else{
    $category_name = 'Diet';
}
?>
<div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li>
                            <a href="\index.php">Home</a>
                        </li>
                        <li>
                            <?php echo $category_name ?>
                        </li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <!-- *** MENUS AND FILTERS ***
 _________________________________________________________ -->
                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Categories</h3>
                        </div>

                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked category-menu">
                                <li id = "men_tab" <?php if($category_name == "Diet" || $category_name == "Protein" || $category_name == "Vegetables" || $category_name == "Meat") echo 'class="active"'; ?>>
                                    <a href="category.php?id=Diet">Diet</a>
                                    <ul>
                                        <li><a href="category.php?id=Protein">Protein</a>
                                        </li>
                                        <li><a href="category.php?id=Vegetables">Vegetables</a>
                                        </li>
                                        <li><a href="category.php?id=Meat">Meat</a>
                                        </li>
                                    </ul>
                                </li>
                                <li id = "women_tab" <?php if($category_name == "Country" || $category_name == "Italian" || $category_name == "Mexican" || $category_name == "American") echo 'class="active"'; ?>>
                                    <a href="category.php?id=Country">Country</a>
                                    <ul>
                                        <li><a href="category.php?id=Italian">Italian</a>
                                        </li>
                                        <li><a href="category.php?id=Mexican">Mexican</a>
                                        </li>
                                        <li><a href="category.php?id=American">American</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="box" <?php if($category_name != "Country" && $category_name != "American" && $category_name != "Mexican" && $category_name != "Italian") echo 'style = "display: none"'?> id = "women_box">
                        <h1>Country</h1>
                        <p>In our Country selection we offer a wide selection of the best recipes from around the world</p>
                    </div>
                    <div class="box" <?php if($category_name != "Diet" && $category_name != "Protein" && $category_name != "Vegetables" && $category_name != "Meat") echo 'style = "display: none"'?> id = "men_box">
                        <h1>Diet</h1>
                        <p>In our Diet selection we offer a wide selection of the best recipes we have found and carefully selected for your health.</p>
                    </div>

                    <div class="row products">
<!--PHP Code to Generate the Products from the Database. As of 4/9/17, this code will also check to see whether the user searched for Men, Women, or Retro-->
<?php

//Check if the cart is empty. If true, initialize the cart session.
if(empty($_SESSION['cart'])){
  $_SESSION['cart'] = array();
}

//Check if the category is retro. If so, select all retro products from the DB. Display all products.
if($category_name == 'Diet'){
    $product_array = $dbc->query("SELECT * FROM recipes WHERE category='Diet' ORDER BY id ASC LIMIT 12");//DB Call
    while($row = $product_array->fetch_assoc()) {

        $id = $row['id'];//Set $id = product. This will be passed through the URL.

        //echo the html for the individual products along with their values from the database
        echo '                    
                                <div id="productModal' . $id . '" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">' . $row["title"] .'</h4>
                                      </div>
                                      <div class="modal-body">
                                        <p>'. $row["description"] .'</p>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>

                                  </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                <div class="product">
                                    <div class="flip-container">
                                        <div class="flipper">
                                            <div class="front">
                                                <a href="detail.html">
                                                    <img src="'. $row["img"] .'" alt="" class="img-responsive">
                                                </a>
                                            </div>
                                            <div class="back">
                                                <a href="detail.html">
                                                    <img src="'. $row["img"] .'" alt="" class="img-responsive">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="detail.html" class="invisible">
                                        <img src="'. $row["img"] .'" alt="" class="img-responsive">
                                    </a>
                                    <div class="text">
                                        <h3><a href="detail.html">' . $row["title"] . '</a></h3>
                                        <p class="price">' . '$' . $row["price"]/100 . '</p>
                                        <p class="buttons">
                                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#productModal' . $id . '">View Detail</button>
                                            <a href="basket.php?buy=' . $id . '" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </p>
                                    </div>
                                    <!-- /.text -->
                                </div>
                                <!-- /.product -->
                            </div>             
            '; 
    }//End while
}//End if

//Check if the category is men. If so, select all men products from the DB. Display all products.
else if($category_name == 'Country'){
    $product_array = $dbc->query("SELECT * FROM recipes WHERE category='Country' ORDER BY id ASC LIMIT 12");
    while($row = $product_array->fetch_assoc()) {

        $id = $row['id'];//Set $id = product. This will be passed through the URL.

    echo '                    
                            <div id="productMenModal' . $id . '" class="modal fade" role="dialog">
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">' . $row["title"] .'</h4>
                                  </div>
                                  <div class="modal-body">
                                    <p>'. $row["description"] .'</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>

                              </div>
                            </div>




                            <div class="col-md-4 col-sm-6">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="detail.html">
                                                <img src="'. $row["img"] .'" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="detail.html">
                                                <img src="'. $row["img"] .'" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="detail.html" class="invisible">
                                    <img src="'. $row["img"] .'" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3><a href="detail.html">' . $row["title"] . '</a></h3>
                                    <p class="price">' . '$' . $row["price"]/100 . '</p>
                                    <p class="buttons">
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#productMenModal' . $id . '">View Detail</button>
                                        <a href="basket.php?buy='. $id .'" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </p>
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>             
        '; 
    }
}//End else if

else if($category_name == 'Protein'){
    $product_array = $dbc->query("SELECT * FROM recipes WHERE type='Protein' ORDER BY id ASC LIMIT 12");
    while($row = $product_array->fetch_assoc()) {

        $id = $row['id'];//Set $id = product. This will be passed through the URL.

    echo '                    
                            <div id="productMenModal' . $id . '" class="modal fade" role="dialog">
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">' . $row["title"] .'</h4>
                                  </div>
                                  <div class="modal-body">
                                    <p>'. $row["description"] .'</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>

                              </div>
                            </div>




                            <div class="col-md-4 col-sm-6">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="detail.html">
                                                <img src="'. $row["img"] .'" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="detail.html">
                                                <img src="'. $row["img"] .'" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="detail.html" class="invisible">
                                    <img src="'. $row["img"] .'" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3><a href="detail.html">' . $row["title"] . '</a></h3>
                                    <p class="price">' . '$' . $row["price"]/100 . '</p>
                                    <p class="buttons">
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#productMenModal' . $id . '">View Detail</button>
                                        <a href="basket.php?buy='. $id .'" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </p>
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>             
        '; 
    }
}//End else if                         

else if($category_name == 'Vegetables'){
    $product_array = $dbc->query("SELECT * FROM recipes WHERE type='Vegetables' ORDER BY id ASC LIMIT 12");
    while($row = $product_array->fetch_assoc()) {

        $id = $row['id'];//Set $id = product. This will be passed through the URL.

    echo '                    
                            <div id="productMenModal' . $id . '" class="modal fade" role="dialog">
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">' . $row["title"] .'</h4>
                                  </div>
                                  <div class="modal-body">
                                    <p>'. $row["description"] .'</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>

                              </div>
                            </div>




                            <div class="col-md-4 col-sm-6">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="detail.html">
                                                <img src="'. $row["img"] .'" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="detail.html">
                                                <img src="'. $row["img"] .'" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="detail.html" class="invisible">
                                    <img src="'. $row["img"] .'" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3><a href="detail.html">' . $row["title"] . '</a></h3>
                                    <p class="price">' . '$' . $row["price"]/100 . '</p>
                                    <p class="buttons">
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#productMenModal' . $id . '">View Detail</button>
                                        <a href="basket.php?buy='. $id .'" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </p>
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>             
        '; 
    }
}//End else if                         

else if($category_name == 'Meat'){
    $product_array = $dbc->query("SELECT * FROM recipes WHERE type='Meat' ORDER BY id ASC LIMIT 12");
    while($row = $product_array->fetch_assoc()) {

        $id = $row['id'];//Set $id = product. This will be passed through the URL.

    echo '                    
                            <div id="productMenModal' . $id . '" class="modal fade" role="dialog">
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">' . $row["title"] .'</h4>
                                  </div>
                                  <div class="modal-body">
                                    <p>'. $row["description"] .'</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>

                              </div>
                            </div>




                            <div class="col-md-4 col-sm-6">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="detail.html">
                                                <img src="'. $row["img"] .'" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="detail.html">
                                                <img src="'. $row["img"] .'" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="detail.html" class="invisible">
                                    <img src="'. $row["img"] .'" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3><a href="detail.html">' . $row["title"] . '</a></h3>
                                    <p class="price">' . '$' . $row["price"]/100 . '</p>
                                    <p class="buttons">
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#productMenModal' . $id . '">View Detail</button>
                                        <a href="basket.php?buy='. $id .'" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </p>
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>             
        '; 
    }
}//End else if                         

else if($category_name == 'Italian'){
    $product_array = $dbc->query("SELECT * FROM recipes WHERE type='Italian' ORDER BY id ASC LIMIT 12");
    while($row = $product_array->fetch_assoc()) {

        $id = $row['id'];//Set $id = product. This will be passed through the URL.

    echo '                    
                            <div id="productMenModal' . $id . '" class="modal fade" role="dialog">
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">' . $row["title"] .'</h4>
                                  </div>
                                  <div class="modal-body">
                                    <p>'. $row["description"] .'</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>

                              </div>
                            </div>




                            <div class="col-md-4 col-sm-6">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="detail.html">
                                                <img src="'. $row["img"] .'" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="detail.html">
                                                <img src="'. $row["img"] .'" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="detail.html" class="invisible">
                                    <img src="'. $row["img"] .'" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3><a href="detail.html">' . $row["title"] . '</a></h3>
                                    <p class="price">' . '$' . $row["price"]/100 . '</p>
                                    <p class="buttons">
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#productMenModal' . $id . '">View Detail</button>
                                        <a href="basket.php?buy='. $id .'" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </p>
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>             
        '; 
    }
}//End else if                         

else if($category_name == 'Mexican'){
    $product_array = $dbc->query("SELECT * FROM recipes WHERE type='Mexican' ORDER BY id ASC LIMIT 12");
    while($row = $product_array->fetch_assoc()) {

        $id = $row['id'];//Set $id = product. This will be passed through the URL.

    echo '                    
                            <div id="productMenModal' . $id . '" class="modal fade" role="dialog">
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">' . $row["title"] .'</h4>
                                  </div>
                                  <div class="modal-body">
                                    <p>'. $row["description"] .'</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>

                              </div>
                            </div>




                            <div class="col-md-4 col-sm-6">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="detail.html">
                                                <img src="'. $row["img"] .'" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="detail.html">
                                                <img src="'. $row["img"] .'" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="detail.html" class="invisible">
                                    <img src="'. $row["img"] .'" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3><a href="detail.html">' . $row["title"] . '</a></h3>
                                    <p class="price">' . '$' . $row["price"]/100 . '</p>
                                    <p class="buttons">
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#productMenModal' . $id . '">View Detail</button>
                                        <a href="basket.php?buy='. $id .'" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </p>
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>             
        '; 
    }
}//End else if                         

else if($category_name == 'American'){
    $product_array = $dbc->query("SELECT * FROM recipes WHERE type='American' ORDER BY id ASC LIMIT 12");
    while($row = $product_array->fetch_assoc()) {

        $id = $row['id'];//Set $id = product. This will be passed through the URL.

    echo '                    
                            <div id="productMenModal' . $id . '" class="modal fade" role="dialog">
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">' . $row["title"] .'</h4>
                                  </div>
                                  <div class="modal-body">
                                    <p>'. $row["description"] .'</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>

                              </div>
                            </div>




                            <div class="col-md-4 col-sm-6">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="detail.html">
                                                <img src="'. $row["img"] .'" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="detail.html">
                                                <img src="'. $row["img"] .'" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="detail.html" class="invisible">
                                    <img src="'. $row["img"] .'" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3><a href="detail.html">' . $row["title"] . '</a></h3>
                                    <p class="price">' . '$' . $row["price"]/100 . '</p>
                                    <p class="buttons">
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#productMenModal' . $id . '">View Detail</button>
                                        <a href="basket.php?buy='. $id .'" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </p>
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>             
        '; 
    }
}//End else if                         

else{
    echo 'Sorry, that category is no longer being offered on our site. For further information, ask us on our Social Media or email support';
}
?>
                    </div>
                    <!-- /.products -->
                    <div class="pages">

                        <p class="loadMore">
                            <a href="#" class="btn btn-primary btn-lg"><i class="fa fa-chevron-down"></i> Load more</a>
                        </p>

                        <ul class="pagination">
                            <li><a href="#">&laquo;</a>
                            </li>
                            <li class="active"><a href="#">1</a>
                            </li>
                            <li><a href="#">&raquo;</a>
                            </li>
                        </ul>
                    </div>


                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->

<?php
include('./includes/footer.html');
?>