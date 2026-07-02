<?php
   class Pedido {
       private $id_cliente;
       private $valor_total;
       private $valortotal_frete;
       private $data_compra;

      function __construct($id_cliente, $valor_total, $valortotal_frete){
              $this->id_cliente = $id_cliente;
              $this->valor_total = $valor_total;
              $this->valortotal_frete = $valortotal_frete;
              $this->data_compra = time();
      }

      public function getId_cliente(){
             return $this->id_cliente;
      }

      public function setId_cliente($id_cliente){
              $this->id_cliente = $id_cliente;
      }

      public function getValorTotal(){
             return $this->valor_total;
      }

      public function setValorTotal($valor_total){
              $this->valor_total = $valor_total;
      }

      public function getValortotalFrete(){
             return $this->valortotal_frete;
      }

      public function setValortotalFrete($valortotal_frete){
              $this->valortotal_frete = $valortotal_frete;
      }

      public function getDataCompra(){
              return $this->data_compra;
      }

      public function setDataCompra($data_compra){
              $this->data_compra = $data_compra;
      }
}
?>
