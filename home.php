<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login1.php');
};

if(isset($_POST['add_to_wishlist'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);

   $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
   $check_wishlist_numbers->execute([$p_name, $user_id]);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_wishlist_numbers->rowCount() > 0){
      $message[] = 'already added to wishlist!';
   }elseif($check_cart_numbers->rowCount() > 0){
      $message[] = 'already added to cart!';
   }else{
      $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
      $insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
      $message[] = 'added to wishlist!';
   }

}

if(isset($_POST['add_to_cart'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);
   $p_qty = $_POST['p_qty'];
   $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_cart_numbers->rowCount() > 0){
      $message[] = 'already added to cart!';
   }else{

      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$p_name, $user_id]);

      if($check_wishlist_numbers->rowCount() > 0){
         $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
         $delete_wishlist->execute([$p_name, $user_id]);
      }

      $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
      $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
      $message[] = 'added to cart!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title> VegiMA home page</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>
   
<?php include 'Head.php'; ?>

<div class="home-bg">

   <section class="home">

         <div class="content">
               
               <h2>Fresh and <span>Organic</span> Products for Your.</h2>
               <p>If   We   Can   Get   People  To  Focus  On  Fruits And Vegetables And More Healthy Foods,We'll Be Better In Terms Of Our Healtjhcare Situation....</p>
               <a href="about.php" class="about-btn">about us</a>
         </div>

   </section>

</div>

<section class="features" id="features">

    <h1 class="heading"> our <span>features</span> </h1>

    <div class="box-container">

        <div class="box">
            <img src="image/cat-5.png" alt="">
            <h3>Fresh and Organic</h3>
            <p>Fresh and new vegetables !</p>
            <a href="#" class="delete-btn">read more</a>
        </div>

        <div class="box">
            <img src="image/feature-img-2.png" alt="">
            <h3>Free home Delivery</h3>
            <p>More than RS:10,000.00 orders are free shiping !</p>
            <a href="#" class="delete-btn">read more</a>
        </div>

        <div class="box">
            <img src="image/feature-img-3.png" alt="">
            <h3>Easy Payments</h3>
            <p>Money bank guarented !</p>
            <a href="#" class="delete-btn">read more</a>
        </div>

    </div>

</section>





<section class="home-category">

   <h1 class="heading">Shop by  VegiMa <span>Category</span></h1>

   <div class="box-container">

      <div class="box">
         <img src="images/leave.png" alt="">
         <h3>Leave</h3><br><br><br>
         <p>The edible leaves of plants.</p>
         <a href="category.php?category=leave" class="about-btn">Leave</a>
      </div>

      <div class="box">
         <img src="images/fruit.png" alt="">
         <h3>Fruit</h3>
         <p>Vegetable fruit are fleshy and contain seeds.</p>
         <a href="category.php?category=fruit" class="about-btn">Fruit</a>
      </div>

      <div class="box">
         <img src="images/root.png" alt="">
         <h3>Root</h3>
         <p>Usually a long or round-shaped taproot.</p>
         <a href="category.php?category=root" class="about-btn">Root</a>
      </div>

      <div class="box">
         <img src="images/flower.png" alt="">
         <h3>Flower</h3>
         <p>The edible flowers of certain vegetables.</p>
         <a href="category.php?category=flower" class="about-btn">Flower</a>
      </div>

      <div class="box">
         <img src="images/bulb.png" alt="">
         <h3>Bulbs</h3>
         <p>produce a fleshy, leafy shoot above ground.</p>
         <a href="category.php?category=bulbs" class="about-btn">Bulbs</a>
      </div>

   </div>

</section>

<section class="products">

   <h1 class="heading">Latest <span>products</span></h1>

   <div class="box-container">

   <?php
      $select_products = $conn->prepare("SELECT * FROM `products`");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" class="box" method="POST">
      <div class="price">1Kg = RS:<span><?= $fetch_products['price']; ?></span>/-</div>
      <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <div class="name"><?= $fetch_products['name']; ?></div>
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
      
      
      <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
      <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
      <select type="number"  name="p_qty" class="qty">
         <option value="">Select quantity</option>
         <option value="10">10g</option>
         <option value="20">20g</option>
         <option value="50">50g</option>
         <option value="75">75g</option>
         <option value="100">100g</option>
         <option value="250">250g</option>
         <option value="500">500g</option>
         <option value="750">750g</option>
         <option value="1000">1Kg</option>
         <option value="2000">2Kg</option>
         <option value="3000">3Kg</option>
         <option value="4000">4Kg</option>

      </select>
      <input type="submit" value="add to wishlist" class="btn" name="add_to_wishlist">
      <input type="submit" value="add to cart" class="option-btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">No products added yet!</p>';
   }
   ?>

   </div>



</section>









<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>