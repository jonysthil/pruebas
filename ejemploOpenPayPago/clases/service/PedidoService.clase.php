<?php

class PedidoService
{
	var $oDB = null;

	function __construct($oDB)
	{
		$this->oDB=$oDB;
	}

	function actualizarPedido($_VAR,$charge)
	{
		$sql="update pedido set pd_pagoEstatus='".$charge->status."',pd_pagoFecha='".date("H-m-d H:i:s")."' where pd_id='".$_VAR["pd_id"]."'";
		return $this->oDB->execSQL($sql);
	}
}

?>