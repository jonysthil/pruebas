<?php

    /*$letras=array('A','B','C','D','E','F','G','H','J','K','L','M','N','P','Q','R','S','T','U','V','W','X','Y','Z');
    $clave = "";
	for($i=0;$i<=3;$i++)
	{
		$valor = rand(0,count($letras));
		$clave.=$letras[$valor];
	}
	$clave.="-";
	$numeros=array('1','2','3','4','5','6','7','8','9');
	for($i=0;$i<=5;$i++)
	{
		$valor = rand(0,count($numeros));
		$clave.=$numeros[$valor];
	}
	
	echo  $clave;*/

	function generarCodigo() {
		$cupon = '';
		$key = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';

		$max = strlen($key)-1;

		for ($i = 0; $i < 10; $i++) {
			$cupon .= $key{mt_rand(0,$max)};
		}

		$cupon .= '-';

		for ($i = 0; $i < 10; $i++) {
			$cupon .= $key{mt_rand(0,$max)};
		}

		return "DB-" . $cupon;
	}
		
	   //Ejemplo de uso
		
	   echo generarCodigo();


///$obj = $this->generarFolio();
//echo $clave;
?>