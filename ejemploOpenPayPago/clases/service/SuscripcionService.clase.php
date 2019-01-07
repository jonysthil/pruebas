<?php

class SuscripcionService
{
	var $oDB = null;

	function __construct($oDB)
	{
		$this->oDB=$oDB;
	}

	function actualizarCliente($_VAR,$custumer,$card,$suscription)
	{
		$sql="update cliente set clt_pagoEstatus='".$charge->status."',clt_pagoFecha='".date("H-m-d H:i:s")."' where clt_id='".$_VAR["clt_id"]."'";
		return $this->oDB->execSQL($sql);
	}
}
?>