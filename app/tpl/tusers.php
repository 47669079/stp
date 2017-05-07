<?php
	include 'head_common.php';
	?>
<body>
	<h1>Mi Perfil</h1>
	<div class="well cont_user">

		  <div id="mens"></div>

		     <form class="edit-form" name="f1" id="f1">

					 <label> UserID: <label for="UserID" id="userid"> <?php echo $this->dataTable[0]['idusers']; ?> </label> </label>

					 	<label for="UserName"> Username: <input type="text" class="form-control" placeholder="username " id="username" name="username"> </label> <br>
		        <label for="Email"> Email: <input type="text" class="form-control" placeholder="email " id="email" name="email"> </label> <br>

						<label for="Password2"> Nuevo password: <input type="password" class="form-control" id="password2" name="password2"> </label>
						<label for="Password3"> Repetir nuevo password: <input type="password" class="form-control" id="password3" name="password3"> </label>

						<label for="Password1"> Password* <input type="password" class="form-control" id="password1" name="password1"> </label>

		        <br>

		     <button class="edit-btn" >Editar</button>

		      </form>

		     </div>

	</div>

	<script>

	document.f1.username.value = '<?php echo $this->dataTable[0]['usersname']; ?>';
	document.f1.email.value = '<?php echo $this->dataTable[0]['email']; ?>';
	document.f1.userid.innerHTML = '<?php echo $this->dataTable[0]['idusers']; ?>';

	</script>

<?php
	include 'footer_common.php';
?>
