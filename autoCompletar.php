<?php

    include("conect.php");
    
    require("comida.php");

    $user = $_POST["user"];
    $tipo = $_POST["tipo"];
    $pos = $_POST["pos"];
    $pos2 = $_POST["pos2"];

    // rango de kcal, proteinas y grasas recomendables por dia [Maximas, minimas]
    $kcalR = explode(",", $_POST['kcalR']);
    $proR = explode(",", $_POST['proR']);
    $grasaR = explode(",", $_POST['grasaR']);


    // Lista de comidas que encajan en los valores recomendados en combinacion con la comida ya existende en ese dia
    $validas = [];

    if($tipo == "COMIDA"){
        $cambiar = $pos;
        $otro = $pos2;
    }
    if($tipo == "CENA"){
        $cambiar = $pos2;
        $otro = $pos;
    }


    // Localiza el identificador de la comida o cena que ya existe en este dia

    $consulta = $mysql->query("SELECT * FROM calendario WHERE `user` = " .$user);

    foreach($consulta as $tabla){

        $idOtro = $tabla[$otro];

    }




    // busca las comidas que, en combinacion con la que ya está asignada a este dia, se mantengan dentro del rango recomendado
    function buscar(){
        if($GLOBALS["idOtro"] == 0){
            $query = "SELECT * FROM comidas WHERE id != 0 AND USER = " .$GLOBALS["user"] ." AND (tipo = '" .$GLOBALS["tipo"] ."' OR tipo = 'AMBOS') ORDER BY LAST, cont";
            
            $consulta = $GLOBALS["mysql"]->query($query);

            foreach($consulta as $comida2){
                array_push($GLOBALS["validas"], $comida2["id"]);
            }
        }else{
            $query = "SELECT * FROM combinacionescomidas WHERE USER = " .$GLOBALS["user"] ." AND (kcal BETWEEN " .$GLOBALS["kcalR"][1] ." AND " .$GLOBALS["kcalR"][0] .") AND (proteina BETWEEN " .$GLOBALS["proR"][1] ." AND " .$GLOBALS["proR"][0] .") AND (grasa BETWEEN " .$GLOBALS["grasaR"][1] ." AND " .$GLOBALS["grasaR"][0] .") AND comida1 = " .$GLOBALS["idOtro"];
            
            $consulta = $GLOBALS["mysql"]->query($query);

            foreach($consulta as $comida2){
                array_push($GLOBALS["validas"], $comida2["comida2"]);
            }
        }
    }

    buscar();

    // Si no ha habido ninguna que encaje en el rando, va ampliando el rango en ambos sentidos y con cada ampliación vuelve a comprobar si hay comidas que encajen
    // El proposito de esto es asignar la comida mas equilibrada despues de concluir que no hay ninguna que en combinacion con la ya asiganada al dia que esté dentro del rango deseable

    while(count($validas) < 1){
        $kcalR[0] = $kcalR[0] + 1;
        $kcalR[1] = $kcalR[1] - 1;
        buscar();
        if(count($validas) > 0){
            break;
        }
        $proR[0] = $proR[0] + 1;
        $proR[1] = $proR[1] - 1;
        buscar();
        if(count($validas) > 0){
            break;
        }
        $grasaR[0] = $grasaR[0] + 1;
        $grasaR[1] = $grasaR[1] - 1;
        buscar();
    }
    

    $query = "UPDATE `calendario` SET `" .$cambiar ."`= " .$validas[array_rand($validas, 1)] ." WHERE `user` = " .$user;

    $consulta = $mysql->query($query);

   
?>