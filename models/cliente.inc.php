<?php
   class Cliente{
      public $id_cliente;
      public $nome;
      public $cnpj;
      public $endereco;
      public $id_cidade;
      public $email;
      public $senha;

      function __construct(){

      }

      function setCliente($nome, $cnpj, $endereco, $id_cidade, $email, $senha)
      {
               $this->nome = $nome;
               $this->cnpj = $cnpj;
               $this->endereco = $endereco;
               $this->id_cidade = $id_cidade;
               $this->email = $email;
               $this->senha = $senha;
      }

      public function getId_cliente()
      {
             return $this->id_cliente;
      }

      public function getNome()
      {
             return $this->nome;
      }

      public function setNome($pNome)
      {
             return $this->nome = $pNome;
      }

      public function getCnpj()
      {
             return $this->cnpj;
      }

      public function setCnpj($pCnpj)
      {
             return $this->cnpj = $pCnpj;
      }

      public function getEndereco()
      {
             return $this->endereco;
      }

      public function setEndereco($pEndereco)
      {
             return $this->endereco = $pEndereco;
      }

      public function getId_cidade()
      {
             return $this->id_cidade;
      }

      public function setId_cidade_fk($pIdCidade)
      {
             return $this->id_cidade = $pIdCidade;
      }

      public function getEmail()
      {
             return $this->email;
      }

      public function setEmail($pEmail)
      {
             return $this->email = $pEmail;
      }

      public function getSenha()
      {
             return $this->senha;
      }

      public function setSenha($pSenha)
      {
             return $this->senha = $pSenha;
      }
}

?>