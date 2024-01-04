<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login1.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Vegima about us</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'Head.php'; ?>

<section class="about">

   <div class="row">

      <div class="box">
         <img src="image/transport.svg" alt="">
         <h3>what we provide?</h3>
         <p>This is the project our 2nd year 1st semester group project. We are doing a project about online vegetable shopping (web based project). Recently a few years ago the corona situation the farmers cant sell the products to market. Still same problems  this time country faces so many economical problems  so the farmers cant sell the product. The vegetables cant reaching the whole shale market.
			    So we are considering that problems and we will produce a new solutions about that problems.</p>
         
      </div>

      <div class="box">
         <img src="image/usd.svg" alt="">
         <h3>Scope</h3>
         <p>    This system can be implemented to any shop in the locality or to multinational branded shops
               having retail outlet chains. The system recommends a facility to accept the orders 24*7 and a
               home delivery system which can make customers happy. If shops are providing an online portal
               where their customers can enjoy easy shopping from any
               here, the shops won’t be losing any more
               customers to the trending online shops such as flipcart or ebay. Since the application is available
               in the Smartphone it is easily accessible and always available.</p>
      </div>
      
      <div class="box">
         <img src="image/bag.svg" alt="">
         <h3>Motivation</h3>
         <p>We are allowing resources to be released to other areas where they can be used more effectively, which in the long-run will save you both time and money. Another way selling your product quickly and get back your money.</p>
      </div>

  


   </div>


   </div>

</section>



 

      
    
      
      


     










<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>