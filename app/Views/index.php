<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/all.min.css" >
    <link rel="stylesheet" href="css/style-home.css" >
    <link rel="stylesheet" href="css/animate.css" >
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon" />
</head>
<body>

    <!-- Start Header -->
    <section class="header">
      <nav>
      <div class="container">
        <div class="logo">
          <a href="/"><img src="./images/logo-en-black.svg" alt=""></a>
        </div>
        <ul class="main-links">
          <li>
            <a class="active" href="/">Home</a> 
          </li>
          <li>
            <a href="#about">About</a>
          </li>
          <li>
            <a href="#contact">Contact</a>
          </li>
        </ul>
        <i class="fa-solid fa-user-large" style="left: 74%; top: -1%;"></i>
        <i class="fa-sharp fa-solid fa-bars"></i>        
      </div>
    </nav>
    <!-- End Header -->
    
    <!-- Start Landing Page -->
    <div class="landing">
      <div class="container">
        <div class="text">
          <h1>Welcome to <span>the Egyptian Ministry of Health</span></h1>
        </div>
        <div class="btn">
          <button class="reg" data-popup=".reg-popup">Registration</button>
          <button class="log" data-popup=".log-popup">Log In</button>
        </div>

        <!-- Start popup Registration -->
        <div class="popup reg-as-popup">
          <div class="inner">
            <i class="fa-solid fa-xmark"></i>
            <h2>Registration As a ... </h2>
            <div class="reg-box">
              <div class="person patient" data-person="patient">
                <span>Patient</span>
                <a href="patientRegisteration">
                  <img src="./images/patient-reg.png" >
                </a>
              </div>
              <div class="person doctor" data-person="doctor">
                <span>Doctor</span>
                <a href="doctorRegisteration">
                  <img src="./images/doctor-reg.png">
                </a>
              </div>
              <div class="person nurse" data-person="nurse">  
                <span>Nurse</span>
                <a href="nurseRegisteration">
                  <img src="./images/nurse-reg.png" >
                </a>
              </div>
              <div class="person pharmacist" data-person="pharmacist">  
                <span>Pharmacist</span>
                <a href="pharmacistRegisteration">
                  <img src="./images/pharmacist-reg.png" >
                </a>
              </div>
              <div class="person receptionist" data-person="receptionist">  
                <span>Receptionist</span>
                <a href="receptionistRegiseration">
                  <img src="./images/receptionist-reg.png" >
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- End popup Registration -->

        <!-- Start popup Login -->
        <div class="popup log-as-popup">
          <div class="inner">
            <i class="fa-solid fa-xmark"></i>
            <h2>Login As a ... </h2>
            <div class="reg-box">
              <div class="person patient" data-person="patient">
                <span>Patient</span>
                <a href="patientLogin">
                  <img src="./images/patient-reg.png" >
                </a>
              </div>

              <div class="person doctor" data-person="doctor">
                <span>Doctor</span>
                <a href="doctorLogin">
                  <img src="./images/doctor-reg.png">
                </a>
              </div>
              <div class="person nurse" data-person="nurse">  
                <span>Nurse</span>
                <a href="nurseLogin">
                  <img src="./images/nurse-reg.png" >
                </a>
              </div>
              <div class="person pharmacist" data-person="pharmacist">  
                <span>Pharmacist</span>
                <a href="pharmacistLogin">
                  <img src="./images/pharmacist-reg.png" >
                </a>
              </div>
              <div class="person receptionist" data-person="receptionist">  
                <span>Receptionist</span>
                <a href="receptionistLogin">
                  <img src="./images/receptionist-reg.png" >
                </a>
              </div>
			<div class="person patient" data-person="patient">
                <span>Admin</span>
                <a href="adminLogin">
                  <img src="./images/patient-reg.png" >
                </a>
              </div>

            </div>
          </div>
        </div>
        <!-- End popup Login -->

<!-- 
          <div class="popup reg-popup">
            <div class="inner">
              <i class="fa-solid fa-xmark"></i>
                <form>
                  <i class="fa-solid fa-user-large"></i>
                  <label for="">First Name</label>
                  <input type="text">
                  <i class="fa-solid fa-user-large"></i>
                  <label for="">Last Name</label>
                  <input type="text">
                  <i class="fa-regular fa-credit-card"></i>
                  <label for="">National ID</label>
                  <input type="text">
                  <i class="fa-regular fa-credit-card"></i>
                  <label for="">Na</label>
                  <input type="text">
                  <i class="fa-regular fa-credit-card"></i>
                  <label for="">Na</label>
                  <input type="text">
                  <i class="fa-regular fa-credit-card"></i>
                  <label for="">Na</label>
                  <input type="text">
                  <input type="submit" value="Save">
                </form>
              </div>
            </div> -->

          <!-- <div class="popup log-as-popup">
            <div class="inner">
            <i class="fa-solid fa-xmark"></i>
            <form>
              <i class="fa-regular fa-credit-card"></i>
              <label for="">National ID</label>
                <input type="text">
                <input type="submit" value="Save">
              </form>
          </div>
        </div> -->

          
          <!-- <div class="popup log-popup">
            <div class="inner">
            <i class="fa-solid fa-xmark"></i>
            <form>
              <i class="fa-regular fa-credit-card"></i>
              <label for="">National ID</label>
                <input type="text">
                <input type="submit" value="Save">
              </form>
          </div>
        </div> -->
      
        <div class="the-down text-center">
          <i class="fas fa-arrow-circle-down"></i>
        </div>
      </div>
    </div>
  </section>
  <!-- End Landing Page -->

  <!-- Start About -->
  <section class="about" id="about">
    <div class="container">
      <div class="desc">
        <h2>About</h2>
        <p>People targeted by our system to help them</p>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-6">
          <div class="about-box wow fadeInDown" data-wow-duration="1s" data-wow-offset="300" data-wow-delay="">
            <i class="fa-solid fa-wheelchair"></i>
            <h4>Patient</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis dicta neque eaque quasi saepe id eius earum nobis est corporis.</p>
          </div>
        </div>
        <div class="col-sm-12 col-md-6">
          <div class="about-box wow fadeInDown" data-wow-duration="1s" data-wow-offset="300" data-wow-delay=".3s">
            <i class="fa-solid fa-user-doctor"></i>
            <h4>Doctor</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis dicta neque eaque quasi saepe id eius earum nobis est corporis.</p>
          </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4">
          <div class="about-box wow fadeInLeft" data-wow-duration="1s" data-wow-offset="300" data-wow-delay=".5s">
            <i class="fa-solid fa-user-nurse"></i>
            <h4>Nurse</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis dicta neque eaque quasi saepe id eius earum nobis est corporis.</p>
          </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4">
          <div class="about-box wow fadeInUp" data-wow-duration="1s" data-wow-offset="300" data-wow-delay=".5s">
            <i class="fa-regular fa-rectangle-list"></i>
            <h4>Receptionist</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis dicta neque eaque quasi saepe id eius earum nobis est corporis.</p>
          </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4">
          <div class="about-box wow fadeInRight" data-wow-duration="1s" data-wow-offset="300" data-wow-delay=".5s">
            <i class="fa-solid fa-capsules"></i>
            <h4>Pharmacist</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis dicta neque eaque quasi saepe id eius earum nobis est corporis.</p>
          </div>
        </div>
    </div>
    </div>
  </section>
  <!-- End About -->

  <!-- Start Contact -->
  <section class="contact" id="contact">
    <div class="container">
      <h2>Contact</h2>
      <form>
        <div class="row">
          <div class="col-md-6">
            <label for="name">Your Name <span>*</span></label>
            <input type="text" id="name">
    
            <label for="nationalId">National Id<span>*</span></label>
            <input type="text" id="nationalId">
    
            <label for="phone">Phone <span>*</span></label>
            <input type="tel" id="phone">

            <label for="address">Address <span>*</span></label>
            <input type="text" id="address">

            <label for="subject">You Are ... <span>*</span></label>
            <select name="" id="" >
              <option value="">Patient</option>
              <option value="">Doctor</option>
              <option value="">Nurse</option>
              <option value="">Receptionist</option>
              <option value="">Pharmacist</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="textArea">Your Message <span>*</span></label>
            <textarea name="textArea" id="textArea" cols="30" rows="10"></textarea>
            <input type="submit" value="Send">
          </div>
        </div>

      </form>
    </div>
  </section>
  <!-- End Contact -->


  <!-- <script src="./js/bootstrap.min.js"></script> -->
  <script src="./js/plugin-home.js" ></script>
  <script src="js/wow.min.js"></script>
  <script> new WOW().init();</script>
</body>
</html>
