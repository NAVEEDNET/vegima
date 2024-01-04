<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login1.php');
};

if(isset($_POST['send'])){

   
   $msg = $_POST['msg'];
  

   $select_reply = $conn->prepare("SELECT * FROM `reply` WHERE messag = ?");
   $select_reply->execute([ $msg]);

   if($select_reply->rowCount() > 0){
      $message[] = 'Already sent message!';
   }else{

      $insert_reply = $conn->prepare("INSERT INTO `reply`(user_id,messag) VALUES(?,?)");
      $insert_reply->execute([$user_id, $msg]);

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
   <title>VegiMa contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'Head.php'; 


?>
  <h1 class="heading">added<span>message</span></h1> 

<section class="contact">

 

   <form action="" method="POST">
      
      <textarea name="msg" class="box" required placeholder="Enter your message" cols="30" rows="10"></textarea>
      <input type="submit" value="send message" class="btn" name="send">
   </form>

</section>








<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>