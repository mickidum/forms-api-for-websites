<?php 
session_start();
if(@$_SESSION['logged']){ 
    header("Location: api/list.php"); 
    exit; 
} 

// username = 'admin'
// password = 'admin'
$users = array(
	// CHANGE THIS
	"admin"=>"8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918"
);


if(isset($_POST['submit'])){
	
	$user = $_POST['username']; 
  $pass = hash('sha256', $_POST['password']); 
  foreach ($users as $username => $password) {
  	if ($username === $user and $password === $pass) {
			$_SESSION['logged'] = TRUE;
			$_SESSION['username'] = $user;
			header("Location: api/list.php");
			exit;
		}
  }
	 echo '<h5 style="color:red;position:absolute;top: 5px;left: 5px; border: solid; padding: 5px;">Incorrect login or password</h5>';
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register System Welcome</title>
	<link rel="stylesheet" href="api/styles/foundation.css">
	<style>
		.all-wrap {
			position: relative;
	    width: 100%;
	    height: 100vh;
		}
		.all-wrap-inner {
			position: absolute;
			width: 100%;
			max-width: 350px;
			border: solid 1px silver;
	    padding: 30px 15px 0;
	    top: 50%;
	    left: 50%;
	    transform: translate(-50%, -50%);
		}
		h1 {
			font-size: 24px;
			font-weight: bold;
			text-align: center;
			margin-bottom: 40px;
		}
	</style>
</head>
<body>


	<div class="all-wrap">
		
		<div class="all-wrap-inner">
			<h1>Login to dashboard</h1>
			<form id="login" method="post"  autocomplete="off"> 
			    <label>User Name
				    <input type="text" name="username">
				  </label>
			    <label>Password
				    <input type="password" name="password"  autocomplete="new-password">
				  </label>
			    <p><button class="button expanded warning" type="submit" name="submit">Login</button></p>
			</form>
		</div>
	</div>


	<!-- <script>
		window.onload = function() {
			setTimeout(function(){
				document.getElementById('login').reset();
			},300);
		}
	</script> -->
</body>
</html>