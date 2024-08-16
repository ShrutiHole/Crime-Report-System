<?php
include ("config.php");
$result=mysqli_query($mysqli,"SELECT* from user ORDER by id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="function .php" method="POST">
        name<input type="text" name="name"><br>
        email<input type="email" name="email"><br>
        mobile<input type="mobile" name="mobile"><br>
        date<input type="date" name="date"><br>
        <input type="submit" name="submit"><br>

    </form>
    <table>
    <?php
  while($res=mysqli_fetch_array($result)){
      echo '<tr>';
echo '<td>'.$res['name'].'</td>';

      echo '</tr>';

  }
    ?>
    </table>
</body>
</html>