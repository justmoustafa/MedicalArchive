<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Receptionist</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/all.min.css" >
    <link rel="stylesheet" href="css/style-home.css" >
    <link rel="stylesheet" href="css/animate.css" >
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon" />

    <style>
    .login {
      padding: 90px 0;
      position: relative;
    }
    .login h1 {
      color: #333;
      font-weight: bold;
      margin-bottom: 35px;
    }
    .login form {
      text-align: center;
    }
    .login form input {
      display: block;
      width: 50%;
      margin: 20px auto;
      padding: 8px 7px;
      border: 2px solid #ddd;
      outline: none;
      border-radius: 3px;
      font-size: 17px;
    } 
    .login form input::placeholder{
      text-transform: capitalize;
    }
    .login form input:focus {
      border: 2px solid var(--mainColor);
    }
    .login form button[type="submit"] {
      width: 50%;
      display: block;
      background-color: var(--mainColor);
      color: var(--secondColor);
      border: none;
      outline: none;
      font-size: 17px;
      font-weight: bold;
      padding: 12px 20px; 
      margin: 35px auto;
      cursor: pointer;
      transition: 0.3s;
      -webkit-transition: 0.3s;
      -moz-transition: 0.3s;
      -ms-transition: 0.3s;
      -o-transition: 0.3s;
      border-radius: 6px;
      -webkit-border-radius: 6px;
      -moz-border-radius: 6px;
      -ms-border-radius: 6px;
      -o-border-radius: 6px;
    }
    .login form button[type="submit"]:hover {
      background-color: var(--secondColor);
      color: #fff;
    }
    @media (max-width: 767.98px) {
      .login form input, .login form button[type="submit"] {
        width: 95%;
      } 
    } 
    </style>
</head>
<body>

    <!-- Start Header -->
      <nav style="background-color: #777;">
      <div class="container">
        <div class="logo">
          <a href="./index.html"><img src="./images/logo-en-black.svg" alt=""></a>
        </div>
        <ul class="main-links">
          <li>
            <a class="active" href="./index.html">Home</a> 
          </li>
          <li>
            <a href="./index.html?x=83&y=70#about">About</a>
          </li>
          <li>
            <a href="index.html?x=83&y=70#contact">Contact</a>
          </li>
        </ul>
        <i class="fa-sharp fa-solid fa-bars"></i>        
      </div>
    </nav>
    <!-- End Header -->
    
    <!-- Start Landing Page -->
    <div class="login">
      <h1 class="text-center">Login</h1>
      <div class="container">
		 <form action="adminLogin" method="post">
			<?php
                    if(isset($validation)):
                        if($validation->hasError('id')):?>
							<p class="alert alert-danger">
								<?php echo $validation->getError('id');?>
							</p>
                <?php
                        endif;
					 endif;
					if(isset($userNotExist)):?>
							<p class="alert alert-danger">
								<?php echo $userNotExist;?>				</p>
							</p>
                <?php
					 endif; ?>


            <input type="text" name='id' placeholder="national id">
				<?php
                    if(isset($validation)):
                        if($validation->hasError('password')):?>
							<p class="alert alert-danger">
								<?php echo $validation->getError('password');?>
							</p>
                <?php
                        endif;
					 endif; 
					if(isset($wrongPassword)):?>
							<p class="alert alert-danger">
								<?php echo $wrongPassword;?>				</p>
                <?php
					 endif; ?>


            <input type="password" name="password" placeholder="password">
 
            <button type="submit">Submit</button>
        </form>
      </div>
    </div>
    <!-- End Landing Page -->

  <!-- <script src="./js/bootstrap.min.js"></script> -->
  <script src="./js/plugin-reg-all.js" ></script>
  <script src="js/wow.min.js"></script>
  <script> new WOW().init();</script>
</body>
</html>
