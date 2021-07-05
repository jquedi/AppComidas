<?php

include("conect.php");
$checked = explode(",", $_POST['checked']);
$valores = explode(",", $_POST['valores']);
$nombre = $_POST['nombre'];
$prio = $_POST['prio'];
$tipo = $_POST['tipo'];
$racion = $_POST['racion'];
if($prio == "" || $prio == null){
    $prio = 1;
}
if($tipo == "" || $tipo == null){
    $tipo = "COMIDA";
}
if($racion == "" || $racion == null){
    $racion = 1;
}

if($nombre != ""){

    $consulta = "INSERT INTO `comidas` (`name`, `prio`, `tipo`, `raciones`, `user`) VALUES ('" .$nombre ."', " .$prio .", '" .$tipo ."', " .$racion .", 1)";

    $mysql->query($consulta);

    if(count($checked) > 0){
        $id = $mysql->insert_id;

        foreach($checked as $r){
            $pos = array_search($r, $checked);
            $consulta = "INSERT INTO `comidaingredientes` (`comida`, `ingrediente`, `cant`) VALUES (" .$id .", " .$r .", " .$valores[$pos] .")";

            $mysql->query($consulta);
        }
    }



    echo true;
}else{
    echo false;
}



?>