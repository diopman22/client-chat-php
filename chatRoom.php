<?php 
session_start();
if(!isset($_SESSION['pseudo']))
	header("Location: login.php");
	else echo $_SESSION['pseudo'];
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


<div class="container">
<br><br><br>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title text-center">ChatRoom</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-4">
				<div class="row">
					<button class="glyphicon glyphicon-plus pull-left btn btn-success" data-toggle="modal" data-target="#newSalon">Salon</button>
					<a href="deconect.php" class="btn btn-primary pull-right">Se d&eacute;connecter</a>
					<div class="modal fade" id="newSalon" tabindex="-1" role="dialog" aria-labelledby="newChatRoomLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title">Nouveau salon</h4>
					      </div>

					      <div class="modal-body">
					      	<form id="form2">
						        <div class="form-group">
						    		<label for="salon" class="control-label text-center">Salon</label>
				            		<input type="text" class="form-control" id="salon" name="salon" placeholder="salon" required="required">
						    	</div>
					    	</form>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					        <button id="btnSalon" class="btn btn-primary" data-dismiss="modal">Add</button><!-- à revoir-->
					      </div>
					    </div><!-- /.modal-content -->
					  </div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
				</div><br>
				<div class="row">
					<div class="list-group" id="listSalons">
						


					</div>
				</div>
			</div>

			<div class="col-md-8">
				<div class="row">
					<div class="col-md-offset-2">
					<div class="list-group" id="listMessages">
				   		
					</div>
					</div>
				</div>
				<div class="row">
						<div class="col-md-offset-2">
							<form id="form3">
								<div class="form-group">
			            			<input type="text" class="form-control" disabled="disabled" id="message" name="message" placeholder="message" required="required">		
					    		</div>	
				    		</form>
				    		<button class="btn btn-info glyphicon glyphicon-send pull-right" disabled="disabled" name="btnSend" id="btnSend" title="Envoyer"></button>
			    		</div>	
				</div>
			</div>
			
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		$.ajax({
				url: '/chat client/listSalonsN.php',
				type: 'GET',
				timeout: 10000,

				beforeSend: function () {
            		//console.log("Requête en cours");
            	},

            	success: function (data) {
            		
            		if (data!=''){
            		var resp = $.parseJSON(data);
            		console.log(data);
            		$('#listSalons').html('');
            		resp.forEach(function (dat){
            			$('#listSalons').append('<a href="#" class="list-group-item index">\n'
						+dat+'\n\
					</a>')
            		})
            	}
            	

            	},

            	error: function () {
            		console.log("Erreur de la requête");
            	}
			});
		//Empêcher l'écriture de message  si un salon est sélectionné
		/*var salonStart = $('.glyphicon-eye-open').val();
		console.log(salonStart);*/


		//entrer dans un salon
		$(document).on('click', '.index', function () {
			$('#message').removeAttr('disabled');
			$('#btnSend').removeAttr('disabled');
			$(".index").removeClass('active glyphicon glyphicon-eye-open');
			$(this).addClass('active glyphicon glyphicon-eye-open');
			var salon_v = $('.glyphicon-eye-open');

			var salon = $(".glyphicon-eye-open");//variable symbolisant le salon dans la partie JS
            //setInterval(function(){},1500);
            $.ajax({
            	type: 'GET',
            	url: '/chat client/choisirSalon.php?',
            	timeout: 10000,
            	data: $('#form3').serialize()+'&salon='+salon_v.text(),
            	//data: 'salon='+$(".glyphicon-eye-open").val(),

            	beforeSend: function () {
            		console.log("Requête en cours");
            	},

            	success: function (data) {
            		//console.log('ok chui la');
            		if (data!=''){
            		//console.log(data);
            		var messages = $.parseJSON(data);
            		console.log(messages);
            		$('#listMessages').html('');
            		messages.forEach(function(mesg){
            			$('#listMessages').append('<a class="list-group-item list-group-item-success text-right">'+mesg+'</a>')
            		})
            	}
            	},

            	error: function () {
            		console.log("Erreur de la requête");
            	}
            })
		});

		//Envoi de message dans un salon de discussion
		$('#btnSend').click(function() {
			//var message_v = $('#message').val();//message à envoyer dans une salon
			var salon_v = $('.glyphicon-eye-open');

			$.ajax({
				url: '/chat client/ajoutMessage.php',
				type: 'GET',
				timeout: 10000,
				data: $('#form3').serialize()+'&salon='+salon_v.text(),

				beforeSend: function () {
            		console.log("Requête en cours");
            	},

            	success: function (data) {
            		$('#message').val("");
            		var resp = $.parseJSON(data);
            		console.log(data);
            		/*$('#listMessages').append('<a class="list-group-item list-group-item-success text-right">'+resp.response+'</a>')*/
            	},

            	error: function () {
            		console.log("Erreur de la requête");
            	}
			});
			
		});

			//Création d'un nouveau salon de discussion
		$('#btnSalon').click(function() {
			$.ajax({
				url: '/chat client/ajoutSalon.php',
				type: 'GET',
				timeout: 10000,
				data: $('#form2').serialize(),

				beforeSend: function () {
            		console.log("Requête en cours");
            	},

            	success: function (data) {
            		$('#salon').val("");
            		var resp = $.parseJSON(data);
            		console.log(data);

            		if(resp.response!='salon exist'){
            	/*	$('#listSalons').append('<a href="#" class="list-group-item index">\n'
						+resp.response+'\n\
					</a>');*/
            		}
            		else
            			alert ('ce salon existe deja');

            	},

            	error: function () {
            		console.log("Erreur de la requête");
            	}
			});
			
		});

		
		//Fonction qui gère la réception des messages chaque seconde
		setInterval(function () {
			var salon_v = $('.glyphicon-eye-open');
			$.ajax({
				url: '/chat client/listMessages.php',
				type: 'GET',
				timeout: 10000,
				data: $('#form3').serialize()+'&salon='+salon_v.text(),

				beforeSend: function () {
            		console.log("Requête en cours");
            	},

            	success: function (data) {
            		if(data!=''){
            		var resp = $.parseJSON(data);
            		console.log(resp);
            		$('#listMessages').html('');
            		resp.forEach(function(mesg){
            			$('#listMessages').append('<a class="list-group-item list-group-item-success text-right">'+mesg+'</a>')
            		})
            		}
            	},

            	error: function () {
            		console.log("Erreur de la requête");
            	}
			});
		}, 1000);
		

		//Fonction qui gère la réception des salons de discussion (éventuellement ceux nouvellement créés)
		setInterval(function () {
			$.ajax({
				url: '/chat client/listSalons.php',
				type: 'GET',
				timeout: 10000,

				beforeSend: function () {
            		//console.log("Requête en cours");
            	},

            	success: function (data) {
            		
            		if (data!=''){
            		var resp = $.parseJSON(data);
            		console.log(data);
            		$('#listSalons').html('');
            		resp.forEach(function (dat){
            			$('#listSalons').append('<a href="#" class="list-group-item index">\n'
						+dat+'\n\
					</a>')
            		})
            	}
            	/*var sess= <?php $_SESSION['salons'] ?>
            	if($('#listSalons').val=='' && sess!=''){
            		$('#listSalons').html('');
            		resp.forEach(function (dat){
            			$('#listSalons').append('<a href="#" class="list-group-item index">\n'
						+dat+'\n\
					</a>');
            		})
            	}*/

            	},

            	error: function () {
            		console.log("Erreur de la requête");
            	}
			});
		}, 2000);


	});
</script>
</div>

	

</body>
</html>