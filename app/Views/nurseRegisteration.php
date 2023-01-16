<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Pharmacist</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/all.min.css" >
    <link rel="stylesheet" href="css/style-home.css" >
    <link rel="stylesheet" href="css/animate.css" >
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon" />

    <style>
    .registration {
      padding: 90px 0;
      position: relative;
    }
    .registration h1 {
      color: #333;
      font-weight: bold;
      margin-bottom: 35px;
    }
    .registration form {
      text-align: center;
    }
    .registration form input, .custom-file   {
      display: block;
      width: 50%;
      margin: 20px auto;
      padding: 8px 7px;
      border: 2px solid #ddd;
      outline: none;
      border-radius: 3px;
      font-size: 17px;
    }
    .registration form input::placeholder{
      text-transform: capitalize;
    }
    .registration form input:focus {
      border: 2px solid var(--mainColor);
    }
    .registration form button[type="submit"] {
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
    .registration form button[type="submit"]:hover {
      background-color: var(--secondColor);
      color: #fff;
    }

    /* Start Create Choose File */
    .custom-file input[type="file"] {
      width: 100%;
      height: 100%;
      opacity: 0;
      position: absolute;
      top: -20px;
      right: -9px;
      z-index: 6;
      width: 120px;
    }
    .custom-file span {
      position: absolute;
      color: #777;
      left: 5px;
    }
    .custom-file::after {
      content: "Upload";
      background-color: var(--mainColor);
      width: 100px;
      height: 38px;
      color: #fff;
      padding: 5px 10px;
      position: absolute;
      top: -1px;
      right: -1px;
      line-height: 30px;
      text-align: center;
    }
    .custom-file::after:hover {
      background-color: var(--secondColor);
    }
    @media (max-width: 767.98px) {
      .registration h1 {
        font-size: 25px;
      }
      .registration form input, .registration form button[type="submit"], .custom-file {
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
    <div class="registration">
      <h1 class="text-center">Patient Registration </h1>
      <div class="container">
 <?php 
			  if(isset($failed)):?>
							<p class="alert alert-danger">
								<?php echo $failed;?>
							</p>
                <?php
					endif;?>
        <form action="nurseRegisteration" method='post' enctype="multipart/form-data">
<?php
                    if(isset($registBefore)):
                        ?>
							<p class="alert alert-danger">
								<?php echo $registBefore;?>
							</p>
                <?php
					endif;?>
 
<?php
                    if(isset($validation)):
                        if($validation->hasError('nurseId')):?>
							<p class="alert alert-danger">
								<?php echo $validation->getError('nurseId');?>
							</p>
                <?php
                        endif;
					endif;?> 

            <input type="text" name='nurseId' placeholder="national id" value=<?= set_value('nurseId')?>>
<?php
                    if(isset($inValidIdImage)):
                        ?>
							<p class="alert alert-danger">
								<?php echo $inValidIdImage;?>
							</p>
                <?php
					endif;?>
              <input type="file" name='idImage'>
<?php
                    if(isset($validation)):
                        if($validation->hasError('firstName')):?>
							<p class="alert alert-danger">
								<?php echo $validation->getError('firstName');?>
							</p>
                <?php
                        endif;
					endif;?>
            <input type="text" name='firstName' placeholder="first Name" value=<?= set_value('firstName')?>> 
<?php
                    if(isset($validation)):
                        if($validation->hasError('lastName')):?>
							<p class="alert alert-danger">
								<?php echo $validation->getError('lastName');?>
							</p>
                <?php
                        endif;
					endif;?>
            <input type="text" name='lastName' placeholder="last Name" value=<?= set_value('lastName')?>> 
<?php
                    if(isset($validation)):
                        if($validation->hasError('phone')):?>
							<p class="alert alert-danger">
								<?php echo $validation->getError('phone');?>
							</p>
                <?php
                        endif;
					endif;?>
            <input type="text" name='phone' placeholder="phone" value=<?= set_value('phone')?>> 
<?php
                    if(isset($validation)):
                        if($validation->hasError('address')):?>
							<p class="alert alert-danger">
								<?php echo $validation->getError('address');?>
							</p>
                <?php
                        endif;
					endif;?>
            <input type="text" name='address' placeholder="address" value=<?= set_value('address')?>> 
<?php
                    if(isset($validation)):
                        if($validation->hasError('dateOfBrith')):?>
							<p class="alert alert-danger">
								<?php echo $validation->getError('dateOfBrith');?>
							</p>
                <?php
                        endif;
					endif;?>
            <input type="date" name='dateOfBirth' value=<?= set_value('dateOfBrith')?>>
<?php
                    if(isset($inValidPersonalPhoto)):
                        ?>
							<p class="alert alert-danger">

								<?php echo $inValidPersonalPhoto;?>
							</p>
                <?php
					endif;?>
             <input type="file" name='personalPhoto' value=<?= set_value('personalPhoto')?>>
<?php
                    if(isset($inValidPersonalPhoto)):
                        ?>
							<p class="alert alert-danger">

								<?php echo $inValidPersonalPhoto;?>
							</p>
                <?php
					endif;?>
             <input type="file" name='professionLicense' value=<?= set_value('professionLicense')?>>
<?php
                    if(isset($inValidProfessionLicense)):
                        ?>
							<p class="alert alert-danger">

								<?php echo $inValidProfessionLicense;?>
							</p>
                <?php
					endif;?>
           	<input type="text" name='hospitalId' placeholder="Hospital Id" value=<?= set_value('hospitalId')?>> 
           	<input type="text" name='departmentId' placeholder="Department Id" value=<?= set_value('departmentId')?>> 

<?php
                    if(isset($validation)):
                        if($validation->hasError('password')):?>
							<p class="alert alert-danger">
								<?php echo $validation->getError('password');?>
							</p>
                <?php
                        endif;
					endif;?>
           	<input type="text" name='password' placeholder="password" value=<?= set_value('password')?>> 
<?php
                    if(isset($validation)):
                        if($validation->hasError('confirmPassword')):?>
							<p class="alert alert-danger">
								<?php echo $validation->getError('confirmPassword');?>
							</p>
                <?php
                        endif;
					endif;?>
            <input type="text" name='confirmPassword' placeholder="confirm password" value=<?= set_value('confirmPassword')?>> 

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
