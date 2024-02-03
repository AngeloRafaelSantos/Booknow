<?php
$notificationCode = preg_replace('/[^[:alnum:]=]/','',$_POST["idpedido"]);

$data['token']= 'C5AACBC184564B8C92B0C51AE22DFFA0';
$data['email']='gabrielleiteolimpio@gmail.com';


$url = 'https://ws.pagseguro.uol.com.br/v3/transactions/notifications
/'.$notificationCode.'
?'.$data;

$data = http_build_query($data);

$curl = curl_init($url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$xml = curl_exec($curl);
curl_close($curl);

$xml = simplexml_load_string($xml);

echo $xml->code;

$reference = $xml->$reference;

$status = $xml -> $status;

