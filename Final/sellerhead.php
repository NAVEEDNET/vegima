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

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VegiMa seller  Home page</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/edit.css">
    

    </head>
    <body>

        <header class="header">

            <div class="flex">
                    

                <a href="login1.php" class="logo"><i class="fas fa-shopping-cart"><span1>V</span1> egi<span>Ma</span></i></a>

                <nav class="navbar">
                    <a href="seller.php">Home</a>
                    <a href="shop.php">Shop</a>
                    <a href="orders.php">Orders</a>
                    <a href="about.php">About</a>
                    <a href="contact.php">Contact</a>
                </nav>

                

                <div class="icons">
                    <div id="menu-btn" class="fas fa-bars"></div>
                    <div id="user-btn" class="fas fa-user"></div>
                    <a href="search_page.php" class="fas fa-search"></a>
                    <?php
                       
                        $count_reply_items = $conn->prepare("SELECT * FROM `reply` WHERE user_id = ?");
                        $count_reply_items->execute([$user_id]);
                    ?>
                    <a href="reply.php"><i class="fas fa-message"></i><span class="badge"><?= $count_reply_items->rowCount(); ?></span></a>
                   
                    <a href=""><i class=""></i><span1 class="badges"><h5>Workin Hours:: </h5> Mon-Sat (8.00 AM - 10.00 PM) Open</span1></a>
                </div>
                

                <div class="profile">
                    <?php
                        $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                        $select_profile->execute([$user_id]);
                        $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
                    <p><?= $fetch_profile['name']; ?></p>
                    <a href="user_profile_update.php" class="update-btn">update profile</a>
                    <a href="logout.php" class="delete-btn">logout</a>
                    <div class="flex-btn">
                        
                        
                    </div>
                </div>


            </div>

        </header>
    </body>
</html>