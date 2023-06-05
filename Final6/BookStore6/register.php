<?php

include "ck_session.php";
if(isSessionAction()){
  header("location: index.php");
}
?>
<?php
include "conn.php";
if(isset($_POST['submit'])){

    $Name = $_POST['Name'];
    $email = $_POST['email'];
    $Number = $_POST['Number'];
    $userName = $_POST['username'];
    $passWord = $_POST['password'];
    $cpassWord = $_POST['cpassword'];
    $Age = $_POST['age'];
    $Gender = $_POST['gender'];

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE Name = '$Name' AND email = '$email'AND Number = '$Number' AND username = '$userName' AND password = '$passWord' AND age = '$Age' AND gender = '$Gender'") or die('query failed');
 
 if(mysqli_num_rows($select_users) > 0){
}else{
  if($passWord != $cpassWord){
    header("location: register.php?error=confirm password not matched!");
    exit();
  }else{
   mysqli_query($conn, "INSERT INTO `users` (Name, email, Number, username, password, age, gender) VALUES('$Name', '$email', '$Number', '$userName', '$cpassWord', '$Age', '$Gender')") or die('query failed');
 
   echo "<script type='text/javascript'>alert('Account Successfully Created!');
   window.location='index.php';
   </script>";
   exit();
  }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Registration </title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="images/code.png">
</head>
<body>

  <div class="container">
    <div class="myform">
    <a href="index.php"><button type="submit"><i class="fas fa-sign-out"></i> RETURN</button></a>
      <form action="#" method="POST">
        <h2>PLEASE REGISTER AN ACCOUNT</h2> 

        <?php if(isset($_GET['error'])) { ?>
			<p class="error"> <?php echo $_GET['error']; ?></p>
			<?php } ?>

        <input type="text" name="Name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="Number" placeholder="Number" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="cpassword" placeholder="Comfirm Password" required>
        <input type="text" name="age" placeholder="Age" required>
        <label for="">Gender:</label><br><br>
        Male<input class="gender" type="radio" name="gender" value="Male" /><br>
        Female<input class="gender" type="radio" name="gender" value="Female" /><br>

       <button type="submit" name="submit">REGISTER</button>
      </form>
    </div>
    <div class="image">
      <img src="images/geek.png">
    </div>
  </div>

</body>
</html>