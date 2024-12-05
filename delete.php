<?php
require('db.php');
include('authUser.php');
if(isset($_GET['id'])){

    $userId=$_GET['id'];

    $sqlDelete = $con->prepare("DELETE FROM `users` WHERE id =(?)");
    $sqlDelete->bind_param("i",$userId);
    $sqlDelete->execute();
    if($sqlDelete){
            echo
            '<script>
                    alert("Deleted Successfully");
                    window.location.href = "display.php";
            </script>';
    }else{
        echo
            '<script>
                    alert("Fail to Delete, Please Try Again.");
                    window.location.href = "display.php";
            </script>';
    }
}
?>