<?php
// incluido a conexão com banco
include'conn.php';
// pegando dados por metodo post
$nome=$_POST['nome'];
$sobrenome=$_POST['sobrenome'];
$email=$_POST['email'];
$cidade=$_POST['cidade'];
$cep=$_POST['cep'];
$estado=$_POST['estado'];
$cpf=$_POST['cpf'];
$endereco=$_POST['endereco'];
$complemento=$_POST['complemento'];
$senha=$_POST['senha'];
$foto = "../banco de dados/imagem/user.png";
//imserindo dados na tabela
$sql = "INSERT INTO usuarios (nome, sobrenome, email, cidade, cep, estado, cpf, endereco, complemento, senha, foto)
VALUES('$nome', '$sobrenome', '$email', '$cidade', '$cep', '$estado', '$cpf', '$endereco', '$complemento', '$senha', '$foto')";
//verifica linhas afetadas
$verifica= mysqli_query($con,$sql);

if($verifica == true){
    header("location:../login.php");
}else{
    echo "<script> function alerta(){document.write('Erro ao realizar cadastro...');}</script>";
}

?>