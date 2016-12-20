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
				<div class="col-md-3 top-buffer-50">
					<a class="btn btn-default" disabled="disabled">Browse</a>
				</div>
				<div class="col-md-3 top-buffer-50">
					<a class="btn btn-default" href="index.php?action=Search&method=search">Search</a>
				</div>
				<div class="col-md-3 top-buffer-50">
					<a class="btn btn-default" href="index.php?action=Default&method=logout">Logout</a>
				</div>
			</div>
		</div>


		<div class="col-md-10">
			Welcome! 
			<?php
			require_once ("model/UserHandler.php");

			$loginUser = $_SESSION["loginUser"];
			print($loginUser->getUserName())
			?>. Logged in at --><?=$loginUser->getTimeOfLogin() ?>
		</div>

		<?php require_once('Dispatcher.php'); ?>
	</div>
	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="js/bootstrap.js"></script>
<body>
<html>