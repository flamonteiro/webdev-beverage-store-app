<?php
   class Bebida{
      public $id_bebida;
      public $nome;
      public $volume;
      public $preco;
      public $peso;
      public $qde_estoque;
      public $fabricante;

      function __construct(){

      }

      function setBebida($nome, $volume, $preco, $peso, $qde_estoque, $fabricante)
      {
               $this->nome = $nome;
               $this->volume = $volume;
               $this->preco = $preco;
               $this->peso = $peso;
               $this->qde_estoque = $qde_estoque;
               $this->fabricante = $fabricante;
      }

      public function getId_bebida()
      {
             return $this->id_bebida;
      }

      public function getNome()
      {
             return $this->nome;
      }

      public function setNome($pNome)
      {
             return $this->nome = $pNome;
      }

      public function getVolume()
      {
             return $this->volume;
      }

      public function setVolume($pVolume)
      {
             return $this->volume = $pVolume;
      }

      public function getPreco()
      {
             return $this->preco;
      }

      public function setPreco($pPreco)
      {
             return $this->preco = $pPreco;
      }

      public function getPeso()
      {
             return $this->peso;
      }

      public function setPeso($pPeso)
      {
             return $this->peso = $pPeso;
      }

      public function getQde_estoque()
      {
             return $this->qde_estoque;
      }

      public function setQde_estoque($pQdeEstoque)
      {
             return $this->qde_estoque = $pQdeEstoque;
      }

      public function getFabricante()
      {
             return $this->fabricante;
      }

      public function setFabricante($pFabricante)
      {
             return $this->fabricante = $pFabricante;
      }
}

?>