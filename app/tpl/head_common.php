<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title><?= $this->page;?></title>

	      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,600i,700,800,900" rel="stylesheet">
				<link rel="stylesheet" href="/stp/pub/css/style.css" type="text/css">

</head>
<body>

   <nav class="navbar navbar-light" >
        <div class="container">

				<div class="navbar-header">
            <a class="navbar-brand" href="/stp">
                <image class="storypub" src="/stp/pub/images/logo_hor.png">
            </a>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?= APP_W; ?>home"><?= $this->page;?></a></li>
								</ul>
				</div>
                    <?php

										use \X\Sys\Session;

												if( Session::get('user') )
														{
															//echo Session::get('user')  <li><a href='login'><span class='glyphicon glyphicon-log-in'></span> ".Session::get('user')."</a></li>
															$ses = Session::get('user');

															if($this->page=="Home")
															{
																echo('<ul class="nav navbar-nav navbar-left">
																				<li><a href="'.APP_W.'dashboard"></span>Dashboard</a></li>
																			</ul>
																			');
															}


														echo '
																		<ul class="nav navbar-nav navbar-right">
																		<li><a href="'.APP_W.'editor"></span>Nueva història</a></li>
														        <li class="dropdown">
														          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">¡Hola! '.$ses["usersname"].' <span class="caret"></span></a>
														          <ul class="dropdown-menu">
														            <li><a href="'.APP_W."users/profile/id/".$ses["idusers"].'">Mi Cuenta</a></li>
																				<li><a href="'.APP_W."dashboard/my/id/".$ses["idusers"].'">Mis historias</a></li>';

																if( $ses["roles"]==2 )
																{

																	echo ('<li class="divider"></li>
																							<li><a href="/stp/users">Administrar Usuarios</a></li>
																							<li><a href="/stp/storyes">Administrar Historias</a></li>

																					<li class="divider"></li>
																					            <li><a href="/stp/login/logout">Cerrar Sesión</a></li>
																					          </ul>
																					</li>
																	');

																}
																else{

																	echo ('<li class="divider"></li>
																							<li><a href="/stp/login/logout">Cerrar Sesión</a></li>
																						</ul>
																					</li>
																					</ul>
																				');

																}


														}

														else{

															if($this->page=="Home")
																	{
																	echo('
																				<ul class="nav navbar-nav navbar-right">
																				<li><a href="signup"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
																				<li><a href="login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
																				</ul>
																				');
																	}

															if($this->page=="Login")
																	{
																	echo('
																				<ul class="nav navbar-nav navbar-right">
																				<li><a href="signup"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
																				</ul>
																				');
																	}

															if($this->page=="SignUp")
																	{

																	echo('
																				<ul class="nav navbar-nav navbar-right">
																				<li><a href="login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
																				</ul>
																				');
																	}

														}

										?>


        </div>
    </nav>
    <div id="container">
