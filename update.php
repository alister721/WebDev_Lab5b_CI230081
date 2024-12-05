<?php  
  require ('db.php');
  include('authUser.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Update</title>
  </head>
  <body>
    
  <?php 
  //  echo $_GET['id'];
  //  echo $userId;
    $userId = $_GET['id'];
    if(isset($_POST['submit'])){
      $matric = $_POST['matric'];
      $name = $_POST['name'];
      $role = $_POST['role'];
      $sqlUpdate = $con->prepare("UPDATE `users` SET `matric` = (?),`name` = (?),`role` = (?) WHERE `id` = (?)");
      $sqlUpdate->bind_param("ssss",$matric,$name,$role,$userId);
      $sqlUpdate->execute();
      // $resultSqlUpdate = $sqlUpdate->get_result();  
      if($sqlUpdate->execute()){
        echo 
          '<script>
            alert("Update Successful");
            window.location.href = "display.php";
          </script>';
      }else{
        echo 
          '<script>
            alert("Fail to Update Data, Please try again.");
            window.location.href = "display.php";
          </script>';
      }
    }else{
    ?>
<?php 
    $sqlUserData = $con->prepare("SELECT * FROM `users` WHERE id = (?)");
    $sqlUserData->bind_param("i",$userId);
    $sqlUserData->execute();
    $resultSqlUserData = $sqlUserData->get_result();
    while ($tableResultSqlUserData = $resultSqlUserData->fetch_assoc()) {
?>
    <form action="update.php?id=<?php echo $userId; ?>" method="POST">
      Matric:<input type="text" name="matric" value="<?php echo $tableResultSqlUserData['matric'] ?>" required><br>
      Name:<input type="text" name="name"value="<?php echo $tableResultSqlUserData['name'] ?>" required><br>
      <?php if ($tableResultSqlUserData['role'] == "student"){ ?>
        Access Level:<select name="role">
        <option value="select" disabled>Please select</option>
        <option value="teacher">Teacher</option>
        <option value="student" selected>Student</option>
        </select>
      <?php }else{ ?>
        Access Level:<select name="role">
        <option value="select" disabled>Please select</option>
        <option value="teacher" selected>Teacher</option>
        <option value="student">Student</option>
        </select>
      <?php } ?>
      <br>
      <input type="submit" value="Update" name="submit">
      <a href="display.php">Cancel</a>
    </form>
    <?php } ?>
  </body>
  <?php } ?>
</html>
