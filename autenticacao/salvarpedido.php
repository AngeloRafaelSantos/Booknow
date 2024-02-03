<?php
 include'functions.php';
 
$func =$_GET['func'];
switch ($func) {
	case 'salvar':
		salvarPedido();
		echo $pedido["id"];
break;
}
function salvarPedido(){
session_start();
$logado = $_SESSION['id'];
foreach($_SESSION['car'] as $id){
 $sql="SELECT * FROM tb_postagem WHERE id_postagem = '$id'";
			$res = $GLOBALS['con']->query($sql);
			$mostrar = $res->fetch_array();
			$postagem = $mostrar['id_postagem'];
			$user = $mostrar['id_usuario'];
			$sql2 = "INSERT INTO tb_compra (cd_produto, cd_comprador, cd_status, cd_vendedor) VALUES ('$postagem', '$logado','1','$user')";
			$res2 = $GLOBALS['con']->query($sql2);
if($res2>0){
    echo"deu tudo certo";
}else{
    echo "falha ao comprar".$sql2;
}

}
}


