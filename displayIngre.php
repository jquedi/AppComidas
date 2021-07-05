<?php

include("conect.php");
$checked = explode(",", $_POST['checked']);
$valores = explode(",", $_POST['valores']);

$consulta = "SELECT * FROM ingredientes";

$resultados = $mysql->query($consulta);

$devolver = "<ul>";

foreach( $resultados as $r ){
    if(in_array($r["id"], $checked)){
        $pos = array_search($r["id"], $checked);
        $devolver = $devolver . '<li class="ingrediente"><div>'.$r["name"] .'<input type="number" onkeyup="arrayIngreF(' .$r["id"] .', value)" value="' .$valores[$pos] .'" class="cantIngreInput">' .$r["unidad"] .'</div></li>';
    }
}

$devolver = $devolver .'<ul>';

echo json_encode($devolver);

?>