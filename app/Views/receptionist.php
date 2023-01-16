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
<?php
					if(session()->getFlashdata('success') !== null):?>
							<p class="alert alert-danger">
								<?= session()->getFlashdata('success');?>			
							</p>
                <?php
					 endif; ?>
<?php
					if(session()->getFlashdata('userNotExist') !== null):?>
							<p class="alert alert-danger">
								<?= session()->getFlashdata('userNotExist');?>			
							</p>
                <?php
					 endif; ?>





        <input type="text" name="patientId" placeholder="national id">
       
        <select name="department" id="departments">
<?php
		foreach($departmentsNames as $d){
?>		   
		<option><?=$d ?></option>
<?php } ?>
		  </select>
		<select id='doctors' name="doctor">
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
<?php
		foreach($receptionistTable as $rt){
?>
        <tr>
          <td>01</td>
		  <td><?= $rt['patientName']?></td>
		  <td><?= $rt['departmentName']?></td>
		  <td><?= $rt['doctorName']?></td>
          <td><a class="del" value="<?= $rt['waitListId']?>" ><button  class="btn btn-danger">Delete</button></a></td>
		</tr>
<?php }?>
              </table>
    </div>
  </section>
 <!-- End Bookings -->

    <!-- <script src="./js/bootstrap.min.js"></script> -->
  <script src="./js/plugin-receptionist.js" type="module"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function(){
    $("#departments").on("input", function(){
		departmentName =$("#departments").val();
		$.ajax({
			url:"<?= base_url().'/receptionist'?>",
			type:"get",
			datatype:"json",
			data:{
				department:departmentName
},
		success:function(data){
				data = JSON.parse(data);
				data.forEach(function(e){
						$("#doctors").empty();
						$("#doctors").append("<option>"+e+"</option>");
				});}

		});
	});		
});					
$(document).ready(function(){
    $(".del").on("click", function(){
			var delID = $(this).attr("value");
			if(delID == ''){
				alert('There is no specified ID');
			}else{
			const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger mr-3'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {

		$.ajax({
			url:"<?= base_url().'/deleteFromReception'?>",
			type:"post",
			datatype:"json",
			data:{
				waitListId:delID
},
		success:function(data){
 swalWithBootstrapButtons.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
setTimeout(() => {
location.reload()
},"2500")

																		}
		 });


   
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
});
			}
	});
});
</script>
</body>
</html>
