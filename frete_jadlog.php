<?php
	$curl = curl_init();
	$cepori = "ceporigem"; //00000000
	$cepdes = "cepdestino"; //00000000
	$cnpj = "CNPJ";
	$frap = "N";
	$modalidade=5;
	/*0 - Aéreo (EXPRESSO)
	3 - Rodoviário (.PACKAGE)
	4 - Rodoviário (RODOVIÁRIO)
	5 - Rodoviário (ECONÔMICO)
	6 - Rodoviário (DOC)
	9 - Aéreo (.COM)
	10 - Aéreo (INTERNACIONAL)
	12 - Aéreo (CARGO)
	14 - Rodoviário (EMERGÊNCIAL)
	40 - Aéreo (PICKUP)
	*/
	$peso = 0.150;
	$tpentrega = "D";
	$tpseguro = "N";
	$vldeclarado = 0.150;
	$vlColeta = 50.00;

	$parametro = " {\r\n \"frete\": [\r\n       {\r\n        \"cepori\": \"$cepori\",\r\n            \"cepdes\": \"$cepdes\",\r\n            \"cnpj\": \"$cnpj\",\r\n            \"frap\": \"$frap\",\r\n            \"modalidade\":$modalidade,\r\n            \"peso\": $peso,\r\n            \"tpentrega\": \"$tpentrega\",\r\n            \"tpseguro\": \"$tpseguro\",\r\n            \"vldeclarado\": $vldeclarado,\r\n            \"vlColeta\": $vlColeta\r\n        }\r\n    ]\r\n}\r\n\r\n";
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://www.jadlog.com/embarcador/api/frete/valor",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => $parametro,
	  CURLOPT_HTTPHEADER => array(
		"Authorization: XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX",
		"Content-Type: application/json"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
		$arrfrete = json_decode($response);
		$frete = $arrfrete->frete;
		foreach ( $frete as $efrete )
		{
			$valor_frete = $efrete->vltotal;
			$prazo_logistica = $efrete->prazo;
		}
	}
?>