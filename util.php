<?php
session_start();
$CURRENT_USER = null;
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    $CURRENT_USER = unserialize($_SESSION['user']);
}
$BASE_URL = "http://localhost/FarewellDir/";
$conn = mysqli_connect("localhost", "root", "000000", "farewelldiaries");
function get_connection() {
    global $conn;
    return $conn;
}
function query_to_array($query) {
    $q = mysqli_query(get_connection(), $query);
    $data = [];
    while($row = mysqli_fetch_assoc($q)) {
        $data[] = $row;
    }
    return $data;
}

function generatePIN($digits = 9){
    $i = 0; //counter
    $pin = ""; //our default pin is blank.
    while($i < $digits){
        //generate a random number between 0 and 9.
        $pin .= mt_rand(0, 9);
        $i++;
    }
    return $pin;
}
?>