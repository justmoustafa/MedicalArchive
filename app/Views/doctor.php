<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor</title>
    <link rel="stylesheet" href="css/all.min.css" >
    <link rel="stylesheet" href="css/style-doctor.css" >
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;700&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon" />
</head>
<body>

  <!-- Start Header -->
  <section class="header">
		<nav>
			<div class="container">
			  <div class="logo">
				<a href="./index.html"><img src="./images/logo-en-black.svg" alt=""></a>
			  </div>
			  <ul class="main-links">
				<li>
				  <a href="./index.html">Home</a> 
				</li>
				<li>
				  <a class="active" href="./doctor.html">Doctor</a>
				</li>

				<div class="log-out">
				  <a href='logOut'><button>Log out</button></a>
				</div>
			  </ul>
			  <i class="fa-sharp fa-solid fa-bars"></i>        
			  
			</div>
		  </nav>
		  
		<!-- End Header -->

  <!-- Start Landing Page -->
  <div class="landing">
    <div class="container">
      <div class="text">
	  <h1>Welcome Dr <span><?=session()->get('userName');?></span></h1>
      </div>
    </div>
  </div>
  </section>
  <!-- End Landing Page -->

  <!-- Start Detection -->
  <section class="detection">
    <div class="container">
<?php
	foreach($doctorTable as $dt){
?>
      <form action="doctor" method="post">
			  <table>
				<thead>
				  <th>patient name</th>
				  <th>age</th>
				  <th>examination</th>
				</thead>
				<tr>
				<td><?= $dt['patientName']?></td>
				<td><?= $dt['patientAge']?></td>
				  <td><input name='presc' class="valid" type="text">
					<input name="waitListId" value="<?= $dt['waitListId'] ?>" style="display:none">
</td>
				</tr>
			  </table>

      <button type="submit">Submit</button>
	</form>
		<?php }
?>
    </div>
  </section>
  <!-- End Detection -->

  <script src="./js/plugin-doctor.js" type="module"></script>
</body>
</html>
