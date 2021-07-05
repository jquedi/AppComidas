<?php

require("ingrediente.php");
require("comida.php");

$id = $_POST["id"];

$comidaOb = new Comida($id);


// crea la lista de ingredientes
function ingedientesF($comidaOb){

    $ingredientesEcho = "";

    $ingredientes = $comidaOb->getIngredientes();
    foreach($ingredientes as $idIngre){
        $ingredienteOb = new Ingrediente($idIngre[0]);

        $ingredientesEcho = $ingredientesEcho .'<li class="ingrediente">'.$ingredienteOb->getCant($idIngre[1]) .'</li>';
    }

    return $ingredientesEcho;

};


// Selecciona la opcion adecuada en el select en funcion a la prioridad de la comida
function selected($comidaOb, $num){
    if($comidaOb->get(3) == $num){
        $aux = ' selected="selected"';
    }else{
        $aux = '';
    }
    return $aux;
}


echo json_encode('

<div class="tituloCont">
    <div class="titulo1">' .$comidaOb->get(1) .'</div>
    <div class="tipo">' .$comidaOb->get(2) .'</div>
</div>

<div class="titulo2">VALOR NUTRICIONAL/ración</div>
<div class="grid">
    <div class="cel label">Kcal: </div>
    <div class="cel">' .$comidaOb->get(6) .'</div>
    <div class="cel label">Grasas: </div>
    <div class="cel">' .$comidaOb->get(7) .'</div>
    <div class="cel label">Proteina: </div>
    <div class="cel">' .$comidaOb->get(12) .'</div>
    <div class="cel label">Grasas Saturadas: </div>
    <div class="cel">' .$comidaOb->get(8) .'</div>
    <div class="cel label">Hidratos de carbono: </div>
    <div class="cel">' .$comidaOb->get(9) .'</div>
    <div class="cel label">Fibra: </div>
    <div class="cel">' .$comidaOb->get(11) .'</div>
    <div class="cel label">Azucares: </div>
    <div class="cel">' .$comidaOb->get(10) .'</div>
    <div class="cel label">Sal: </div>
    <div class="cel">' .$comidaOb->get(13) .'</div>
    <div class="cel label">Calcio: </div>
    <div class="cel">' .$comidaOb->get(14) .'</div>
    <div class="cel label">Fosforo: </div>
    <div class="cel">' .$comidaOb->get(15) .'</div>
    <div class="cel label">Hierro: </div>
    <div class="cel">' .$comidaOb->get(16) .'</div>
</div>
<div class="ingredientesBox">
    <div class="titulo2">INGREDIENTES</div>
    <ul>' .ingedientesF($comidaOb)

        .'
    </ul>
    
</div>
<div class="info1">
    <label>Raciones: </label>
    <div>' .$comidaOb->get(18) .'</div>
</div>
<div class="info1">
    <label>Prioridad: </label>
    <select>
        <option' .selected($comidaOb, 1) .'>1</option>
        <option' .selected($comidaOb, 2) .'>2</option>
        <option' .selected($comidaOb, 3) .'>3</option>
        <option' .selected($comidaOb, 4) .'>4</option>
        <option' .selected($comidaOb, 5) .'>5</option>
        <option' .selected($comidaOb, 6) .'>6</option>
        <option' .selected($comidaOb, 7) .'>7</option>
        <option' .selected($comidaOb, 8) .'>8</option>
        <option' .selected($comidaOb, 9) .'>9</option>
        <option' .selected($comidaOb, 10) .'>10</option>
    </select>
</div>
<div class="info1">
    <label>Comido por última vez: </label>
    <div>' .$comidaOb->get(5) .'</div>
</div>
<div class="info1">
    <label>Veces comido:</label><div>' .$comidaOb->get(4) .'</div>
</div>
');
?>