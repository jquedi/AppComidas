<?php

include("conect.php");

// Crea la lista de los ingredientes para seleccionarlos y asignarlos a una nueva comida

$filtro = $_POST['filtro'];
$checked = explode(",", $_POST['checked']);

$consulta = "SELECT * FROM ingredientes WHERE name LIKE '%" .$filtro ."%' ORDER BY name";

$resultados = $mysql->query($consulta);

$devolver = "";

foreach( $resultados as $r ){
    if(in_array($r["id"], $checked)){
        $devolver = $devolver .
        '<div class="selectIIngrediente"><div class="checkIngre" onclick="addIng(' .$r["id"] .', 2)">-</div><div>' .$r["name"] .'</div></div>';
    }
}
if($devolver != ""){
    $devolver = $devolver .'<div style="width: 100%; height: 5px; border-bottom: solid;"></div>';
}

foreach( $resultados as $r ){
    if(!in_array($r["id"], $checked)){
        $devolver = $devolver .
        '<div class="selectIIngrediente"><div class="checkIngre" onclick="addIng(' .$r["id"] .', 1)">+</div><div>' .$r["name"] .'</div></div>';
    }
}

echo json_encode($devolver);

?>