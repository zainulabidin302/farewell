<?php 
include('util.php');
$hash = $_GET['activation_hash'];

$query = "select * from `user` where activation_hash = '{$hash}'";
$user = query_to_array($query);

if (count($user) > 0) {
    $_SESSION['logged_in'] = 1;
    $_SESSION['user'] = serialize($user[0]);  
    header('Location: index.php');
    exit;
} else {
    echo '<h3>Sorry User not found! To request addition of your email, send us your email and photo
        at ahmedaliumtian@gmail.com from your umt email id.</h3>';
}