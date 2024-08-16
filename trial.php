<!DOCTYPE html>
<html>
<head>
	<title>Police pending complain</title>
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
    if(isset($_POST['s2']))
    {
      if($_SERVER["REQUEST_METHOD"]=="POST")
      {
       $cid=$_POST['cid'];
       $_SESSION['cid']=$cid;
       $alok=mysqli_query($conn,"SELECT p_id FROM complaint WHERE c_id='$cid'");
       $row = mysqli_fetch_assoc($alok);
       $p_id=$_SESSION['pol'];
     if($row['p_id']==$p_id){
     header("location:police_complainDetails.php");}
     else{
         $message = "searching";
        echo "<script type='text/javascript'>alert('$message');</script>";
     }
 }
}
    
    $p_id=$_SESSION['pol'];
     $result=mysqli_query($conn,"SELECT c_id,type_crime,d_o_c,location FROM complaint where p_id='$p_id' and pol_status='In Process' order by c_id desc");
    ?>
 <script>
     function f1()
        {
        var sta2=document.getElementById("ciid").value;
        var x2=sta2.indexOf(' ');
      if(sta2!="" && x2>=0){
          document.getElementById("ciid").value="";
          alert("Blank Field Found");
        }
}
</script>
</head>
<body style="background-image:(cutout.jpg);
background-size=cover;">
	<nav>
  <div class="logo"><b>crime portal</b></div>
         <div class="container">
           <div class="menu">
           <a href="home.html"><i class="fa fa-home"></i> official login</a> 
             <a href="police_complainDetails.php"><i class="fa fa-file"></i>view complaints</a> 
             <a href="completed_complaints.php"><i class="fa fa-file-text"></i>completed complaint</a> 
             <a href="#"><i class="fa fa-sign-out"></i>log out &nbsp</a> 
           </div>
         </div>
        </nav>
 
    
    <form style="margin-top: 7%; margin-left: 40%;" method="post">
    <input type="text" name="cid" style="width: 250px; height: 30px; background-color:white; color:grey; margin-top:5px;" placeholder="&nbsp Complaint Id" onfocusout="f1()" required id="ciid">
        <div>
     <a href="home.php"> <input class="btn btn-primary" type="submit" value="Search" name="s2" style="margin-top: 10px; margin-left: 11%;"></a>
        </div>
    </form>
    
 <div style="padding:50px;">
   <table class="table table-bordered">
    <thead class="thead-dark" style="background-color: black; color: white;">
      <tr>
        <th scope="col">Complaint Id</th>
        <th scope="col">Type of Crime</th>
        <th scope="col">Date of Crime</th>
        <th scope="col">Location of Crime</th>
        
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
<!DOCTYPE html>
<html>
<head>
    
    <?php
    
    if(!isset($_SESSION['x']))
        header("location:policelogin.php");
    $conn=mysqli_connect("localhost","root","","crime_portal");
    if(!$conn)
    {
        die("could not connect".mysqli_error());
    }
    mysqli_select_db($conn,"crime_portal");
    
    $cid=$_SESSION['cid'];
    $p_id=$_SESSION['pol'];    
    
    $query="select c_id,type_crime,d_o_c,description,mob,u_addr from complaint natural join user where c_id='$cid' and p_id='$p_id'";
    $result=mysqli_query($conn,$query);  
    
    if(isset($_POST['status'])){
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            $upd=$_POST['update'];
            $qu1=mysqli_query($conn,"insert into update_case(c_id,case_update) values('$cid','$upd')");
        }
    }
    
    if(isset($_POST['close'])){
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            $up=$_POST['final_report'];
            $qu2=mysqli_query($conn,"insert into update_case(c_id,case_update) values('$cid','$up')");
            $q2=mysqli_query($conn,"update complaint set pol_status='ChargeSheet Filed' where c_id='$cid'");
           
        }
    }
     $res2=mysqli_query($conn,"select d_o_u,case_update from update_case where c_id='$cid'");
    
    ?>

	<title>Incharge Homepage</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="register.css">
<script>
     function f1()
        {
        var sta2=document.getElementById("ciid").value;
        var x2=sta2.indexOf(' ');
        if(sta2=="" && x2>=0){
          document.getElementById("ciid").value="";
          alert("Blank FIeld Not Allowed");
        }
      }
    </script>
</head>


 
<div style="padding:50px; margin-top:10px;">
   <table class="table table-bordered">
    <thead class="thead-dark" style="background-color: black; color: white;">
    <tr>
      <th scope="col">Complaint Id</th>
      <th scope="col">Type of Crime</th>
      <th scope="col">Date of Crime</th>
      <th scope="col">Description</th>
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
        <td><?php echo $rows['description']; ?></td>
        <td><?php echo $rows['mob']; ?></td>
        <td><?php echo $rows['u_addr']; ?></td>
      </tr>
       </tbody>
       <?php
} 
?>
          
</table>
 </div>
    
<div style="padding:50px; margin-top:8px;">
   <table class="table table-bordered">
        <thead class="thead-dark" style="background-color: black; color: white;">
    <tr>
      <th scope="col">Date Of Update</th>
      <th scope="col">Case Update</th>
    </tr>
       </thead>
      <?php
              while($rows1=mysqli_fetch_assoc($res2)){
             ?> 
       <tbody style="background-color: white; color: black;">
    <tr>
        
      <td><?php echo $rows1['d_o_u']; ?></td>
      <td><?php echo $rows1['case_update']; ?></td>
        
        
    </tr>
       </tbody>
       <?php
} 
?>
          
</table>
 

  <div style="width: 100%; height: 250px;"> 
    
    <div style="width: 50%;float: left;height: 250px; background-color: #dcdcdc"> 
     
     <form method="post">
    
      <h5 style="text-align: center;"><b>Complaint ID</b></h5>                 
      <input type="text" name="cid" style="margin-left: 47%; width: 50px;" disabled value="<?php echo "$cid" ?>">
    
      <select class="form-control" style="align-content: center;margin-top: 20px; margin-left: 35%; width: 180px;" name="update">
          <option>Criminal Verified</option>
          <option>Criminal Caught</option>
          <option>Criminal Interrogated</option>
          <option>Criminal Accepted the Crime</option>
          <option>Criminal Charged</option>
      </select>

      <input class="btn btn-primary btn-sm" type="submit" value="Update Case Status" name="status" style="margin-top: 10px; margin-left: 40%;">
        
    </form>
    </div>     
     <div style="width: 50%;float: right;height: 250px; background-color: #dfdfdf;">
     <form method="post">
     <textarea name="final_report" cols="40" rows="5" placeholder="Final Report" style="margin-top: 20px;margin-left: 20px;" id="ciid" onfocusout="f1()" required></textarea>
     <div>
      <input  class="btn btn-danger" type="submit" value="Close Case" name="close" style="margin-left: 20px; margin-top: 10px; margin-bottom:20px;">
       </div> 
    </form>
  </div>
</div>
 </div>
    <div style="position: relative;
    float: left;
    margin-bottom: 0px;
   left: 0;
   bottom: 0;
   width: 100%;
   height: 30px;
   background-color: rgba(0,0,0,0.8);
   color: white;
   text-align: center;">
  <h4 style="color: white;">&copy <b>Contact us at</b></h4>
</div> 

 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
 <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>