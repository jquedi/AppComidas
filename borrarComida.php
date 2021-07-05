<?php

    include("conect.php");

    // Elimina una comida del dia al que estaba asignada

    $user = $_POST["user"];
    $pos = $_POST["pos"];
    $id = $_POST["id"];


    $consulta = $mysql->query("SELECT * FROM calendario WHERE `user` = " .$user);

    foreach($consulta as $tabla){
        $consulta2 = $mysql->query("UPDATE calendario SET `" .$pos ."` = " .$id ." WHERE `id` = " .$tabla['id']);
    }



?>