<?php include('lib.php'); ?>
<?php 
define('HEART', 1);
define('LIKE', 2);

    $query = "SELECT user.*, user_vote.by_user_id, user_vote.vote_level, user_vote.vote_type FROM `user` LEFT JOIN user_vote ON user.id = user_vote.to_user_id ";
    if (isset($_GET['id']))
    {
        $query .= " WHERE user.id = {$_GET['id']}";
    }
    $users = query_to_array($query);
    $new_users = [];
    foreach ($users as $user ) {
        $new_users[$user['id']]['user']  = $user;
        $new_users[$user['id']]['votes'][] = array('by_user_id' => $user['by_user_id'], 
                                            'vote_level' => $user['vote_level'],
                                            'vote_type' => $user['vote_type']) ;
    }
    
    function get_comments($user) {
        
        $query = "select * from `comments` 
        left join user on user.id = comments.by_user_id
        where to_user_id = {$user['id']} order by date desc";
        

        return query_to_array($query);
    }


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/diary.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">


</head>
<body>
    <div class="main">
    <?php include("include.php"); ?>

    <div class="row"></div>
    <div class="clearfix"></div>
    <div class="container">
<div class="row">        <?php $comments = []; foreach ($new_users as $tmp) :
$user = $tmp['user'];
$user['votes'] = $tmp['votes'];
 
        ?>

            <div class="col-xs-1 col-sm-1 col-md-6 col-lg-4" style="margin-top: 10px;">
                <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="images/14024020016.jpg" alt="Card image cap">
                        <div class="card-body">
                                    <h5 class="card-title"><?php echo $user['name']; ?></h5>
                                    <p class="card-text"><?php echo $user['email']; ?></p>
                                    <?php if ($CURRENT_USER != null): ?>
                                        <!-- <i class="fas fa-heart fa-2x" style="color: red;"></i> -->
                                        <?php 
                                            $heart_class = 'far';
                                            $like_class = 'far';
                                            
                                            $total_likes = 0;
                                            $total_hearts = 0;

                                            foreach($user['votes'] as $vote) {
                                                if ($vote['vote_type'] == HEART && $vote['vote_level'] == 1) $total_hearts++;
                                                if ($vote['vote_type'] == LIKE && $vote['vote_level'] == 1) $total_likes++;
                                                
                                                if ($vote['by_user_id'] == $CURRENT_USER['id']) {
                                                    if ($vote['vote_type'] == HEART && $vote['vote_level'] == 1) {
                                                        $heart_class = 'fas';
                                                        
                                                    }
                                                    if ($vote['vote_type'] == LIKE && $vote['vote_level'] == 1) {
                                                        $like_class = 'fas';
                                                    }
                                                } 
                                            }
                                        ?>
                                        <i class="<?php echo $heart_class ?> fa-heart fa-2x add_user_vote" data-to-user-id="<?php echo $user['id']; ?>" data-by-user-id="<?php echo $CURRENT_USER['id']; ?>"  data-type="<?php echo HEART; ?>"></i>

                                        <!-- <i class="fas fa-thumbs-up fa-2x" style="color: blue;"></i> -->
                                        <i class="<?php echo $like_class ?> fa-thumbs-up fa-2x add_user_vote" data-to-user-id="<?php echo $user['id']; ?>" data-by-user-id="<?php echo $CURRENT_USER['id']; ?>"  data-type="<?php echo LIKE; ?>" ></i>
                                    <?php endif; ?>
                                    <i class="heart-count"><?php echo $total_hearts ?></i> <i class="fas fa-heart" style="color: red;"></i> | <i class="like-count"><?php echo $total_likes ?></i> <i class="fas fa-thumbs-up" style="color: blue;"></i> 
                                </div>
                                <?php if ($CURRENT_USER != null): ?>
                                <form action="" style="display: inline;">   
                                    
                                    <div class="input-group">
                                    <input type="text"  name="comment" class="form-control" aria-label="Text input with segmented dropdown button">
                                    <input type="hidden" name="to_user_id" value="<?php echo $user['id']; ?>" >     
                                    <input type="hidden" name="by_user_id" value="<?php echo $CURRENT_USER['id']; ?>" >     
                                    <div class="input-group-append">
                                            <input type="submit" 
                                                class="btn btn-outline-secondary add-comment" 
                                            value="Comment">
                                    </div>
                                    
                                    </div>
                                    </form>
                                    <?php endif; ?>
                            
                            <ul class="list-group">
                                
                                
                                <?php $comments[] = get_comments_to_user_id(true, $user['id']); ?>
                            </ul>
                        </div>
        </div>

    

            <?php endforeach; ?>
        </div></div>
       














    <?php include("footer.php"); ?>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script type="text/javascript" >
        var GLOBAL_COMMENTS_DATA_DIARY_PHP = <?php echo json_encode($comments); ?>;
    </script>
    <script src="js/init.js" type="text/javascript"></script>
    <script src="js/login.js" type="text/javascript"></script>  
    <script src="js/diary.js" type="text/javascript"></script>    

</div>
</body>
</html>
