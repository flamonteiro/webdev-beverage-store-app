<?php
   class Pedido {
       private $id_compra;
       private $id_cliente;
       private $valor_total;
       private $valortotal_frete;
       private $data_compra;

      function __construct($id_cliente, $valor_total, $valortotal_frete){
              if(!is_numeric($id_cliente) || $id_cliente <= 0){
                  throw new InvalidArgumentException('Cliente invalido.');
              }
              if(!is_numeric($valor_total) || $valor_total <= 0){
                  throw new InvalidArgumentException('Valor total deve ser maior que zero.');
              }
              if(!is_numeric($valortotal_frete) || $valortotal_frete < 0){
                  throw new InvalidArgumentException('Valor do frete nao pode ser negativo.');
              }

              $this->id_cliente = $id_cliente;
              $this->valor_total = $valor_total;
              $this->valortotal_frete = $valortotal_frete;
              $this->data_compra = time();
      }

      public function getIdCompra(){
             return $this->id_compra;
      }

      public function setIdCompra($id_compra){
              $this->id_compra = $id_compra;
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
