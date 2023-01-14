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
<?php
	echo view('header');
?> 
 <!-- End Header -->

  <!-- Start Landing Page -->
  <div class="landing">
    <div class="container">
      <div class="text">
        <h1>Welcome Dr <span>Ali Ahmed</span></h1>
      </div>
    </div>
  </div>
  </section>
  <!-- End Landing Page -->

  <!-- Start Detection -->
  <section class="detection">
    <div class="container">
      <form>
      <table>
        <thead>
          <th>Id</th>
          <th>patient name</th>
          <th>age</th>
          <th>examination</th>
        </thead>
        <tr>
          <td>01</td>
          <td>ahmed hassan</td>
          <td>30</td>
          <td><input class="valid" type="text"></td>
        </tr>
      </table>

      <button type="submit">Submit</button>
    </form>
    </div>
  </section>
  <!-- End Detection -->

  <script src="./js/plugin-doctor.js" type="module"></script>
</body>
</html>
