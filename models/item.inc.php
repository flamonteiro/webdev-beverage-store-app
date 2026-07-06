<?php
require_once "bebida.inc.php";

class Item {
       private Bebida $bebida;
       private $quantidade;
       private $valorItem;

      function __construct($bebida){
       if(!($bebida instanceof Bebida)){
           throw new InvalidArgumentException('Item precisa de uma Bebida valida.');
       }

       $this->bebida = $bebida;
       $this->quantidade = 1;
       $this->valorItem = $this->bebida->getPreco();

      }

      public function getValorItem(){
             return $this->valorItem;
      }

      public function setValorItem(){
              $this->valorItem = $this->quantidade * $this->bebida->getPreco();
      }

      public function getQuantidade(){
             return $this->quantidade;
      }

       public function setQuantidade($q = null){
              if ($q !== null) {
                     $this->quantidade = $q;
              } else {
                     $this->quantidade++;
              }
       }

       public function getBebida(){
             return $this->bebida;

      }
}
?>
