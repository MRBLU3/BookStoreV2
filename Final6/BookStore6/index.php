	<?php
	include "ck_session.php";

	if(isSessionAction()){
		$host="localhost";
		$user="root";
		$password="admin";
		$db="demo_db3";

		$data=mysqli_connect($host,$user,$password,$db);

		$userName = $_SESSION['userSession'];
		$sql="SELECT * FROM users WHERE username='".$userName."'";
		$result=mysqli_query($data, $sql);

		$row=mysqli_fetch_array($result);
		if($row["usertype"]=="admin"){
			header("location: dashboard.php");
		}else{
			header("location: landing.php");
		}		
	}
	?>
	<?php
	$host="localhost";
	$user="root";
	$password="admin";
	$db="demo_db3";

	$data=mysqli_connect($host,$user,$password,$db);
	if($data==false){
		die("connection error");
	}

	if($_SERVER["REQUEST_METHOD"]=="POST"){

		$username=$_POST["username"];
		$password=$_POST["password"];

		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysqli_real_escape_string($data, $username);
		$password = mysqli_real_escape_string($data, $password);

		if (empty($username)){
			header("location: index.php?error=Username is required");
			exit();
		}else if(empty($password)){
			header("location: index.php?error=Password is required");
			exit();
		}else{
			$sql="SELECT * FROM users WHERE username='".$username."' AND password='".$password."'";
			$result=mysqli_query($data, $sql);
			$row=mysqli_fetch_array($result);

			if($row["usertype"]=="admin"){
				$_SESSION['userSession'] = $username;
				header("location: dashboard.php");				
			}else if($row["usertype"]=="user"){
				$_SESSION['userSession'] = $username;
				header("location: landing.php");
			}else{
				header("location: index.php?error=incorrect username or password");
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
	<title>Admin Login</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="images/code.png">
	</head>
	<body>

	<div class="container">
		<div class="myform">
		<a href="register.php"><button><i class="fas fa-registered"></i>REGISTER</button></a>
		<form action="index.php" method="post">
			<h2>WELCOME TO CODEGEEK</h2>
			
			<?php if(isset($_GET['error'])) { ?>
			<p class="error"> <?php echo $_GET['error']; ?></p>
			<?php } ?>

			<input type="text" name="username" placeholder="Username">
			<input type="password" name="password" placeholder="Password">
		<button type="submit">LOGIN</button>
		</form>
		</div>
		<div class="image">
		<img src="images/geek.png">
		</div>
	</div>

	</body>
	</html>