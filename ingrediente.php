<?php
    class Ingrediente{
        private $id;
        private $name;
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
        private $unidad;

        function __construct(int $id){
            include("conect.php");
            $ingrediente = $mysql->query("SELECT * FROM ingredientes WHERE id = {$id}");
            foreach( $ingrediente as $r1 ){

            }
            $this->id = $id;
            $this->name = $r1['name'];
            $this->kcal = $r1['kcal']/100;
            $this->grasa = $r1['grasa']/100;
            $this->saturadas = $r1['saturadas']/100;
            $this->hc = $r1['hc']/100;
            $this->azucar = $r1['azucar']/100;
            $this->fibra = $r1['fibra']/100;
            $this->proteina = $r1['proteina']/100;
            $this->sal = $r1['sal']/100;
            $this->calcio = $r1['calcio']/100;
            $this->fosforo = $r1['fosforo']/100;
            $this->hierro = $r1['hierro']/100;
            $this->unidad = $r1['unidad'];
        }

        public function getValores(int $cant):array{
            $valores = [$kcal*$cant, $grasa*$cant,  $saturadas*$cant,  $hc*$cant,  $azucar*$cant,  $fibra*$cant,  $proteina*$cant,  $sal*$cant,  $calcio*$cant,  $fosforo*$cant,  $hierro*$cant];

            return $valores;
        }        
        public function getCant(int $cant){
            $info = $this->name .": " .$cant ." " .$this->unidad;
            return $info;
        }
    }
?>