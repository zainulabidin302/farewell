<?php include("util.php"); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/diary.css">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous"> -->
</head>
<body>
    <div class="main">
    <?php include("include.php"); ?>

    <div class="card-container">
        <?php 
        $query = "select * from `user`";
        $users = query_to_array($query);


        foreach ($users as $user) : ?>
        
            <div class="card">
                <div class="status">
                    public
                </div>

                <div class="icons"></div>

                <div class="image-div">
                    <img src="images/14024020016.jpg" alt="">
                </div>

                <div class="name-div">
                    <h3><?php echo $user['name']; ?></h3>
                </div>
                <div class="email-div">
                    <h4><?php echo $user['email']; ?></h4>
                </div>
                <div class="form-div">
                    <form action="">
                    <input type="text">
                    <input type="submit" value="comment">
                    </form>
                </div>
                <div class="button" id="button1">
                    <a href="#">Message</a>
                </div>
                <div class="button">
                    <a href="#">Call</a>
                </div>
                <div class="comments-container">        
                    <?php 
                    $query = "select * from `comments` left join user on comments.by_user_id = user.id WHERE to_user_id = {$user['id']} order by date desc";
                    $comments = query_to_array($query);
                    foreach($comments as $comment): ?>
                    
                        <div class="comment">
                            <?php echo $comment['name'] ?>: <?php echo $comment['comment'] ?> 
                            <button >Love it</button>
                            <button >Like it</button>
                        </div>

                    <?php endforeach; ?>
                    

                </div>
        </div>

        <?php endforeach; ?>
        </div>
        <div class="clearfix"></div>
        
        
        <?php include("footer.php"); ?>
    </div>
</body>
</html>
