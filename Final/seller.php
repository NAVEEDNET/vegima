<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login1.php');
};

if(isset($_POST['add product'])){

   
   $name = $_POST['name'];
   $price = $_POST['price'];
   $image = $_FILES['image']['name'];
   $quntity =$_POST['quantity'];
   $weight = $_POST['weight'];
   $category =$_POST['category'];
   $lotnum =$_POST['lotnum'];

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;
  

   $select_seller = $conn->prepare("SELECT * FROM `seller` WHERE name = ? AND price = ? AND image = ? AND quantity = ? AND weight = ? AND category= ? AND lotnum  = ?");
   $select_seller->execute([$name, $price, $image, $quntity ,$weight, $category,$lotnum ]);

   if($select_seller->rowCount() > 0){
      $seller[] = 'Already add product!';
   }else{

      $insert_seller = $conn->prepare("INSERT INTO `seller`(user_id, name,price, image, quntity,weight,category,lotnum) VALUES(?,?,?,?,?,?,?,?)");
      $insert_seller->execute([$user_id, $name, $price, $image, $quntity ,$weight, $category,$lotnum ]);

      if($insert_seller){
         if($image_size > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'new product added!';
         }

      }

      $seller[] = 'Add product successfully!';
    
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
  <h1 class="heading">Add a new<span>product</span></h1> 

<section class="contact">

 

   <form action="" method="POST">
      
      <input type="text" placeholder="Enter product name" name="name" class="box">
         <input type="number" placeholder="Enter product price" name="price" class="box" min="1">
         <select type="text" placeholder="" name="weight" class="box">
            <option value ="">Enter product weight</option>
            <option value ="10">10g</option>
            <option value ="25">25g</option>
            <option value ="50">50g</option>
            <option value ="75">75g</option>
            <option value ="100">100g</option>
            <option value ="250">250g</option>
            <option value ="500">500g</option>
            <option value ="1000">1Kg</option>
            <option value ="2000">2Kg</option>
            <option value ="3000">3Kg</option>
            <option value ="4000">4Kg</option>
            <option value ="5000">5Kg</option>
            <option value ="6000">6Kg</option>
            <option value ="7000">7Kg</option>
         </select>
          
      <input type="file" accept="image/png, image/jpeg, image/jpg" name="image" class="box">
		<input type="number" placeholder ="Enter Product Quantity" name ="quantity" class="box" min="1">
      <input type="text" placeholder ="Enter Product Category" name ="category" class="box">
      <input type="text" placeholder ="Enter Product LOT_Number" name ="lotnum" class="box">
      <input type="submit" class="btn" name="add_product" value="add product">
   </form>

</section>





      
         
         
      </form>

   </div>








<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>