<?php
include_once('autenticacao/functions.php');
include_once('busca.php');
	session_start();
	if($_FILES){
      if(isset($_FILES['perfil']['name'])){
        MudaFotoPerfil();
      }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Booknow</title>
	<!--maaterialize css-->
	<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
	<!--icons google -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--estilo autocomplete-->
	<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
	
	
</head>
<body>
   <div class="container-fluid">
	   <div class="row">
		   	<div class="col s12" id="topo">
		   		<form id="formPesquisa" autocomplete="off" action="resultadopesquisa.php?func=pesquisa" method="get">
		   			<div class="col s3">
		   				<a href="index.php">
		   				<img src="img/logobooknow.png" id="logofina"></img>
		   				</a>
		   			</div>
		   			<div class=" col s6 white-text">
		   			<input type="text" name="pesquisa" id="pesquisa" class="searchbtn"/>
		   			</div>
		   			<div class="input_field col s1">
		   			<button id="enviaPesquisa" type="submit"><i class='material-icons white-text submit pointer' >search</i></button>
		   			</div>
		   		</form>
		   		<div class="col s3" id="capsulacart">
		   			<a href="carrinho.php"><i class='material-icons white-text' id="carrinho">shopping_cart</i>
		   			<i id="carquant">
		   				<?php 
		   					//numCarrinho();
		   						echo $_SESSION['qtd'];
		   				?>	
		   			</i>
		   			</a>
		   		</div>
		   	</div>
		   		<!-------------------- MENU MOBILE -------------------->
						
			<div class="col s12 menumobile">
				<div class=" col s1 white-text piconmenu">
					<i data-activates="slide-out" class="material-icons button-collapse" id="iconMenu">menu</i>
					</div>
				<form id="formPesquisa" autocomplete="off" action="resultadopesquisa.php?func=pesquisa" method="get">
					
					<br>
		   			<div class=" col s8 offset-s1 white-text">
		   			<input type="text" name="pesquisa" id="pesquisa" class="searchbtn"/>
		   			</div>
		   			<div class="input_field col s2">
		   			<button id="enviaPesquisa" type="submit"><i class='material-icons white-text submit pointer' >search</i></button>
		   			</div>
		   		</form>
		   		
			</div>
		
			<ul id="slide-out" class="side-nav">
				    <li>
				    	<div class="user-view">
				      	<div class="background">
				        <img src="../banco de dados/imagem/fundo.jpg" id="backgroundimage">
				      	</div>
				      	<?php
				      	if(!isset($_SESSION['email'])){ 
				      	echo'
				      	<a href="login.php"><img class="circle" src="../banco de dados/imagem/user.png" id="perfil"></a>';
				    	}else{ 
				    	echo'
				    	<a href="../perfil/index.php">';?><img class="circle" src="<?php echo$_SESSION['foto'];?>" id="perfillogado"> <?php echo'</a>';
				    	 }?>
				    	</div>
				    	
				    </li>
				    <?php
				    if(!isset($_SESSION['email'])){ 
				    echo'
				    <div id="LoginMobile">
				    	<br>
				    	<h4>Faça seu Login</h4>
				    	<h5>ou cadastre-se</h5>
				    </div>';
				    }else{
				    	echo'
				    <div id="LoginMobile">
				    	<br>
				    	<h1>Bem Vindo</h1>
				    	<h2>'.$_SESSION['nome'].'</h2>
				    </div>';
				    }
				    ?>
				    <div class="col s12" id="menu1">
				    <div class="row">
				    	<a href="index.php">
				    		<div class="col s12 liconfig">
				    			Home
				    		</div>
				    	</a>
				    </div>
				    <div class="row">
				    	<a href="catalogo.php">
							<div class="col s12 liconfig">
				    			Generos
				    		</div>
				    	</a>
				    </div>
				  	<div class="row">
				    	<a href="#!">
				    		<div class="col s12 liconfig">
				    			Quem Somos
				    		</div>
				    	</a>
				    </div>
				    <div class="row">
				    	<a href="#!">
				    		<div class="col s12 liconfig">
				    			Suporte
				    		</div>
				    	</a>
				    </div>
				    <?php
				    	if(isset($_SESSION['email'])){
				    		echo'
				    		<div class="row">
						    	<a href="#!">
						    		<div class="col s12 liconfig">'?>
						    		<a href="../autenticacao/encerra.php"><li><i class="material-icons" id="logaut">input</i></li></a>
					<?php echo'</div>
						    	</a>
							</div>';
				    	}else {
				    		echo'
				    		<div class="row">
						    	<a href="#!">
						    		<div class="col s12 liconfig">
						    			<i class="material-icons" id="logaut">insert_emoticon</i>
						    		</div>
						    	</a>
				    		</div>
				    		';
				    	}
				    ?>
				    </div>
  				</ul>
 				
        					<!-------------------- MENU DESCKTOP -------------------->
        					
		   	<div class="col s12 menu" id="menu">
        			<li class='dropdown-button' data-activates='dropdown1'><a href="#" > Generos </a>
						<ul id='dropdown1' class='dropdown-content'>
						    <li><a href="catalogo.php">Todos</a></li>
						    <li><a href="genero.php?genero=Ação">Ação</a></li>
						    <li><a href="genero.php?genero=Aventura">Aventura</a></li>
						    <li><a href="genero.php?genero=Romance">Romance</a></li>
						    <li><a href="genero.php?genero=Suspense">Suspense</a></li>
						    <li><a href="#!">Outros</a></li>
	  					</ul>
        			</li>
        			<li><a href="quem_somos.php">Quem somos</a></li>
        			<li><a href="suporte.php">Suporte</a></li>
        			<li id="login"><?php
		            if (!isset($_SESSION['email'])){
		            echo '<a href="login.php">Login</a>';
		            }
		            else{
		             echo "<li class='dropdown-button' data-activates='dropdown2' id='barra'>
		            		<a href='#'>";?> 
			            		<div id="CapsulaDaFoto"><img src='<?php echo $_SESSION['foto'];?>' id="FotoPerfil"></div>
			            		<?php echo "<div id='NameUser'>&nbsp; ".$_SESSION['nome']."</div>"; echo"
		            		</a> 
		                    <ul id='dropdown2' class='dropdown-content'>
		                        <li><a href='perfil.php'>Meu Perfil</a></li>
		                        <li><a href='autenticacao/encerra.php'>Logout</a></li>
		                    </ul>
		                   </li>";
		             }
		            
		            ?></li>
		   	</div>
	   </div>
	</div>