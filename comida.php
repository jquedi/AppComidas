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
        private $raciones;

        function __construct(int $id){
            
            include("conect.php");

            $comida = $mysql->query("SELECT * FROM comidas WHERE id = {$id}");
            foreach( $comida as $r1 ){

            }
            $this->name = $r1['name'];
            $this->tipo = $r1['tipo'];
            $this->prio = $r1['prio'];
            $this->cont = $r1['cont'];
            $this->last = $r1['last'];
            $this->raciones = $r1['raciones'];


            $ingredientes = $mysql->query("SELECT * FROM comidaingredientes WHERE comida = {$id}");


            while($registro = mysqli_fetch_array($ingredientes, MYSQLI_NUM)){
                $aux = [];

                $aux = [$registro[2], $registro[3]];

                $resultado[] = $aux;
            }
            $this->ingredientes = json_encode($resultado);

            foreach(json_decode($this->ingredientes) as $identificador){


                $ingrediente = $mysql->query("SELECT * FROM ingredientes WHERE id = {$identificador[0]}");


                foreach( $ingrediente as $r ){
                    $this->kcal += (($r['kcal']/100)*$identificador[1])/$this->raciones;
                    $this->grasa += (($r['grasa']/100)*$identificador[1])/$this->raciones;
                    $this->saturadas += (($r['saturadas']/100)*$identificador[1])/$this->raciones;
                    $this->hc += (($r['hc']/100)*$identificador[1])/$this->raciones;
                    $this->azucar += (($r['azucar']/100)*$identificador[1])/$this->raciones;
                    $this->fibra += (($r['fibra']/100)*$identificador[1])/$this->raciones;
                    $this->proteina += (($r['proteina']/100)*$identificador[1])/$this->raciones;
                    $this->sal += (($r['sal']/100)*$identificador[1])/$this->raciones;
                    $this->calcio += (($r['calcio']/100)*$identificador[1])/$this->raciones;
                    $this->fosforo += (($r['fosforo']/100)*$identificador[1])/$this->raciones;
                    $this->hierro += (($r['hierro']/100)*$identificador[1])/$this->raciones;
                }
            }
        }

        public function getIngredientes(){
            return json_decode($this->ingredientes);
        }

        public function get($entrada){

            switch($entrada){
                case 0:
                    $aux = $this->id;
                    break;
                case 1:
                    $aux = $this->name;
                    break;
                case 2:
                    $aux = $this->tipo;
                    break;
                case 3:
                    $aux = $this->prio;
                    break;
                case 4:
                    $aux = $this->cont;
                    break;
                case 5:
                    $aux = $this->last;
                    break;
                case 6:
                    $aux = $this->kcal;
                    break;
                case 7:
                    $aux = $this->grasa;
                    break;
                case 8:
                    $aux = $this->saturadas;
                    break;
                case 9:
                    $aux = $this->hc;
                    break;
                case 10:
                    $aux = $this->azucar;
                    break;
                case 11:
                    $aux = $this->fibra;
                    break;
                case 12:
                    $aux = $this->proteina;
                    break;
                case 13:
                    $aux = $this->sal;
                    break;
                case 14:
                    $aux = $this->calcio;
                    break;
                case 15:
                    $aux = $this->fosforo;
                    break;
                case 16:
                    $aux = $this->hierro;
                    break;
                case 17:
                    $aux = $this->ingredientes;
                    break;
                case 18:
                    $aux = $this->raciones;
                    break;
            }


            return $aux;
        }
    }
?>