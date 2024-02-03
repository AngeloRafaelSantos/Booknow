 <?php 
include_once('autenticacao/functions.php');
  session_start();
  if(!isset($_SESSION['email'])){
    header('Location: login.php');
  }
?>
 <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">

      <script type="text/javascript" src="js/jquery.min.js"></script>
      
      <link rel="stylesheet" type="text/css" href="css/styleticket.css">
      
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      
      <script type="text/javascript" src="js/script.js"></script>

      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    </head>

    <body>
               <!-------------------- MENU MOBILE -------------------->
              
      <div class="col-xs-12 menumobile">
        <i data-activates="slide-out" class="material-icons button-collapse" id="iconMenu">menu</i>
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
                <a href="../LOGIN/index.php"><img class="circle" src="../banco de dados/imagem/user.png" id="perfil"></a>';
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
              <h1>Faça seu Login</h1>
              <h2>ou cadastre-se</h2>
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
            <div class="col-xs-12" id="menu1">
            <div class="row">
              <a href="#!">
                <div class="col-xs-12 liconfig">
                  Home
                </div>
              </a>
            </div>
            <div class="row">
              <a href="#!">
              <div class="col-xs-12 liconfig">
                  Generos
                </div>
              </a>
            </div>
            <div class="row">
              <a href="#!">
                <div class="col-xs-12 liconfig">
                  Quem Somos
                </div>
              </a>
            </div>
            <div class="row">
              <a href="#!">
                <div class="col-xs-12 liconfig">
                  Suporte
                </div>
              </a>
            </div>
            <?php
              if(isset($_SESSION['email'])){
                echo'
                <div class="row">
                  <a href="#!">
                    <div class="col-xs-12 liconfig">'?>
                    <a href="../autenticacao/encerra.php"><li><i class="material-icons" id="logaut">input</i></li></a>
          <?php echo'</div>
                  </a>
              </div>';
              }else {
                echo'
                <div class="row">
                  <a href="#!">
                    <div class="col-xs-12 liconfig">
                      <i class="material-icons" id="logaut">insert_emoticon</i>
                    </div>
                  </a>
                </div>
                ';
              }
            ?>
            </div>
          </ul>
        
                  <!-------------------- MENU DESKTOP -------------------->
                  
        <div class="col-xs-12 menu" id="menu">
            <li><a href="index.php"> Home</a></li>
              <li class='dropdown-button' data-activates='dropdown1'><a href="#" > Generos </a>
            <ul id='dropdown1' class='dropdown-content'>
                <li><a href="catalogo.php" id="decoration">Todos</a></li>
                <li><a href="genero.php?genero=Ação" id="decoration">Ação</a></li>
                <li><a href="genero.php?genero=Aventura" id="decoration">Aventura</a></li>
                <li><a href="genero.php?genero=Romance" id="decoration">Romance</a></li>
                <li><a href="genero.php?genero=Suspense" id="decoration">Suspense</a></li>
                <li><a href="#!" id="decoration">Outros</a></li>
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
                            <li><a href='perfil.php'' id='decoration'>Meu Perfil</a></li>
                            <li><a href='autenticacao/encerra.php' id='decoration'>Logout</a></li>
                        </ul>
                       </li>";
                 }
                
                ?></li>
        </div>
     </div>
  </div>
 

      <br>
      <p>
      <br>
      </p>
      <br>
      <br>
      <p>
      <br>
      </p>
      <br>
      <section>
        <div class="loginBox">
			<form action="autenticacao/email.php" method="post">
				<p>Assunto</p>
				<input type="text" id="email" name="assunto" placeholder="insira um assunto" required="required">
				<p>Descrição</p>
				<textarea id="mensagem" cols="5" rows="80" name="mensagem"/></textarea>
				<br><br>
				<a class="waves-effect waves-dark btn"><input type="submit"><i class="material-icons left">cloud</i></a>

			</form>
		</div>
		
		

      </section>
      
      <footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">BookNow</h5>
                <p class="grey-text text-lighten-4">O universo de cada um se resume no tamanho de seu saber.<br><i>Albert Einstein</i></p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Siga-nos</h5>
                <ul>
                  <div class='col s1'><a class="grey-text text-lighten-3" href="#!">
                    <img src='img/face.png' class='iconSo'>
                  </a></div>
                  <div class='col s1 offset-s1'><a class="grey-text text-lighten-3" href="#!">
                    <img src='img/insta.png' class='iconSo'>
                  </a></div>
                  <div class='col s1 offset-s1'><a class="grey-text text-lighten-3" href="#!">
                    <img src='img/tt.png' class='iconSo'>
                  </a></div>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2018 BookNow
            <a class="grey-text text-lighten-4 right" href="#!">Entre em contato</a>
            </div>
          </div>
        </footer>
   <!--maaterialize min-->
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <!-- jquery -->
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <!--bootstrap js-->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!--maaterialize js-->
  <script type="text/javascript" src="js/materialize.js"></script>
  <!--nosso scriipt -->
  <script src="js/script.js"></script>


    </body>
  </html>