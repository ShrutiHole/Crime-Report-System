<!DOCTYPE html>
<html>
<head>
	<title>Complainer Home Page</title>

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

	<link href="register.css" rel="stylesheet" type="text/css" media="all" />
	<?php
    session_start();
    if(!isset($_SESSION['x']))
        header("location:inchargelogin.php");
    
    $con=mysqli_connect('localhost','root','','crime_portal');
    if(!$con)
    {
        die('could not connect: '.mysqli_error());
    }
     mysqli_select_db($con,"crime_portal");
    
    $i_id=$_SESSION['email'];

    $result1=mysqli_query($con,"SELECT location FROM police_station where i_id='$i_id'");
      
    $q2=mysqli_fetch_assoc($result1);
    $location=$q2['location'];
    
if(isset($_POST['s'])){
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $p_name=$_POST['police_name'];
        $p_id=$_POST['police_id'];
        $spec=$_POST['police_spec'];
        $p_pass=$_POST['password'];

    $reg="insert into police values('$p_name','$p_id','$spec','$location','$p_pass')";
    
        $res=mysqli_query($con,$reg);
        if(!$res)
         {
          $message = "User already Exists.";
          echo "<script type='text/javascript'>alert('$message');</script>";
        }
        else
        {
          $message = "Police Added Successfully";
          echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
}
?>
    
     <script>
     function f1()
    {
      var sta=document.getElementById("pname").value;
      var sta1=document.getElementById("pid").value;
      var sta2=document.getElementById("pspec").value;
      var sta3=document.getElementById("pas").value;
      var x=sta.trim();
      var x1=sta1.indexOf(' ');
      var x2=sta2.trim();
      var x3=sta3.indexOf(' ');
  if(sta!="" && x==""){
    document.getElementById("pname").value="";
    document.getElementById("pname1p").focus();
      alert("Space Not Allowed");
        }
        
         else if(sta1!="" && x1>=0){
    document.getElementById("pid").value="";
    document.getElementById("pid").focus();
      alert("Space Not Allowed");
        }
        else if(sta2!="" && x2==""){
    document.getElementById("pspec").value="";
    document.getElementById("pspec").focus();
      alert("Space Not Allowed");
        }
        else if(sta3!="" && x3>=0){
    document.getElementById("pas").value="";
    document.getElementById("pas").focus();
      alert("Space Not Allowed");
        }      
}
</script>
</head>

<body style="background-size: cover;
    background-image: url(cap.jpg);
    background-position: center;">
	<header>
        <nav>
          <div class="logo"><b>crime portal</b></div>
         <div class="container">
           <div class="menu">
           <a href="home.html"><i class="fa fa-home"></i> official login</a> 
             <a href="#"><i class="fa fa-user"></i>incharge home</a> 
             <a href="incharge_complain_page.php"><i class="fa fa-file"></i> Complaint history</a> 
           
             <a href="#"><i class="fa fa-sign-out"></i>log out</a> 
           </div>
         </div>
        </nav>
       </header>
      
       <div class="video" style="margin-top: 5%"> 
      
	<div class="center-container">
  
		 <div class="bg-agile">
     
			<br><br>
   
			<div class="login-form"><p><h2>Log Police Officer</h2></p><br>	
				<form action="#" method="post" style="color: black">Police Name
					<input type="text"  name="police_name" placeholder="Police Name" required="" id="pname" onfocusout="f1()"/>
					Police Id<input type="text"  name="police_id" placeholder="Police Id" required="" id="pid" onfocusout="f1()"/>
                    Specialist<input type="text"  name="police_spec" placeholder="Specialist" id="pspec" required onfocusout="f1()"/>
                    
                    Location of Police Officer<input type="text" required  name="location">
          <br>
					Password<input type="text"  name="password" placeholder="Password" id="pas" onfocusout="f1()" required/>
					<input type="submit" value="Submit" name="s">
				</form>	
			</div>	
		</div>
	</div>	
</div>	
</div>

 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
 <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>