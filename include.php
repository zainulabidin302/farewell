<header>
    <div>
        <a href="index.php">Search</a>
        <a href="diary.php">Diary</a>
    </div>

    <div class="right-align" >

    <?php if ($CURRENT_USER == null) : ?>
        <a href="#" id="login-btn">Login</a>
    <?php else: ?>
        <span style="color: white;">Logged in as <?php echo $CURRENT_USER['email']; ?></span>
        <span><a href="logout.php">Logout</a></span>
    <?php endif ?>
        
        
    </div>
</header>
<div>

<div class="card " id="login-box" style="display:none; position: absolute;right: 0;top: 0;z-index:10;">
  <div class="card-header">
    Login
  </div>
  <div class="alert alert-primary alert-activate" style="display: none;" role="alert">
    Check your email for login link.
    </div>

  <div class="alert alert-danger alert-error" style="display: none;" role="alert">
    Can not send email. Please try again.
    </div>

    <div class="alert alert-warning alert-loading" style="display: none;" role="alert">
    Sending email, Just a second ...
    </div>
    
  <div class="card-body">
    <h5 class="card-title">Enter you University Email ID:</h5>
    <p class="card-text">
    <div class="input-group mb-3">
  <input type="text" class="form-control" id="login-input" placeholder="Umt batch 24 id" aria-label="Recipient's username" aria-describedby="basic-addon2">
  <div class="input-group-append">
    <span class="input-group-text" id="basic-addon2">@umt.edu.pk</span>
  </div>
</div>
    </p>
    <a href="#" class="btn btn-primary" id="login-activate" style="color: white;">Get Login Link</a>
    <a href="#" class="btn btn-danger" id="login-cancel" style="color: white;">Close</a>
  </div>
</div>

