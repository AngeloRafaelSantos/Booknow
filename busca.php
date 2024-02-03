<?php
function busca(){
$con = new mysqli("localhost","root","root","booknow");
$sql='SELECT * FROM tb_postagem WHERE nm_livro LIKE "%'.$_GET['q'].'%"';

$res = $con-> query($sql);

while($livro = $res->fetch_array()){
     $id=$livro['id_postagem'];
	 $nome=$livro['nm_livro'];//."\r\n"
	 $foto=$livro['cd_foto'];
	 $preco=$livro['vl_preco'];
	 
		echo"{text:'".$nome."', url:'mostra_produto.php?id=".$id."', src:'".$foto."'},";
		
		
}

}
