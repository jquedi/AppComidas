<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comidas</title>
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
    
        <div class="btn1" onclick="añadirComidaF(true)">Añadir</div>

        <!-- Lista de las comidas -->
        <div class="subContainer">
            <input style="margin-top: 50px;" type="text" id="searchComida" onkeyup="cargarLista(value)" placeholder="Buscar Comida">
            <div style="margin-top: 60px" id="contComidaLista">
            </div>

        </div>
        <div id="InfoC" class="contInfoComida">
            <div class="infoComida" id="comidaInfo">
                <!-- informacion de la comida -->
            </div>
            <div onclick="toggleComida(false, -1)" class="exitComida">
            </div>
        </div>

        <!-- Formulario para añadir una nueva comida a la base de datos -->
        <div id="addC" class="contInfoComida">
            <div class="infoComida" id="comidaAdd">
                <div class="formAdd">
                    <div>
                        <label for="nombre">Nombre:</label>
                        <input name="nombre" type="text" id="nombre">
                    </div>

                    <div>
                        <label for="tipo">Tipo:</label>
                        <select name="tipo" id="tipo">
                            <option value="COMIDA">COMIDA</option>
                            <option value="CENA">CENA</option>
                            <option value="AMBOS">AMBOS</option>
                        </select>
                    </div>

                    <div>
                        <label for="prio">Prioridad:</label>
                        <select name="prio" id="prio">
                            <option value=1>1</option>
                            <option value=2>2</option>
                            <option value=3>3</option>
                            <option value=4>4</option>
                            <option value=5>5</option>
                            <option value=6>6</option>
                            <option value=7>7</option>
                            <option value=8>8</option>
                            <option value=9>9</option>
                            <option value=10>10</option>
                        </select>
                    </div>

                    <div>
                        <label for="racion">Raciones:</label>
                        <input name="racion" type="number" id="racion">
                    </div>
                </div>

                <div class="addCIngredientes">
                    <h3>INGREDIENTES</h3>
                    <div id="contIngre"></div>
                    <button onclick="añadirIngreF(true)">+</button>
                </div>
                <div class="addCOpcion">
                    <div class="cancelBtn" onclick="añadirComidaF(false)">Cancelar</div>
                    <div class="confirmBtn" onclick="crearComida()">Confirmar</div>
                </div>
                
            </div>
            <div class="exitComida">
            </div>
        </div>

        <!-- Lista de los ingredientes para asignarlos a la comida -->
        <div class="selectI" id ="contSelecIIngrediente1">
            <input onchange="listaIngredientes()" id="search" name="search" type="text" placeholder="Buscar ingrediente">
            <div id="contSelecIIngrediente">
            </div>
            <div onclick="newIngreF(true)" id="añadirIngre">Añadir nuevo</div>
            <div onclick="añadirIngreF(false)" id="selectIConf" class="confirmBtn">Confirmar</div>
        </div>
        
        <!-- Formulario para añadir un nuevo ingrediente a la base de datos -->
        <div id="newIngre" class="contInfoComida">
            <div class="infoComida" id="newIngre2">
                
                <div class="formAdd">
                    <label for="nombreIngre">Nombre:</label>
                    <input name="nombreIngre" type="text" id="nombreIngre">
                </div>

                <div class="titulo2">Valores por 100 gramos</div>
                <div class="grid">
                    <div class="cel label">Kcal: </div>
                    <div class="cel"><input class="inputIngre" type="number" id="1" value="0"></div>
                    <div class="cel label">Grasas: </div>
                    <div class="cel"><input class="inputIngre" type="number" id="2" value="0"></div>
                    <div class="cel label">Proteina: </div>
                    <div class="cel"><input class="inputIngre" type="number" id="3" value="0"></div>
                    <div class="cel label">Grasas Saturadas: </div>
                    <div class="cel"><input class="inputIngre" type="number" id="4" value="0"></div>
                    <div class="cel label">Hidratos de carbono: </div>
                    <div class="cel"><input class="inputIngre" type="number" id="5" value="0"></div>
                    <div class="cel label">Fibra: </div>
                    <div class="cel"><input class="inputIngre" type="number" id="6" value="0"></div>
                    <div class="cel label">Azucares: </div>
                    <div class="cel"><input class="inputIngre" type="number" id="7" value="0"></div>
                    <div class="cel label">Sal: </div>
                    <div class="cel"><input class="inputIngre" type="number" id="8" value="0"></div>
                    <div class="cel label">Calcio: </div>
                    <div class="cel"><input class="inputIngre" type="number" id="9" value="0"></div>
                    <div class="cel label">Fosforo: </div>
                    <div class="cel"><input class="inputIngre" type="number" id="10" value="0"></div>
                    <div class="cel label">Hierro: </div>
                    <div class="cel"><input class="inputIngre" type="number" id="11" value="0"></div>
                </div>
                
                <div class="formAdd">
                    <label for="unidades">Unidades:</label>
                    <select name="unidades" id="unidades">
                        <option value="g">Gramos</option>
                        <option value="ml">Mililitros</option>
                    </select>
                </div>
                <div id="addNewIngre" class="addCOpcion">
                    <div class="cancelBtn" onclick="newIngreF(false)">Cancelar</div>
                    <div class="confirmBtn" onclick="guardarIngredienteF()">Confirmar</div>
                </div>
            </div>
            <div class="exitComida">
            </div>
        </div>

    </div>
</body>

<script>
    var usuario = 1;
    var addIngredientes = [];
    var addIngredientesDef = [];
    cambiarMenu();
    cargarLista("");



    // Abre y cierra el menu

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

    // Mantiene el menu en un Z-index adecuado para no molestar a las vantanas emergentes

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

    // Redireccionamientos al interactuar con el menu

    function redirectF(val){
        if(val == 1){
            window.location.replace("calendario.php");
        }
        if(val == 2){
            location.reload();
        }
        if(val == 3){
            window.location.replace("compra.php");
        }
    }

    // Abre la info de la comida seleccionada

    function toggleComida(comidaInfo, id){
        var item = document.getElementById("InfoC");
        if(id > -1){
            let formData = new FormData();

            formData.append("id", id);

            fetch("prueba.php", {
            method: "POST",
            body: formData,
            }).then((response) => response.json())
            .then((result) => {
                document.getElementById("comidaInfo").innerHTML = result;
            });
        }

        if(!comidaInfo){
            item.style.display = "none";
            zMenu(2);
        }else{
            item.style.display = "block";
            zMenu(1);
        }
    }

    // Abre el formulario para añadir una nueva comida

    function añadirComidaF(estado){
        var item = document.getElementById("addC");

        document.getElementById("nombre").value = "";
        document.getElementById("tipo").value = "COMIDA";
        document.getElementById("prio").value = 1;
        document.getElementById("racion").value = 0;
        
        addIngredientes = [];
        addIngredientesDef = [];
        ingreSelecctedDisplay();

        if(!estado){
            item.style.display = "none";
            zMenu(2);
        }else{
            item.style.display = "block";
            zMenu(1);
        }
    }

    // Carga la lista de ingredientes

    function listaIngredientes(){
        let formData = new FormData();

        var filtro = document.getElementById("search").value;

        formData.append("filtro", filtro);
        formData.append("checked", addIngredientes);

        fetch("checkIngredientes.php", {
        method: "POST",
        body: formData,
        }).then((response) => response.json())
        .then((result) => {
            document.getElementById("contSelecIIngrediente").innerHTML = result;
        });
    }

    // Carga la lista de ingredientes asignados a la comida

    function ingreSelecctedDisplay(){
        let formData = new FormData();

        formData.append("checked", addIngredientes);
        formData.append("valores", addIngredientesDef);

        fetch("displayIngre.php", {
        method: "POST",
        body: formData,
        }).then((response) => response.json())
        .then((result) => {
            document.getElementById("contIngre").innerHTML = result;
        });
    }

    // Abre la lista de ingredientes

    function añadirIngreF(val){
        var item = document.getElementById("contSelecIIngrediente1");

        if(!val){
            item.style.display = "none";
            ingreSelecctedDisplay();
        }else{
            item.style.display = "flex";
            document.getElementById("search").value = "";
            listaIngredientes();
        }
    }

    // Añade un ingrediente a la lista de ingredientes ligados a la nueva comida

    function addIng(val, opcion){
        if(opcion == 1){
            addIngredientes.push(val);
            addIngredientesDef.push(0);
        }else{
            var index = addIngredientes.indexOf(val);
            addIngredientes.splice(index, 1);
            addIngredientesDef.splice(index, 1);

        }
        listaIngredientes();
    }

    // Sincroniza el array de identificadores de ingrediente con el de sus cantidades
    function arrayIngreF(id, val){
        var index = addIngredientes.indexOf(id);
        addIngredientesDef[index] = val;
    }

    // Añade una nueva comida en la base de datos
    function crearComida(){
        var nombre = document.getElementById("nombre").value;
        var tipo = document.getElementById("tipo").value;
        var prio = document.getElementById("prio").value;
        var racion = document.getElementById("racion").value;


        let formData = new FormData();

        formData.append("checked", addIngredientes);
        formData.append("valores", addIngredientesDef);
        formData.append("nombre", nombre);
        formData.append("tipo", tipo);
        formData.append("prio", prio);
        formData.append("racion", racion);

        fetch("guardarComida.php", {
        method: "POST",
        body: formData,
        }).then((response) => response.json())
        .then((result) => {
            if(result){
                document.getElementById("addC").style.display = "none";
                location.reload();
            }
        });
    }

    // Abre el formulario para crear un nuevo ingrediente
    function newIngreF(val){
        var item = document.getElementById("newIngre");

        if(!val){
            item.style.display = "none";
        }else{
            item.style.display = "block";
            document.getElementById("nombreIngre").value = "";
            document.getElementById("unidades").value = "g";
            document.getElementById("1").value = 0;
            document.getElementById("2").value = 0;
            document.getElementById("3").value = 0;
            document.getElementById("4").value = 0;
            document.getElementById("5").value = 0;
            document.getElementById("6").value = 0;
            document.getElementById("7").value = 0;
            document.getElementById("8").value = 0;
            document.getElementById("9").value = 0;
            document.getElementById("10").value = 0;
            document.getElementById("11").value = 0;
        }
    }


    // guarda un ingrediente en la base de datos
    function guardarIngredienteF(){
        var nombre = document.getElementById("nombreIngre").value;
        var unidades = document.getElementById("unidades").value;
        var prop1 = document.getElementById("1").value;
        var prop2 = document.getElementById("2").value;
        var prop3 = document.getElementById("3").value;
        var prop4 = document.getElementById("4").value;
        var prop5 = document.getElementById("5").value;
        var prop6 = document.getElementById("6").value;
        var prop7 = document.getElementById("7").value;
        var prop8 = document.getElementById("8").value;
        var prop9 = document.getElementById("9").value;
        var prop10 = document.getElementById("10").value;
        var prop11 = document.getElementById("11").value;


        let formData = new FormData();

        formData.append("nombre", nombre);
        formData.append("unidades", unidades);
        formData.append("prop1", prop1);
        formData.append("prop2", prop2);
        formData.append("prop3", prop3);
        formData.append("prop4", prop4);
        formData.append("prop5", prop5);
        formData.append("prop6", prop6);
        formData.append("prop7", prop7);
        formData.append("prop8", prop8);
        formData.append("prop9", prop9);
        formData.append("prop10", prop10);
        formData.append("prop11", prop11);

        fetch("guardarIngrediente.php", {
        method: "POST",
        body: formData,
        }).then((response) => response.json())
        .then((result) => {
            if(result){
                document.getElementById("newIngre").style.display = "none";
                listaIngredientes();
            }
        });
    }

    // Carga la lista de comidas aplicando el filtro del buscador
    function cargarLista(filtro){
        var item = document.getElementById("contComidaLista");

        let formData = new FormData();
        
        formData.append("user", usuario);
        formData.append("filtro", filtro);

        fetch("listaComidasInicio.php", {
        method: "POST",
        body: formData,
        }).then((response) => response.json())
        .then((result) => {
            item.innerHTML = result;
        });
    }
</script>
</html>