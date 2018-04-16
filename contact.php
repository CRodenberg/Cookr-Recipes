<?php
require('./includes/config.inc.php');
require(MYSQL);
include('./includes/header.html');
?>

    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a>
                        </li>
                        <li>Contact</li>
                    </ul>

                </div>

                <div class="col-md-3">
                    <!-- *** PAGES MENU ***
 _________________________________________________________ -->
                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">Pages</h3>
                        </div>

                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked">
                                <li>
                                    <a href="text.php">About Us</a>
                                </li>
                                <li>
                                    <a href="faq.php">FAQ</a>
                                </li>

                            </ul>

                        </div>
                    </div>

                    <!-- *** PAGES MENU END *** -->
                </div>

                <div class="col-md-9">


                    <div class="box" id="contact">
                        <h1>Contact</h1>

                        <p class="lead">Are you curious about something? Do you have some kind of problem with our products?</p>
                        <p>Please feel free to contact us, our customer service center is working for you 24/7.</p>

                        <hr>

                        <div class="row">
                            <div class="col-sm-4">
                                <h3><i class="fa fa-map-marker"></i> Address</h3>
                                <p>2001 Newburg Rd.
                                    <br>Louisville
                                    <br>Kentucky
                                    <br>40205
                                    <br>
                                    <strong>United States</strong>
                                </p>
                            </div>
                            <!-- /.col-sm-4 -->
                            <div class="col-sm-4">
                                <h3><i class="fa fa-phone"></i> Call center</h3>
                                <p class="text-muted">This number is toll free if calling from United States otherwise we advise you to use the electronic form of communication.</p>
                                <p><strong>555 555-5555</strong>
                                </p>
                            </div>
                            <!-- /.col-sm-4 -->
                            <div class="col-sm-4">
                                <h3><i class="fa fa-envelope"></i> Electronic support</h3>
                                <p class="text-muted">Please feel free to write an email to us.</p>
                                <ul>
                                    <li><strong><a href="mailto:">info@cookr.com</a></strong>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.col-sm-4 -->
                        </div>
                        <!-- /.row -->

                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="map">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3134.733677247946!2d-85.70503318404126!3d38.216079379681595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88690c956d55f9cf%3A0x2e8cab892263874c!2sOwsley+B.+Frazier+Stadium%2C+2001+Newburg+Rd%2C+Louisville%2C+KY+40205!5e0!3m2!1sen!2sus!4v1523315171246" width=100%; height=100% frameborder="0" style="border:0" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>


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