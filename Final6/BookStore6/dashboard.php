<?php
include "conn.php";
include "ck_session.php";
if(!isSessionAction()){
    header("location: landing.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/dash.css">
    <link rel="icon" href="images/code.png">
    <title>Admin panel</title>
</head>

<body>
    <div class="container">
        <div class="topbar">
            <div class="logo">
                
            </div>
            <div class="search">
                <input type="text" name="search" placeholder="search here">
                <label for="search"><i class="fas fa-search"></i></label>
            </div>
            <i class="fas fa-bell"></i>
            <div class="user">
                <img src="images/me.jpeg" alt="">
            </div>
        </div>
        <div class="sidebar">
            <ul>
                <li>
                    <a href="dashboard.php">
                        <i class="fas fa-dashboard "></i>
                        <div>Dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="products.php">
                    <i class="fa fa-shopping-cart"></i>
                        <div>Products</div>
                    </a>
                </li>
                <li>
                <a href="users.php">
                        <i class="fas fa-users"></i>
                        <div>Users</div>
                    </a>
                </li>
                <li>
                    <a href="order.php">
                        <i class="fas fa-chart-bar"></i>
                        <div>Order</div>
                    </a>
                </li>
            
                <li>
                    <a href="message.php">
                        <i class="fa-solid fa-message"></i>
                        <div>Message</div>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <i class="fas fa-sign-out"></i>
                        <div>Logout</div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="main">
            <div class="cards">


                <a href="products.php"><div class="card">
                    <div class="card-content">
                    <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         $count = mysqli_num_rows($select_products);
      ?>
                        <div class="number"><?php echo $count; ?></div>
                        <div class="card-name">Products</div>
                    </div>
                    <div class="icon-box">
                    <i class="fa fa-shopping-cart"></i>
                    </div>
                </div></a>


                <a href="order.php"><div class="card">
                    <div class="card-content">
                    <?php  
         $select_order = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
         $count = mysqli_num_rows($select_order);
      ?>
                        <div class="number"><?php echo $count; ?></div>
                        <div class="card-name">Orders</div>
                    </div>
                    <div class="icon-box">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                </div></a>

               <div class="card">
                    <div class="card-content">
                    <?php
            $total_completed = 0;
            $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'Approved'") or die('query failed');
            if(mysqli_num_rows($select_completed) > 0){
               while($fetch_completed = mysqli_fetch_assoc($select_completed)){
                  $total_price = $fetch_completed['total_price'];
                  $total_completed += $total_price;
               };
            };
         ?>
                        <div class="number"><?php echo $total_completed; ?></div>
                        <div class="card-name">Earning</div>
                    </div>
                    <div class="icon-box">
                        <i class='fa-solid fa-peso-sign'></i>
                    </div>
                </div>



                <a href="message.php"><div class="card">
                    <div class="card-content">
                    <?php  
         $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
         $count = mysqli_num_rows($select_message);
      ?>
                        <div class="number"><?php echo $count; ?></div>
                        <div class="card-name">Message</div>
                    </div>
                    <div class="icon-box">
                        <i class="fa-solid fa-message"></i>
                    </div>
                </div></a>


                <a href="users.php"><div class="card">
                    <div class="card-content">
                    <?php  
         $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
         $count = mysqli_num_rows($select_users);
      ?>
                        <div class="number"><?php echo $count; ?></div>
                        <div class="card-name">Total Accounts</div>
                    </div>
                    <div class="icon-box">
                        <i class='fa-solid fa-users'></i>
                    </div>
                </div></a>

               

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script src="js/das.js"></script>
    <script src="js/das2.js"></script>
</body>

</html>