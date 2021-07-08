<?php

include("conect.php");
require("comida.php");

// Guarda la comida nueva y crea todas las combinaciones posibles con el resto de comidas existentes guardandolas en la BD


$checked = explode(",", $_POST['checked']);
$valores = explode(",", $_POST['valores']);
$nombre = $_POST['nombre'];
$prio = $_POST['prio'];
$tipo = $_POST['tipo'];
$racion = $_POST['racion'];
$user = $_POST['user'];
if($prio == "" || $prio == null){
    $prio = 1;
}
if($tipo == "" || $tipo == null){
    $tipo = "COMIDA";
}
if($racion == "" || $racion == null){
    $racion = 1;
}



function sumarValores($comida1, $comida2){
    $aux1 = new Comida($comida1);
    $aux2 = new Comida($comida2);


    $return = [($aux1->get(6)+$aux2->get(6)), ($aux1->get(12)+$aux2->get(12)), ($aux1->get(7)+$aux2->get(7))];

    return $return;
}


function combinar($response, $comida){
    foreach($response as $comida2){

        $valores = sumarValores($comida, $comida2["id"]);

        $consulta2 = "INSERT INTO `combinacionescomidas` (`comida1`, `comida2`, `kcal`, `proteina`, `grasa`, `user`) VALUES (" .$comida .", " .$comida2["id"] .", " .number_format($valores[0], 1, ".", "") .", " .number_format($valores[1], 1, ".", "") .", " .number_format($valores[2], 1, ".", "") .", " .$GLOBALS["user"] .")";

        $GLOBALS["mysql"]->query($consulta2);
    }
}





if($nombre != ""){

    $consulta = "INSERT INTO `comidas` (`name`, `prio`, `tipo`, `raciones`, `user`) VALUES ('" .$nombre ."', " .$prio .", '" .$tipo ."', " .$racion .", " .$user .")";

    $mysql->query($consulta);

    if(count($checked) > 0){
        $id = $mysql->insert_id;

        foreach($checked as $r){
            $pos = array_search($r, $checked);
            $consulta = "INSERT INTO `comidaingredientes` (`comida`, `ingrediente`, `cant`) VALUES (" .$id .", " .$r .", " .$valores[$pos] .")";

            $mysql->query($consulta);
        }
    }

    if($tipo == "COMIDA"){

        $consulta = "SELECT * FROM comidas WHERE (tipo = 'CENA' OR tipo = 'AMBOS') AND id != 0 AND user = " .$user;

        $response = $mysql->query($consulta);

        combinar($response, $id);
    }
    if($tipo == "CENA"){

        $consulta = "SELECT * FROM comidas WHERE (tipo = 'COMIDA' OR tipo = 'AMBOS') AND id != 0 AND user = " .$user;

        $response = $mysql->query($consulta);
        combinar($response, $id);
    }
    if($tipo == "AMBOS"){


        $consulta = "SELECT * FROM comidas WHERE (tipo = 'CENA' OR tipo = 'AMBOS') AND id != 0 AND user = " .$user;

        $response = $mysql->query($consulta);
        combinar($response, $id);


        $consulta = "SELECT * FROM comidas WHERE tipo = 'COMIDA' AND id != 0 AND user = " .$user;

        $response = $mysql->query($consulta);
        combinar($response, $id);
    }



    echo true;
}else{
    echo false;
}



?>