<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $sql = "SELECT * FROM `users` WHERE email = ? AND password = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$email, $pass]);
   $rowCount = $stmt->rowCount();  

   $row = $stmt->fetch(PDO::FETCH_ASSOC);

   if($rowCount > 0){

    if($row['user_type'] == 'admin')
    {

        $_SESSION['admin_id'] = $row['id'];
        header('location:admin_page.php');

     }
     elseif($row['user_type'] == 'Seller')
     {

        $_SESSION['seler_id'] = $row['id'];
        header('location:seller.php');

     }
     elseif($row['user_type'] == 'User')
     {

        $_SESSION['user_id'] = $row['id'];
        header('location:home.php');

     }
     else
     {
        $message[] = 'No user found !';
     }

   }
   else
   {
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Vegima login page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">

   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/login.css">

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
         <i class="" onclick="this.parentElement.remove();"></i>
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
                                             

                                            <form action="" method="POST">
                                                <h3>login now</h3>
                                                <input type="email" name="email" class="box" placeholder="Enter your email" required>
                                                <input type="password" name="pass" class="box" placeholder="Enter your password" required>
                                                <input type="submit" value="login now" class="btn" name="submit">
                                                <p>Don't have an account? <a href="register.php">Register Now</a></p>
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