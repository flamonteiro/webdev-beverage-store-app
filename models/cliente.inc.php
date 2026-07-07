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
               if(trim($nome) === ''){
                   throw new InvalidArgumentException('Nome nao pode ser vazio.');
               }
               if(trim($cnpj) === ''){
                   throw new InvalidArgumentException('CNPJ nao pode ser vazio.');
               }
               $cnpjDigitos = preg_replace('/\D/', '', $cnpj);
               if(strlen($cnpjDigitos) !== 14){
                   throw new InvalidArgumentException('CNPJ deve conter 14 digitos, com ou sem pontuacao (ex: 00.000.000/0000-00).');
               }
               $cnpj = substr($cnpjDigitos, 0, 2) . '.' . substr($cnpjDigitos, 2, 3) . '.' . substr($cnpjDigitos, 5, 3) . '/' . substr($cnpjDigitos, 8, 4) . '-' . substr($cnpjDigitos, 12, 2);
               if(trim($endereco) === ''){
                   throw new InvalidArgumentException('Endereco nao pode ser vazio.');
               }
               if(!is_numeric($id_cidade) || $id_cidade <= 0){
                   throw new InvalidArgumentException('Cidade invalida.');
               }
               if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                   throw new InvalidArgumentException('Email invalido.');
               }
               if(strlen($senha) < 6){
                   throw new InvalidArgumentException('Senha deve ter pelo menos 6 caracteres.');
               }

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