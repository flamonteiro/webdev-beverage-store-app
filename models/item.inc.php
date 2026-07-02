<?php
require_once "bebida.inc.php";

class Item {
       private Bebida $bebida;
       private $quantidade;
       private $valorItem;

      function __construct($bebida){
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

      public function setQuantidade(){
             $this->quantidade++;
      }

       public function getBebida(){
             return $this->bebida;

      }
}
?>
