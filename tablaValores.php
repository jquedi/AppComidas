<?php

require("dia.php");
include("conect.php");

$kcalR = explode(",", $_POST['kcalR']);
$proR = explode(",", $_POST['proR']);
$grasaR = explode(",", $_POST['grasaR']);


$resultado = '<tr class="tablaValoresT">
                <td class="">Kcal</td>
                <td class="">Proteinas</td>
                <td class="">Grasas</td>
            </tr>
            <tr class="tablaValoresV">
                <td class="">Max: ' .intval($kcalR[0]) .'</td>
                <td class="">Max: ' .intval($proR[0]) .'</td>
                <td class="">Max: ' .intval($grasaR[0]) .'</td>
            </tr>
            <tr class="tablaValoresV">
                <td class="">Min: ' .intval($kcalR[1]) .'</td>
                <td class="">Min: ' .intval($proR[1]) .'</td>
                <td class="">Min: ' .intval($grasaR[1]) .'</td>
            </tr>';


echo json_encode($resultado);




?>