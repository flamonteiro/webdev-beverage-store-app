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
               if(trim($cidade) === ''){
                   throw new InvalidArgumentException('Nome da cidade nao pode ser vazio.');
               }
               $ufsValidas = ['AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO'];
               if(!in_array(strtoupper($estado), $ufsValidas)){
                   throw new InvalidArgumentException('Estado deve ser uma UF valida (ex: SP, RJ, ES).');
               }
               if(trim($CEP) === ''){
                   throw new InvalidArgumentException('CEP nao pode ser vazio.');
               }
               if(!preg_match('/^\d{5}-?\d{3}$/', $CEP)){
                   throw new InvalidArgumentException('CEP deve estar no formato 00000-000 ou 00000000.');
               }
               if(!is_numeric($valorfrete_porPeso) || $valorfrete_porPeso < 0){
                   throw new InvalidArgumentException('Valor do frete por peso nao pode ser negativo.');
               }
               if(!is_numeric($peso) || $peso < 0){
                   throw new InvalidArgumentException('Peso nao pode ser negativo.');
               }

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