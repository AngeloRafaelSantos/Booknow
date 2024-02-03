<?php
include_once ('autenticacao/functions.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <!--maaterialize css-->
	    <link rel="stylesheet" type="text/css" href="css/materialize.min.css">
	    <!--bootstrap css-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <title>teste</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
         <link rel="stylesheet" href="css/styleperfil.css" type="text/css" />
    </head>
    <body>
        <?php produtosVendidos(); ?>    
    </body>
    <!-- jquery -->
	<script src="js/jquery.min.js"></script>
		<!-- bootstrap -->
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!--maaterialize js-->
	<script type="text/javascript" src="js/materialize.js"></script>
	<!-- nosso script -->
	<script type="text/javascript" src="js/script.js"></script>
</html>