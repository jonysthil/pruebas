<?php
header("Access-Control-Allow-Origin", "*");
header('Content-Type: application/json');

date_default_timezone_set('Mexico/General');




class Parser
{
	var $contenido;
	
	function Parser()
	{

	}
	
	function log($datos)
	{
		$fp = fopen("log","a");
		fwrite($fp,$datos);
		fclose($fp);
	}
	
	function listar($_VAR)
	{
		if($_VAR["dia"]==""){
			$dia=date("Y-m-d");
		}else{
			// dd/mm/yyyy
			$dia=substr($_VAR["dia"],6,4)."-".substr($_VAR["dia"],3,2)."-".substr($_VAR["dia"],0,2);
		}

		$url="http://www.cinetecanacional.net/controlador.php?opcion=carteleraDia&dia=".$dia; // http://www.cinetecanacional.net/controlador.php?opcion=carteleraDia&dia=2014-6-22
		$fp = fopen($url,"r");
		$html = stream_get_contents($fp);
		fclose($fp);

		$c=0;
		preg_match_all('/<p class="peliculaTitulo">(.*?)<\/p>/s', $html, $matches);
		for($i=0;$i<count($matches[1]);$i++)
		{
			$datos["titulo"][$i]=$this->limpiar($matches[1][$i]);
			$c++;
		}
		
		preg_match_all('/location.href=\'php\/detallePelicula.php\?clv=(.*?)\&/s', $html, $matches);//print_r($matches[1]);
		for($i=0;$i<count($matches[1]);$i++)
		{
			$datos["codigo"][$i]=$this->limpiar($matches[1][$i]);
		}

		preg_match_all('/<p class="peliculaMiniFicha">(.*?)<\/div>/s', $html, $matches);
		for($i=0;$i<count($matches[1]);$i++)
		{
			$datos["ficha"][$i]=$this->limpiar($matches[1][$i]);
		}

		preg_match_all('/peliculaImagenSinopsis peliculaSinopsis(.*?)<div id="horarios/s', $html, $matches);//print_r($matches[1]);
		for($i=0;$i<count($matches[1]);$i++){
		$datos["sinopsis"][$i]=$this->limpiar($matches[1][$i]);

		$datos["sinopsis"][$i]=str_replace("D\">","",$datos["sinopsis"][$i]);
		$datos["sinopsis"][$i]=str_replace("\">","",$datos["sinopsis"][$i]);
		}

		preg_match_all('/<div id="horarios">(.*?)<\/div>/s', $html, $matches);//print_r($matches[1]);
		for($i=0;$i<count($matches[1]);$i++){
			$datos["horario"][$i]=$this->limpiar($matches[1][$i]);
			$datos["horario"][$i]=str_replace("Lunes","-Lunes",$datos["horario"][$i]);
			$datos["horario"][$i]=str_replace("Martes","-Martes",$datos["horario"][$i]);
			$datos["horario"][$i]=str_replace("Mi&eacute;rcoles","-Mi&eacute;rcoles",$datos["horario"][$i]);
			$datos["horario"][$i]=str_replace("Jueves","-Jueves",$datos["horario"][$i]);
			$datos["horario"][$i]=str_replace("Viernes","-Viernes",$datos["horario"][$i]);
			$datos["horario"][$i]=str_replace("S&aacute;bado","-S&aacute;bado",$datos["horario"][$i]);
			$datos["horario"][$i]=str_replace("Domingo","-Domingo",$datos["horario"][$i]);
			$datos["horario"][$i]=str_replace("Sala",", Sala",$datos["horario"][$i]);
			
			$datos["horario"][$i]=str_replace("Cineteca Nacional:"," ",$datos["horario"][$i]);
		}
		
		preg_match_all('/src="http:\/\/www.cinetecanacional.net\/imagenes\/img_peliculas\/(.*?)"/s', $html, $matches);//print_r($matches[1]);
		for($i=0;$i<count($matches[1]);$i++)
		{
			//$datos["imagen"][$i]="http://www.cinetecanacional.net/imagenes/img_peliculas/".$this->limpiar($matches[1][$i]);
			$datos["imagen"][$i]=$this->limpiar($matches[1][$i]);
		}

		echo "[";
		for($i=0;$i<=$c;$i++)
		{
			if($datos["titulo"][$i]!="")
			{
				if($i>0){echo ",";}
				echo "{";
				echo "\"titulo\":".json_encode($datos["titulo"][$i]).",";
				echo "\"ficha\":".json_encode($datos["ficha"][$i]).",";
				echo "\"imagen\":".json_encode($datos["imagen"][$i]).",";
				echo "\"sinopsis\":".json_encode($datos["sinopsis"][$i]).",";
				echo "\"horario\":".json_encode($datos["horario"][$i]).",";
				echo "\"codigo\":".json_encode($datos["codigo"][$i])."";
				echo "}";
			}
		}
		echo "]";

		//------------------------------------------------------------------
		$this->log("1|".date("Y-m-d H:i:s")."|".$_VAR["email"]."|".$dia."\n");
		//------------------------------------------------------------------
	}
	
	function detalle($_VAR)
	{
		$url="http://www.cinetecanacional.net/php/detallePelicula.php?clv=".$_VAR["codigo"];
		$fp = fopen($url,"r");
		$html = stream_get_contents($fp);
		fclose($fp);
		


		$c=0;
		preg_match_all('/div class="peliculaTitulo" style="margin-left: 10px;">(.*?)<p/s', $html, $matches);//print_r($matches[1]);
		for($i=0;$i<count($matches[1]);$i++)
		{
			$datos["titulo"][$i]=$this->limpiar($matches[1][$i]);
			$c++;
		}

		preg_match_all('/<div id="peliculaSinopsis" class="peliculaImagenSinopsis peliculaSinopsis2">(.*?)<div id="peliculaImagen" style="text-align: center;">/s', $html, $matches);//print_r($matches[1]);
		for($i=0;$i<count($matches[1]);$i++)
		{
			$datos["sinopsis"][$i]=$this->limpiar($matches[1][$i]);
		}
		
		preg_match_all('/<div id="horarios">(.*?)<div style="clear:both"><\/div>/s', $html, $matches);//print_r($matches[1]);
		for($i=0;$i<count($matches[1]);$i++)
		{
			$datos["horario"][$i]=$this->limpiar($matches[1][$i]);
			$datos["horario"][$i]=str_replace("Lunes","-Lunes",$datos["horario"][$i]);
			$datos["horario"][$i]=str_replace("Martes","-Martes",$datos["horario"][$i]);
			$datos["horario"][$i]=str_replace("Mi&eacute;rcoles","-Mi&eacute;rcoles",$datos["horario"][$i]);
			$datos["horario"][$i]=str_replace("Jueves","-Jueves",$datos["horario"][$i]);
			$datos["horario"][$i]=str_replace("Viernes","-Viernes",$datos["horario"][$i]);
			$datos["horario"][$i]=str_replace("S&aacute;bado","-S&aacute;bado",$datos["horario"][$i]);
			$datos["horario"][$i]=str_replace("Domingo","-Domingo",$datos["horario"][$i]);
			$datos["horario"][$i]=str_replace("Sala",", Sala",$datos["horario"][$i]);
			
			$datos["horario"][$i]=str_replace("Cineteca Nacional:"," ",$datos["horario"][$i]);

		}
		
		preg_match_all('/\/img_peliculas\/(.*?)"/s', $html, $matches);//print_r($matches[1]);
		for($i=0;$i<count($matches[1]);$i++)
		{
			$datos["imagen"][$i]=$this->limpiar($matches[1][$i]);
		}

		preg_match_all("/http:\/\/www\.youtube\.com\/embed\/(.*?)'/s", $html, $matches);//print_r($matches[1]);
		for($i=0;$i<count($matches[1]);$i++)
		{
			$datos["youtube"][$i]=$this->limpiar($matches[1][$i]);
		}

		if( $datos["youtube"][0]=="" ){
			preg_match_all("/http:\/\/youtu\.be\/(.*?)'/s", $html, $matches);//print_r($matches[1]);
			for($i=0;$i<count($matches[1]);$i++)
			{
				$datos["youtube"][$i]=$this->limpiar($matches[1][$i]);
			}
		}

		$titulo="";
		echo "[";
		for($i=0;$i<=$c;$i++)
		{
			if($datos["titulo"][$i]!="")
			{
				if($i>0){echo ",";}
				echo "{";
				echo "\"codigo\":".json_encode($_VAR["codigo"]).",";
				echo "\"titulo\":".json_encode($datos["titulo"][$i]).",";
				echo "\"sinopsis\":".json_encode($datos["sinopsis"][$i]).",";
				echo "\"horario\":".json_encode($datos["horario"][$i]).",";
				echo "\"imagen\":".json_encode($datos["imagen"][$i]).",";
				echo "\"youtube\":".json_encode($datos["youtube"][$i])."";
				echo "}";
				
				$titulo=$datos["titulo"][$i];
			}
		}
		echo "]";
		
		//------------------------------------------------------------------
		$this->log("2|".date("Y-m-d H:i:s")."|".$_VAR["email"]."|".$_VAR["codigo"]."&".$titulo."\n");
		//------------------------------------------------------------------
	}
	
	function limpiar($cad)
	{
		$cad=strip_tags($cad);
		$cad=trim($cad);
		$cad=str_replace("\n","",$cad);
		$cad=utf8_encode($cad);
	
		return $cad;
	}	
}


switch ($_REQUEST["a"]) {
		case "l":
			$oParser=new Parser();
			echo $oParser->listar($_REQUEST);
		break;
		case "d":
			$oParser=new Parser();
			echo $oParser->detalle($_REQUEST);
		break;

}

?>