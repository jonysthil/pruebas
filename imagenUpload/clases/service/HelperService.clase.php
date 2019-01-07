<?php

class HelperService {

	function calcularTamanio($size) {
		$kb = 1024;
		$mb = 1048576;
		$gb = 1073741824;
		$tb = 1099511627776;

		if($size < $kb) {
			return $size." B";
		} elseif ($size < $mb) {
			return round($size/$kb,1)." KB";
		} elseif($size < $gb) {
			return round($size/$mb,1)." MB";
		} elseif($size < $tb) {
			return round($size/$gb,1)." GB";
		} else {
			return round($size/$tb,1)." TB";
		}
	}

	function validaTamanio($size) {
		$permitido = 5242880; //5MB

		if ($size < $permitido) {
			return 1;
		} else {
			return 0;
		}
	}

	function validaFormato($type) {
		$validos = array('jpg', 'png', 'jpeg');
		$denegados = array('php', 'php3', 'php4', 'phtml','exe','html','sh','js','shtml','pl','cgi','mp4');
		
		$desp = ".";
        $selec = strpos($type, $desp);
        $ext = substr($type, ($selec+1));
		
		if (in_array($ext, $validos) and !in_array($ext, $denegados)) {
			return 1;
		} else {
			return 0;
		}
	}

	function limpiaNombre($name) {
        
        $desp = ".";
        $selec = strpos($name, $desp);
        $ext = substr($name, ($selec+1));
        
        $name = str_replace("." . end(explode('.', $name)), "", $name);

        $name = trim($name);

        $name = str_replace(
                array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'), array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'), $name
        );

        $name = str_replace(
                array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'), array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'), $name
        );

        $name = str_replace(
                array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'), array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'), $name
        );

        $name = str_replace(
                array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'), array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'), $name
        );

        $name = str_replace(
                array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'), array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'), $name
        );

        $name = str_replace(
                array('ñ', 'Ñ', 'ç', 'Ç'), array('n', 'N', 'c', 'C',), $name
        );

        //Esta parte se encarga de eliminar cualquier caracter extraño
        $name = str_replace(array("\\", "¨", "º", "-", "~", "#", "@", "|", "!", "\"", "·", "$", "%", "&", "/", "(", ")", "?", "'", "¡", "¿", "[", "^", "`", "]", "+", "}", "{", "¨", "´", ">", "< ", ";", ",", ":", ".", " "), "_", $name);
        return date("dmY_His") . "_" . $name . "." . $ext; 
    }

}

?>