   <!-- MENU PHP -->
   
   
    <?php
        function toggleM($n) {
            if($n == 1){
                echo 'class="mAbierto"';
            }else{
                echo 'class="mCerrado"';
            }
        }
    ?>
    <!-- Menú botón -->
    <form method="post" <?php         
        if(isset($_POST['toggleM1'])) {
            toggleM(2);
        }else if(isset($_POST['toggleM2'])) {
            toggleM(1);
        }else {
            toggleM(1);
        } ?>>
        <div class="bMenu">
            <div class="hambur"></div>
            <div class="hambur"></div>
            <div class="hambur"></div>
            <input type="submit" name="toggleM1" class="subm" value="" />
        </div>
    </form>

    <!-- Menu expandido -->
    <form method="post" <?php         
        if(isset($_POST['toggleM1'])) {
            toggleM(1);
        }else if(isset($_POST['toggleM2'])) {
            toggleM(2);
        }else {
            toggleM(2);
        } ?>>
        <div class="menuAmpliado">
            <div class="bMenu">
                <div class="hambur2"></div>
                <div class="hambur2"></div>
                <div class="hambur2"></div>
                <input type="submit" name="toggleM2" class="subm" value="" />
            </div>
            <div class="containerBtnOpcionMenu">
                <div class="btnOpcionMenu">Cal</div>
                <div class="btnOpcionMenu">Lista</div>
                <div class="btnOpcionMenu">compra</div>
            </div>
        </div>
    </form>





    <?php

class Comida{
    private $id;
    private $name;
    private $tipo;
    private $prio;
    private $cont;
    private $last;
    private $kcal;
    private $grasa;
    private $saturadas;
    private $hc;
    private $azucar;
    private $fibra;
    private $proteina;
    private $sal;
    private $calcio;
    private $fosforo;
    private $hierro;
    private $ingredientes;

    function __construct(int $id, string $name, string $tipo, int $prio, int $cont, string $last, int $ingrediente){
        
        include("conect.php");
        $this->name = $name;
        $this->id = $id;
        $this->tipo = $tipo;
        $this->prio = $prio;
        $this->cont = $cont;
        $this->last = $last;
        $this->ingrediente = $ingrediente;



            $in = $mysql->query("SELECT * FROM ingredientes WHERE id = {$ingrediente}");


            foreach( $in as $r ){
                $this->kcal = $r['kcal'];
                $this->grasa = $r['grasa'];
                $this->saturadas = $r['saturadas'];
                $this->hc = $r['hc'];
                $this->azucar = $r['azucar'];
                $this->fibra = $r['fibra'];
                $this->proteina = $r['proteina'];
                $this->sal = $r['sal'];
                $this->calcio = $r['calcio'];
                $this->fosforo = $r['fosforo'];
                $this->hierro = $r['hierro'];
            }


        



    }

    public function getName(){

        return $this->kcal;
    }
}
?>