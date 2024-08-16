<?php

session_start();
if(!isset($_SESSION['u_id']))
{
    header("location:headlogin.php");
}
?>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<div class="container">
    <div class="row">
        <div class="col-md-12">
            
           
        
        <?php
         $p_id=$_SESSION['pol'];
         $result=mysqli_query($conn,"SELECT c_id,type_crime,d_o_c,location,mob,u_addr FROM complaint natural join user where p_id='$p_id' and pol_status='ChargeSheet Filed' order by c_id desc");
         while($rows=mysqli_fetch_assoc($result)){
       ?>
</div>
</div>
</div>
<?php } ?>
         </body>
         </html>

