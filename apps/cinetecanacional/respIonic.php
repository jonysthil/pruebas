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
		$html="";

		if( !isset($_VAR["dia"]) ){ //and $_VAR["dia"]==""
			$dia=date("Y-m-d");
		}else{
			// dd/mes/yyyy to yyyy-mm-dd

			$d=explode("/",$_VAR["dia"]);
			$dia=$d[2]."-".$d[1]."-".$d[0];
		}

		// aaaa-mm-dd
		$url="http://www.cinetecanacional.net/controlador.php?opcion=carteleraDia&dia=".$dia; // http://www.cinetecanacional.net/controlador.php?opcion=carteleraDia&dia=2014-06-22
		@$fp = fopen($url,"r");
		@$html = stream_get_contents($fp);
		@fclose($fp);


		// Obtenemos el bloque que se repite por cada pelicula del listado.
		$datosPeliculas="";
		preg_match_all('/<div id="contenedorPelicula">(.*?)<div class="slice"> <\/div>/s', $html, $matches0);
		for($i=0;$i<count($matches0[1]);$i++)
		{
			$datosPeliculas[$i]=$matches0[1][$i];
		}

		// Recorremos cada bloque para obtener los datos de cada pelicula.
		$c=0;
		for($j=0;$j<count($datosPeliculas);$j++)
		{
			$c++;

			// Obtenemos el titulo de la pelicula.
			preg_match_all('/<p class="peliculaTitulo">(.*?)<\/p>/s', $datosPeliculas[$j], $matches);
			for($i=0;$i<count($matches[1]);$i++)
			{
				$datos["titulo"][$j]=$this->limpiar($matches[1][$i]);
			}
		
			// Obtenemos el código de la pelicula.
			preg_match_all('/clv=(.*?)\'/s', $datosPeliculas[$j], $matches);
			for($i=0;$i<count($matches[1]);$i++)
			{
				$datos["codigo"][$j]=str_replace("'","",str_replace("clv=","",$matches[1][$i]));
			}

			// Obtenemos datos de la pelicula, como nombre original y año.
			preg_match_all('/<p class="peliculaMiniFicha">(.*?)<\/div>/s', $datosPeliculas[$j], $matches);
			for($i=0;$i<count($matches[1]);$i++)
			{
				$datos["ficha"][$j]=$this->limpiar($matches[1][$i]);
			}

			// Obtenemos la sinopsis de la pelicula.
			preg_match_all('/peliculaImagenSinopsis peliculaSinopsis\">(.*?)<div id=\"horarios\">/s', $datosPeliculas[$j], $matches);
			for($i=0;$i<count($matches[1]);$i++)
			{	
				$datos["sinopsis"][$j]=$this->limpiar(html_entity_decode($matches[1][$i], ENT_COMPAT, 'ISO-8859-1'));				
			}
			
			if( !isset($datos["sinopsis"][$j]) ) //and $datos["sinopsis"][$j]==""
			{
				preg_match_all('/peliculaImagenSinopsis peliculaSinopsisD\">(.*?)<div id=\"horarios\">/s', $datosPeliculas[$j], $matches);
				for($i=0;$i<count($matches[1]);$i++)
				{	
					$datos["sinopsis"][$j]=$this->limpiar(html_entity_decode($matches[1][$i], ENT_COMPAT, 'ISO-8859-1'));				
				}
			}
		
			// Obtenemos la imagen de la pelicula.
			preg_match_all('/img_peliculas\/(.*?)\"/s', $datosPeliculas[$j], $matches);
			for($i=0;$i<count($matches[1]);$i++)
			{
				$datos["imagen"][$j]=$this->limpiar($matches[1][$i]);
			}
			
			// Obtenemos los horarios.
			preg_match_all('/<div id="horarios">(.*?)<\/div>/s', $datosPeliculas[$j], $matches);//print_r($matches[1]);
			for($i=0;$i<count($matches[1]);$i++)
			{
				$datos["horario"][$j]=$this->limpiar($matches[1][$i]);
			

				//$datos["horario"][$j]=str_replace("Lunes","Lunes",$datos["horario"][$j]);
				//$datos["horario"][$j]=str_replace("Martes","Martes",$datos["horario"][$j]);
				$datos["horario"][$j]=str_replace("Mi&eacute;rcoles","Miércoles",$datos["horario"][$j]);
				//$datos["horario"][$j]=str_replace("Jueves","Jueves",$datos["horario"][$j]);
				//$datos["horario"][$j]=str_replace("Viernes","Viernes",$datos["horario"][$j]);
				$datos["horario"][$j]=str_replace("S&aacute;bado","Sábado",$datos["horario"][$j]);
				//$datos["horario"][$j]=str_replace("Domingo","Domingo",$datos["horario"][$j]);

				//$datos["horario"][$j]=str_replace("SALA",", Sala",$datos["horario"][$j]);
				for($z=1;$z<15;$z++){
					$datos["horario"][$j]=str_replace("SALA ".$z.":",", sala ".$z." a las ",$datos["horario"][$j]);
				}
				
				
				$datos["horario"][$j]=utf8_decode($datos["horario"][$j]." hrs.");
			}
		}		

		$json = "[";
		for($i=0;$i<=$c;$i++)
		{
			if( isset($datos["titulo"][$i]) and $datos["titulo"][$i]!="" and $datos["codigo"][$i]!="" and $datos["imagen"][$i]!="" )
			{

				if($i>0){$json.=",";}
				
					$json.="{";
					$json.="\"fecha\":\"".substr($dia,8,2)."/".substr($dia,5,2)."/".substr($dia,0,4)."\",";
					$json.="\"codigo\":\"".$datos["codigo"][$i]."\",";					
					$json.="\"titulo\":\"".$datos["titulo"][$i]."\",";
					$json.="\"ficha\":\"".$datos["ficha"][$i]."\",";
					$json.="\"sinopsis\":\"".$datos["sinopsis"][$i]."\",";
					$json.="\"horario\":\"".$datos["horario"][$i]."\",";
					$json.="\"imagen\":\"".$datos["imagen"][$i]."\"";
					$json.="}";

			}
		}
		$json.="]";

		//------------------------------------------------------------------
		if( isset($_VAR["email"]) ){
			$this->log("1|".date("Y-m-d H:i:s")."|".$_VAR["email"]."|".$dia."\n");
		}
		//------------------------------------------------------------------

		return $json;
	}
	
	function detalle($_VAR)
	{
		$url="http://www.cinetecanacional.net/php/detallePelicula.php?clv=".$_VAR["codigo"];
		$fp = fopen($url,"r");
		$html = stream_get_contents($fp);
		fclose($fp);

		// Obtenemos el titulo.
		$c=0;
		preg_match_all('/div class="peliculaTitulo" style="margin-left: 10px;">(.*?)<p/s', $html, $matches);//print_r($matches[1]);
		for($i=0;$i<count($matches[1]);$i++)
		{
			$datos["titulo"][$i]=$this->limpiar($matches[1][$i]);
			$c++;
		}

		// Obtenemos la sinopsis.
		preg_match_all('/<div id="peliculaSinopsis" class="peliculaImagenSinopsis peliculaSinopsis2">(.*?)<div id="peliculaImagen" style="text-align: center;">/s', $html, $matches);//print_r($matches[1]);
		for($i=0;$i<count($matches[1]);$i++)
		{
			$datos["sinopsis"][$i]=$this->limpiar(html_entity_decode($matches[1][$i], ENT_COMPAT, 'ISO-8859-1'));
		}
		
		// Obtenemos el horario.
		preg_match_all('/<div id="horarios">(.*?)<div style="clear:both"><\/div>/s', $html, $matches);//print_r($matches[1]);
		for($i=0;$i<count($matches[1]);$i++)
		{
			$datos["horario"][$i]=$this->limpiar($matches[1][$i]);

			$datos["horario"][$i]=str_replace("Lunes"," hrs.<br><br>Lunes",$datos["horario"][$i]);
			$datos["horario"][$i]=str_replace("Martes"," hrs.<br><br>Martes",$datos["horario"][$i]);
			$datos["horario"][$i]=str_replace("Mi&eacute;rcoles"," hrs.<br><br>Miércoles",$datos["horario"][$i]);
			$datos["horario"][$i]=str_replace("Jueves"," hrs.<br><br>Jueves",$datos["horario"][$i]);
			$datos["horario"][$i]=str_replace("Viernes"," hrs.<br><br>Viernes",$datos["horario"][$i]);
			$datos["horario"][$i]=str_replace("S&aacute;bado"," hrs.<br><br>Sábado",$datos["horario"][$i]);
			$datos["horario"][$i]=str_replace("Domingo"," hrs.<br><br>Domingo",$datos["horario"][$i]);

			//$datos["horario"][$i]=str_replace("SALA",", Sala",$datos["horario"][$i]);
			for($z=1;$z<15;$z++){
					$datos["horario"][$i]=str_replace("SALA ".$z.":",", sala ".$z." a las ",$datos["horario"][$i]);
			}			

			$datos["horario"][$i]=utf8_decode($datos["horario"][$i]."&nbsp;hrs.");
			
			$datos["horario"][$i]=substr($datos["horario"][$i],9);
		}
		
		preg_match_all('/\/img_peliculas\/(.*?)"/s', $html, $matches);
		for($i=0;$i<count($matches[1]);$i++)
		{
			$datos["imagen"][$i]=$this->limpiar($matches[1][$i]);
		}

		$hayVideo=false;

		// Buscamos y obtenemos el codigo del video de youtube.
		preg_match_all("/embed\/(.*?)'/s", $html, $matches);
		for($i=0;$i<count($matches[1]);$i++)
		{
			$datos["youtubeVideo"][$i]=$matches[1][$i];
			$hayVideo=true;
		}

		if( $hayVideo==false )
		{
			//-Buscaros y obtenemos el codigo del video de vimeo.
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

		/*
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
		*/

//$enc=strpos("","");

		$titulo = "";
		$json = "[";
		for($i=0;$i<=$c;$i++)
		{
			if( isset($datos["titulo"][$i]) )
			{
				if($datos["titulo"][$i]!="")
				{
					if($i>0){$json.=",";}
					$json.="{";
				
					$json.="\"codigo\":\"".$_VAR["codigo"]."\",";
					$json.="\"titulo\":\"".$datos["titulo"][$i]."\",";
					$json.="\"sinopsis\":\"".$datos["sinopsis"][$i]."\",";
					$json.="\"horario\":\"".$datos["horario"][$i]."\",";
					$json.="\"imagen\":\"".$datos["imagen"][$i]."\",";
				
					if( isset($datos["youtubeVideo"][$i]) ){
						$json.="\"youtubeVideo\":\"".$datos["youtubeVideo"][$i]."\",";
					}else{
						$json.="\"youtubeVideo\":\"\",";
					}
				
					if( isset($datos["vimeoThumbnailURL"][$i]) ){
						$json.="\"vimeoThumbnailURL\":\"".$datos["vimeoThumbnailURL"][$i]."\",";
					}else{
						$json.="\"vimeoThumbnailURL\":\"\",";
					}

					if( isset($datos["vimeoVideo"][$i]) ){
						$json.="\"vimeoVideo\":\"".$datos["vimeoVideo"][$i]."\"";
					}else{
						$json.="\"vimeoVideo\":\"\"";
					}


					//$json.="\"youtubeURL\":\"".$datos["youtubeURL"][$i]."\"";
				
					$json.="}";
				
					$titulo=$datos["titulo"][$i];
				}
			}
		}
		$json.="]";
		
		//------------------------------------------------------------------
		if( isset($_VAR["email"]) )
		{
			$this->log("2|".date("Y-m-d H:i:s")."|".$_VAR["email"]."|".$_VAR["codigo"]."&".$titulo."\n");
		}
		//------------------------------------------------------------------
		
		return $json;
	}
	
	/*
	function fechaMostrar($dia)
	{
		// yyyy-mm-dd
		$meses=array("01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
		$dia = substr($dia,8,4)." de ".$meses[substr($dia,5,2)]." de ".substr($dia,0,4);
		return $dia;
	}
	*/
	
	function limpiar($cad)
	{
		//$cad=html_entity_decode($cad,ENT_QUOTES,"ISO-8859-1");
		//$cad=html_entity_decode($cad,ENT_QUOTES,"UTF-8");
				$cad=str_replace("\"","",$cad);
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
	
	function registro($_VAR)
	{
		$fp = fopen("registro.log","a");
		fputs($fp, str_replace("\n"," ",date("Y-m-d H:i:s")."|".$_VAR["nombre"]."|".$_REQUEST["apellidos"]."|".$_REQUEST["email"])."\n");
		fclose($fp);
		
		return "[]";
	}
	
	function ingreso($_VAR)
	{
		$fp = fopen("ingreso.log","a");
		fputs($fp, str_replace("\n"," ",date("Y-m-d H:i:s")."|".$_REQUEST["email"])."\n");
		fclose($fp);
		
		return "[]";
	}
	
	function estatus($_VAR)
	{
		echo "ok";
	}

}


switch ($_REQUEST["a"]) {
		case "l": // Listado de peliculas.
			$oParser=new Parser();
			echo $oParser->listar($_REQUEST);
		break;
		case "d": // Detalle de la pelicula.
			$oParser=new Parser();
			echo $oParser->detalle($_REQUEST);
		break;
		case "c": // Contacto.
			$oParser=new Parser();
			echo $oParser->contacto();
		break;
		case "r": // Registro.
			$oParser=new Parser();
			echo $oParser->registro($_REQUEST);
		break;
		case "i": // Ingreso.
			$oParser=new Parser();
			echo $oParser->ingreso($_REQUEST);
		break;
		case "e": // Estatus.
			$oParser=new Parser();
			echo $oParser->estatus($_REQUEST);
		break;

}

?>