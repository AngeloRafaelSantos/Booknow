<?php
include_once('autenticacao/functions.php');
session_start();
if(isset($_POST['email'])){
  login($_POST['email'],$_POST['senha']);
}
?>
<!doctype html>
<html>
	<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<title>Login</title>
	<!--maaterialize css-->
	<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="css/stylelogin.css">

	</head>
	<body>
	<div class="col s12 topo">
		<div class="row">
		<div class="col s3 hlogo">
			<a href="index.php">
			<img src="img/logobooknow.png" id="logo"></img>
			</a>
		</div>
		</div>
	</div>
	<div class="col s12 topoMobile">
		<div class="row">
		<div class="col s8 offset-s2">
			<a href="index.php">
			<img src="img/logobooknow.png" id="logo"></img>
			</a>
		</div>
		</div>
	</div>
		<div class="row">
		<div class="col s4 offset-s4 tudo">
					<img src="img/user.png" class="user">
			<h4>Login</h4>
			<form action="login.php" method="post">
				<div class="input-field col s10 offset-s1">
				<input type="text" id="email" name="email" required="required">
				<label for="email">Email</label>
				</div>
				<div class="input-field col s10 offset-s1">
				<input type="password" id="password" name="senha" required="required">
				<label for="password">Senha</label>
				</div>
				<font face="arial" size="4" style="color:red"><script type="text/javascript"> alerta() </script></font>
				<br>
				<input type="submit" id="cadastra">
				<br><p></p>
				<div class='col s6'>
				<a href="#" id="esque">Esqueceu sua senha ?</a> &emsp;&emsp;&emsp; <div id="esp"><br></div>
				</div>
				<div class='col s6'>
				<a href="cadastro.php" id="cad">Não Possui Cadastro ?</a>
				</div>
			</form>
		</div>
		</div>
															
																<!--mobile-->
																
		<div class="row">
		<div class="col s10 offset-s1 tudoMobile">
			<img src="img/user.png" class="user">
			<h4>Login</h4>
			<form action="login.php" method="post">
				<div class="input-field col s10 offset-s1">
				<input type="text" id="email" name="email" required="required">
				<label for="email">Email</label>
				</div>
				<div class="input-field col s10 offset-s1">
				<input type="password" id="password" name="senha" required="required">
				<label for="password">Senha</label>
				</div>
				<font face="arial" size="4" style="color:red"><script type="text/javascript"> alerta() </script></font>
				<br>
				<input type="submit" id="cadastra">
				<br><p></p>
				<div class='col s6 text-center'>
				<a href="#" id="esque">Esqueceu sua senha ?</a> &emsp;&emsp;&emsp; <div id="esp"><br></div>
				</div>
				<div class='col s6 text-center'>
				<a href="cadastro.php" id="cad">Não Possui Cadastro ?</a>
				</div>
			</form>
		</div>
		</div>
	<!--script jquery -->	
	<script src="js/jquery.min.js"></script>
	<!-- script materialize -->
	<script type="text/javascript" src="js/materialize.js"></script>
	<!-- nosso js -->
  	<script type="text/javascript" src="js/script.js"></script> 
  	
	</body>
</html>

		

		<!--<div class="loginBox">-->
		<!--	<img src="img/user.png" class="user">-->
		<!--	<h2>Login</h2>-->
		<!--	<form action="login.php" method="post">-->
		<!--		<p>Email</p>-->
		<!--		<input type="text" id="email" name="email" placeholder="Insira seu email" required="required">-->
		<!--		<p>Senha</p>-->
		<!--		<input type="password" id="password" name="senha" placeholder="••••••" required="required">-->
		<!--		<font face="arial" size="4" style="color:red"><script type="text/javascript"> alerta() </script></font>-->
		<!--		<br>-->
		<!--		<input type="submit">-->
		<!--		<a href="#" id="esque">Esqueceu sua senha ?</a> &emsp;&emsp;&emsp; <div id="esp"><br></div>-->
		<!--		<a href="cadastro.php" id="cad">Não Possui Cadastro ?</a>-->
		<!--	</form>-->
		<!--</div>-->

