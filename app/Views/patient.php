<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient</title>
    <link rel="stylesheet" href="css/all.min.css" >
    <link rel="stylesheet" href="css/style-patient.css" >
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
        <a class="active" href="./patient.html">Patient</a>
      </li>
      <div class="log-out">
        <a href="logOut"><button>Log out</button></a>
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

<!-- Start Report -->
<section class="report">
  <div class="container">
    <h2>the report</h2>
    <div class="exam-box">
      <table>
        <thead>
          <th>doctor name</th>
          <th>doctor department</th>
          <th>hospital name</th>
          <th>date</th>
          <th>detection</th>
        </thead>

<?php
if(isset($data)){
foreach( $data as $exam){?>
        <tr>
	      <td><?= $exam['doctorName'] ?></td>
	      <td><?= $exam['departmentName'] ?></td>
	      <td><?= $exam['hospitalName'] ?></td>
	      <td><?= $exam['date'] ?></td>
          <td>
<?php foreach($exam['prescriptions'] as $prescription ){?>
            <ul>
			<li><?=$prescription['prescriptionName']?></li>
            </ul>
<?php }?>
          </td>
		</tr>
<?php }}?>
      </table>
    </div>
  </div>
</section>
<!-- End Report -->

  <script src="./js/plugin-patient.js" type="module"></script>
</body>
</html>
