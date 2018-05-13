<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

include('util.php');


$api_map = array(
    'get_users' => 'get_users', // input: q

    'add_comment' => 'add_comment', // comment, user_id
    'get_comments_to_user_id' => 'get_comments_to_user_id', // user_id
    'add_vote_user' => 'add_vote_user' // to_user_id, by_user_id, vote_level, vote_type
);





$api_map[$_GET['api_req']]();

function get_users() {
    $q = $_GET['q'];
    if (empty($q)) {
        echo json_encode("query is empty");
        return;
    }
    $query = "select * from `user` WHERE  `name` like '%" . $q ."%' or `email` like '%" . $q ."%' limit 0, 10 ";
    echo json_encode(query_to_array($query));
    return;
}


function get_comments_to_user_id() {
    $user_id = $_GET['user_id'];
    if (empty($user_id)) {
        echo json_encode("user_id is empty");
        return;
    }
    $query = "select * from `comments` WHERE to_user_id order by date desc";
    echo json_encode(query_to_array($query));
    return;
}

function add_vote_user() {
    $by_user_id = $_GET['by_user_id'];
    $to_user_id = $_GET['to_user_id'];
    $vote_type  = $_GET['vote_type'];
    $vote_level  = $_GET['vote_level'];
    
    if (empty($vote_level) || empty($vote_type) || empty($by_user_id) || empty($to_user_id)) {
        echo json_encode(" empty value recieved ");
        return ;
    }

    $sql = "select * from user_vote where by_user_id = {$by_user_id} && to_user_id = {$to_user_id}";
    $data = query_to_array($sql);
    
    if (count($data) > 0) {
        $id = $data[0]['id'];

        $update_sql = "update user_vote set vote_type = {$vote_type} , vote_level = ${vote_level} where id = {$id}";
        $res = mysqli_query(get_connection(), $update_sql);
        if ($res) {
            echo json_encode('updated');
        } else {
            echo json_encode('error updating');
        }
    } else {
        $insert_sql = "insert into user_vote (by_user_id, to_user_id, vote_type, vote_level) values({$by_user_id}, {$to_user_id}, {$vote_type}, {$vote_level} )";
        echo $insert_sql;
        $res = mysqli_query(get_connection(), $insert_sql);
        if ($res) {
            echo json_encode('inserted');
        } else {
            echo json_encode('error inserting');
        }
    }

}

function add_comment() {
    $comment = $_GET['comment'];
    $by_user_id = $_GET['by_user_id'];
    $to_user_id = $_GET['to_user_id'];

    if (empty($comment) || empty($by_user_id) || empty($to_user_id)) {
        echo json_encode("user_id or comment is empty ");
        return ;
    }

    $query = "insert into comments (comment, by_user_id, to_user_id)
                     values ('{$comment}', {$by_user_id}, {$to_user_id}) ";
    $q = mysqli_query(get_connection(), $query);

    if ($q) {
        $id = mysqli_insert_id(get_connection());
        echo json_encode($id);
    } else {
        echo json_encode("can not add comment");
    }
}

