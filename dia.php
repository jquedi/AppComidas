<?php
    class Dia{
        private $comida;
        private $cena;
        private $kcal;
        private $pro;
        private $grasa;

        function __construct(int $comida, int $cena){
            include("conect.php");
            $racionesComida = 1;
            $racionesCena = 1;
            $consulta = $mysql->query("SELECT * FROM comidas WHERE id = {$comida}");
            foreach( $consulta as $r1 ){
                $this->comida = [$comida, $r1['name']];
                $racionesComida = $r1['raciones'];
            }
            $consulta = $mysql->query("SELECT * FROM comidas WHERE id = {$cena}");
            foreach( $consulta as $r1 ){
                $this->cena = [$cena, $r1['name']];
                $racionesCena = $r1['raciones'];
            }

            $kcal = 0;
            $pro = 0;
            $grasa = 0;
            $kcal2 = 0;
            $pro2 = 0;
            $grasa2 = 0;

            $consulta = $mysql->query("SELECT * FROM comidaingredientes WHERE comida = " .$this->comida[0]);
            foreach( $consulta as $r1 ){
                $consulta2 = $mysql->query("SELECT * FROM ingredientes WHERE id = " .$r1['ingrediente']);
                foreach( $consulta2 as $r2 ){
                    $kcal += ($r2['kcal']/100)*$r1['cant'];
                    $pro += ($r2['proteina']/100)*$r1['cant'];
                    $grasa += ($r2['grasa']/100)*$r1['cant'];
                }
            }
            $kcal = $kcal/$racionesComida;
            $pro = $pro/$racionesComida;
            $grasa = $grasa/$racionesComida;


            $consulta = $mysql->query("SELECT * FROM comidaingredientes WHERE comida = " .$this->cena[0]);
            foreach( $consulta as $r1 ){
                $consulta2 = $mysql->query("SELECT * FROM ingredientes WHERE id = " .$r1['ingrediente']);
                foreach( $consulta2 as $r2 ){
                    $kcal2 += ($r2['kcal']/100)*$r1['cant'];
                    $pro2 += ($r2['proteina']/100)*$r1['cant'];
                    $grasa2 += ($r2['grasa']/100)*$r1['cant'];
                }
            }

            $kcal2 = $kcal2/$racionesCena;
            $pro2 = $pro2/$racionesCena;
            $grasa2 = $grasa2/$racionesCena;



            $this->kcal = $kcal + $kcal2;
            $this->pro = $pro + $pro2;
            $this->grasa = $grasa + $grasa2;

        }

        public function getComida():array{
            $valor = $this->comida;

            return $valor;
        } 
        public function getCena():array{
            $valor = $this->cena;

            return $valor;
        }        
        public function getKcal():float{
            $valor = $this->kcal;

            return $valor;
        } 
        public function getProteina():float{
            $valor = $this->pro;

            return $valor;
        } 
        public function getGrasa():float{
            $valor = $this->grasa;

            return $valor;
        } 
    }
?>