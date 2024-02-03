<?php
include_once('conn.php');

session_start();



		$frete=$_POST['frete'];
		$pedido = preg_replace('/[^[:alnum:]=]/','',$_POST["idpedido"]);
        $data['token']= 'C5AACBC184564B8C92B0C51AE22DFFA0';
        $data['email']='gabrielleiteolimpio@gmail.com';
        $data['currency']='BRL';
 foreach($_SESSION['car']as $id){
		$sql="SELECT * FROM tb_postagem WHERE id_postagem = '$id'";
		$res = $GLOBALS['con']->query($sql);
		$mostrar  = mysqli_fetch_assoc($res);
		$id = $mostrar['id_postagem'];
		$cdfoto = $mostrar['cd_foto'];
		$livro = $mostrar['nm_livro'];
		$descricao = $mostrar['cd_descricao'];
		$genero = $mostrar['genero'];
		$origem = $mostrar['cep'];
		$editora =$mostrar['editora'];
		$valor = $mostrar['vl_preco'];
		$user = $mostrar['id_usuario'];
		//frete
			
		$i++;
		    
        $data['itemId'.$i.'']=''.$id.'';
        $data['itemQuantity'.$i.'']='1';
        $data['itemDescription'.$i.'']=''.$livro.'';
        $data['itemAmount'.$i.'']=''.$valor.''; 
        $data['reference'] = $pedido;
            
		    
 }

         

$url = 'https://ws.pagseguro.uol.com.br/v2/checkout';

$data = http_build_query($data);

$curl = curl_init($url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

$xml = curl_exec($curl);

curl_close($curl);

$xml = simplexml_load_string($xml);
echo $xml->code;

?>
