<?php

include "ck_session.php";
if(!isSessionAction()){
    header("location: index.php");
}


?>
<?php 


require_once('conn.php');
$query = "select * from users";
$result = mysqli_query($conn,$query);


// require_once 'conn.php';
// require_once 'functions.php';

// $result = display_data();

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
    header('location: users.php');
 }
 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/users.css">
    <link rel="icon" href="images/code.png">
    <title>Users</title>
</head>

<body>
    <div class="container">
        <div class="topbar">
            <div class="logo">
                
            </div>
           <section class="search">
        <form action="" method="post">
        <input type="text" name="search" placeholder="search products..." class="box"><input type="submit" name="submit" value="search" class="btn1">
        </form>
            </section>

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
            <div class="row-mt-5">
        <div class="col">
        <div class="card-mt-5">
 <div class="card-body1">
    <?php
      if(isset($_POST['submit'])){
         $name = $_POST['search'];
         $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE name LIKE '%{$name}%'") or die('query failed');
         if(mysqli_num_rows($select_users) > 0){
         while($fetch_users = mysqli_fetch_assoc($select_users)){
   ?>
        <table class="table-border1" style="width: 100%">
        <tr>
            <td> -Name- </td>
            <td> -Email- </td>
            <td> -Number- </td>
            <td> -Age- </td>
            <td> -Gender- </td>
            <td> -Username- </td>
            <td> -Password- </td>
            <td> -Usertype- </td>   
            <td></td>
        </tr>
        <tr>
                <td><?php echo $fetch_users['name']; ?></td>
                  <td><?php echo $fetch_users['email']; ?></td>
                  <td><?php echo $fetch_users['number']; ?></td>
                  <td><?php echo $fetch_users['age']; ?></td>
                  <td><?php echo $fetch_users['gender']; ?></td>
                  <td><?php echo $fetch_users['username']; ?></td>
                  <td><?php echo $fetch_users['password']; ?></td>
                  <td><?php echo $fetch_users['usertype']; ?></td>
                  <td><a href="users.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">Delete</a></td>  
                </tr>
        </table>
<?php
            }
         }else{
            echo '<center><p class="empty">no result found!</p>';
         }
      }else{

      }
   ?>
   </div>


        <div class="card-header">
            <center><h2 class="display-6 text-center">User</h2>
        </div>
        <div class="card-body">
        <table class="table-border" style="width: 100%">
        <tr>
            <td> -Name- </td>
            <td> -Email- </td>
            <td> -Number- </td>
            <td> -Age- </td>
            <td> -Gender- </td>
            <td> -Username- </td>
            <td> -Password- </td>
            <td> -Usertype- </td>   
            <td></td>
        </tr>
        <tr>
                <?php 
                  while($row = mysqli_fetch_assoc($result))
                  {
                ?>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo $row['number']; ?></td>
                  <td><?php echo $row['age']; ?></td>
                  <td><?php echo $row['gender']; ?></td>
                  <td><?php echo $row['username']; ?></td>
                  <td><?php echo $row['password']; ?></td>
                  <td><?php echo $row['usertype']; ?></td>
                  <td><a href="users.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">Delete</a></td>  
                </tr>
                <?php    
                  }
                
                ?>
                
        </table>
        </div>
        </div>
        </div>
        </div>
        </div>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
        <script src="js/Employees.js"></script>
</body>
</html>