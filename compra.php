<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista</title>
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
        

        <div class="subContainer">

        <!-- Crea la lista de los distintos ingredientes necesarios para la semana y combina la cantidad de aquellos que se repitan -->
            <?php
                $ingredienesFinal= [];
                $ingredienesFinalCant= [];
                $ingredienesFinalNombre= [];
                $ingredienesFinalUnidad= [];
                $comidasSemana = $mysql->query("SELECT lunes1, lunes2, martes1, martes2 miercoles1, miercoles2, jueves1, jueves2, viernes1, viernes2, sabado1, sabado2, domingo1, domingo2 FROM calendario ");

                foreach($comidasSemana as $r){
                    foreach($r as $r1){
                        
                        $ingredientes = $mysql->query("SELECT * FROM comidaingredientes WHERE comida = " .$r1);
                        foreach($ingredientes as $r2){
                            if(!in_array($r2['ingrediente'], $ingredienesFinal)){
                                array_push($ingredienesFinal, $r2['ingrediente']);
                                array_push($ingredienesFinalCant, $r2['cant']);
                                $ingredientesN = $mysql->query("SELECT * FROM ingredientes WHERE id = " .$r2['ingrediente']);
                                foreach($ingredientesN as $r3){
                                    array_push($ingredienesFinalNombre, $r3['name']);
                                    array_push($ingredienesFinalUnidad, $r3['unidad']);
                                }
                            }else{
                                $index = array_search($r2['ingrediente'], $ingredienesFinal);
                                $ingredienesFinalCant[$index] += $r2['cant'];
                            }
                        }

                    }
                }
                echo "<ul>";
                foreach($ingredienesFinal as $key=>$value){

                    echo '<li class="ingrediente2"> <div class="ingrediente2NombreCont"><div class="ingrediente2Nombre">'.$ingredienesFinalNombre[$key] ."</div><div>" .$ingredienesFinalCant[$key] .$ingredienesFinalUnidad[$key] .'</div></div></li>';

                }
                echo "</ul>";
            ?>
        </div>
    </div>
</body>

<script>
// Funciones de control del menu
    cambiarMenu();

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
        window.location.replace("calendario.php");
    }
    if(val == 2){
        window.location.replace("index.php");
    }
    if(val == 3){
        location.reload();
    }
}

</script>
</html>