<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pharmacist</title>
    <link rel="stylesheet" href="css/all.min.css" >
    <link rel="stylesheet" href="css/style-pharmacist.css" >
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
          <a class="active" href="./pharmacist.html">pharmacist</a>
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
	<h1>Welcome <span><?= session()->get('userName')?></span></h1>
      </div>
    </div>
  </div>
  </section>
  <!-- End Landing Page -->

  <!-- Start Detection -->
  <section class="detection">
    <div class="container">
      <h2>Examination Id</h2>
      <form method='post' action='pharmacist'>
      <input type="text" name="examId" id="examinationId">
      <button type="submit">Search</button>
    </form>
    </div>
  </section>
  <!-- End Detection -->

  <!-- Start Examination -->
<?php
if(isset($data)){
?>
<section class="examination">
    <div class="container">
      <h2>The Examination</h2>
      <div class="exam-box">
        <table>
          <thead>
            <th>patient name</th>
            <th>age</th>
            <th>date</th>
            <th>doctor name</th>
            <th>detection</th>
          </thead>
<?php
foreach( $data as $exam){?>
        <tr>
	      <td><?= $exam['patientName'] ?></td>
	      <td><?= $exam['patientAge'] ?></td>
	      <td><?= $exam['date'] ?></td>
	      <td><?= $exam['doctorName'] ?></td>
          <td>
<?php foreach($exam['prescriptions'] as $prescription ){?>
            <ul>
			<li><?=$prescription['prescriptionName']?></li>
            </ul>
<?php }?>
          </td>
		</tr>
<?php }
}else if(isset($error))
{
	echo '<h1 style="text-align:center; color:red;">'.$error .'</h1>';
}
?>
        </table>
      </div>
    </div>
  </section>
  <!-- End Examination -->

  <script src="./js/plugin-pharmacist.js" type="module"></script>
</body>
</html>
