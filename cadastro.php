<!doctype html>
<html>
	<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<title>Cadastro</title>
	<!--maaterialize css-->
	<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="css/stylecadastro.css">

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
			<h4>
				<i class="material-icons">account_circle</i>
				<br>Cadastrar-se</h4>
			
			<form action="autenticacao/cadastrando.php" name="signup" id="signup" method="post" onsubmit="return validarSenha();">
				<div class="input-field col s12">
				<input type="text" required="required" name="nome" id="nome"> 
				<label for="nome">Nome</label>
				</div>
				<div class="input-field col s12">
				<input type="text" required="required" name="sobrenome">
				<label for="sobrenome">Sobrenome</label>
				</div>
				<div class="input-field col s12">
				<input type="email" required="required" name="email">
				<label for="email">Email</label>
				</div>
				<div class="input-field col s6">
				<input type="text" required="required" name="cidade">
				<label for="cidade">Cidade</label>
				</div>
				<div class="input-field col s6">
				<input type="number" name="cep">
				<label for="cep">CEP</label>
				</div>
				<div class="input-field col s12">
				<input type="number" name="cpf">
				<label for="cpf">CPF</label>
				</div>
				<div class="input-field col s12">
				<input type="text" required="required" name="estado">
				<label for="estado">Estado</label>
				</div>
				<div class="input-field col s12">
				<input type="text" required="required" name="endereco">
				<label for="endereco">Endereço</label>
				</div>
				<div class="input-field col s12">
				<input type="text" name="complemento">
				<label for="complemento">Complemento</label>
				</div>
				<div class="input-field col s6">
				<input type="password" required="required" name="senha">
				<label for="senha">Senha</label>
				</div>
				<div class="input-field col s6">
				<input type="password" required="required" name="c_senha">
				<label for="c_senha">Confirmar Senha</label>
				</div>
				<font face="arial" size="4" style="color:red"><script type="text/javascript"> alerta() </script></font>
				<input type="submit" value="Cadastrar-se" id="cadastra">
				<br><p></p>
				<a href="login.php" id="esque">Ja possui cadastro ? Entrar</a>

				<br><br><br>

			</form>
		</div>
		</div>
															
																<!--mobile-->
																
		<div class="row">
		<div class="col s10 offset-s1 tudoMobile">
			<h4>
				<i class="material-icons">account_circle</i>
				<br>Cadastrar-se</h4>
			
			<form action="autenticacao/cadastrando.php" name="signup" id="signup" method="post" onsubmit="return validarSenha();">
				<div class="input-field col s12">
				<input type="text" required="required" name="nome" id="nome"> 
				<label for="nome">Nome</label>
				</div>
				<div class="input-field col s12">
				<input type="text" required="required" name="sobrenome">
				<label for="sobrenome">Sobrenome</label>
				</div>
				<div class="input-field col s12">
				<input type="email" required="required" name="email">
				<label for="email">Email</label>
				</div>
				<div class="input-field col s6">
				<input type="text" required="required" name="cidade">
				<label for="cidade">Email</label>
				</div>
				<div class="input-field col s6">
				<input type="number" name="cep">
				<label for="cep">CEP</label>
				</div>
				<div class="input-field col s12">
				<input type="number" name="cpf">
				<label for="cpf">CPF</label>
				</div>
				<div class="input-field col s12">
				<input type="text" required="required" name="estado">
				<label for="estado">Estado</label>
				</div>
				<div class="input-field col s12">
				<input type="text" required="required" name="endereco">
				<label for="endereco">Endereço</label>
				</div>
				<div class="input-field col s12">
				<input type="text" name="complemento">
				<label for="complemento">Complemento</label>
				</div>
				<div class="input-field col s6">
				<input type="password" required="required" name="senha">
				<label for="senha">Senha</label>
				</div>
				<div class="input-field col s6">
				<input type="password" required="required" name="c_senha">
				<label for="c_senha">Confirmar Senha</label>
				</div>
				<font face="arial" size="4" style="color:red"><script type="text/javascript"> alerta() </script></font>
				<input type="submit" value="Cadastrar-se" id="cadastra">
				<br><p></p>
				<a href="login.php" id="esque">Ja possui cadastro ? Entrar</a>

				<br><br><br>

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
