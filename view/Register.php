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
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/Register.js"></script>
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

<?php
if(isset($errorMessage)){?>
<div class="alert alert-danger">
	<h4><?=$errorMessage?></h4>
</div>
<?php } ?>

<form action = "index.php" method = "post">
	<input type="hidden" name="action" value="Register" />
	<input type="hidden" name="method" value="register" />
	<div class="col-md-6 top-buffer-30 col-lg-offset-3">
	<label for="Name">Name : </label>
	<input class="form-control" type ="text" name = "name" id = "name" placeholder="name"
	value="<?=$user->getName()?>"/>
	</div>
	<div class="col-md-6 top-buffer-30 col-lg-offset-3">
    <label for="userName">User Name : </label>
    <input class="form-control" type ="text" name = "userName" id = "userName" placeholder="user name"
    value="<?=$user->getUserName()?>"/>
	</div>
	<div class="col-md-6 top-buffer-30 col-lg-offset-3">
	<label for="emailAddress">Email Address : </label>
	<input class="form-control" type = text name = "emailAddress" id = "emailAddress" placeholder="email address"
    value="<?=$user->getEmailAddress()?>"/>
	</div>
	<div class="col-md-6 top-buffer-30 col-lg-offset-3">
	<label for="password">Password :        </label>
	<input class="form-control" type= password name= "password" id = "password" placeholder="password"/>
	</div>
	<div class="col-md-6 top-buffer-30 col-lg-offset-3">
	<label for="rePassword">Repeat Password : </label>
	<input class="form-control" type= password name="rePassword" id ="rePassword" placeholder="repeat password"/>
	</div>
	<div class="col-md-6 top-buffer-30 col-lg-offset-5">
    <input class="btn btn-primary btn-lg" type ="submit" name ="submit" value = "Register" id="registerSubmit"><br/>
	</div>
    
</form>

	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="js/bootstrap.js"></script>

</div>
</body>
</html>