<?php
/**
 * 159.339 Internet Programming Assignment 3
 * Student : Shenchuan Gao (16131180)
 */
?>
<DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/bootstrap.css" rel="stylesheet" media="screen">
</head>
<body>
	<div class="container">
		<div class="panel panel-default">
			<div class="row">
				<div class="col-md-3">
					<img src="1.jpg">
				</div>
				<div class="col-md-6 top-buffer-30 col-lg-offset-2">
					<h3>Welcome to Toolshed Inc.</h3>
				</div>
			</div>
		</div>

<br/>
<?php
if(isset($errorMessage)){?>
<div class="alert alert-danger">
	<h4><?=$errorMessage?></h4>
</div>
<?php } ?>

<form action = "index.php" method = "post">
	<input type="hidden" name="action" value="LogIn" /> 
	<input type="hidden" name="method" value="login" />
	<div class="col-md-6 top-buffer-30 col-lg-offset-3">
	<label for="ID">User Name :</label>
	<input class="form-control" type = text name = ID  placeholder="user name"/><br/>
	</div>
	<div class="col-md-6 top-buffer-30 col-lg-offset-3">
	<label for="ID">Password : </label>
	<input class="form-control" type = password name = password  placeholder="password"/><br/>
	</div>
	<div class="col-md-6 top-buffer-30 col-lg-offset-6">
    <input class="btn btn-primary btn-lg" type ="submit" name ="submit" value = "Log In"><br/>
	</div>
	<div class="col-md-6 top-buffer-30 col-lg-offset-5">
	<font size = "2">Don't have an account? </font>
	<a class="btn btn-default" href = "index.php?action=Register&method=register">Register</a>
	</div>
</form>

	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="js/bootstrap.js"></script>

</div>
</body>
</html>