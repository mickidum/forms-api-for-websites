<?php 

if(isset($_POST['submit'])){
	
	$user = $_POST['username']; 
  $pass = hash('sha256', $_POST['password']); 

	echo "<h2><pre>\"".$user."\" => \"".$pass."\"</pre></h2>";
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Hash Password</title>
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
		h2 {
			position: absolute;
	    width: 100%;
	    text-align: center;
	    left: 0;
	    top: 50px;
	    z-index: 1000;
		}
		pre {
			display: inline-block;
			padding: 10px;
			border: solid 2px green;
		}
	</style>
</head>
<body>
	<div class="all-wrap">
		<div class="all-wrap-inner">
			<h1>Hash Password</h1>
			<form id="login" method="post" autocomplete="off"> 
			    <label>User Name
				    <input type="text" name="username">
				  </label>
			    <label>Password
				    <input type="password" name="password" autocomplete="new-password">
				  </label>
			    <p><button class="button expanded warning" type="submit" name="submit">Hash Password</button></p>
			</form>
		</div>
	</div>
</body>
</html>