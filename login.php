<?php
session_start();
 if (isset($_SESSION['pseudo']))
	header("Location: chatRoom.php");
	else{
 ?>
<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8"/>
	<title>Client</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/myStyle.css">
	
</head>
<body  id="mainFont">


<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<br><br><br><br>
<div class="row">
	<div class="col-md-offset-4 col-md-4">
		
		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title text-center">Logger vous SVP</h3>
		  </div>
		  <div class="panel-body">
		    <form id="form1" method="post" action="verifLogin.php" >
		    	<div class="form-group">
		    		<label for="pseudo" class="control-label text-center">Pseudo</label>
            		<input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="pseudo" required="required">
		    	</div>
		    </form>
		  </div>
		  <div class="panel-footer">
		  	<button type="submit" form="form1" class="btn btn-success">Se connecter</button>
		  </div>
		</div>
	</div>
</div>
	

</body>
</html>
<?php } ?>