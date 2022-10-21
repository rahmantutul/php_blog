<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../lib/Session.php'; 
  Session::startSession();
?>
<?php include '../helpers/Formate.php'; ?>
<?php 
  $db = New Database;
  $helper = New Formate;
  $session = New Session;
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php
		  if($_SERVER["REQUEST_METHOD"]=="POST"){
			$username = $helper->validate($_POST['username']);
			$password = $helper->validate(md5($_POST['password']));

            $username = mysqli_real_escape_string($db->link, $username);
            $password = mysqli_real_escape_string($db->link, $password);

			$query = "SELECT * FROM tbl_users WHERE username = '$username' AND password = '$password'";
			$result=$db->select($query);
			if($result !=false){
				    $value =mysqli_fetch_assoc($result);
                    Session::setSession('login',true);
                    Session::setSession('username',$value['username']);
                    Session::setSession('user_id',$value['id']);
                    Session::setSession('user_role',$value['role']);
					header("Location:index.php");
				}

		  }
		?>
		<form action="" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>