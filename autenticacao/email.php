<?php
session_start();
$nome = $_SESSION['nome'];
$sobrenome = $_SESSION['sobrenome'];
$email = $_SESSION['email'];
$identidade = $_SESSION['id'];
$assunto = $_POST['assunto'];
$mensagem = $_POST['mensagem'];

$to = "angelo_rafael_dos_santos@hotmail.com";
$subject = "$assunto";
$message = "<strong>Nome:</strong> $nome $sobrenome <br /> <br /> <strong>Idusuario:</strong> $identidade 
<br /> <br /> <strong>Email:</strong> $email <br /> <br /> <strong>Assunto:</strong> $assunto 
<br /> <br /> <br /> <strong>Mensagem:</strong> $mensagem";
$header = "MIME-Version: 1.0\n";
$header = "Content-type: text/html; charset=iso-8859-1\n";
$header = "From: $email\n";
mail($to, $subject, $message, $header);
header('Location: ../sucesso.php');

if(!isset($_SESSION['email'])){
    header('Location: ../login.php');
  }
?>