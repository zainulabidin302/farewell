<?php include("util.php"); ?>
<?php 
    $query = "select * from `user`";
    $users = query_to_array($query);

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
<div class="row">        <?php foreach ($users as $user) : ?>

            <div class="col-xs-1 col-sm-1 col-md-6 col-lg-4" style="margin-top: 10px;">
                <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="images/14024020016.jpg" alt="Card image cap">
                        <div class="card-body">
                                    <h5 class="card-title"><?php echo $user['name']; ?></h5>
                                    <p class="card-text"><?php echo $user['email']; ?></p>

                                    <i class="fas fa-heart fa-2x" style="color: red;"></i>
                                    <i class="far fa-heart fa-2x"></i>

                                    <i class="fas fa-thumbs-up fa-2x" style="color: blue;"></i>
                                    <i class="far fa-thumbs-up fa-2x"></i>
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
                                
                                
                                <?php foreach(get_comments($user) as $comment): ?>
                                    <li class="list-group-item"><?php echo $comment['comment'] ?> <span class="badge badge-primary badge-pill pull-right"><?php echo $comment['name'] ?></span> 
                                    <!--user icon in two different styles-->
                                    <i class="fas fa-heart" style="color: red;"></i>
                                    <i class="far fa-heart"></i>

                                    <i class="fas fa-thumbs-up" style="color: blue;"></i>
                                    <i class="far fa-thumbs-up"></i>
  
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
        </div>

    

            <?php endforeach; ?>
        </div></div>
       

    












    <?php include("footer.php"); ?>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="js/init.js" type="text/javascript"></script>
    <script src="js/login.js" type="text/javascript"></script>  
    <script src="js/diary.js" type="text/javascript"></script>    
</div>
</body>
</html>
