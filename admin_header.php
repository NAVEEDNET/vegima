<!DOCTYPE html>
<html lang="en">
   <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VegiMa Home page</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/edit.css">
    

   </head>
   <body>

      <?php

         if(isset($message)){
            foreach($message as $message){
               echo '<span class="message">'.$message.'</span>';
            }
         }

      ?>

      <header class="header">

         <div class="flex">
         
            <a href="login1.php" class="logo"><i class="fas fa-shopping-cart"><span1>V</span1>egi<span>Ma</span><l>Admin</l></i></a>

            <nav class="navbar">
               <a href="admin_page.php">Home</a>
               <a href="admin_products.php">Products</a>
               <a href="admin_orders.php">Orders</a>
               <a href="admin_users.php">Users</a>
               <a href="admin_contacts.php">Messages</a>
            </nav>

            <div class="icons">
               <div id="menu-btn" class="fas fa-bars"></div>
               <div id="user-btn" class="fas fa-user"></div>
              
            </div>

            <div class="profile">
               <?php
                  $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                  $select_profile->execute([$admin_id]);
                  $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
               ?>
               <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
               <p><?= $fetch_profile['name']; ?></p>
               <a href="admin_update_profile.php" class="btn">update profile</a>
               <a href="logout.php" class="delete-btn">logout</a>
            
            </div>

         </div>

    </header>
   </body>
</html>