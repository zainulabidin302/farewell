<?php
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
