<?php
//This file is the home page
require('./includes/config.inc.php');
require(MYSQL);
include('./includes/header.html');
?>

<div id="all">

        <div id="content">

            <div class="container">
                <div class="col-md-3">
                    <!-- *** MENUS AND FILTERS ***
                    _________________________________________________________ -->
                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Categories</h3>
                        </div>

                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked category-menu">
                                <li id = "men_tab">
                                    <a href="category.php?id=Diet">Diet</a>
                                    <ul>
                                        <li><a href="category.php?id=Protein">Protein</a>
                                        </li>
                                        <li><a href="category.php?id=Vegetables">Vegetables</a>
                                        </li>
                                        <li><a href="category.php?id=Meat">Meat</a>
                                        </li>
                                        <li><a href="category.php?id=Gluten-Free">Gluten-Free</a>
                                        </li>
                                    </ul>
                                </li>
                                <li id = "women_tab">
                                    <a href="category.php?id=Country">Country</a>
                                    <ul>
                                        <li><a href="category.php?id=Italian">Italian</a>
                                        </li>
                                        <li><a href="category.php?id=Mexican">Mexican</a>
                                        </li>
                                        <li><a href="category.php?id=American">American</a>
                                        </li>
                                        <li><a href="category.php?id=German">German</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="carousel-wrapper">
                        <div class="search-bar" id="search-wrap">
                            <form class="carousel-form" action="category.php" role="search">
                                <div class="input-group" id = "carousel-search">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <span class="input-group-btn" id="homeSearch">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <div id="main-slider">
                            <div class="item">
                                <img src="img/main-slider1.jpg" alt="" class="img-responsive">
                            </div>
                            <div class="item">
                                <img class="img-responsive" src="img/main-slider2.jpg" alt="">
                            </div>
                            <div class="item">
                                <img class="img-responsive" src="img/main-slider3.jpg" alt="">
                            </div>
                            <div class="item">
                                <img class="img-responsive" src="img/main-slider4.jpg" alt="">
                            </div>
                        </div>
                        <!-- /#main-slider -->
                    </div>
                </div>
            </div>

            <!-- *** ADVANTAGES END *** -->
        </div>
        <!-- /#content -->
<?php
include('/includes/footer.html');
?>