<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nurse</title>
    <link rel="stylesheet" href="css/all.min.css" >
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/style-nurse.css" >
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
            <a class="active" href="./nurse.html">Nurse</a>
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
		<h1>Welcome MSS <span><?= session()->get('userName')?></span></h1>
        </div>
      </div>
    </div>
    </section>
    <!-- End Landing Page -->

    <!-- Start Detection -->
  <section class="detection">
    <div class="container">
			  <table >
				<thead>
				  <th>Id</th>
				  <th>patient name</th>
				  <th>department name</th>
				  <th>doctor name</th>
				  <th class="entered">Actions</th>
   			  </thead>
<?php
		foreach($nurseTable as $nt){
?>
<div id='t'>
				<tr>
				  <td>02</td>
				  <td><?= $nt['patientName']?></td>
				  <td><?= $nt['departmentName']?></td>
				  <td><?= $nt['doctorName']?></td>
				  <td>
				  <a  class="done" value="<?= $nt['waitListId']?>"><button  class="btn btn-primary">Done</button></a>
				  <a class="absent" value="<?= $nt['waitListId']?>" ><button  class="btn btn-danger">Absent</button></a>
				  </td>        
				</tr>
</div>
<?php }?>
			  </table>
    </div>
  </section>
  <!-- End Detection -->

  <script src="./js/plugin-nurse.js" type="module"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

				<script>
$(document).ready(function(){
    $(".done").on("click", function(){
			var doneID = $(this).attr("value");
			if(doneID == ''){
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
			url:"<?= base_url().'/nurse'?>",
			type:"post",
			datatype:"json",
			data:{
				waitListIdDone:doneID
},
		success:function(data){
				console.log(data);
		 swalWithBootstrapButtons.fire(
			  'Deleted!',
			  'Your file has been deleted.',
			  'success'
			)
		setTimeout(() => {
		location.reload()
		},"2500");

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


$(document).ready(function(){
    $(".absent").on("click", function(){
			var absentID = $(this).attr("value");
			if(absentID== ''){
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
			url:"<?= base_url().'/nurse'?>",
			type:"post",
			datatype:"json",
			data:{
				waitListIdAbsent:absentID
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
