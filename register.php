<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register Page</title>
</head>
<body>
  <?php 

  require('db.php');

  if(isset($_POST['submit'])){
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sqlRegister = $con->prepare("INSERT INTO `users` (`matric`,`name`,`password`,`role`) VALUES ((?),(?),(?),(?))");
    $sqlRegister->bind_param("ssss",$matric,$name,$password,$role);
    $sqlRegister->execute();
    $resultSqlRegister = $sqlRegister->get_result();

    if($sqlRegister){
      echo '<script>
        alert("Register Successful");
        window.location.href = "register.php";
      </script>';
    }else{
      echo '<script>
        alert("Fail to Register,Please try again.");
        window.location.href = "register.php";
      </script>';
    }
  }else{

?>
    <form action="register.php" method="POST">
      Matric:<input type="text" name="matric" required><br>
      Name:<input type="text" name="name" required><br>
      Password:<input type="password" name="password" required><br>
      Role:<select name="role">
        <option value="select" disabled selected>Please select</option>
        <option value="teacher">Teacher</option>
        <option value="student">Student</option>
      </select><br>
      <input type="submit" value="Submit" name="submit">
    </form>
</body>

<?php 
  }
?>
</html>
