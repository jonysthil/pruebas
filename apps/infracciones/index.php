<?php

$placa="";
	
if( $_GET["placa"]!="" ){
	$placa=$_GET["placa"];
}

$oI=new Infracciones();

if( $placa=="" )
{
echo $oI->consultarInfracciones("C52AEA");
echo "<br><br>\n\n";
echo $oI->consultarInfracciones("499VRV");
echo "<br><br>\n\n";
echo $oI->consultarInfracciones("881YHR");
echo "<br><br>\n\n";
echo $oI->consultarInfracciones("588XRZ");
}
else
{
echo $oI->consultarInfracciones($placa);
}

//echo "\n\n";
//echo $oI->consultarInfracciones("588xrz","09012351919");



class Infracciones
{
	var $url="http://www.finanzas.df.gob.mx/sma/detallePlaca.php?placa=";
	var $cont="";
	var $placa="";
	
	var $infraccionesNoPagadas=0;
	var $infraccionesPagadas=0;
	
	var $fundamentos=array();
	var $sanciones=array();
	var $motivos=array();
	var $fechas=array();
	var $situaciones=array();
	var $folios=array();

	function Infracciones()
	{
	}
		
	function consultarInfracciones($placa,$folio="")
	{
		$url=$this->url.$placa;
		$cont="";	

		$cont = @file_get_contents ( $url );
		if( trim($cont)=="" ){
			$cont = $this->getData($url);
			echo "Hola";
		}

		$this->obtenerDatos($cont);
		
		return $this->respuesta($folio);
	}
	
	function obtenerDatos($cnt)
	{
		$cnt=$this->eliminarEtiquetas($cnt);
		$cnt=$this->eliminarLineas($cnt);

		$tmp=explode("\n",$cnt);
		for($i=0;$i<count($tmp);$i++)
		{
			// Placa
			if( substr($tmp[$i],0,5)=="PLACA" )
			{
				$this->placa=trim(substr($tmp[$i],6));
			}

			// Fundamentos
			if( substr($tmp[$i],0,10)=="Fundamento" )
			{
				array_push($this->fundamentos,trim(str_replace("|","",substr($tmp[$i],12))));
			}

			// Sansiones			
			if( substr($tmp[$i],0,8)=="Sanción" )
			{
				array_push($this->sanciones,trim(str_replace("|","",substr($tmp[$i],10))));
			}

			// Motivos
			if (stripos($tmp[$i],"Motivo") !== false )
			{
				$tmp2=explode("|",$tmp[$i]);
		
				array_push($this->motivos,trim($tmp2[4]));
				array_push($this->fechas, trim($tmp2[1]));
				array_push($this->situaciones, trim($tmp2[2]));
				array_push($this->folios, trim($tmp2[0]));
			}
		}
		
		$this->infraccionesNoPagadas = substr_count($cnt,"No pagada");
		$this->infraccionesPagadas = substr_count($cnt,"Pagada");
	}
	
	function eliminarEtiquetas($html)
	{
		$html = html_entity_decode($html,ENT_QUOTES,'UTF-8');
		$html = str_replace("</td>","|",$html);

		return strip_tags($html);
	}
	
	function eliminarLineas($str)
	{
		$cont="";
		$tmp=explode("\n",$str);

		for($i=0;$i<count($tmp);$i++)
		{
			if( trim($tmp[$i])!="" )
			{
				$cont.=trim($tmp[$i])."\n";
			}
		}
		
		return $cont;
	}
	
	function obtenerPlaca()
	{
		return $this->placa;
	}
	
	function obtenerNumeroDeInfraccionesNoPagadas()
	{
			return $this->infraccionesNoPagadas;
	}
	
	function obtenerNumeroDeInfraccionesPagadas()
	{
			return $this->infraccionesPagadas;
	}
	
	function obtenerFundamentos()
	{
		return $this->fundamentos;
	}

	function obtenerSanciones()
	{
		return $this->sanciones;
	}

	function obtenerMotivos()
	{
		return $this->motivos;
	}

	function obtenerFechas()
	{
		return $this->fechas;
	}

	function obtenerSituaciones()
	{
		return $this->situaciones;
	}
	
	function obtenerFolios()
	{
		return $this->folios;
	}
	
	function respuesta($folio="")
	{
		$resp='
		[
			{
				"Placa":"'.$this->obtenerPlaca().'",
				"<b>Infracciones no pagadas":"'.$this->obtenerNumeroDeInfraccionesNoPagadas().'</b>",
				"Infracciones pagadas":"'.$this->obtenerNumeroDeInfraccionesPagadas().'",
				"Infracciones":
				[
		';
				
				for($i=0;$i<count($this->fundamentos);$i++)
				{
					if($folio=="")
					{
						if($i>0){$resp.=',';}
						$resp.='
						{
						"Folio":"'.$this->folios[$i].'",
						"Situación":"'.$this->situaciones[$i].'",
						"Motivo":"'.$this->motivos[$i].'",
						"Fecha":"'.$this->fechas[$i].'",
						"Fundamento":"'.$this->fundamentos[$i].'",
						"Sanción":"'.$this->sanciones[$i].'"
						}
						';
					}
					else
					{
						if( $this->folios[$i]==$folio )
						{
							if($i>0){$resp.=',';}
							$resp.='
							{
							"Folio":"'.$this->folios[$i].'",
							"Situación":"'.$this->situaciones[$i].'",
							"Motivo":"'.$this->motivos[$i].'",
							"Fecha":"'.$this->fechas[$i].'",
							"Fundamento":"'.$this->fundamentos[$i].'",
							"Sanción":"'.$this->sanciones[$i].'"
							}
							';
						}
					}
				}
		
		$resp.='
				]
			}
		]
		';

		$resp=str_replace("\t","",$resp);
		$resp=str_replace("\n","",$resp);
		$resp=trim($resp);

		print $resp;
	}
	
	function getData($url)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
//		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);

		$data = curl_exec($ch);
		curl_close($ch);

		return $data;
	}
}
?>