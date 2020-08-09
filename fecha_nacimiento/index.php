<?php

function calcular_edad($fecha){

    $fecha_nac = new DateTime(date('Y/m/d',strtotime($fecha))); // Creo un objeto DateTime de la fecha ingresada

    $ano = date("Y");
    
    $fecha_hoy =  new DateTime(date('Y/m/d', strtotime($ano."/09/01"))); // Creo un objeto DateTime de la fecha de hoy
    
    $edad = date_diff($fecha_hoy,$fecha_nac); // La funcion ayuda a calcular la diferencia, esto seria un objeto
    
    return $edad;
    
    }
    
     
    
     
    
    $edad = calcular_edad('2015-09-01');
    
    echo "Tiene {$edad->format('%Y')} años y {$edad->format('%m')} meses"; // Aplicamos un formato al objeto resultante de la funcion
    
     
    
    ?>