<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>
<body>
    <?php 
        require('db.php');
        session_start();
        if (!isset($_SESSION["id"])) {
          echo '<script>
              swal({
                  title: "Something went wrong.",
                  text: "Please proceed to login first.",
                  type: "error",
                  showConfirmButton: true
              }, function(){
                  window.location.href = "login.php";
              });
          </script>';
          exit; // Stop further execution of the script
      } 
      ?>
</body>
</html>