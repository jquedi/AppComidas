<?php

include("conect.php");
$nombre = $_POST['nombre'];
$unidades = $_POST['unidades'];
$prop1 = $_POST['prop1'];
$prop2 = $_POST['prop2'];
$prop3 = $_POST['prop3'];
$prop4 = $_POST['prop4'];
$prop5 = $_POST['prop5'];
$prop6 = $_POST['prop6'];
$prop7 = $_POST['prop7'];
$prop8 = $_POST['prop8'];
$prop9 = $_POST['prop9'];
$prop10 = $_POST['prop10'];
$prop11 = $_POST['prop11'];

if($nombre != ""){

    $consulta = "INSERT INTO `ingredientes` (`name`, `kcal`, `grasa`, `saturadas`, `hc`, `azucar`, `fibra`, `proteina`, `sal`, `calcio`, `fosforo`, `hierro`, `unidad`) VALUES ('" .$nombre ."', " .$prop1 .", " .$prop2 .", " .$prop4 .", " .$prop5 .", " .$prop7 .", " .$prop6 .", " .$prop3 .", " .$prop8 .", " .$prop9 .", " .$prop10 .", " .$prop11 .", '" .$unidades ."')";

    $mysql->query($consulta);

    echo true;
}else{
    echo false;
}



?>