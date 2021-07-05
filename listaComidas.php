<?php

    include("conect.php");


    // Crea la lista de comidas para la seleccion del calendario

    $filtro = $_POST["filtro"];
    $user = $_POST["user"];
    $pos = $_POST["pos"];


    $comidas = $mysql -> query("SELECT * FROM comidas WHERE user = " .$user ." AND name LIKE '%" .$filtro ."%' AND id != 0 ORDER BY name");


    $devolver = '<ul>';


    foreach($comidas as $comida){
        $devolver = $devolver .'<li class="searchComidaName" onclick="borrarComida(\'' .$pos .'\', ' .$comida["id"] .')">' .$comida["name"] .'</li>';
    }

    $devolver = $devolver .'</ul>';

    echo json_encode($devolver);

?>