<?php

/*
 * Nombre: ConexionService.clase.php
 * Versión: 1.0
 * Autor: Antonio Monter
 * Descripción: Esta clase se encgrga de hacer todas las conexiones de la base de datos
 * Fecha: 2018/04/17
 */

class ConexionService {

    var $host;
    var $user;
    var $password;
    var $database;
    var $link;

    public function __construct() {
        global $cfg;

        $this->host = $cfg["db"]["servidor"];
        $this->user = $cfg["db"]["usuario"];
        $this->password = $cfg["db"]["clave"];
        $this->database = $cfg["db"]["baseDeDatos"];

        $this->link = $this->conectar();

        if (!empty($this->link)) {
            $this->seleccionarDB();
        }
    }

    public function conectar() {
        try {
            $this->link = mysqli_connect($this->host, $this->user, $this->password);
        } catch (Exception $e) {
            echo "Error: No se ha podido conectar a la base de datos.";
            return NULL;
        }

        return $this->link;
    }

    function seleccionarDB() {
        if ($this->link != NULL) {
            mysqli_select_db($this->link, $this->database);
            mysqli_set_charset($this->link, "utf8");
        }
    }

    function desconectar() {
        if ($this->link != NULL) {
            mysqli_close($this->link);
        }
    }

    function error() {
        if ($this->link != NULL) {
            return mysqli_error($this->link);
        }
    }

    function execSQL($query) {
        if ($this->link != NULL) {
            $result = mysqli_query($this->link, $query);

            if (is_object($result)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $resultset[] = $row;
                }
                if (!empty($resultset)) {
                    return $resultset;
                }
            } else {
                return $result;
            }
        }
    }

    function numFilas($query) {
        if ($this->link != NULL) {
            $result = mysqli_query($this->link, $query);
            $num = mysqli_num_rows($result);
            return $num;
        }
    }

    function insertId() {
        if ($this->link != NULL) {
            return mysqli_insert_id($this->link);
        }
    }

    function escaparCadena($val) {
        if ($this->link != NULL) {
            if (is_array($val) == true) {
                foreach ($val as $key => $value) {
                    $val[$key] = mysqli_real_escape_string($this->link, $value);
                }
            } else {
                mysqli_real_escape_string($this->link, $val);
            }

            return $val;
        }
    }

}

?>