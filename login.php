<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
</head>
<body>
  <?php 

  require('db.php');
  session_start();

  if(isset($_POST['submit'])){
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    $sqlLogin = $con->prepare("SELECT * FROM `users` WHERE `matric` = (?) AND `password` = (?)");
    $sqlLogin->bind_param("ss",$matric,$password);
    $sqlLogin->execute();
    $resultSqlLogin= $sqlLogin->get_result();
    $rowResultQueryCheckLogin = mysqli_num_rows($resultSqlLogin);

    if($rowResultQueryCheckLogin){
      echo '<script>
        alert("Login Successful");
        window.location.href = "display.php";
      </script>';
      while($rowUser = $resultSqlLogin->fetch_assoc()){
        $_SESSION['id'] = $rowUser['id'];
      }
    }else{
      echo '<script>
        alert("Incorrect Matric or Password, Please try again.");
        window.location.href = "login.php";
      </script>';
    }
  }else{

?>
    <form action="login.php" method="POST">
      Matric:<input type="text" name="matric" required><br>
      Password:<input type="password" name="password" required><br>
      <input type="submit" value="Login" name="submit">
    </form>
    <br>
    <a href="register.php">Register</a> here if you have not.
</body>

<?php 
  }
?>
</html>
