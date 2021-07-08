<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
    <link rel="stylesheet" href="../sass/style.css">
    <?php
        require("ingrediente.php");
        require("comida.php");
        include("conect.php");
    ?>
</head>
<body>
<!-- Menú -->
    <!-- Menú botón -->
        <div id="menu1" class="bMenu" onclick="toggleM()">
            <div class="hambur"></div>
            <div class="hambur"></div>
            <div class="hambur"></div>
        </div>

    <!-- Menu expandido -->
        <div id="menu2" class="menuAmpliado">
            <div class="bMenu" onclick="toggleM()">
                <div class="hambur2"></div>
                <div class="hambur2"></div>
                <div class="hambur2"></div>
            </div>
            <div class="containerBtnOpcionMenu">
                <div class="btnOpcionMenu" onclick="redirectF(1)">Cal</div>
                <div class="btnOpcionMenu" onclick="redirectF(2)">Lista</div>
                <div class="btnOpcionMenu" onclick="redirectF(3)">compra</div>
            </div>
        </div>

    <!-- Contenido -->

    <div class="container">

        <!-- Lista y buscador de comidas para asignarlos a un dia -->
        <div class="contInfoComida" id="listaComidas" data-pos="">
            <div class="infoComida">
                <input type="text" id="searchComida" onkeyup="listaComidasF(true, value, -1)" placeholder="Buscar Comida">
                <div style="padding-top: 50px;" id="listaComidasSub"></div>
                
            </div>
            <div onclick="listaComidasF(false, '', '')" class="exitComida">
            </div>
        </div>



        <div id="InfoC" class="contInfoComida">
            <div class="infoComida" id="comidaInfo">
                <!-- informacion de la comida -->
            </div>
            <div onclick="toggleComida(false, -1)" class="exitComida">
            </div>
        </div>
            <table class="tablaValores" id="tabla">

            </table>
        <div id="subcontainer">

        <!-- calendario de comidas -->
        </div>
    </div>
</body>

<script>

var edad = 24;
var peso = 92;
var altura = 177;
var musculo = 61;
var actividad = 1.375;

var usuario = 1;
var kcalR = [2200, 1800];
var proR = [1000, 150];
var grasaR = [30, 0];

function calcularValoresRecomendados(){

    var kcal = (66 + (13.7*peso) + (5*altura) - (6.75*edad))*actividad;
    kcalR = [kcal-1000, kcal-1500];

    proR = [musculo*2.5, musculo*1.5];

    grasaR = [kcal*0.038, kcal*0.022];

}




    calcularValoresRecomendados();
    cambiarMenu();
    loadCalendario();
    loadTabla();

// Funciones para manejar el menu
    function cambiarMenu(){
        var estado = localStorage.getItem("menuEstado");
        var item = document.getElementById("menu1");
        var item2 = document.getElementById("menu2");
        if(estado == 1){
            item.style.display = "flex";
            item2.style.display = "none";
        }else{
            item2.style.display = "flex";
            item.style.display = "none";
        }
    }

    function toggleM(){
        var estado = localStorage.getItem("menuEstado");
        if(estado == 1){
            localStorage.setItem("menuEstado", 2);
        }else{
            localStorage.setItem("menuEstado", 1);
        }
        cambiarMenu();
    }

    function zMenu(estado){
        var menu = document.getElementById("menu1");
        var menu2 = document.getElementById("menu2");
        if(estado == 1){
            menu.style.zIndex = 1;
            menu2.style.zIndex = 1;
        }else{
            menu.style.zIndex = 2;
            menu2.style.zIndex = 2;
        }
    }

function redirectF(val){
    if(val == 1){
        location.reload();
    }
    if(val == 2){
        window.location.replace("index.php");
    }
    if(val == 3){
        window.location.replace("compra.php");
    }
}


// Carga el calendario

function loadCalendario(){
    let formData = new FormData();

    formData.append("user", usuario);
    formData.append("kcalR", kcalR);
    formData.append("proR", proR);
    formData.append("grasaR", grasaR);

    fetch("calendariosub.php", {
    method: "POST",
    body: formData,
    }).then((response) => response.json())
    .then((result) => {
        document.getElementById("subcontainer").innerHTML = result;
    });
}

// Carga la tabla de valores recomendados

function loadTabla(){
    let formData = new FormData();

    formData.append("kcalR", kcalR);
    formData.append("proR", proR);
    formData.append("grasaR", grasaR);

    fetch("tablaValores.php", {
    method: "POST",
    body: formData,
    }).then((response) => response.json())
    .then((result) => {
        document.getElementById("tabla").innerHTML = result;
    });
}


// Carga la informacion de la comida seleccionada
function toggleComida(comidaInfo, id){
    var item = document.getElementById("InfoC");
    if(id > 0){
        let formData = new FormData();

        formData.append("id", id);

        fetch("prueba.php", {
        method: "POST",
        body: formData,
        }).then((response) => response.json())
        .then((result) => {
            document.getElementById("comidaInfo").innerHTML = result;
        });
        if(!comidaInfo){
            item.style.display = "none";
            zMenu(2);
        }else{
            item.style.display = "block";
            zMenu(1);
        }
    }
    
    if(!comidaInfo){
        item.style.display = "none";
        zMenu(2);
    }

}


// Elimina la comida del dia seleccionado

function borrarComida(pos, id){
    let formData = new FormData();

    formData.append("pos", pos);
    formData.append("user", usuario);
    formData.append("id", id);

    fetch("borrarComida.php", {
    method: "POST",
    body: formData,
    }).then(() => {
        listaComidasF(false, "", "");
        loadCalendario();
    });
}

// Abre las opciones del dia

function opciones(pos){

    if(document.getElementById(pos).style.display == "flex"){
        document.getElementById(pos).style.display = "none";
    }else{
        document.getElementById(pos).style.display = "flex";
    }
}

// Carga la lista de comidas para asignar manualmente una comida a un dia en especifico

function listaComidasF(estado, filtro, pos){
    if(estado){
        document.getElementById("listaComidas").style.display = "block";
        if(pos != -1){
            document.getElementById(pos).style.display = "none";
            document.getElementById("listaComidas").setAttribute("data-pos", pos);
        }

        zMenu(1);
        let formData = new FormData();
        
        formData.append("user", usuario);
        formData.append("filtro", filtro);
        formData.append("pos", document.getElementById("listaComidas").getAttribute("data-pos"));

        fetch("listaComidas.php", {
        method: "POST",
        body: formData,
        }).then((response) => response.json())
        .then((result) => {
            document.getElementById("listaComidasSub").innerHTML = result;
        });


    }else{
        document.getElementById("listaComidas").style.display = "none";
        document.getElementById("listaComidas").setAttribute("data-pos", pos);

        zMenu(2);
    }
}

// Ejecuta de forma asincrona (Ya que puede tardar en ejecutarse) la auto asignacion de una comida a un dia

function autoCompletar(pos, pos2, tipo){
    let formData = new FormData();

    formData.append("tipo", tipo);
    formData.append("pos", pos);
    formData.append("pos2", pos2);
    formData.append("user", usuario);
    formData.append("kcalR", kcalR);
    formData.append("proR", proR);
    formData.append("grasaR", grasaR);

    fetch("autoCompletar.php", {
    method: "POST",
    body: formData,
    }).then(() => {
        loadCalendario();
    });

    

}
</script>
</html>