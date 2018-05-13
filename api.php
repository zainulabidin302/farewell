<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

include('util.php');
require('PHPMailer.php');


$api_map = array(
    'get_users' => 'get_users', // input: q
    'add_comment' => 'add_comment', // comment, user_id
    'get_comments_to_user_id' => 'get_comments_to_user_id', // user_id
    'add_vote_user' => 'add_vote_user', // to_user_id, by_user_id, vote_level, vote_type
    'activate_email' => 'activate_email'
);


use PHPMailer\PHPMailer\PHPMailer;

$api_map[$_GET['api_req']]();


function activate_email() {
    global $BASE_URL;

    $email = $_GET['email'] ;
    if (empty($email)) {
        echo json_encode('error');
        return;
    }
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 25;
    $mail->SMTPAuth = true;
    $mail->Username = 'ahmedaliumtian@gmail.com';
    $mail->Password = 'account?service=mail&continu';
    $mail->setFrom('umtian@umt.edu.pk', 'UMTIAN');
    $mail->addReplyTo('no-reply@email.com', 'UMTIAN');
    $mail->addAddress($email, 'UMT User');
    $mail->Subject = 'Login Activation Link | Sent from Farewell Diaries';
    $html = "<h3>Please click on the following link to login directly.</h3>";
    $hash = md5(generatePIN());
    $html .= "<a href='{$BASE_URL}activate.php?activation_hash={$hash}' style='width: 120px; height: 60px; background-color: #4442213; border-color: 1px solid white; border-radius: 10;'>Login</a>";

    $mail->msgHTML($html);
    $mail->AltBody = $html;

    $query = "update user set activation_hash = '{$hash}' where email = '{$email}'";
    $q = mysqli_query(get_connection(), $query);

    if (!$mail->send()) {
        echo json_encode(array('error' => $mail->ErrorInfo));
    } else {
        echo json_encode(array('done' => 'ok'));
    }

}

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
    $query = "select * from `comments` 
    left join user on user.id = comments.by_user_id
    where comments.to_user_id = {$user_id} order by date desc";
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

