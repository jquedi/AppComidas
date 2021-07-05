<?php

require("dia.php");
include("conect.php");

$user = $_POST['user'];
$kcalR = explode(",", $_POST['kcalR']);
$proR = explode(",", $_POST['proR']);
$grasaR = explode(",", $_POST['grasaR']);
$valores = [$kcalR, $proR, $grasaR];


// Forma la tabla completa de la semana
$semana = $mysql->query("SELECT * FROM calendario WHERE user = " .$user);

$resultado = "";

foreach($semana as $r1){
    $resultado = $resultado .diaF($r1["lunes1"], $r1["lunes2"], "LUNES", "lunes1", "lunes2", $valores);
    $resultado = $resultado .diaF($r1["martes1"], $r1["martes2"], "MARTES", "martes1", "martes2", $valores);
    $resultado = $resultado .diaF($r1["miercoles1"], $r1["miercoles2"], "MIERCOLES", "miercoles1", "miercoles2", $valores);
    $resultado = $resultado .diaF($r1["jueves1"], $r1["jueves2"], "JUEVES", "jueves1", "jueves2", $valores);
    $resultado = $resultado .diaF($r1["viernes1"], $r1["viernes2"], "VIERNES", "viernes1", "viernes2", $valores);
    $resultado = $resultado .diaF($r1["sabado1"], $r1["sabado2"], "SABADO", "sabado1", "sabado2", $valores);
    $resultado = $resultado .diaF($r1["domingo1"], $r1["domingo2"], "DOMINGO", "domingo1", "domingo2", $valores);
}


// Comprueba si los valores nutricionales se encuentran dentro del rango recomendado

function intervalo($num, $val, $val2){
    switch($num){
        case 1:
            if(intval($val2[0]) < intval($val)){
                $aux = "valAlto";
            }else{
                if(intval($val2[1]) > intval($val)){
                    $aux = "valBajo";
                }else{
                    $aux = "valNormal";
                }
            }

            break;
        
        case 2:

            if(intval($val2[0]) < intval($val)){
                $aux = "valAlto";
            }else{
                if(intval($val2[1]) > intval($val)){
                    $aux = "valBajo";
                }else{
                    $aux = "valNormal";
                }
            }

            break;
        
        case 3:

            if(intval($val2[0]) < intval($val)){
                $aux = "valAlto";
            }else{
                if(intval($val2[1]) > intval($val)){
                    $aux = "valBajo";
                }else{
                    $aux = "valNormal";
                }
            }

            break;
    }
    return $aux;
}


// Forma el dia

function diaF($idComida, $idCena, $nombreDia, $pos1, $pos2, $valores){
    $dia = new Dia($idComida, $idCena);
    $comida = $dia->getComida();
    $cena = $dia->getCena();
    $kcal = $dia->getKcal();
    $pro = $dia->getProteina();
    $grasa = $dia->getGrasa();
    
    $result = '<div class="diaCont">
    <div class="nombreDia">
        ' .$nombreDia .'
    </div>
    <div class="comidaDia">
        COMIDA
        <div id="' .$pos1 .'" class="menuOpciones">
            <div onclick="borrarComida(\'' .$pos1 .'\', 0)" class="opcion">Vaciar</div>
            <div onclick="listaComidasF(true, \'\', \'' .$pos1 .'\')" class="opcion">Cambiar</div>
            <div onclick="autoCompletar(\'' .$pos1 .'\', \'' .$pos2 .'\', \'COMIDA\')" class="opcion">Auto</div>
        </div>
        <div onclick="opciones(\'' .$pos1 .'\')" style="position: absolute;right: 5px;top: 2px;" class="opciones">
            <div class="punto"></div>
            <div class="punto"></div>
            <div class="punto"></div>
        </div>
    </div>
    <div class="comidaNombre" onclick="toggleComida(true, ' .$comida[0] .')">
        ' .$comida[1] .'
    </div>
    <div class="comidaDia">
        CENA
        <div id="' .$pos2 .'" class="menuOpciones">
            <div onclick="borrarComida(\'' .$pos2 .'\', 0)" class="opcion">Vaciar</div>
            <div onclick="listaComidasF(true, \'\', \'' .$pos2 .'\')" class="opcion">Cambiar</div>
            <div onclick="autoCompletar(\'' .$pos1 .'\', \'' .$pos2 .'\', \'CENA\')" class="opcion">Auto</div>
        </div>
        <div onclick="opciones(\'' .$pos2 .'\')" style="position: absolute;right: 5px;top: 2px;" class="opciones">
            <div class="punto"></div>
            <div class="punto"></div>
            <div class="punto"></div>
        </div>
    </div>
    <div class="comidaNombre" onclick="toggleComida(true, ' .$cena[0] .')">
        ' .$cena[1] .'
    </div>
    <div class="comidaDia">
        VALORES
    </div>
    <div class="contValoresDia">
        <div class="valorDia">
            <div class="">Kcals</div>
            <div class="lineaValoresDia"></div>
            <div class="' .intervalo(1, $kcal, $valores[0]) .'">' .number_format($kcal, 1, ".", "") .'</div>
        </div>
        <div class="valorDia">
            <div class="">Proteinas</div>
            <div class="lineaValoresDia"></div>
            <div class="' .intervalo(2, $pro, $valores[1]) .'">' .number_format($pro, 1, ".", "") .'g</div>
        </div>
        <div class="valorDia">
            <div class="">Grasas</div>
            <div class="lineaValoresDia"></div>
            <div class="' .intervalo(3, $grasa, $valores[2]) .'">' .number_format($grasa, 1, ".", "") .'g</div>
        </div>
    </div>
    </div>';

    return $result;
}


echo json_encode($resultado);




?>