<?php

include "conn.php";

include "ck_session.php";

$userName = $_SESSION['userSession'];

if(!isSessionAction()){
    header("location: landing.php");
}


if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND userSession = '$userName'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(userSession, name, price, quantity, image) VALUES('$userName', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      echo "<script type='text/javascript'>alert('product added to cart!');
   window.location='landing.php#about';
   </script>";
      }

}
?>
<?php


include "conn.php";

if(isset($_POST['send'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $msg = $_POST['message'];
 
    $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');
 
    if(mysqli_num_rows($select_message) > 0){
    }else{
       mysqli_query($conn, "INSERT INTO `message` (name, email, number, message) VALUES('$name', '$email', '$number', '$msg')") or die('query failed');
    }
 
 }

?>
<?php


include "conn.php";

if(isset($_POST['order_book'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $quantity = $_POST['quantity'];
    $order_name = $_POST['order_name'];
    $address = $_POST['address'];
 
    $select_order = mysqli_query($conn, "SELECT * FROM `orderdb` WHERE name = '$name' AND email = '$email' AND number = '$number' AND quantity = '$quantity' AND order_name = '$order_name' AND address = '$address'") or die('query failed');
 
    if(mysqli_num_rows($select_order) > 0){
    }else{
       mysqli_query($conn, "INSERT INTO `orderdb` (name, email, number, quantity, order_name, address) VALUES('$name', '$email', '$number', '$quantity', '$order_name', '$address')") or die('query failed');
    }
 
 }

?>
<?php

if(isset($_POST['add_to_cart'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];
 
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'") or die('query failed');
 
    if(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart!';
    }else{
       mysqli_query($conn, "INSERT INTO `cart`(userSession, name, price, quantity, image) VALUES('$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
       echo "<script type='text/javascript'>alert('product added to cart!');
   window.location='landing.php#about';
   </script>";
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
    <link rel="stylesheet" href="css/landing.css">

</head>
<body>
<header>

    <a href="landing.php" class="logo"><i class="fas fa-code"></i>Code Geek</a>

    <nav class="navbar">

        <ul class="nav-links">

        <input type="checkbox" id="checkbox_toggle" />
        <label for="checkbox_toggle" class="hamburger">&#9776;</label>
      
        <div class="menu"> 

            <li><a href="cart.php"><i class="fas fa-shopping-cart" aria-hidden="true"></i></a></li>
            <li><a class="" href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#product">Product</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="logoutuser.php"><i class="fas fa-sign-out" aria-hidden="true"></i>Logout
            </a></li>

            </div>
        </ul>
    </nav>
  

</header>

<!-- heading section ends -->

<!-- home section starts  -->

<section class="home" id="home">

    <div class="content">
        <h1>best quality programming books for you</h1>
        <p>Learn programming.</p>
        <a href="#product"><button class="btn">order now</button></a>
    </div>

    <div class="image">
        <img src="images/prog.jpg" alt="">
    </div>

</section>

<!-- home section ends -->

<!-- about section starts  -->

<section class="about" id="about">

    <div class="image">
        <img src="images/prog.png" alt="">
    </div>

    <div class="content">
        <h1 class="heading">About Us.</h1>
        <h3><i class="fas fa-code"></i>Code Geek</h3>
        <p>is an online book store web base application that allows customers to buy books online.</p>
    </div>

</section>

<!-- about section ends -->

<!-- Product section starts  -->

<section class="products" id=product>

   <h1 class="title">Latest Products</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploads/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">₱<?php echo $fetch_products['price']; ?></div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" class="btn" value="add to cart" name="add_to_cart" >
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      
   </div>

</section>

<!-- Product section ends -->


<!-- contact section starts  -->

<section class="contact" id="contact">

<h1 class="heading">Contact</h1>

<h1 class="title">contact us for latest updates</h1>

<form action="" method="post">

    <div class="inputBox">
        <input type="text" name="name" required placeholder="name">
    </div>
    <div class="inputBox">
        <input type="email" name="email" required placeholder="your email">
        <input type="number" name="number" required placeholder="number">
    </div>
    <textarea name="message" id="" cols="30" rows="10" placeholder="message"></textarea>

    <button type="submit" value="send message" name="send" class="btn" onclick="alert('Message was sent successfully');">Send Message</button>

</form>

</section>

<!-- contact section ends -->



<!-- footer section starts  -->

<section class="footer">

<div class="box-container">

    <div class="box">
        <h3>why choose us?</h3>
        <p>Choosing CodeGeek can allow you to purchase the best selling books which are great if you're starting in programming.</p>
    </div>

    <div class="box">
        <h3>quick links</h3>
        <a href="#home">home</a>
        <a href="#about">about</a>
        <a href="#product">products</a>
        <a href="#contact">contact</a>
    </div>

    <div class="box">
        <h3>contact us</h3>
        <p> <i class="fas fa-map-marker-alt"></i> Barobo, Surigao del Sur, Philippines </p>
        <p> <i class="fas fa-globe"></i> www.CodeGeek.com </p>
        <p> <i class="fas fa-phone"></i> +639383479055 </p>
    </div>

</div>

<h1 class="credit"> created by <a href="https://github.com/MRBLU3">MRBLU3</a> | all rights reserved. </h1>

</section>

<!-- footer section ends -->


<!-- jquery cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>