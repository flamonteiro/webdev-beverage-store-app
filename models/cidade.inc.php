<?php
   class Cidade{
      public $id_cidade;
      public $cidade;
      public $estado;
      public $CEP;
      public $valorfrete_porPeso;
      public $peso;

      function __construct(){

      }

      function setCidade($cidade, $estado, $CEP, $valorfrete_porPeso, $peso)
      {
               $this->cidade = $cidade;
               $this->estado = $estado;
               $this->CEP = $CEP;
               $this->valorfrete_porPeso = $valorfrete_porPeso;
               $this->peso = $peso;
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

      public function getPeso()
      {
             return $this->peso;
      }

      public function setPeso($pPeso)
      {
             return $this->peso = $pPeso;
      }
}

?>