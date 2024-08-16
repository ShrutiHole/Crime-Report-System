<!DOCTYPE html>
<html>
<head>
	<title>Police completed complaint</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="register.css">
     <?php
    session_start();
    if(!isset($_SESSION['x']))
        header("location:policelogin.php");
     
    $conn=mysqli_connect("localhost","root","","crime_portal");
    if(!$conn)
    {
        die("could not connect".mysqli_error());
    }
    mysqli_select_db($conn,"crime_portal");
      
    
    $p_id=$_SESSION['pol'];
     $result=mysqli_query($conn,"SELECT c_id,type_crime,d_o_c,location,mob,u_addr FROM complaint natural join user where p_id='$p_id' and pol_status='ChargeSheet Filed' order by c_id desc");
    ?>

</head>
<body style="background-image: url(cseries.jpg);
background-size:repeat;
background-position: center;">>
<nav>
  <div class="logo"><b>crime portal</b></div>
         <div class="container">
           <div class="menu">
           <a href="home.html"><i class="fa fa-home"></i> official login</a> 
             <a href="#"><i class="fa fa-user"></i>police home</a> 
             <a href="#"><i class="fa fa-file"></i>pending complaint</a> 
             <a href="completed_complaints.html"><i class="fa fa-file-text"></i>completed complaint</a> 
             <a href="#"><i class="fa fa-sign-out"></i>log out &nbsp</a> 
           </div>
         </div>
        </nav>
    
    
    
 <div style="padding:50px;margin-top:5%;">
   <table class="table table-bordered">
    <thead class="thead-dark" style="background-color: black; color: white;">
      <tr>
        <th scope="col">Complaint Id</th>
        <th scope="col">Type of Crime</th>
        <th scope="col">Date of Crime</th>
          <th scope="col">Location of Crime</th>
          <th scope="col">Complainant Mobile</th>
          <th scope="col">Complainant Address</th>
        
      </tr>
    </thead>

<?php
      while($rows=mysqli_fetch_assoc($result)){
    ?> 

    <tbody style="background-color: white; color: black;">
      <tr>
        <td><?php echo $rows['c_id']; ?></td>
        <td><?php echo $rows['type_crime']; ?></td>     
        <td><?php echo $rows['d_o_c']; ?></td>   
        <td><?php echo $rows['location']; ?></td>
          <td><?php echo $rows['mob']; ?></td>
          <td><?php echo $rows['u_addr']; ?></td>
                  
      </tr>
    </tbody>
    
    <?php
    } 
    ?>
  
</table>
 </div>

 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
 <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>