<?php

    include("conect.php");
    require("comida.php");

    $user = $_POST["user"];

// Crea toda las combinaciones de comidas posibles
// Esto solo se ha usado para no combinar a mano las existentes al haber actualizado la formula para autocompletar

    $consulta1 = "SELECT * FROM comidas WHERE user = " .$user ." AND id != 0";

    $response1 = $mysql->query($consulta1);

    foreach($response1 as $comida){
        $tipo = $comida["tipo"];
        if($tipo == "COMIDA"){

            $consulta = "SELECT * FROM comidas WHERE (tipo = 'CENA' OR tipo = 'AMBOS') AND id != 0 AND user = " .$user;
    
            $response = $mysql->query($consulta);
    
            combinar($response, $comida["id"]);
        }
        if($tipo == "CENA"){
    
            $consulta = "SELECT * FROM comidas WHERE (tipo = 'COMIDA' OR tipo = 'AMBOS') AND id != 0 AND user = " .$user;
    
            $response = $mysql->query($consulta);
            combinar($response, $comida["id"]);
        }
        if($tipo == "AMBOS"){
    
    
            $consulta = "SELECT * FROM comidas WHERE (tipo = 'CENA' OR tipo = 'AMBOS') AND id != 0 AND user = " .$user;
    
            $response = $mysql->query($consulta);
            combinar($response, $comida["id"]);
    
    
            $consulta = "SELECT * FROM comidas WHERE tipo = 'COMIDA' AND id != 0 AND user = " .$user;
    
            $response = $mysql->query($consulta);
            combinar($response, $comida["id"]);
        }
    }






    
function sumarValores($comida1, $comida2){
    $aux1 = new Comida($comida1);
    $aux2 = new Comida($comida2);


    $return = [($aux1->get(6)+$aux2->get(6)), ($aux1->get(12)+$aux2->get(12)), ($aux1->get(7)+$aux2->get(7))];

    return $return;
}


function combinar($response, $comida){
    foreach($response as $comida2){

        $valores = sumarValores($comida, $comida2["id"]);

        $consulta2 = "INSERT INTO `combinacionescomidas` (`comida1`, `comida2`, `kcal`, `proteina`, `grasa`, `user`) VALUES (" .$comida .", " .$comida2["id"] .", " .number_format($valores[0], 1, ".", "") .", " .number_format($valores[1], 1, ".", "") .", " .number_format($valores[2], 1, ".", "") .", " .$GLOBALS["user"] .")";

        $GLOBALS["mysql"]->query($consulta2);
    }
}

?>