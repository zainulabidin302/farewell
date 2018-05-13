<?php

$conn = mysqli_connect("localhost", "root", "000000", "farewelldiaries");


if ($_GET['api_req'] == 'diary') {

    $query = "select * from user";

    $q = mysqli_query($conn, $query);
    $data = [];
    while($row = mysqli_fetch_assoc($q)) {
        $data[] = $row;
    }

    echo json_encode($data);
}

