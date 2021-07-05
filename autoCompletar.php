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

    $kcalOtro = 0;
    $proOtro = 0;
    $grasaOtro = 0;

    // Crea un array con todos los enteros entre el minimo y el maximo recomendable
    $kcalRange = range($kcalR[1], $kcalR[0]);
    $proRange = range($proR[1], $proR[0]);
    $grasaRange = range($grasaR[1], $grasaR[0]);

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

        $otroComida = new Comida($tabla[$otro]);
        $idOtro = $tabla[$otro];

    }


// Valores de la comida existente
    $kcalOtro += $otroComida->get(6);
    $proOtro += $otroComida->get(12);
    $grasaOtro += $otroComida->get(7);


    // busca las comidas que, en combinacion con la que ya está asignada a este dia, se mantengan dentro del rando recomendado
    function buscar(){

        $consulta = $GLOBALS["mysql"]->query("SELECT * FROM comidas WHERE `user` = " .$GLOBALS["user"] ." AND (tipo = '" .$GLOBALS["tipo"] ."' OR tipo = 'AMBOS') AND id != " .$GLOBALS["idOtro"]);

        foreach($consulta as $r1){

            $auxComida = new Comida($r1["id"]);

            $auxKcal = $auxComida->get(6);
            $auxPro = $auxComida->get(12);
            $auxGrasa = $auxComida->get(7);

            $prueba = false;

            if(in_array(intval($auxKcal + $GLOBALS["kcalOtro"]), $GLOBALS["kcalRange"])){
                $prueba = true;
            }else{
                $prueba = false;
            }

            if(in_array(intval($auxPro + $GLOBALS["proOtro"]), $GLOBALS["proRange"]) && $prueba == true){
                $prueba = true;
            }else{
                $prueba = false;
            }

            if(in_array(intval($auxGrasa + $GLOBALS["grasaOtro"]), $GLOBALS["grasaRange"]) && $prueba == true){
                $prueba = true;
            }else{
                $prueba = false;
            }

            if($prueba){
                array_push($GLOBALS["validas"], $r1["id"]);
            }

        }
    }

    buscar();

    // Si no ha habido ninguna que encaje en el rando, va ampliando el rango en ambos sentidos y con cada ampliación vuelve a comprobar si hay comidas que encajen
    // El proposito de esto es asignar la comida mas equilibrada despues de concluir que no hay ninguna que en combinacion con la ya asiganada al dia que esté dentro del rango deseable

    // esta es la funcion que puede ralentizar la asignación, ya que en el peor de los casos puede llegar a hacer muchas iteracciones en la busqueda de la comida 
    // pero cuanto mayor sea la lista de comidas del usuario, mas facil será encontrar esa comida ideal
    while(count($validas) < 1){
        array_unshift($kcalRange, $kcalRange[0]-1);
        array_push($kcalRange, $kcalRange[array_key_last($kcalRange)]+1);
        buscar();
        if(count($validas) > 0){
            break;
        }
        array_unshift($proRange, $proRange[0]-1);
        array_push($proRange, $proRange[array_key_last($proRange)]+1);
        buscar();
        if(count($validas) > 0){
            break;
        }
        array_unshift($grasaRange, $grasaRange[0]-1);
        array_push($grasaRange, $grasaRange[array_key_last($grasaRange)]+1);
        buscar();
    }



    $consulta = $mysql->query("UPDATE `calendario` SET `" .$cambiar ."`= " .$validas[0] ." WHERE `user` = " .$user);

   
?>