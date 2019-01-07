<?php

$mysqli1 = new mysqli("localhost", "root", "pocoyojony12", "maninesa_2019");
if ($mysqli1->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli1->connect_errno . ") " . $mysqli1->connect_error;
}


$mysqli2 = new mysqli("localhost", "root", "pocoyojony12", "maninesa_examen");
if ($mysqli2->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli2->connect_errno . ") " . $mysqli2->connect_error;
}



$sql = "SELECT * FROM acc_enf_q";
$result = mysqli_query($mysqli2, $sql);
while ($row = mysqli_fetch_array($result)) {
        //echo '<pre>';
        //echo $row['pregunta'] ." ". $row['respuesta'];
        $sql1 = "INSERT INTO examen_bateria_q 
                (bat_id, mod_id, pregunta, respuesta) 
                VALUE 
                (13, 1, '".$row['pregunta']."', '".$row['respuesta']."')";
        $result1 = mysqli_query($mysqli1, $sql1);
        
        if ($result1) {
        $id = $mysqli1->insert_id;
            $sql2 = "UPDATE acc_enf_q1 SET id_q = '".$id."' WHERE id_q = '".$row['id_q']."'";
            $result2 = mysqli_query($mysqli2, $sql2);
            $sql3 = "UPDATE acc_enf_q2 SET id_q = '".$id."' WHERE id_q = '".$row['id_q']."'";
            $result3 = mysqli_query($mysqli2, $sql3);
        }
}

$sql4 = "SELECT * FROM acc_enf_q1";
$result4 = mysqli_query($mysqli2, $sql4);
while ($row2 = mysqli_fetch_array($result4)) {
        //echo '<pre>';
        //echo $row['pregunta'] ." ". $row['respuesta'];
        $sql5 = "INSERT INTO examen_bateria_q1 
                (id_q, contenido) 
                VALUE 
                ('".$row2['id_q']."', '".$row2['contenido']."')";
        //echo $sql5;
        $result7 = mysqli_query($mysqli1, $sql5);
        if (!$result7) {
            echo "no se pudo";
        }
}

$sql6 = "SELECT * FROM acc_enf_q2";
$result6 = mysqli_query($mysqli2, $sql6);
while ($row3 = mysqli_fetch_array($result6)) {
        //echo '<pre>';
        //echo $row['pregunta'] ." ". $row['respuesta'];
        $sql7 = "INSERT INTO examen_bateria_q2 
                (id_q, contenido, valor) 
                VALUE 
                ('".$row3['id_q']."', '".$row3['contenido']."', '".$row3['valor']."')";
        $result8 = mysqli_query($mysqli1, $sql7);
        if (!$result8) {
            echo "no se pudo";
        }
}





?>