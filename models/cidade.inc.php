<?php
   class Cidade{
      public $id_cidade;
      public $cidade;
      public $estado;
      public $CEP;
      public $valorfrete_porPeso;

      function __construct(){

      }

      function setCidade($cidade, $estado, $CEP, $valorfrete_porPeso)
      {
               if(trim($cidade) === ''){
                   throw new InvalidArgumentException('Nome da cidade nao pode ser vazio.');
               }
               if(!preg_match('/^[A-Za-z]{2}$/', $estado)){
                   throw new InvalidArgumentException('Estado deve ter exatamente 2 letras (UF).');
               }
               if(trim($CEP) === ''){
                   throw new InvalidArgumentException('CEP nao pode ser vazio.');
               }
               if(!is_numeric($valorfrete_porPeso) || $valorfrete_porPeso < 0){
                   throw new InvalidArgumentException('Valor do frete por peso nao pode ser negativo.');
               }

               $this->cidade = $cidade;
               $this->estado = $estado;
               $this->CEP = $CEP;
               $this->valorfrete_porPeso = $valorfrete_porPeso;
      }

      public function getId_cidade()
      {
             return $this->id_cidade;
      }

      public function getCidade()
      {
             return $this->cidade;
      }

      public function setCidade_nome($pCidade)
      {
             return $this->cidade = $pCidade;
      }

      public function getEstado()
      {
             return $this->estado;
      }

      public function setEstado($pEstado)
      {
             return $this->estado = $pEstado;
      }

      public function getCEP()
      {
             return $this->CEP;
      }

      public function setCEP($pCEP)
      {
             return $this->CEP = $pCEP;
      }

      public function getValorfrete_porPeso()
      {
             return $this->valorfrete_porPeso;
      }

      public function setValorfrete_porPeso($pValorFretePorPeso)
      {
             return $this->valorfrete_porPeso = $pValorFretePorPeso;
      }
}

?>