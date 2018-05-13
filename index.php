<?php include ('util.php'); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Farewell Diaries</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

</head>
<body >
  <div class="main">

      <?php include("include.php")?>
        <div class="clearfix"></div>

        <article>
          <h1>Farewell Diaries</h1>
          <p>Make the Farewell moments memorable by adding your heartly comments for your beloved friends</p>
            <div>
                <form action="">
                    <input id="search" type="text" placeholder="Enter a Name or Email (e.g Abdullah or 140240xxxxx@umt.edu.pk)">
                </form>
            </div>


            <div id="result">
            </div>



        </article>
        <?php include("footer.php"); ?>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/init.js" ></script>
    <script type="text/javascript" src="js/login.js"></script>
</body>
</html>
