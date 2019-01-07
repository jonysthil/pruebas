<?php
//header('Content-Type: application/json');
header('Content-Type: text/html; charset=ISO-8859-1');
//header('Content-Type: text/html; charset=utf-8');
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
			// dd/mes/yyyy to yyyy-mm-dd

			$d=explode("/",$_VAR["dia"]);
			$dia=$d[2]."-".$d[1]."-".$d[0];
		}

		// aaaa-mm-dd
		$url="http://www.cinetecanacional.net/controlador.php?opcion=carteleraDia&dia=".$dia; // http://www.cinetecanacional.net/controlador.php?opcion=carteleraDia&dia=2014-06-22
		$fp = fopen($url,"r");
		$html = stream_get_contents($fp);
		fclose($fp);


		$datosPeliculas="";
		preg_match_all('/<div id="contenedorPelicula">(.*?)<div class="slice"> <\/div>/s', $html, $matches0);
		for($i=0;$i<count($matches0[0]);$i++)
		{
			$datosPeliculas[$i]=$matches0[0][$i];
		}

		$c=0;
		for($j=0;$j<count($datosPeliculas);$j++)
		{
			$c++;

			preg_match_all('/<p class="peliculaTitulo">(.*?)<\/p>/s', $datosPeliculas[$j], $matches);
			for($i=0;$i<count($matches[0]);$i++)
			{
				$datos["titulo"][$j]=$this->limpiar($matches[0][$i]);
			}
		
			//location.href='php/detallePelicula.php?clv=15105'">
			preg_match_all('/clv=(.*?)\'/s', $datosPeliculas[$j], $matches);//print_r($matches[1]);
			for($i=0;$i<count($matches[0]);$i++)
			{
				$datos["codigo"][$j]=str_replace("'","",str_replace("clv=","",$matches[0][$i]));
			}

			preg_match_all('/<p class="peliculaMiniFicha">(.*?)<\/div>/s', $datosPeliculas[$j], $matches);
			for($i=0;$i<count($matches[0]);$i++)
			{
				$datos["ficha"][$j]=$this->limpiar($matches[0][$i]);
			}

			preg_match_all('/peliculaImagenSinopsis peliculaSinopsis(.*?)<div id="horarios/s', $datosPeliculas[$j], $matches);//print_r($matches[1]);
			for($i=0;$i<count($matches[0]);$i++){
				$datos["sinopsis"][$j]=$this->limpiar($matches[0][$i]);

				//$datos["sinopsis"][$i]=str_replace("D\">","",$datos["sinopsis"][$i]);
				$datos["sinopsis"][$j]=str_replace("\">","",$datos["sinopsis"][$i]);
			}

			preg_match_all('/<div id="horarios">(.*?)<\/div>/s', $datosPeliculas[$j], $matches);//print_r($matches[1]);
			for($i=0;$i<count($matches[0]);$i++)
			{
				$datos["horario"][$j]=$this->limpiar($matches[0][$i]);
			

				$datos["horario"][$i]=str_replace("Lunes","Lunes",$datos["horario"][$i]);
				$datos["horario"][$i]=str_replace("Martes","Martes",$datos["horario"][$i]);
				$datos["horario"][$i]=str_replace("Mi&eacute;rcoles","Miércoles",$datos["horario"][$i]);
				$datos["horario"][$i]=str_replace("Jueves","Jueves",$datos["horario"][$i]);
				$datos["horario"][$i]=str_replace("Viernes","Viernes",$datos["horario"][$i]);
				$datos["horario"][$i]=str_replace("S&aacute;bado","Sábado",$datos["horario"][$i]);
				$datos["horario"][$i]=str_replace("Domingo","Domingo",$datos["horario"][$i]);

				$datos["horario"][$j]=str_replace("SALA",", Sala",$datos["horario"][$i]);
			
				$datos["horario"][$j]=str_replace("Cineteca Nacional:"," ",$datos["horario"][$i]);
			
			
				//$datos["horario"][$i]=str_replace("\n","",$datos["horario"][$i]);
				
				$datos["horario"][$i]=utf8_decode($datos["horario"][$i]);
			}
		
			preg_match_all('/src="http:\/\/www.cinetecanacional.net\/imagenes\/img_peliculas\/(.*?)"/s', $datosPeliculas[$j], $matches);//print_r($matches[1]);
			for($i=0;$i<count($matches[0]);$i++)
			{
				//$datos["imagen"][$i]="http://www.cinetecanacional.net/imagenes/img_peliculas/".$this->limpiar($matches[1][$i]);
				$datos["imagen"][$j]=$this->limpiar($matches[1][$i]);
			}
		}		

		$json.="[";
		for($i=0;$i<=$c;$i++)
		{
			if( $datos["titulo"][$i]!="" and $datos["codigo"][$i]!="" and $datos["imagen"][$i]!="" )
			{

				if($i>0){$json.=",";}
				/*
				$json.="{";
				$json.="\"titulo\":".json_encode($datos["titulo"][$i]).",";
				$json.="\"ficha\":".json_encode($datos["ficha"][$i]).",";
				
				$json.="\"imagen\":".json_encode($datos["imagen"][$i]).",";
				
				$json.="\"sinopsis\":".json_encode($datos["sinopsis"][$i]).",";
				$json.="\"horario\":".json_encode($datos["horario"][$i]).",";
				$json.="\"codigo\":".json_encode($datos["codigo"][$i])."";
				$json.="}";
				*/
				
					$json.="{"; // yyyy-mm-dd
					$json.="\"fecha\":\"".substr($dia,8,2)."/".substr($dia,5,2)."/".substr($dia,0,4)."\",";
					$json.="\"titulo\":\"".$datos["titulo"][$i]."\",";
					$json.="\"ficha\":\"".$datos["ficha"][$i]."\",";
					$json.="\"imagen\":\"".$datos["imagen"][$i]."\",";
					//$json.="\"sinopsis\":\"".$datos["sinopsis"][$i]."\",";
					$json.="\"horario\":\"".$datos["horario"][$i]."\",";
					$json.="\"codigo\":\"".$datos["codigo"][$i]."\"";					
					$json.="}";


			}
		}
		$json.="]";

		//------------------------------------------------------------------
		$this->log("1|".date("Y-m-d H:i:s")."|".$_VAR["email"]."|".$dia."\n");
		//------------------------------------------------------------------
		
		return $json;
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
			$datos["sinopsis"][$i]=$this->limpiar(html_entity_decode($matches[1][$i], ENT_COMPAT, 'ISO-8859-1'));
		}
		
		preg_match_all('/<div id="horarios">(.*?)<div style="clear:both"><\/div>/s', $html, $matches);//print_r($matches[1]);
		for($i=0;$i<count($matches[1]);$i++)
		{
			$datos["horario"][$i]=$this->limpiar($matches[1][$i]);
			

			$datos["horario"][$i]=str_replace("Lunes","Lunes",$datos["horario"][$i]);
			$datos["horario"][$i]=str_replace("Martes","Martes",$datos["horario"][$i]);
			$datos["horario"][$i]=str_replace("Mi&eacute;rcoles","Miércoles",$datos["horario"][$i]);
			$datos["horario"][$i]=str_replace("Jueves","Jueves",$datos["horario"][$i]);
			$datos["horario"][$i]=str_replace("Viernes","Viernes",$datos["horario"][$i]);
			$datos["horario"][$i]=str_replace("S&aacute;bado","Sábado",$datos["horario"][$i]);
			$datos["horario"][$i]=str_replace("Domingo","Domingo",$datos["horario"][$i]);

			$datos["horario"][$i]=str_replace("SALA",", Sala",$datos["horario"][$i]);
			
			$datos["horario"][$i]=str_replace("Cineteca Nacional:"," ",$datos["horario"][$i]);
			
			
			$datos["horario"][$i]=utf8_decode($datos["horario"][$i]);
		}
		
		preg_match_all('/\/img_peliculas\/(.*?)"/s', $html, $matches);//print_r($matches[1]);
		for($i=0;$i<count($matches[1]);$i++)
		{
			$datos["imagen"][$i]=$this->limpiar($matches[1][$i]);
		}

		$hayVideo=false;

		//-Video de youtube cieneteca
		preg_match_all("/embed\/(.*?)'/s", $html, $matches);
		for($i=0;$i<count($matches[1]);$i++)
		{
			$datos["youtubeVideo"][$i]=$matches[1][$i];
			$hayVideo=true;
		}

		if( $hayVideo==false )
		{
			//-Video de vimeo
			preg_match_all("/video\/(.*?)\'/s", $html, $matches);
			for($i=0;$i<count($matches[1]);$i++)
			{
				$datos["vimeoVideo"][$i]=$matches[1][$i];
			
				$url  = "http://vimeo.com/api/v2/video/".$datos["vimeoVideo"][$i].".xml";
				$fp   = fopen($url,"r");
				$html = stream_get_contents($fp);
				fclose($fp);
		
				preg_match_all("/<thumbnail_medium>(.*?)<\/thumbnail_medium>/s", $html, $matches);
				for($i=0;$i<count($matches[1]);$i++)
				{
					$datos["vimeoThumbnailURL"][$i]=$matches[1][$i];
					
					$hayVideo=true;
				}
			}
		}



		if( $hayVideo==false )
		{
			//-Lo extraigo desde el listado de youtube
			$url  = "https://www.youtube.com/results?search_query=trailer+oficial+".str_replace(" ","+",$datos["titulo"][0]);
			$fp   = fopen($url,"r");
			$html = stream_get_contents($fp);
			fclose($fp);

			if( strpos($html,$datos["titulo"][0])!=FALSE )
			{
				preg_match_all('/data-video-ids="(.*?)"/s', $html, $matches);
				for($i=0;$i<count($matches[1]);$i++)
				{
					$datos["youtubeURL"][$i]=$url;
					$datos["youtubeVideo"][$i]=$matches[1][$i];
				}

			}
		}






//$enc=strpos("","");

//--

		$titulo="";
		$json.="[";
		for($i=0;$i<=$c;$i++)
		{
			if($datos["titulo"][$i]!="")
			{
				if($i>0){$json.=",";}
				$json.="{";
				/*
				echo "\"codigo\":".json_encode($_VAR["codigo"]).",";
				echo "\"titulo\":".json_encode($datos["titulo"][$i]).",";
				echo "\"sinopsis\":".json_encode($datos["sinopsis"][$i]).",";
				echo "\"horario\":".json_encode($datos["horario"][$i]).",";
				echo "\"imagen\":".json_encode($datos["imagen"][$i]).",";
				echo "\"youtube\":".json_encode($datos["youtube"][$i])."";
				*/
				
				$json.="\"codigo\":\"".$_VAR["codigo"]."\",";
				$json.="\"titulo\":\"".$datos["titulo"][$i]."\",";
				$json.="\"sinopsis\":\"".$datos["sinopsis"][$i]."\",";
				$json.="\"horario\":\"".$datos["horario"][$i]."\",";
				$json.="\"imagen\":\"".$datos["imagen"][$i]."\",";
				$json.="\"youtubeVideo\":\"".$datos["youtubeVideo"][$i]."\",";

				$json.="\"vimeoThumbnailURL\":\"".$datos["vimeoThumbnailURL"][$i]."\",";
				$json.="\"vimeoVideo\":\"".$datos["vimeoVideo"][$i]."\"";

				//$json.="\"youtubeURL\":\"".$datos["youtubeURL"][$i]."\"";
				
				$json.="}";
				
				$titulo=$datos["titulo"][$i];
			}
		}
		$json.="]";
		
		//------------------------------------------------------------------
		$this->log("2|".date("Y-m-d H:i:s")."|".$_VAR["email"]."|".$_VAR["codigo"]."&".$titulo."\n");
		//------------------------------------------------------------------
		
		return $json;
	}
	
	function fechaMostrar($dia)
	{
		// yyyy-mm-dd
		$meses=array("01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
		$dia = substr($dia,8,4)." de ".$meses[substr($dia,5,2)]." de ".substr($dia,0,4);
		return $dia;
	}

	
	function limpiar($cad)
	{
		//$cad=html_entity_decode($cad,ENT_QUOTES,"ISO-8859-1");
		//$cad=html_entity_decode($cad,ENT_QUOTES,"UTF-8");
		$cad=str_replace("\t","",$cad);
		$cad=str_replace("\n","",$cad);
		
		$cad=str_replace("","",$cad);
		
		
		for($i=0;$i<10;$i++)
		{
			$cad=str_replace("  ","",$cad);
		}
		
		$cad=trim($cad);


		$cad=strip_tags($cad);


		//$cad=utf8_encode($cad);
	
		return $cad;
	}
	
	function contacto()
	{


    	if (isset($_SERVER['HTTP_ORIGIN']))
    	{
        	header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        	header('Access-Control-Allow-Credentials: true');
        	header('Access-Control-Max-Age: 86400');    // cache for 1 day
    	}

    	// Access-Control headers are received during OPTIONS requests
    	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS')
    	{
        	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            	header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

        	if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            	header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        	exit(0);
    	}

				/*
    	$postdata = file_get_contents("php://input");
    	if (isset($postdata))
    	{
        	$request = json_decode($postdata);
        	$username = $request->username;

        		if ($username != "") {
            		//echo "Server returns: " . $username;
        		}
        		else {
            		//echo "Empty username parameter!";
        		}
        		
        		
    	}
    	else {
        		//echo "Not called properly with username parameter!";
    	}
    	*/
    	
    	$fp = fopen("debug.txt","a");
		fputs($fp, str_replace("\n"," ",$_REQUEST["nombre"]."|".$_REQUEST["email"]."|".$_REQUEST["comentarios"])."\n");
		fclose($fp);

		//--
		require_once('./PHPMailer_5.2.4/class.phpmailer.php');

		try
		{
			$mail = new PHPMailer(true);
			$mail->IsSMTP();
			$mail->SMTPAuth   = true;
			$mail->SMTPSecure = "tls";
			$mail->Host       = "alexandria.mx";
			$mail->Username   = "angel@alexandria.mx"; // Correo completo a utilizar
			$mail->Password   = "S?7uv85i";
			$mail->Port       = 587;
			$mail->From       = "angel@alexandria.mx";
			$mail->FromName   = "angel@alexandria.mx";
			$mail->AddAddress("aguerrero.mail@gmail.com");
			//$mail->AddCC("cuenta@dominio.com");
			//$mail->AddBCC("cuenta@dominio.com");
			$mail->IsHTML(true);
			$mail->Subject = "Formulario de contacto desde la App de Cineteca Nacional";
			$body = "

			<h2>Formulario de contacto</h2>
			<table>
			<tr><td>Origen: </td>      <td>".$_REQUEST["origen"]."</td></tr>
			<tr><td>Nombre: </td>      <td>".$_REQUEST["nombre"]."</td></tr>
			<tr><td>Email: </td>       <td>".$_REQUEST["email"]."</td></tr>
			<tr><td>Comentarios: </td> <td>".$_REQUEST["comentarios"]."</td></tr>
			</table>
			";
			$mail->Body = $body;
			$mail->AltBody = strip_tags($body);
			//$mail->AddAttachment("imagenes/imagen.jpg", "imagen.jpg");
			$exito = $mail->Send();

			if($exito){
				echo "1";
			}else{
				echo "0";
			}
		} catch (phpmailerException $e) {
			echo $e->errorMessage(); //Pretty error messages from PHPMailer
		} catch (Exception $e) {
			echo $e->getMessage(); //Boring error messages from anything else!
		}

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
		case "c":
			$oParser=new Parser();
			echo $oParser->contacto();
		break;
}

?>