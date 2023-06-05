<?php

include "conn.php";

include "ck_session.php";

$userName = $_SESSION['userSession'];

if(!isSessionAction()){
    header("location: landing.php");
}

if(isset($_POST['order_btn'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = $_POST['number'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, ' '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' ');
    $placed_on = date('d-M-Y');
 
    $cart_total = 0;
    $cart_products[] = '';
 
    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE userSession = '$userName'") or die('query failed');
    if(mysqli_num_rows($cart_query) > 0){
       while($cart_item = mysqli_fetch_assoc($cart_query)){
          $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
          $sub_total = ($cart_item['price'] * $cart_item['quantity']);
          $cart_total += $sub_total;
       }
    }
 
    $total_products = implode(', ',$cart_products);
 
    $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');
 
    if($cart_total == 0){
       $message[] = 'your cart is empty';
    }else{
       if(mysqli_num_rows($order_query) > 0){
          $message[] = 'order already placed!'; 
       }else{
         mysqli_query($conn, "INSERT INTO `orders`(userSession, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$userName', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
         echo '<script> alert("Order Placed")</script>';
      }
         header ("location:landing.php");
          
          mysqli_query($conn, "DELETE FROM `cart` WHERE userSession = '$userName'") or die('query failed');
       }
    }
    
 
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Geek</title>

    <link rel="icon" href="images/code.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/checkout.css">


</head>
<body class="anybody">
<header>

    <a href="landing.php" class="logo"><i class="fas fa-code"></i>Code Geek</a>

    <nav class="navbar">

        <ul class="nav-links">

        <input type="checkbox" id="checkbox_toggle" />
        <label for="checkbox_toggle" class="hamburger">&#9776;</label>
      
        <div class="menu"> 

            <li><a href="cart.php"><i class="fas fa-shopping-cart" aria-hidden="true"></i></a></li>
            <li><a class="" href="landing.php#home">Home</a></li>
            <li><a href="landing.php#about">About</a></li>
            <li><a href="landing.php#product">Product</a></li>
            <li><a href="landing.php#contact">Contact</a></li>
            <li><a href="logoutuser.php"><i class="fas fa-sign-out" aria-hidden="true"></i>Logout
            </a></li>

            </div>
        </ul>
    </nav>
  

</header>
<div class="heading">
   <h3>checkout</h3>
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE userSession = '$userName'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo '₱'.$fetch_cart['price'].''.' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">your cart is empty</p>';
   }
   ?>
   <div class="grand-total"> grand total : <span>₱<?php echo $grand_total; ?></span> </div>

</section>

<section class="checkout">
   <form action="" method="post">
      <h3>place your order</h3>
      <div class="flex">
         <div class="inputBox">
         <?php

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE username = '$userName'") or die('query failed');
   if(mysqli_num_rows($select_users) > 0){
      while($fetch_users = mysqli_fetch_assoc($select_users)){

         $email = $fetch_users['email'];
         $number = $fetch_users['number'];
   ?>
            <span>Your Name :</span>
             <p><br><span><?php echo $fetch_users['name']; ?></span></p>
             <?php
      }
   }else{
   }
   ?>
            </div>
         <div class="inputBox">
            <span>Your Number :</span>
            <input type="number" name="number" value="<?php echo $number; ?>" required placeholder="Enter your number">
         </div>
         <div class="inputBox">
            <span>Your Email :</span>
            <input type="email" name="email" value="<?php echo $email; ?>" required placeholder="Enter your email">
         </div>
         <div class="inputBox">
            <span>Payment Method :</span>
            <select name="method">
               <option value="cash on delivery">cash on delivery</option>
               <option value="credit card">credit card</option>
               <option value="paypal">paypal</option>
               <option value="paytm">paytm</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Street Address:</span>
            <input type="text" name="street" required placeholder="e.g. street name">
         </div>
         <div class="inputBox">
            <span>City :</span>
            <input type="text" name="city" required placeholder="e.g. Bislig City">
         </div>
         <div class="inputBox">
            <span>State :</span>
            <input type="text" name="state" required placeholder="e.g. Surigao del Sur">
         </div>
         <div class="inputBox">
            <span>Country :</span>
            <input type="text" name="country" required placeholder="e.g. Phillipines">
         </div>
      </div>
      <input type="submit" value="back to cart" class="btn"  onclick="window.location='cart.php';" name="order_btn">
      <input type="submit" value="order now" class="btn1" name="order_btn">
   </form>

</section>

</body>
</html>