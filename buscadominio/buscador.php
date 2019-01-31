<?php 
/**
 * Autor:Rodrigo Chambi Q.
 * Script para la consulta de dominio
 * a un sevidor WHOIS
 */
function WOIS($WOIS='',$Dominio){
	$stringDatoWois="";
	$Mostrar=array();
	       $sock       = fsockopen($WOIS, 43);
	       if(!$sock){
	       	$Mostrar[0]=false;
	       }else{
	       	$Mostrar[0]=true;
			    fwrite($sock, $Dominio."\r\n");
				while(!feof($sock) ){
				  	$stringDatoWois .= fgetss($sock,128);
				}	
			    fclose($sock);
			$Mostrar[1]=$stringDatoWois;     
	       } 
return $Mostrar;	       
}
   $WoisNombre = array(
   	          '.com'   =>array('whois.crsnic.net','No match for'),//.com
   	          '.net'   =>array('whois.crsnic.net','No match for'),// .net
   	          '.bo'    =>array('whois.nic.bo','whois.nic.bo solo acepta consultas con dominios .bo'),//.bo
               '.mx'    =>array('whois.nic.mx','No_Se_Encontro_El_Objeto'),//.mx
               '.com.mx'    =>array('whois.nic.com.mx','No_Se_Encontro_El_Objeto'),//.com.mx
   	          '.pe'    =>array('whois.nic.pe','No Object Found'),//.pe
   	          '.co'    =>array('whois.nic.co','Not found'));//.co
         $NombreDominio   =empty($_POST['Nomb']) ? false :  $_POST['Nomb'];
         $ExtesionDominio =empty($_POST['Ext'])  ? false :  $_POST['Ext'];
         $incremento       =empty($_POST['Incremento']) ? 0 :  $_POST['Incremento'];
    if(strlen($NombreDominio)>0){
    	$stringParser="";
       $NombreDominio   = preg_replace(array(
				'/www./','/http:\//','/\//','/.com/',
				'/.bo/','/.com.bo/','/edu.bo/','/.com.mx/',
				'/.org.bo/','/.net/','/.mx/',
				'/.pe/','/.co/'), '', $NombreDominio);
       	foreach ($WoisNombre as $key => $value) {
       		if($key==$ExtesionDominio){
            if (WOIS($value[0],$NombreDominio.$ExtesionDominio)[0]==true){
                  $DatoSWois= WOIS($value[0],$NombreDominio.$ExtesionDominio)[1];
                  $Disponible='<div class="alert alert-success alert-dismissible" style="margin-top:5px;" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>                 
                           <span>El dominio <strong>'.$NombreDominio.$ExtesionDominio.'</strong> esta <strong>disponible.</strong> para la realizacion de compra. </span>
                           <button class="btn btn-success" id="Enviar" type="button"><i class="glyphicon glyphicon-shopping-cart"></i> Comprar</button>
                        </div>';
                    $NoDisponible='<div class="alert alert-danger alert-dismissible" role="alert" style="margin-top:5px;">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>                 
                           <span>El dominio <strong>'.$NombreDominio.$ExtesionDominio.'</strong> esta <strong>no esta disponible.</strong></span>
                           <a class="btn btn-linnk" role="button" data-toggle="collapse" href="#collapseExample'.$incremento .'" aria-expanded="false" aria-controls="collapseExample'.$incremento .'">
                                  Ver el autor registrante
                                </a>
                                <div class="collapsing" id="collapseExample'.$incremento .'">
                                  <div class="well">
                                   <pre>'.WOIS($value[0],$NombreDominio.$ExtesionDominio)[1].'</pre>
                                  </div>
                                </div>
                        </div>'; 
                       //Quitamos algunos caracteres
                       //del servidor WHOIS Boliviano    
                      if($key==".bo"){
                        $DatoSWois=str_replace(array("\r\n", "\n", "\r"), '', $DatoSWois);
                         if($DatoSWois==$value[1]){
                           echo $Disponible;
                        }else{
                            echo $NoDisponible; 
                        }
                      }else{
                        //Buscamos 
                        if (preg_match("/".$value[1]."/i",$DatoSWois)){
                            echo $Disponible ;
                          }else{
                            echo $NoDisponible; 
                          }
                      }
               }else{
               }
       		}
       	} 	  
     }
 ?>