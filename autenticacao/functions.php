<?php
include_once ('conn.php');
$func =$_GET['func'];
switch ($func) {
	case 'publica':
		PublicarProduto();
	break;
	case 'deleta':
		deletarProduto();
	break;
	case 'session':
		sessionCar();
	break;
	case 'pesquisa':
		mostrarPesquisa();
	break;
	case'correios':
	apiCorreios();
	break;
}

													//funcão do login

function login($email,$senha){
	$sql = 'SELECT * FROM usuarios WHERE email ="'.$email.'" and senha ="'.$senha.'"' or die(mysql_error());
	$res = $GLOBALS['con']->query($sql);
	if($res->num_rows > 0){
		$dados = $res->fetch_array();
		$_SESSION['id'] = $dados['idusuarios'];
		$_SESSION['nome'] = $dados['nome'];
		$_SESSION['email'] = $dados['email'];
		$_SESSION['cidade'] = $dados['cidade'];
		$_SESSION['cep'] = $dados['cep'];
		$_SESSION['endereco'] = $dados['endereco'];
		$_SESSION['estado'] = $dados['estado'];
		$_SESSION['sobrenome'] = $dados['sobrenome'];
		$_SESSION['foto'] = $dados['foto'];
		header("location:../index.php");
	}else{
		echo "<script> function alerta(){document.write('Senha ou Email Incorretos...');}</script>";
	}
}

											// função alterar foto de perfil

function MudaFotoPerfil(){
	$destino = "banco de dados/imagem/".$_SESSION['id'].'/';
	if(!is_dir($destino)){
		mkdir($destino);
	}
	$destino.=$_FILES['perfil']['name'];
	
	if(move_uploaded_file($_FILES['perfil']['tmp_name'], $destino))
	{ //se fazer upload, atualize a foto atual da sessão
		$_SESSION['foto'] = $destino;
		$sql = 'UPDATE usuarios SET foto = "'.$destino.'" WHERE idusuarios ='.$_SESSION['id'];
		$res = $GLOBALS['con']->query($sql);
		if($res){
			header("location:../perfil.php");
		}
	}else{
		echo "<script> alert('erro ao atualizar perfil')</script>";
	}
}

												//função cadastrar produto

function PublicarProduto(){
	session_start();
	$pastaUser="../banco de dados/imagem/".$_SESSION['id']."/";
	if(!is_dir($pastaUser)){
		mkdir($pastaUser);
	}
	$foto = "../banco de dados/imagem/".$_SESSION['id']."/produtos/";
	
	$user=$_SESSION['id'];
	
	if(!is_dir($foto)){
		mkdir($foto);
	}
	$foto.=$_FILES['FotoProduto']['name'];
	if(move_uploaded_file($_FILES['FotoProduto']['tmp_name'], $foto))
	{ //se fazer upload, atualize a foto atual da sessão
		$nomelivro = $_POST['nome'];
		$autor = $_POST['autor'];
		$editora = $_POST['editora'];
		$genero = $_POST['genero'];
		$descricao = $_POST['descricao'];
		$preco = $_POST['valor'];
		$qtd= $_POST['qtd'];
		$estado= $_POST['estado'];
		$sinopse = $_POST['sinopse'];
		$data = date("Y-m-d");
		$sql = "INSERT INTO tb_postagem (cd_foto, nm_livro, nm_autor, dt_data, cd_descricao, genero, editora, cd_qtd, dl_estado, sinopse, vl_preco, id_usuario)
		VALUES ('$foto', '$nomelivro', '$autor', '$data', '$descricao', '$genero','$editora','$qtd','$estado','$sinopse', '$preco','$user')"; 
		$res = $GLOBALS['con']->query($sql);
		if($res > 0){
			header("location: ../perfil.php");
			echo "<script> alert('Produto publicado com exito!!')</script>";
		}else {
			echo$sql;
		}
		
	}else{
		echo "erro";
	}
	
}

												//função mostrar catalogo
												
function MostrarCatalogo(){
	session_start();
	$logado = $_SESSION['id'];
	// começo do codigo do pagination
	$sql="SELECT * FROM tb_postagem";
	$res = $GLOBALS['con']->query($sql);
	while ($mostrar= $res->fetch_array()){
			$id = $mostrar['id_postagem'];
			$i++;
	}
	echo "
		<div class='row'>
			<div class='col s2 offset-s1'>
			".$i." Produtos
			</div>
		</div>
	";
		$total = $res->num_rows;
		$pp = 5;
		$totalpag = ceil($total / $pp);
		$pagina =  isset($_GET['pag']) ? $_GET['pag']:1;
		$inicio = ($pp*$pagina) - $pp;

		$sql="SELECT * FROM tb_pedido WHERE id LIMIT $inicio, $pp";
		$res = $GLOBALS['con']->query($sql);
	
	
	// busca produtos e mostra na tela
	$sql="SELECT * FROM tb_postagem WHERE id_postagem LIMIT $inicio, $pp";
		$res = $GLOBALS['con']->query($sql);
	
		
			 while ($mostrar= $res->fetch_array()){
			$id = $mostrar['id_postagem'];
			$cdfoto = $mostrar['cd_foto'];
			$livro = $mostrar['nm_livro'];
			$data = $mostrar['dt_data'];
			$descricao = $mostrar['cd_descricao'];
			$genero = $mostrar['genero'];
			$editora =$mostrar['editora'];
			$valor = $mostrar['vl_preco'];
			$user = $mostrar['id_usuario'];
			$sql2="SELECT * FROM usuarios WHERE idusuarios = $user";
			$res2 = $GLOBALS['con']->query($sql2);
			while ($mostrar2= $res2->fetch_array()){
				$nomeUser=$mostrar2['nome'];
				$Snome=$mostrar2['sobrenome'];
				
			}
			
			if($logado != $user){
				
				echo"
				<div class='row'>
		          <div class='col s10 offset-s1 produtosen'>
		          		<div class='col s1 fotoen'>
		          				<img src='".$cdfoto."' id='produtofto'></img>
		          		</div>
		          		<div class='col s3 offset-s1 dadosdolivroen'>
		          			Nome do livro: ".$livro."<br>
		          			<div class='detalhesCar'>
		          			Detalhes: ".$descricao."</div><br>
		          			Genero: ".$genero."
		          		</div>
		          		<div class='col s4 dadosdolivroen'>
		          			Nome do vendedor: ".$nomeUser." ".$Snome."<br><p>
		          			Editora: ".$editora."<br><p>
		          			R$:".$valor."
		          		</div>
		          		<div class='col s3 dadosdolivroen'>
		          			<a href='mostra_produto.php?id=".$id."'><button id='btncar'>Mais Detalhes</button></a>
		          			<a class='addCart pointer' data-id='".$id."' data-livro='".$livro."'>
		          			<div class='btncar2'><i class='material-icons' id='car2'>local_grocery_store</i></div>
		          			</a>
		          		</div>
		          </div>
		          </div>
		        
				    ";
			}elseif($logado == $user){
				echo"
				<div class='row'>
		          <div class='col s10 offset-s1 produtosen'>
		          		<div class='col s1 fotoen'>
		          				<img src='".$cdfoto."' id='produtofto'></img>
		          		</div>
		          		<div class='col s3 offset-s1 dadosdolivroen'>
		          			Nome do livro: ".$livro."<br>
		          			<div class='detalhesCar'>
		          			Detalhes: ".$descricao."</div><br>
		          			Genero: ".$genero."
		          		</div>
		          		<div class='col s4 dadosdolivroen'>
		          			Nome do vendedor: ".$nomeUser." ".$Snome."<br><p>
		          			Editora: ".$editora."<br><p>
		          			R$:".$valor."
		          		</div>
		          		<div class='col s3 dadosdolivroen'>
		          			<a href='mostra_produto.php?id=".$id."'><button id='btncar'>Mais Detalhes</button></a>
		          			<a class='seuProduto pointer'>
		          			<div class='btncar2'><i class='material-icons' id='car2'>remove_shopping_cart</i></div>
		          			</a>
		          		</div>
		          </div>
		        </div>
				    ";}
		          
		     }
		     
		     //final do codigo pagination
		     $r=$_GET['pag']-'1';
		     if($r>=1){
		     echo"<ul class='pagination'>
				    <li><a href='?pag=$r'><i class='material-icons'>chevron_left</i></a></li>";
		     }else{
		     	echo"<ul class='pagination col s12'>";
		     }
		     for ($btn=1; $btn <= $totalpag ; $btn++) {
		     	echo"<li id='numpag'><a href='?pag=$btn'>".$btn."</a></li>";
		     }
		     $l= isset($_GET['pag'])? $_GET['pag'] + 1 : 2;
		    if($l<=$totalpag){
		    echo"<li><a href='?pag=$l'><i class='material-icons'>chevron_right</i></a></li>
				  </ul>";
		    }	  
}


											// gerar pagina para o produto

function GerarPaginaProduto(){
	session_start();
	$logado=$_SESSION['id'];
	$produto =$_GET['id'];
	$sql="SELECT * FROM tb_postagem WHERE id_postagem = $produto";
	$res = $GLOBALS['con']->query($sql);

			 while ($mostrar= $res->fetch_array()){
			$id = $mostrar['id_postagem'];
			$cdfoto = $mostrar['cd_foto'];
			$livro = $mostrar['nm_livro'];
			$autor = $mostrar['nm_autor'];
			$data = $mostrar ['dt_data'];
			$descricao = $mostrar['cd_descricao'];
			$genero = $mostrar['genero'];
			$editora =$mostrar['editora'];
			$sinopse =$mostrar['sinopse'];
			$valor = $mostrar['vl_preco'];
			$user = $mostrar['id_usuario'];
			$estado = $mostrar['dl_estado'];
			$qtd = $mostrar['cd_qtd'];
			$sql2="SELECT * FROM usuarios WHERE idusuarios = $user";
			$res2 = $GLOBALS['con']->query($sql2);
			while ($mostrar2= $res2->fetch_array()){
				$nomeUser=$mostrar2['nome'];
				$Snome=$mostrar2['sobrenome'];
				$cep=$mostrar2['cep'];
			}
			if ($logado != $user) {
			echo "
			<div class='row'>
				<div class='col s4 offset-s1 gurdaproduto'>
		            	<img class='materialboxed' src='$cdfoto' id='mmproduto'>	
		          </div>
		          <div class='col s4 offset-s2 guardardados'>
		          	<h5>".$livro."</h5>
		          	</h6> ".$descricao."</h6>
		          	Vendido por: ".$nomeUser." ".$Snome."<br>
		          	Data de publicação: ".$data."
		          	<p><h5>R$ ".$valor."</h5></p>
		          	<a href='#' id='comprar-button' data-id='".$id."' data-livro='".$livro."' class='btn-large waves-effect waves-light addCart'><i class='material-icons' id='basket'>shopping_basket</i> &nbsp &nbsp &nbsp Comprar</a>
		          	<div class='row'>
		          	<div class='col s6 offset-s3 estadoProduto'>
		          		<h6>Estado: ".$estado."</h6>
		          	</div>
		          	</div>
		        	<div class='col s6 offset-s3'>
		          		Quatidade fornecida:".$qtd."
		          	</div>
		          </div>
		          <br><p>
		        </div>
				<div class='row'>
		          <div class='col s4 offset-s1 detalhes'>
		            <ul class='collapsible'>
				    <li>
				      <div class='collapsible-header'><i class='material-icons'>description</i>Descrição</div>
				      <div class='collapsible-body'><span>".$descricao."</span></div>
				    </li>
				    <li>
				      <div class='collapsible-header'><i class='material-icons'>book</i>Sinopse</div>
				      <div class='collapsible-body'><span>".$sinopse."</span></div>
				    </li>
				    <li>
				      <div class='collapsible-header'><i class='material-icons'>info</i>Detalhes</div>
				      <div class='collapsible-body'><span>Nome: ".$livro."<br> Autor: ".$autor."<br> Genero: ".$genero."<br>Editora: ".$editora."</span></div>
				    </li>
				  </ul>
				  </div>
				  <div class='col s3 offset-s3 frete'>
				  <form method='post' class='frete'>
					
				    
				    <div class='input-field col s7'>
	                  <i class='material-icons prefix' id='iconDestino'>local_shipping</i>
	                  <input type='number' class='validate'   id='destino'>
	                  <label id='labelDestino' >Digite seu CEP</label>
	                  <input type='hidden' value='".$cep."' id='origem'>
	                </div>
	                <div class='input-field col s1'>
	                	<a class='btn waves-effect waves-light envia'>
	                	<i class='material-icons white-text' >search </i>
					    </a>
	                </div><br>
	                
				   </form>
				   <div class=row>
				   <div id='conteudo'>
						<img src='img/cargando.gif' id='carregando' style='visibility:hidden'>
				   </div>
					</div>
				   </div>
				   </div>
			</div>   
		          ";
		      }else{

		      	echo "
		      	<div class='row'>
		      	<div class='col s4 offset-s1 gurdaproduto'>
		            	<img class='materialboxed' src='$cdfoto' id='mmproduto'>	
		          </div>
		          <div class='col s4 offset-s2 guardardados'>
		          	<h5>".$livro."</h5>
		          	</h6> ".$descricao."</h6>/
		          	Vendido por: ".$nomeUser." ".$Snome."<br>
		          	Data de publicação: ".$data."
		          	<p><h5>R$ ".$valor."</h5></p>
		          	<a href='#' id='nao-comprar' class='btn-large waves-effect waves-light seuProduto'>Não é possiver comprar seu próprio produto</a>
		          	<br><p>
		          </div>
		    	 </div>
		    	 <div class='row'>
		          <div class='col s4 offset-s1 detalhes'>
		            <ul class='collapsible'>
				    <li>
				      <div class='collapsible-header'><i class='material-icons'>description</i>Descrição</div>
				      <div class='collapsible-body'><span>".$descricao."</span></div>
				    </li>
				    <li>
				      <div class='collapsible-header'><i class='material-icons'>book</i>Sinopse</div>
				      <div class='collapsible-body'><span>".$sinopse."</span></div>
				    </li>
				    <li>
				      <div class='collapsible-header'><i class='material-icons'>info</i>Detalhes</div>
				      <div class='collapsible-body'><span>Nome: ".$livro."<br> Autor: ".$autor."<br> Genero: ".$genero."<br>Editora: ".$editora."</span></div>
				    </li>
				  </ul>
				  </div>
				  </div>
		          ";
		      }
		}
}
										// função  frete
										
function apiCorreios(){
$origem=$_POST['origem'];
$destino=$_POST['destino'];
$data['nCdEmpresa'] = 'Booknowsebos';
$data['sDsSenha'] = 'booknowsebos123';
$data['nCdServico']='41106, 40010';
$data['sCepOrigem']=$origem;
$data['sCepDestino']=$destino;
$data['nVlPeso']='1';
$data['nCdFormato']='1';
$data['nVlComprimento']='16';
$data['nVlAltura']='5';
$data['nVlLargura']='15';
$data['nVlDiametro']='0';
$data['sCdMaoPropria']='s';
$data['nVlValorDeclarado']='200';
$data['sCdAvisoRecebimento']='n';
$data['StrRetorno'] = 'xml';

$data = http_build_query($data);

 $url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx';

 $curl = curl_init($url . '?' . $data);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

 $result = curl_exec($curl);
 $result = simplexml_load_string($result);
 echo "<div class='row resultadoFrete'>
			<div class='col s4'>
			Serviço:
			</div>
			<div class='col s4'>
			Preço:
			</div>
			<div class='col s4'>
			Prazo:
			</div>
		";
foreach($result -> cServico as $row) {
 //Os dados de cada serviço estará aqui
 if($row -> Erro == 0) {
     $codigo = $row -> Codigo;
     $valor = $row -> Valor;
     $prazo = $row -> PrazoEntrega;
     if($codigo == 41106){
     	echo "<div class='col s4'>PAC</div>";
     }else{
     	echo "<div class='col s4'>SEDEX</div>";
     }
     echo "<div class='col s4'>R$".$valor."</div>";
     echo "<div class='col s4'>".$prazo."";
     if($prazo<2){
     	echo" dia";
     }else{
     	echo" dias";
     }
     echo "</div>";
    }
 else {
     $erro = $row -> MsgErro;
     echo "<br>".$erro;
 }
 }
 echo"</div>";
}										

										// função mostrar itens no carousel

function ProdutosCarousel(){
	session_start();
	$logado = $_SESSION['id'];
	$limite= 8;
	$sql="SELECT * FROM tb_postagem WHERE id_postagem  LIMIT $limite";
		$res = $GLOBALS['con']->query($sql);

			 while ($mostrar= $res->fetch_array()){
			$id = $mostrar['id_postagem'];
			$cdfoto = $mostrar['cd_foto'];
			$livro = $mostrar['nm_livro'];
			$descricao = $mostrar['cd_descricao'];
			$valor = $mostrar['vl_preco'];
			$vendedor = $mostrar['id_usuario'];
	
			    // <a href='carrinho.php?add=carrinho&id=".$id."'>
  
	echo"		
		<div class='carousel-item'>
			<input type='hidden' id='".$id."' name='id'>
			<div class='card'>
			    <img src='".$cdfoto."' class='image'>
			    <br>";
			    if($logado != $vendedor){
			    echo"
			    <a class='addCart pointer' data-id='".$id."' data-livro='".$livro."' data-valor='".$valor."'>
			    <div class='col s5 offset-s1 teste'>
			    <p>
			   	<i class='material-icons'>add_shopping_cart</i>
			    </div>
			    </a>";
			    }else{
			    	echo"
			    <a class='seuProduto pointer'>
			    <div class='col s5 offset-s1 teste'>
			    <p>
			   	<i class='material-icons'>remove_shopping_cart</i>
			    </div>
			    </a>";
			    }
			    echo"
			    <a href='mostra_produto.php?id=".$id."'>
			    <div class='col s5 teste2'>
			    <div class='row maisDetalhes'>
			     Mais Detalhes
			     </div>
			    </div>
			    </a>
			  </div>
		</div>
		<br>";
		
	}
  
}
											// mostrar menores preços tela inicial
											
function menoresPrecos(){
	
	session_start();
	$user = $_SESSION['id'];
	
	$sql="SELECT * FROM tb_postagem WHERE vl_preco < 20.00 LIMIT 3";
	$res = $GLOBALS['con']->query($sql);
	
	while($mostrar = $res->fetch_array()){
		$id = $mostrar['id_postagem'];
		$cdfoto = $mostrar['cd_foto'];
		$livro = $mostrar['nm_livro'];
		$descricao = $mostrar['cd_descricao'];
		$valor = $mostrar['vl_preco'];
		$autor=$mostrar['nm_autor'];
		$editora= $mostrar['editora'];
		$valorReal = number_format($valor, 2, ',', '.');
		echo"
		  	<div class='col s2 offset-s1 testeMenores'>
		  		<img src='".$cdfoto."' id='fotoMenoresPrecos'>
		  		<br>
		  		<a href='mostra_produto.php?id=".$id."'>
		  		<div class='col s12 detalhesMenoresPrecos'>
		  			<div class='co s12 descricaoMenoresPrecos'>
		  				".$livro." ".$descricao."<br>
		  			</div>
		  			<h4 id='valorMenorPreco'>R$:".$valorReal."</h4>
		  		</div>
		  		</a>
		  	</div>
		  	
		";
		
	}
	
	
}

										//mostrar seus intens publicados na pagina perfil

function SeusIntensPublicados(){
	session_start();
	$user = $_SESSION['id'];
	
	$sql="SELECT * FROM tb_postagem WHERE id_usuario = $user";
		$res = $GLOBALS['con']->query($sql);
	echo"<div class='row'>";
			 while ($mostrar= $res->fetch_array()){
			$id = $mostrar['id_postagem'];
			$cdfoto = $mostrar['cd_foto'];
			$livro = $mostrar['nm_livro'];
			$descricao = $mostrar['cd_descricao'];
			$valor = $mostrar['vl_preco'];
	echo"
	
        <div class='col s12 m6'>
          <div class='card white darken-1'>
            <div class='card-content grey-text'>
              <span class='card-title'>".$livro."</span>
              <img src='".$cdfoto."' id='ftoOrodutoPubli'>
               Sendo vendido por: ".$valor."
            </div>
            <div class='card-action'>
              <a href='#'><i class='material-icons red-text'>edit</i></a>
              <a class=' modal-trigger' href='#modaldeletalivro".$id."' id='apaga'><i class='material-icons grey-text'>delete</i></a>
            </div>
            <div id='modaldeletalivro".$id."' class='modal deletalivro'>
            <h5>Tem certeza que deseja apagar o produto?</h5>
            nome do Produto: ".$livro."
            <br><p><br>
            <a class='waves-effect waves-light btn' href='autenticacao/functions.php?func=deleta&id=".$id."'><i class='material-icons right'>delete_forever</i>Apagar produto</a>
            <br>
            (você não poderar desfazer sua opção)
            </div>
          </div>
        </div>
      
     
	";}
	echo"</div>";
}

											//function deletar produto anunciado

function deletarProduto(){

	$delete= $_GET['id'];
	
	$sql ="DELETE FROM tb_postagem WHERE id_postagem = $delete";
	if($res = $GLOBALS['con']->query($sql)){
		header('location:../perfil.php');
	}else{
		echo"<script>document.write('erro ao deletar ')</script>";
	}
	
	
}
	
														// mostrar produtos comprados
														
 function produtoComprado(){
	session_start(); 
	$logado = $_SESSION['id'];
	
	$sql = "SELECT * FROM tb_compra WHERE cd_comprador='$logado'";
		$res = $GLOBALS['con']->query($sql);
	while($mostrar= $res->fetch_array()){
		$produto = $mostrar ['cd_produto'];
		$comprador = $mostrar ['cd_comprador'];
		$idStatus = $mostrar ['cd_status'];
		
		
	$sql2 = "SELECT * FROM tb_postagem WHERE id_postagem ='$produto'";
		$res2 = $GLOBALS['con']->query($sql2);
		$mostrar2= $res2->fetch_array();
		$foto = $mostrar2 ['cd_foto'];
		$nome = $mostrar2 ['nm_livro'];
		$preco = $mostrar2 ['vl_preco'];
		$id = $mostrar2 ['id_usuario'];
		
	$sql3 = "SELECT * FROM usuarios WHERE idusuarios ='$id'";
		$res3 = $GLOBALS['con']->query($sql3);
		$mostrar3= $res3->fetch_array();
		$vendedor1 = $mostrar3 ['nome'];
		$vendedor2 = $mostrar3 ['sobrenome'];
		$fotouser = $mostrar3 ['foto'];
		//<img src='".$foto."' height='40' widht='20' ></img> ".$nome." | R$:".$preco." | ".$vendedor1." ".$vendedor2." | ".$status."<br>
		echo "<div class='row'>
		        <div class='col s12 m10 offset-m1'>
		          <div class='card blue-grey lighten-5 '>
		            <div class='card-content'>
		              <span class='card-title'>".$nome."</span>
		            	<img src='".$foto."' height='80' widht='60' ></img> 
		            	<div class='chip chippreco'>
		            	R$: ".$preco."
		            	</div>
		            	<div class='chip chipvendedor'>
					    <img src='".$fotouser."' alt='Contact Person'>
					    ".$vendedor1." ".$vendedor2."
					  </div>
		              </div>";
		       if($idStatus==1 && $idStatus != 2){
		       	echo"
		            <div class='card-action'>
		            <div class='col s2 offset-s1 blue-text'>
		            	<i class='material-icons'>attach_money</i>
		            </div>
		            <div class='col s2 offset-s2'>
		            	 <i class='material-icons'>check_circle</i>
		            </div>
		            <div class='col s2 offset-s2'>
		            	 <i class='material-icons'>local_shipping</i>
		            </div>
		              <br>
		            <div class='col s4 p1 light-blue darken-4'>
		            </div>
		            <div class='col s4 p2'>
		            </div>
		            <div class='col s4 p3'>
		            </div>
		            </div>
		          </div>
		        </div>
		      </div>";}
		      if($idStatus==2 && $idStatus != 1 && $idStatus != 3){
		      	echo"
		            <div class='card-action'>
		            <div class='col s2 offset-s1 blue-text'>
		            	<i class='material-icons'>attach_money</i>
		            </div>
		            <div class='col s2 offset-s2 blue-text'>
		            	 <i class='material-icons'>check_circle</i>
		            </div>
		            <div class='col s2 offset-s2'>
		            	 <i class='material-icons'>local_shipping</i>
		            </div>
		              <br>
		            <div class='col s4 p1 light-blue darken-4'>
		            </div>
		            <div class='col s4 p2 light-blue darken-4'>
		            </div>
		            <div class='col s4 p3'>
		            </div>
		            </div>
		          </div>
		        </div>
		      </div>";}
		      
		     elseif($idStatus==3 && $idStatus != 1 && $idStatus != 2){
		     	echo"
		            <div class='card-action'>
		            <div class='col s2 offset-s1 blue-text'>
		            	<i class='material-icons'>attach_money</i>
		            </div>
		            <div class='col s2 offset-s2 blue-text'>
		            	 <i class='material-icons'>check_circle</i>
		            </div>
		            <div class='col s2 offset-s2 blue-text'>
		            	 <i class='material-icons'>local_shipping</i>
		            </div>
		              <br>
		            <div class='col s4 p1 light-blue darken-4'>
		            </div>
		            <div class='col s4 p2 light-blue darken-4'>
		            </div>
		            <div class='col s4 p3 light-blue darken-4'>
		            </div>
		            </div>
		          </div>
		        </div>
		      </div>";
		     }
	}
 }
											//functions mostrar produtos vendidos
											
function produtosVendidos(){
	
	session_start(); 
	$logado = $_SESSION['id'];
	
	$sql="SELECT * FROM tb_compra WHERE cd_vendedor = $logado";
	$res = $GLOBALS ['con'] -> query($sql);
	while($mostrar = $res-> fetch_array()){
		$cdProduto = $mostrar['cd_produto'];
		$status = $mostrar['cd_status'];
		$comprador = $mostrar ['cd_comprador'];
	
	$sql2="SELECT * FROM tb_postagem WHERE id_postagem = $cdProduto";
	 	$res2 = $GLOBALS['con']->query($sql2);
	 	$mostrar2 = $res2-> fetch_array();
	 	$nomeProduto = $mostrar2['nm_livro'];
	 	$fotoProduto = $mostrar2['cd_foto'];
	 	$compr = $mostrar2['id_usuario'];
		$preco = $mostrar2 ['vl_preco'];
		
	$sql3="SELECT * FROM usuarios WHERE idusuarios = $comprador";
		$res3 = $GLOBALS['con'] -> query($sql3);
		$mostrar3 = $res3->fetch_array();
		$nome = $mostrar3['nome'] ;
		$cep = $mostrar3['cep'] ;
		$sobrenome = $mostrar3['sobrenome'] ;
		$fotoComprador = $mostrar3['foto'];
		$cidade = $mostrar3['cidade'];
		$estado =$mostrar3['estado'];
		$dadosEntrega = $mostrar3['endereco'];
		
		$total += $preco;
		$valor = number_format($total, 2, ',', '.');
	 echo "<div class='row'>
		        <div class='col s12 m10 offset-m1'>
		          <div class='card blue-grey lighten-5 '>
		            <div class='card-content'>
		              <span class='card-title'>".$nomeProduto."</span>
		            	<img src='".$fotoProduto."' height='80' widht='60' ></img> 
		            	<div class='chip chipprecocomprador'>
		            	R$: ".$preco."
		            	</div>
		            	<div class='chip chipcomprador'>
					    <img src='".$fotoComprador."' alt='Contact Person'>
					    ".$nome." ".$sobrenome."
					  </div>
					  <div class='col s5 offset-s6 enderecocliente'>
					   <ul class='collapsible' data-collapsible='accordion'>
					    <li>
					      <div class='collapsible-header text-center'><i class='material-icons'>map</i>Endereço para entrega</div>
					      <div class='collapsible-body white'><span>
					       Estado: ".$estado."<br>
					       Cidade: ".$cidade."<br>
					       Endereço: ".$dadosEntrega."<br>
					       CEP: ".$cep."
					      </span></div>
					    </li>
					    </ul>
					  </div>
		              </div>";
		       if($status<2){
		       echo"
		            <div class='card-action'>
		            <div class='col s4 offset-s2 blue-text'>
		            	<i class='material-icons'>attach_money</i>
		            </div>
		            <div class='col s4 offset-s2'>
		            	 <i class='material-icons'>check_circle</i>
		            </div>
		              <br>
		            <div class='col s6 p1 light-blue darken-4'>
		            </div>
		            <div class='col s6 p2'>
		            </div>
		   
		            </div>
		          </div>
		        </div>
		      </div>";
		       }else{
		       	echo"
		       		<div class='card-action'>
		            <div class='col s4 offset-s2 blue-text'>
		            	<i class='material-icons'>attach_money</i>
		            </div>
		            <div class='col s4 offset-s2 blue-text'>
		            	 <i class='material-icons'>check_circle</i>
		            </div>
		              <br>
		            <div class='col s6 p1 light-blue darken-4'>
		            </div>
		            <div class='col s6 p2 light-blue darken-4'>
		            </div>
		   
		            </div>
		          </div>
		        </div>
		      </div>";
		       }
	}
	echo"<div class='fixed-action-btn'>
	        <a class='btn-floating btn-large waves-effect waves-light blue modal-trigger'
	           href='#carteira' id='confirmar'>
	            <img src='img/monei.png' id='cash'>
	        </a>
	    </div>
	    <form id='carteira' class='modal modal-fixed-footer' method='post'>
        <div class='row'>
        	<div class='col s4 offset-s1'>
        		<img src='img/coin.png' id='imgcarteira'>
        	</div>
        	<div class='col s3' id='money'>
        		<h3>R$".$valor."</h3>
        	</div>
        </div>
        <div class='row'>
        	<div class='col s6 offset-s3 saque'>
        		Valor maximo para transferencia:
				<br>
				".$valor."
        	</div>
        </div>
        <div class='row'>
        	<div class='input-field col s8 offset-s2'>
	          <input id='valor' type='text' class='inputSaque'>
	          <label for='valor' class='labelSaque'>Valor a ser transferido</label>
	        </div>
	        <div class='input-field col s8 offset-s2'>
	          <input id='first_name' type='number' class='inputSaque'>
	          <label for='conta' class='labelSaque' >Digite o numero da conta</label>
	        </div>
	        <div class='input-field col s8 offset-s2'>
	          <input id='senha' type='password' class='inputSaque'>
	          <label for='senha' class='labelSaque'>Senha de seu cadastro no site</label>
	        </div>
	        <div class='input-field col s2 offset-s5 text-center'>
	          <input id='enviaSaque' type='submit' value='Enviar'>
	        </div>
        </div>
		</form>";
}											
											
										    //function do carrinho de compra por session
										    
$_SESSION['qtd']=0;									
function carrinho(){
	session_start(); 
	$logado = $_SESSION['id'];
	$destino = $_SESSION['cep'];
	
	$id = $_GET['id'];
	
     if(!isset($_SESSION['car'])){
         $_SESSION['car'] = array();
      }
	
	
      //adiciona produto
		
   
      
     if(count($_SESSION['car'])>0 ){
		
			 foreach($_SESSION['car']as $id){
			$sql="SELECT * FROM tb_postagem WHERE id_postagem = '$id'";
			$res = $GLOBALS['con']->query($sql);
			$mostrar    = mysqli_fetch_assoc($res);
			$id = $mostrar['id_postagem'];
			$cdfoto = $mostrar['cd_foto'];
			$livro = $mostrar['nm_livro'];
			$descricao = $mostrar['cd_descricao'];
			$genero = $mostrar['genero'];
			$editora =$mostrar['editora'];
			$valor = $mostrar['vl_preco'];
			$user = $mostrar['id_usuario'];
			$sql2="SELECT * FROM usuarios WHERE idusuarios = '$user'";
			$res2= $GLOBALS['con']->query($sql2);
			$mostrar2 = $res2->fetch_array();
			$origem = $mostrar2['cep'];
			$nome = $mostrar2['nome'];
			$sobrenome = $mostrar2['sobrenome'];
			
			//calcular frete
			$data='';
			$data['nCdEmpresa'] = 'Booknowsebos';
			$data['sDsSenha'] = 'booknowsebos123';
			$data['nCdServico']='40010'; //41106
			$data['sCepOrigem']=$origem;
			$data['sCepDestino']=$destino;
			$data['nVlPeso']='1';
			$data['nCdFormato']='1';
			$data['nVlComprimento']='16';
			$data['nVlAltura']='5';
			$data['nVlLargura']='15';
			$data['nVlDiametro']='0';
			$data['sCdMaoPropria']='s';
			$data['nVlValorDeclarado']='200';
			$data['sCdAvisoRecebimento']='n';
			$data['StrRetorno'] = 'xml';
			
			$data = http_build_query($data);
			
			 $url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx';
			
			 $curl = curl_init($url . '?' . $data);
			 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			
			 $result = curl_exec($curl);
			 $result = simplexml_load_string($result);
			foreach($result -> cServico as $row) {
			 //Os dados de cada serviço estará aqui
			 if($row -> Erro == 0) {
			     $codigo = $row -> Codigo;
			     $valorFrete = $row -> Valor;
			     $prazo = $row -> PrazoEntrega;
			    }
			 else {
			     $erro = $row -> MsgErro;
			     
			 }
			 }
			$freteTotal += $valorFrete;
			$precoFrete = number_format($freteTotal, 2, ',', '.');
			$subTotal += $valor;
		    $preco = number_format($subTotal, 2, ',', '.');
				echo"
				<div class='row'>
		          <div class='col s7 offset-s1 produtosen' id='book".$id."'>
		          		<div class='col s2 fotoen'>
		          				<img src='".$cdfoto."' id='produtofto'></img>
		          		</div>
		          		<div class='col s4 dadosdolivroen'>
		          			Nome do livro: ".$livro."<br><p>
		          			<div class='detalhesCar'>
		          			Detalhes: ".$descricao."<br><p>
		          			</div>
		          			Genero: ".$genero."
		          		</div>
		          		<div class='col s4 dadosdolivroen'>
		          			Nome do vendedor: ".$nome." ".$sobrenome."<br><p>
		          			Editora: ".$editora."<br><p>
		          			R$:".$valor."<br>
		          			Valor do frete:".$valorFrete."
		          			<input type='hidden' id='calc' value='".$valorFrete."'>
	
		          		</div>
		          		
						<input type='hidden' value='".$preco."' id='precocar'>
		          		<a class='removeCart pointer' data-id='".$id."' data-livro='".$livro."'><i class='material-icons grey-text carapag'>delete</i></a>
		          </div>
		         
		          
		          ";//href='?add=del&id=".$id."'
		     
			}
			// Subtotal: R$".$preco." <br>
     }elseif(count($_SESSION['car'])==0){
     	echo"
     	<div class='row'>
     	<div class='col s4 offset-s4'>
     		<h3>Seu carrinho de compra esta vazio</h3>
     		<script>localStorage.clear();</script>
     	</div>
     	</div>";
     }$soma=$preco+$precoFrete;
     $total = number_format($soma, 2, ',', '.');
     echo"
    	<div class='col s2 offset-s9 fecharcompra'>
			<h5>Resumo do pedido</h5>
			<hr>
			 Subtotal: R$".$preco." <br>
			 Frete: R$".$precoFrete."
			 <input type='hidden' name='frete' value='".$precoFrete."' id='frete'>
			 <hr>
			 Total: R$".$total." <br>
			 <p></p>
			 <button data-id='comprar-button' class='btn-large waves-effect waves-light comprar'><i class='material-icons' id='basket'>shopping_basket</i> &nbsp &nbsp &nbsp Comprar</button>
			 
			 <br>
			 <img src='img/cargando.gif' id='loading'>
			 <form id='comprar' action='https://pagseguro.uol.com.br/checkout/v2/payment.html' method='post' onsubmit='PagSeguroLightbox(this); return false;'>
				<input type='hidden' name='code' id='code' value='code'/>
			</form>
		</div>
	 </div>";

}

											//functions que assossia localstorage com a session do php
															// e da explode nos colchetes 
															
function sessionCar(){
	session_start(); 
	$car= $_POST['sessaoCar'];
		$pokemon = toArray($car);
	$_SESSION['car'] = $pokemon;
	
	echo "agr vai";

	
		
}

function toArray($str){
	$aux = explode("]" ,explode("[",$str)[1])[0];
	return explode(",", $aux);
}

																//pesquisa
																
function mostrarPesquisa(){
	session_start();
	$logado = $_SESSION['id'];
	$pesquisa = $_GET['pesquisa'];
	// começo do codigo do pagination
	$sql='SELECT * FROM tb_postagem WHERE nm_livro LIKE "%'.$pesquisa.'%" ORDER BY nm_livro';
	$res = $GLOBALS['con']->query($sql);
	$total = $res->num_rows;
		$pp = 5;
		$totalpag = ceil($total / $pp);
		$pagina =  isset($_GET['pag']) ? $_GET['pag']:1;
		$inicio = ($pp*$pagina) - $pp;

		
	
	echo"
		<div class='row'>
			<div class='col s2 offset-s1'>
				Você pesquisou por: ".$pesquisa."
			</div>
		</div>
	";
	$sql='SELECT * FROM tb_postagem WHERE nm_livro LIKE "%'.$pesquisa.'%" ORDER BY nm_livro LIMIT '.$inicio.', '.$pp.'';
	
	$res = $GLOBALS['con'] ->query($sql);
	if($res->num_rows > 0){	
	 while ($mostrar= $res->fetch_array()){
			$id = $mostrar['id_postagem'];
			$cdfoto = $mostrar['cd_foto'];
			$livro = $mostrar['nm_livro'];
			$data = $mostrar['dt_data'];
			$descricao = $mostrar['cd_descricao'];
			$genero = $mostrar['genero'];
			$editora =$mostrar['editora'];
			$valor = $mostrar['vl_preco'];
			$user = $mostrar['id_usuario'];
			
			$sql2="SELECT * FROM usuarios WHERE idusuarios = $user";
			$res2 = $GLOBALS['con']->query($sql2);
			$mostrar2= $res2->fetch_array();
			$nomeUser=$mostrar2['nome'];
			$Snome=$mostrar2['sobrenome'];
		
			
			if($logado != $user){
				
				echo"
				<div class='row'>
		          <div class='col s10 offset-s1 produtosen'>
		          		<div class='col s1 fotoen'>
		          				<img src='".$cdfoto."' id='produtofto'></img>
		          		</div>
		          		<div class='col s3 offset-s1 dadosdolivroen'>
		          			Nome do livro: ".$livro."<br>
		          			<div class='detalhesCar'>
		          			Detalhes: ".$descricao."</div>
		          			Genero: ".$genero."
		          		</div>
		          		<div class='col s4 dadosdolivroen'>
		          			Nome do vendedor: ".$nomeUser." ".$Snome."<br><p>
		          			Editora: ".$editora."<br><p>
		          			R$:".$valor."
		          		</div>
		          		<div class='col s3 dadosdolivroen'>
		          			<a href='mostra_produto.php?id=".$id."'><button id='btncar'>Mais Detalhes</button></a>
		          			<a class='addCart pointer' data-id='".$id."' data-livro='".$livro."'>
		          			<div class='btncar2'><i class='material-icons' id='car2'>local_grocery_store</i></div>
		          			</a>
		          		</div>
		          </div>
		         </div>
		        
				    ";
			}elseif($logado == $user){
				echo"
				<div class='row'>
		          <div class='col s10 offset-s1 produtosen'>
		          		<div class='col s1 fotoen'>
		          				<img src='".$cdfoto."' id='produtofto'></img>
		          		</div>
		          		<div class='col s3 offset-s1 dadosdolivroen'>
		          			Nome do livro: ".$livro."<p> 
		          			<div class='detalhesCar'>
		          			Detalhes: ".$descricao."</div>
		          			Genero: ".$genero."
		          		</div>
		          		<div class='col s4 dadosdolivroen'>
		          			Nome do vendedor: ".$nomeUser." ".$Snome."<br><p>
		          			Editora: ".$editora."<br><p>
		          			R$:".$valor."
		          		</div>
		          		<div class='col s3 dadosdolivroen'>
		          			<a href='mostra_produto.php?id=".$id."'><button id='btncar'>Mais Detalhes</button></a>
		        			<a class='seuProduto pointer'>
		        			<div class='btncar2'><i class='material-icons' id='car2'>remove_shopping_cart</i></div>
		          			</a>
		          		</div>
		          </div>
		         </div>
				";
		    
	 
			}}
	}else{
		echo"<div class='col-xs-5 col-xs-offset-4'>
     		<h3>Não houve resultados para sua busca</h3>
       	</div>";
	 }
	 //final do codigo pagination
		     $r=$_GET['pag']-'1';
		     if($r>=1){
		     echo"<ul class='pagination'>
				    <li><a href='?pesquisa=$pesquisa&&pag=$r'><i class='material-icons'>chevron_left</i></a></li>";
		     }else{
		     	echo"<ul class='pagination col s12'>";
		     }
		     for ($btn=1; $btn <= $totalpag ; $btn++) {
		     	echo"<li id='numpag'><a href='?pesquisa=$pesquisa&&pag=$btn'>".$btn."</a></li>";
		     }
		     $l= isset($_GET['pag'])? $_GET['pag'] + 1 : 2;
		    if($l<=$totalpag){
		    echo"<li><a href='?pesquisa=$pesquisa&&pag=$l'><i class='material-icons'>chevron_right</i></a></li>
				  </ul>";
		    }	
}
											// função genero
											
function genero(){
	$genero= $_GET['genero'];
	session_start();
	$logado = $_SESSION['id'];
	$pesquisa = $_GET['pesquisa'];
	// começo do codigo do pagination
	$sql='SELECT * FROM tb_postagem WHERE genero LIKE "%'.$genero.'%" ORDER BY nm_livro';
	$res = $GLOBALS['con']->query($sql);
	$total = $res->num_rows;
		$pp = 5;
		$totalpag = ceil($total / $pp);
		$pagina =  isset($_GET['pag']) ? $_GET['pag']:1;
		$inicio = ($pp*$pagina) - $pp;

		
	
	echo"
		<div class='row'>
			<div class='col s2 offset-s1'>
				Gênero: ".$genero."
			</div>
		</div>
	";
	$sql='SELECT * FROM tb_postagem WHERE genero LIKE "%'.$genero.'%" ORDER BY nm_livro LIMIT '.$inicio.', '.$pp.'';
	
	$res = $GLOBALS['con'] ->query($sql);
	if($res->num_rows > 0){	
	 while ($mostrar= $res->fetch_array()){
			$id = $mostrar['id_postagem'];
			$cdfoto = $mostrar['cd_foto'];
			$livro = $mostrar['nm_livro'];
			$data = $mostrar['dt_data'];
			$descricao = $mostrar['cd_descricao'];
			$genero = $mostrar['genero'];
			$editora =$mostrar['editora'];
			$valor = $mostrar['vl_preco'];
			$user = $mostrar['id_usuario'];
			
			$sql2="SELECT * FROM usuarios WHERE idusuarios = $user";
			$res2 = $GLOBALS['con']->query($sql2);
			$mostrar2= $res2->fetch_array();
			$nomeUser=$mostrar2['nome'];
			$Snome=$mostrar2['sobrenome'];
		
			
			if($logado != $user){
				
				echo"
				<div class='row'>
		          <div class='col s10 offset-s1 produtosen'>
		          		<div class='col s1 fotoen'>
		          				<img src='".$cdfoto."' id='produtofto'></img>
		          		</div>
		          		<div class='col s3 offset-s1 dadosdolivroen'>
		          			Nome do livro: ".$livro."<br>
		          			<div class='detalhesCar'>
		          			Detalhes: ".$descricao."</div>
		          			Genero: ".$genero."
		          		</div>
		          		<div class='col s4 dadosdolivroen'>
		          			Nome do vendedor: ".$nomeUser." ".$Snome."<br><p>
		          			Editora: ".$editora."<br><p>
		          			R$:".$valor."
		          		</div>
		          		<div class='col s3 dadosdolivroen'>
		          			<a href='mostra_produto.php?id=".$id."'><button id='btncar'>Mais Detalhes</button></a>
		          			<a class='addCart pointer' data-id='".$id."' data-livro='".$livro."'>
		          			<div class='btncar2'><i class='material-icons' id='car2'>local_grocery_store</i></div>
		          			</a>
		          		</div>
		          </div>
		         </div>
		        
				    ";
			}elseif($logado == $user){
				echo"
				<div class='row'>
		          <div class='col s10 offset-s1 produtosen'>
		          		<div class='col s1 fotoen'>
		          				<img src='".$cdfoto."' id='produtofto'></img>
		          		</div>
		          		<div class='col s3 offset-s1 dadosdolivroen'>
		          			Nome do livro: ".$livro."<p> 
		          			<div class='detalhesCar'>
		          			Detalhes: ".$descricao."</div>
		          			Genero: ".$genero."
		          		</div>
		          		<div class='col s4 dadosdolivroen'>
		          			Nome do vendedor: ".$nomeUser." ".$Snome."<br><p>
		          			Editora: ".$editora."<br><p>
		          			R$:".$valor."
		          		</div>
		          		<div class='col s3 dadosdolivroen'>
		          			<a href='mostra_produto.php?id=".$id."'><button id='btncar'>Mais Detalhes</button></a>
		        			<a class='seuProduto pointer'>
		        			<div class='btncar2'><i class='material-icons' id='car2'>remove_shopping_cart</i></div>
		          			</a>
		          		</div>
		          </div>
		         </div>
				";
		    
	 
			}}
	}else{
		echo"<div class='col-xs-5 col-xs-offset-4'>
     		<h3>Não houve resultados para sua busca</h3>
       	</div>";
	 }
	 //final do codigo pagination
	 if($res>1){
		     $r=$_GET['pag']-'1';
		     if($r>=1){
		     echo"<ul class='pagination'>
				    <li><a href='?genero=$genero&&pag=$r'><i class='material-icons'>chevron_left</i></a></li>";
		     }else{
		     	echo"<ul class='pagination col s12'>";
		     }
		     for ($btn=1; $btn <= $totalpag ; $btn++) {
		     	echo"<li id='numpag'><a href='?genero=$genero&&pag=$btn'>".$btn."</a></li>";
		     }
		     $l= isset($_GET['pag'])? $_GET['pag'] + 1 : 2;
		    if($l<=$totalpag){
		    echo"<li><a href='?genero=$genero&&pag=$l'><i class='material-icons'>chevron_right</i></a></li>
				  </ul>";
		    }
	 }else{
	 	echo"
	 	<div class='row'>
	 		<div class='col s4 offset-s5'>
	 			Não há mais paginas
	 		</div>
	 	</div>
	 	";
	 }
}