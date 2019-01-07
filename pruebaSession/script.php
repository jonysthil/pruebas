<?php

function carritoAgregar($_VAR) {
		if( isset($_SESSION["cesta"])==false )
		{
			// No existe la cesta entonces la creamos e insertamos el producto.
			$_SESSION["cesta"] = array();
			
			$oCC = new CarritoDeComprasModel();

			$oCC->setPdtId($_VAR["pdtId"]);
			$oCC->setPdpCantidad($_VAR["pdpCantidad"]);
			
			array_push($_SESSION["cesta"],$oCC);
		}
		else
		{
			$encontrado=0;
			
			// Ya existe la cesta entonces buscamos si existe el producto.
			for( $i=0; $i<count($_SESSION["cesta"]); $i++ )
			{
				// Encontramos el producto.
				if( $_SESSION["cesta"][$i]->getPdtId()==$_VAR["pdtId"] )
				{
					// Reemplazamos la cantidad en vez de sumarla.
					$_SESSION["cesta"][$i]->setPdpCantidad( $_VAR["pdpCantidad"]);
					$_SESSION["cesta"][$i]->setPdpDescripcion($this->obtenerDescripcion($_VAR));
					$_SESSION["cesta"][$i]->setPdpObservaciones( $_VAR["pdpObservaciones"]);
					
					$encontrado=1;
				}
			}
			
			if( $encontrado==0 )
			{
				// No existe el producto lo agregamos.
				$oCC = new CarritoDeComprasModel();
				$oCC->setPdtId($_VAR["pdtId"]);
				$oCC->setPdpCantidad($_VAR["pdpCantidad"]);
				$oCC->setPdpDescripcion($this->obtenerDescripcion($_VAR));
				$oCC->setPdpObservaciones($_VAR["pdpObservaciones"]);
				array_push($_SESSION["cesta"],$oCC);
			}
		}
		return "ok";
}

?>