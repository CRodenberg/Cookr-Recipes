<?php
$user = 'root';
$pass = 'pw';
$db = 'testdb';

$db = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");
?>