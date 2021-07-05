<?php

    include("conect.php");


    // Crea la lista de las comidas del index teniendo en cuenta el filtro del buscador

    $filtro = $_POST["filtro"];
    $user = $_POST["user"];

    $devolver = "";

    $resultados = $mysql->query("select * from comidas where id != 0 AND user = " .$user ." AND name LIKE '%" .$filtro ."%' ORDER BY name");

    foreach( $resultados as $r ){
    
        $devolver = $devolver ."<div onclick='toggleComida(true, {$r['id']})' class='comida'>
                <div>{$r['name']}</div>
            </div>";
    }

    echo json_encode($devolver);

?>