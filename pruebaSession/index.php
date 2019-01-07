<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <title>Carrito de compra</title>
</head>
<body>
    <div class="container">
        <h1>Carrito de compra</h1>
        <form action="?a=a" method="post">

            <label>Id del producto: </label>
            <input type="number" min="1" class="form-control" name="pdId">
            <br><br>
            <label>Cantidad: </label>
            <input type="number" class="form-control"  name="pdCantidad">
            <br><br>
            <input type="submit" name="agregar" class="btn btn-success btn-sm" value="Agregar a carrito">

        </form>
    </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>
<?php

    if (isset($_REQUEST['a']) && $_REQUEST['a'] == 'l') {

        $oCC = new CarritoCompraServise();
        //$oCC->listar();

        echo '<br><div class="container"><table class="table table-bordered">';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>CANTIDAD</th>';
        echo '<th>EDITAR</th>';
        echo '<th>BORRAR</th>';
        echo '</tr>';

        foreach ($oCC->listar() as $listado) {
        
            echo '<tr>'; 
            echo '<td>'.$listado->pdId.'</td>';
            echo '<td>
            <form action="?a=u" method="post">
            <input type="hidden" name="pdId" value="'.$listado->pdId.'">
            <input type="text" class="form-control" name="pdCantidad" value="'.$listado->pdCantidad.'">
            
            </td>';
            echo '<td><input type="submit" class="btn btn-sm btn-primary" name="editar" value="Actualizar"></a></td>';
            echo '</form>';
            echo '<td><a class="btn btn-sm btn-danger" href="?a=d&pdId='.$listado->pdId.'">Borrar</a></td>';
            echo '</tr>';

        }
    echo '</table></div>';
    }
//accion agregar
    if (isset($_REQUEST['a']) && $_REQUEST['a'] == 'a') {
        if (isset($_POST['pdId']) || isset($_POST['pdCantidad'])) {
            $oCC = new CarritoCompraServise();

            $oCC->agregar($_POST);
            $l = 'l';
            header('Location: ?a='.$l);
        }
    }
//accion actualizar
    if (isset($_REQUEST['a']) && $_REQUEST['a'] == 'u') {
        if (isset($_POST['pdId']) || isset($_POST['pdCantidad'])){
            $oCC = new CarritoCompraServise();

            $oCC->actualizar($_POST);
            $l = 'l';
            header('Location: ?a='.$l);
        }
    }
//accion borrar
    if (isset($_REQUEST['a']) && $_REQUEST['a'] == 'd') {
        if (isset($_GET['pdId']) && $_GET['pdId'] != ''){
            $oCC = new CarritoCompraServise();
            $oCC->eliminar($_GET);
            $l = 'l';
            header('Location: ?a='.$l);
        }
    }

    
/*===============================================================*/

class CarritoCompraServise {

    //var $pdId;
    //var $pdCantidad;

    function __construct() {
        
    }

    function agregar($_VAR) {

        if(isset($_SESSION["cesta"]) == false) {
            /*
             * Se ejecuta cuando no hay cesta de compra.
             */
            $_SESSION["cesta"] = array();

            $oPM = new ProductoModel();

            $oPM->setPdId($_VAR['pdId']);
            $oPM->setPdCantidad($_VAR['pdCantidad']);

            array_push($_SESSION['cesta'], $oPM);
            
        } else {

            $encomtrado = 0;

            for ($i=0; $i<count($_SESSION['cesta']); $i++) {
            
                if ($_SESSION['cesta'][$i]->getPdId() == $_VAR['pdId']) {
                    $_SESSION['cesta'][$i]->setPdCantidad($_VAR['pdCantidad']);
                    $encomtrado = 1;
                }

            }

            if ($encomtrado == 0) {

                $oPM = new ProductoModel();

                $oPM->setPdId($_VAR['pdId']);
                $oPM->setPdCantidad($_VAR['pdCantidad']);
                
                array_push($_SESSION["cesta"], $oPM);

            }
        }

        echo "1";
        
	}

    function listar() {

        $oPs = array();
		
        if (isset($_SESSION["cesta"]) == true) {
            for($i=0; $i<count($_SESSION["cesta"]); $i++) {	
                if($_SESSION["cesta"][$i]->getPdCantidad() > 0) {
                    $oPM = new ProductoModel();

                    $oPM->setPdId($_SESSION["cesta"][$i]->getPdId());
                    $oPM->setPdCantidad($_SESSION["cesta"][$i]->getPdCantidad());
                    
                    array_push($oPs,$oPM);
                }
            }
        }
        return $oPs;
    }

    function actualizar($_VAR){
        if (isset($_SESSION["cesta"]) == true) {
            for ($i=0; $i<count($_SESSION['cesta']); $i++) {
                if ($_SESSION['cesta'][$i]->getPdId() == $_VAR['pdId']) {
                    $_SESSION['cesta'][$i]->setPdCantidad($_VAR['pdCantidad']);
                }
            }
        }
    }

    function eliminar($_VAR) {
        if (isset($_SESSION["cesta"]) == true) {
            for ($i=0; $i<count($_SESSION['cesta']); $i++) {
                if ($_SESSION['cesta'][$i]->getPdId() == $_VAR['pdId']) {
                    $_SESSION['cesta'][$i]->setPdCantidad(0);
                }
            }
        }
        return true;
    }

}

/* Modelo */

class ProductoModel {
    var $pdId;
    var $pdCantidad;

    function setPdId($pdId) {
        $this->pdId = $pdId;
    }

    function getPdId() {
        return $this->pdId;
    }

    function setPdCantidad($pdCantidad) {
        $this->pdCantidad = $pdCantidad;
    }

    function getPdCantidad() {
        return $this->pdCantidad;
    }
}

?>