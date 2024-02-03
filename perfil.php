<?php 
require('header.php');
?>
  <link rel="stylesheet" href="css/styleperfil.css" type="text/css" />
  <div class="row">
     <div class="col s8 offset-s2 barrauser">
         <li>
          <div id="CapsulaDaFoto2">
              <img src="<?php echo $_SESSION['foto']; ?>" id="user">
          </div>
         </li>
         <li id="dados">
              Ola <?php echo $_SESSION['nome'];?><p></p>
              Cidade:<?php echo $_SESSION['cidade']." UF:".$_SESSION['estado']." Rua:".$_SESSION['endereco'];?> 
         </li>
         <li id="iconeop">
           <i class="material-icons waves-effect waves-light waves-circle dropdown-button buttontwo" data-activates="submenu" data-gutter="5" data-constrainwidth="false" id="iconeop">settings</i>
           <ul id="submenu" class="dropdown-content">
                  <a class="black-text modal-trigger" href="#TrocarFoto">Trocar Foto</a>
           </ul>
         </li>
         
      </div>
  
        <!-- Modal chamado pelo href TrocarFoto -->
          <div id="TrocarFoto" class="modal">
             <form action="perfil.php" method="post" enctype="multipart/form-data" id="form1" >
              <div  id="alteraimg">
                      <img id="blah" src="<?php echo $_SESSION['foto']; ?>" >
              </div>
              <br>
               Mudar foto de perfil:

              <br>
          
              <label for='imgInp' id="labelimg">Selecionar Imagem</label>
              <input type='file' id="imgInp" name="perfil" /><br>
              <input type="submit"  value="Salvar" id="salvar">
              </form>
          </div>
      
      <div class="col s8 offset-s2 barraopcao">
            
                <div class="col s12">
                  <ul class="tabs">
                    <li class="tab col s3"><a href="#anunciar" class="waves-effect tabtexto">Anunciar</a></li>
                    <li class="tab col s3"><a href="#publi" class="waves-effect tabtexto">Itens publicados</a></li>
                    <li class="tab col s3"><a href="#compras" class="waves-effect tabtexto">Comprados</a></li>
                    <li class="tab col s3"><a href="#estante" class="waves-effect tabtexto">Vendidos</a></li>
                  </ul>
                </div>
          </div>
	  
    <!-- campo para anunciar produto -->
    
	  <div id="anunciar" class="col s8 offset-s2">

            <form class="col s12" action="autenticacao/functions.php?func=publica" method="post" enctype="multipart/form-data">
              <div class="row">
                    <input type='file' id="imgInp2" name="FotoProduto"/><br>
                <div id="capsulaFotoProduto">
                    <img id ="foto_livro" src="img/download.png"></img>
                </div>
                <p>
                <label for='imgInp2' id="labelimg">Selecionar Imagem</label>
              </div>
              <div class="row">
                <div class="input-field col s6">
                  <i class="material-icons prefix">book</i>
                  <input id="inputFont" type="text" class="validate" name="nome">
                  <label>Nome do livro</label>
                </div>
                <div class="input-field col s6">
                  <i class="material-icons prefix">assignment_ind</i>
                  <input id="inputFont" type="text" class="validate" name="autor">
                  <label >Nome do Autor(a)</label>
                </div>
                <div class="input-field col s6">
                  <i class="material-icons prefix">edit</i>
                  <input id="inputFont" type="text" class="validate" name="editora">
                  <label >Nome da Editora</label>
                </div>
                  <div class="input-field col s6">
                    <i class="material-icons prefix">turned_in</i>
                  <select name="genero">
                    <option value="" disabled selected>Escolha o genero do livro</option>
                    <option value="Ação">Ação</option>
                    <option value="Auto Ajuda">Auto Ajuda</option>
                    <option value="Contos">Contos</option>
                    <option value="Didaticos">Didaticos</option>
                    <option value="Fantasia">Fantasia</option>
                    <option value="Gastronomia">Gastronomia</option>
                    <option value="Infantil">Infantil</option>
                    <option value="Romance">Romance</option>
                    <option value="Romance Policial">Romance Policial</option>
                    <option value="Aventura & Fantasia">Aventura & Fantasia</option>
                    <option value="ficção cientifica">ficção cientifica</option>
                    <option value="Terror">Terror</option>
                    <option value="Poesia">Poesia</option>
                    <option value="Manga (Quadrinhos Orientais)">Manga (Quadrinhos Orientais)</option>
                    <option value="HQS (Quadrinhos Ocidentais)">HQS (Quadrinhos Ocidentais)</option>
                    <option value="Biografia">Biografia</option>
                    <option value="Esporte">Esporte</option>
                    <option value="Suspense">Suspense</option>
                  </select>
                </div>
                <div class="input-field col s6">
                  <i class="material-icons prefix">description</i>
                  <input id="inputFont" type="text" class="validate" name="descricao">
                  <label >Descrição</label>
                </div>
                <div class="input-field col s6">
                  <i class="material-icons prefix">attach_money</i>
                  <input id="inputFont" type="number" class="validate" step="0.010" name="valor">
                  <label >Valor do Produto</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">star_rate</i>
                  <select name="estado" class="select">
                    <option value="" disabled selected>Escolha o Estado do seu produto</option>
                    <option value="Razoável">Razoável</option>
                    <option value="Bom">Bom</option>
                    <option value="Exelente">Excelente</option>
                  </select>
                </div>
                <div class="input-field col s6">
                  <i class="material-icons prefix">how_to_vote</i>
                  <input id="inputFont" type="number" class="validate" name="qtd">
                  <label >Quantidade do produto</label>
                </div>
                
                <div class="input-field col s12">
                  <i class="material-icons prefix">short_text</i>
                  <textarea id="inputFont" class="materialize-textarea" name="sinopse"></textarea>
                  <label for="textarea1">Sinopse</label>
                </div>
              </div>
              <input type="submit" name="enviar" id="btnenviar">
              <br>
            </form>
          </div>
          <br>
    </div>
    <div class="row">
          <div id="publi" class="col s8 offset-s2">
            <?php SeusIntensPublicados();?>
          </div>
          <div id="compras" class="col s8 offset-s2">
             <?php produtoComprado(); ?>  
          </div>
          <div id="estante" class="col s8 offset-s2">
            <?php produtosVendidos(); ?>
          </div>
          </div>
     </div>     
	<!-- jquery -->
	<script src="js/jquery.min.js"></script>
	<!--jquery para busca-->
	<script src="js/jquery.autocomplete.js"></script>
	<script>
    		var data = [ <?php busca(); ?> ];
				$("#pesquisa").autocomplete(data, {
				  formatItem: function(item) {
				    return item.text;
				  }
				}).result(function(event, item) {
				  location.href = item.url;
			});
   
  </script>
	<!-- bootstrap -->
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<!-- script materialize -->
	<script type="text/javascript" src="js/materialize.js"></script>
	<!-- nosso script -->
  <script src="js/script.js"></script>
</body>
</html>