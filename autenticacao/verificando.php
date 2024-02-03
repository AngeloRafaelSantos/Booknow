<?php
$host = "localhost";
$user = "root";
$pass = "usbw";
$banco = "cadastro";
$conexao = mysql_connect($host, $user, $pass) or die(mysql_error());
mysql_select_db($banco) or die(mysql_error());
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Autenticando...</title>
	<script type="text/javascript">
		function loginsuccessfully() {
			setTimeout("window.location='../home/index.php'", 5000);
		}
		function loginfailed(){
			setTimeout("window.location='../login/index.php'", 5000);
		}
	</script>
</head>
<body>


<?php
$email = $_POST['email'];
$senha = $_POST['senha'];
$sql = mysql_query("SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha'") or die(mysql_error());
$row = mysql_num_rows($sql);
if ($row > 0) {
	session_start();
	$_SESSION['email']=$_POST['email'];
	$_SESSION['senha']=$_POST['senha'];
	echo "<center><h1>você foi logado com sucesso! aguarde um instante...</h1></center>";
	echo "<script>loginsuccessfully()</script>";

} else{
	echo "<center><h1>nome ou senha incorretos! Aguarde para tentar novamente...</h1></center>";
	echo "<script>loginfailed()</script>";
}
?>

</body>
</html>