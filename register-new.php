<?php
    require('./includes/config.inc.php');
    require(MYSQL); 

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $query = "INSERT INTO `users`(`username`, `email`, `date_created`, 'id', `password`) VALUES ('JohnDoe', 'd@gmail.com', '9999-12-31', 5, '1234')";

    // Perform Query
    $result = mysqli_query($query);

    // Check result
    // This shows the actual query sent to MySQL, and the error. Useful for debugging.
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }
    
    

?>