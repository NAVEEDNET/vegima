<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login1.php');
};

if(isset($_POST['send'])){

   
   $msg = $_POST['msg'];
  

   $select_message = $conn->prepare("SELECT * FROM `reply` WHERE  message = ?");
   $select_message->execute([ $msg]);

   if($select_message->rowCount() > 0){
      $message[] = 'Already sent message!';
   }else{

      $insert_message = $conn->prepare("INSERT INTO `reply`(user_id,  message) VALUES(?,?)");
      $insert_message->execute([$admin_id, $msg]);

      $message[] = 'sent message successfully!';
     
      


   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>VegiMa reply</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'admin_header.php'; 


?>
   

<section class="contact">

 

   <form action="" method="POST">
      
      <textarea name="msg" class="box" required placeholder="Reply message" cols="30" rows="10"></textarea>
      <input type="submit" value="Reply" class="btn" name="send">
   </form>

</section>


<script src="js/script.js"></script>

</body>
</html>