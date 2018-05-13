<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

include ('lib.php');

$api_map = array(
    'get_users' => 'get_users', // input: q
    'add_comment' => 'add_comment', // comment, user_id
    'get_comments_to_user_id' => 'get_comments_to_user_id', // user_id
    'add_vote_user' => 'add_vote_user', // to_user_id, by_user_id, vote_level, vote_type
    'activate_email' => 'activate_email'
);

$api_map[$_GET['api_req']]();
