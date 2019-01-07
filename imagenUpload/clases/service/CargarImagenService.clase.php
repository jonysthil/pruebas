<?php

class CargarImagenService {

	function __construct() {
	}

	function subirImagen($_VAR) {
		$size = $_FILES['subir']['size'];
		$type = $_FILES['subir']['name'];
		
		/*echo "<pre>";
		print_r($_FILES['subir']);
		die();*/

		$obj = new HelperService();

		$dir = "uploads/";
		$nombre = $obj->limpiaNombre($type);
		$archivo = $dir . $nombre;

		$formato = $obj->validaFormato($type);
		if ($formato) {
			$tamanio = $obj->validaTamanio($size);
			if ($tamanio) {
				if (move_uploaded_file($_FILES['subir']['tmp_name'], $archivo)) {
					return 'god';
				} else {
					print_r($_FILES['subir']);
				}
			} else {
				return "grande";
			}
		} else {
			return "formato";
		}
	}

}

?>