<?php

include 'config.php';


if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = md5($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
   $type = $_POST['type'];
   $type = filter_var($type, FILTER_SANITIZE_STRING);
   

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select->execute([$email]);

   if($select->rowCount() > 0){
      $message[] = 'user email already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert = $conn->prepare("INSERT INTO `users`(name, email, password,type, image) VALUES(?,?,?,?,?)");
         $insert->execute([$name, $email, $pass,$type, $image]);

         if($insert){
            if($image_size > 2000000){
               $message[] = 'image size is too large!';
            }else{
               move_uploaded_file($image_tmp_name, $image_folder);
               $message[] = 'registered successfully!';
               header('location:login.php');
            }
         }

      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

      <!-- font awesome cdn link  -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

<link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

<!-- custom css file link  -->
<link rel="stylesheet" href="css/regis.css">

<link rel="stylesheet" href="css/styl.css">

<link rel="stylesheet" href="css/sup.css">

</head>
<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>
<header class="header">
   <a href="login1.php" class="logo"><i class="fas fa-shopping-cart"> <span1>V</span1><span2>egi</span2><span>Ma</span></i> </a>

   <nav class="navbar">
       
   </nav>
   
   <div class="icons">
      <div class="fas fa-phone" id="cart-btn"><h6>Contact</h6></div>
      <div class="fas fa-user"id="login-btn"><h6>About us</h6></div>
    </div>

    <form action="" class="shopping-cart">
        <div class="box">

            <img src="images/call.jpg" alt="">
            
               <h3>Hotline</h3>
               <span class="price"><a href="#" class="links"> <i class="fas fa-phone"></i>  011-1234567 </a></span>
                            
            
        </div>
        <div class="box">
            <img src="images/fa.png" alt="">
           
                <h3>Facebook</h3>
                <span class="quantity"><a href="#" class="links"> <i class="fab fa-facebook-f"></i> Like us </a></span>
          
        </div>
		<div class="box">
            <img src="images/what.png" alt="">
            
                <h3>Whatapp</h3>
                <span class="quantity"><a href="#" class="links"> <i class="fas fa-phone"></i>011-456-7890 </a></span>
            
        </div>
    </form>

    <form action="" class="login-form">
        <h3>Why we Introduces Vegima</h3>
        <h4>Introduction</h4>
		<p>This is the project our 2nd year 1st semester group project. We are doing a project about online vegetable shopping (web based project). Recently a few years ago the corona situation the farmers cant sell the products to market. Still same problems  this time country faces so many economical problems  so the farmers cant sell the product. The vegetables cant reaching the whole shale market.
			So we are considering that problems and we will produce a new solutions about that problems.</p>
		<h4>Motivation</h4>
        
        <p>We are allowing resources to be released to other areas where they can be used more effectively, which in the long-run will save you both time and money. Another way selling your product quickly and get back your money.</p>
        
        
    </form>

</header>

<section class="form-container">

            
            </section>
            <div class="full-page">
                        <div class="sub-page">
                           <video autoplay muted loop id="myVideo">
                           <source src=" vidio/my.mp4" type="video/mp4">
                           </video>
                           <div class="content">
                              <h1>...................................._______Scrollen down to Login to web page_______....................................</h1>
                              
                              <p>--Hi.. welcome to veGima webside--
                              </p>

                            <div class="row">
                              
                                <div class="col-1">
                                 
                                    <div class="form-box">
                                        <div class="form">
                                        <section class="form-container">

                                             <form action="" enctype="multipart/form-data" method="POST">
                                                <h3>register now</h3>
                                                <input type="text" name="name" class="box" placeholder="enter your name" required>
                                                <input type="email" name="email" class="box" placeholder="enter your email" required>
                                                <input type="password" name="pass" class="box" placeholder="enter your password" required>
                                                <input type="password" name="cpass" class="box" placeholder="confirm your password" required>
                                                <input type="file" name="image" class="box" required accept="image/jpg, image/jpeg, image/png">
                                                <select type="text" placeholder="" name="type" class="box">
                                                   <option value ="">Select Here</option>
                                                   <option value ="User">USER</option>
                                                   <option value ="Seller">SELLER</option>
                                                </select>
                                                <input type="submit" value="register now" class="btn" name="submit">
                                                <p>already have an account? <a href="login.php">login now</a></p>
                                             </form>

                                          </section>
                                    </div> 
                                </div>
                            </div>
                            <div class="col-1">
                                    <p class='defination'><b>"---If  We  Can  Get  People  To  Focus  On  Fruits<br> And Vegetables And More Healthy Foods,<br>We'll Be Better In Terms Of Our<br>Healthycare Situation------"</p>
                            </div>  
                 
                        </div> 
                    </div>                
                </div>


<script src='https://code.jquery.com/jquery-3.2.1.min.js'>
    var video = document.getElementById("myVideo");
    </script>
    <script>
        $('.message a').click(function(){$('form').animate({height: "toggle",opacity: "toggle"},"slow");});
    </script>


<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script1.js"></script>

   



</body>
</html>