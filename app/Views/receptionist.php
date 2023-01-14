<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receptionist</title>
    <link rel="stylesheet" href="css/all.min.css" >
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/style-receptionist.css" >
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
          <a class="active" href="./receptionist.html">Receptionist</a>
        </li>

        <div class="log-out">
          <a href='logOut' ><button>Log out</button></a>
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
      <form method='post' action='receptionist'>
<!--        <div class="forgot">
          <input type="text" placeholder="name">
          <div class="custom-date">
            <span>Birth Of Date</span>
            <input type="date">
          </div>
		  </div>
-->
        <input type="text" name="patientId" placeholder="national id">
        <select name="department" id="departments">
          <option>Departments</option>
          <option value="Heart">Heart</option>
          <option value="Heart">the teeth</option>
          <option value="Heart">General Surgery</option>
        </select>
		<select name="doctor">
          <option>Doctors</option>
          <option value="Heart">Heart</option>
          <option value="Heart">the teeth</option>
          <option value="Heart">General Surgery</option>
        </select>

      <button type="submit">Submit</button>
     </form>
<!--      <button class="forgot-btn">Forgot your national id</button> -->
<!--
      <div class="counter">
        <span class="number">25</span>
        <p class="person">person</p>
        <p class="department">department: <span>heart</span></p>
      </div>
-->	
	</div>
  </section>
  <!-- End Detection -->

  <!-- Start Bookings -->
  <section class="bookings">
    <div class="container">
      <h2>Booking</h2>
      <table>
        <thead>
          <th>Id</th>
          <th>patient name</th>
          <th>department name</th>
          <th>doctor name</th>
          <th>Remove</th>
        </thead>
        <tr>
          <td>01</td>
          <td>mostafa</td>
          <td>Heart</td>
          <td>Ali</td>
          <td><button class="btn btn-danger">Delete</button></td>
        </tr>
        <tr>
          <td>02</td>
          <td>ahmed</td>
          <td>Heart</td>
          <td>Mohamed</td>
          <td><button class="btn btn-danger">Delete</button></td>
        </tr>
      </table>
    </div>
  </section>
  <!-- End Bookings -->

    <!-- <script src="./js/bootstrap.min.js"></script> -->
  <script src="./js/plugin-receptionist.js" type="module"></script>
</body>
</html>
