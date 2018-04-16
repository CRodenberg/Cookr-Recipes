<?php
    require('./includes/config.inc.php');
    require('./includes/connect.php');
    require(MYSQL); 

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $id_query = "SELECT * from users";
    $id_result = mysqli_query($db, $id_query);
    $id = mysqli_num_rows($id_result);

    $query = "INSERT INTO `users`(`username`, `email`, `date_created`, `id`, `password`) VALUES ('$username', '$email', '9999-12-31', $id, '$password')";

    // Perform Query
    $result = mysqli_query($db, $query);

    // Check result
    // This shows the actual query sent to MySQL, and the error. Useful for debugging.
    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }
    
    

?>