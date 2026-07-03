<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/cliente.inc.php';

class ClienteDao{
    private $con;

    function __construct(){
        $conexao = new Conexao();
        $this->con = $conexao->getConexao();
    }

    public function cadastrar(Cliente $cliente){
        $sql = $this->con->prepare("insert into clientes (nome, cnpj, endereco, id_cidade, email, senha) values (:nome, :cnpj, :endereco, :id_cidade, :email, :senha)");

        $sql->bindValue(':nome', $cliente->getNome());
        $sql->bindValue(':cnpj', $cliente->getCnpj());
        $sql->bindValue(':endereco', $cliente->getEndereco());
        $sql->bindValue(':id_cidade', $cliente->getId_cidade());
        $sql->bindValue(':email', strtolower($cliente->getEmail()));
        $sql->bindValue(':senha', strtolower($cliente->getSenha()));

        return $sql->execute();
    }

    public function alterar($id_cliente, Cliente $cliente){
        $sql = $this->con->prepare("update clientes set nome = :nome, cnpj = :cnpj, endereco = :endereco, id_cidade = :id_cidade, email = :email, senha = :senha where id_cliente = :id");

        $sql->bindValue(':nome', $cliente->getNome());
        $sql->bindValue(':cnpj', $cliente->getCnpj());
        $sql->bindValue(':endereco', $cliente->getEndereco());
        $sql->bindValue(':id_cidade', $cliente->getId_cidade());
        $sql->bindValue(':email', strtolower($cliente->getEmail()));
        $sql->bindValue(':senha', strtolower($cliente->getSenha()));
        $sql->bindValue(':id', $id_cliente);

        return $sql->execute();
    }

    public function excluir($id_cliente){
        $sql = $this->con->prepare("delete from clientes where id_cliente = :id");
        $sql->bindValue(':id', $id_cliente);

        return $sql->execute();
    }

    public function listar(){
        $sql = $this->con->query("select * from clientes order by nome");
        $clientes = array();

        while($row = $sql->fetch(PDO::FETCH_OBJ)){
            $clientes[] = $this->hidratar($row);
        }

        return $clientes;
    }

    public function buscarPorId($id_cliente){
        $sql = $this->con->prepare("select * from clientes where id_cliente = :id");
        $sql->bindValue(':id', $id_cliente);
        $sql->execute();

        $row = $sql->fetch(PDO::FETCH_OBJ);

        return $row === false ? null : $this->hidratar($row);
    }

    private function hidratar($row){
        $cliente = new Cliente();
        $cliente->setCliente($row->nome, $row->cnpj, $row->endereco, $row->id_cidade, $row->email, $row->senha);
        $cliente->id_cliente = $row->id_cliente;

        return $cliente;
    }

    public function emailExiste($email, $ignoreId = null){
        if($ignoreId === null){
            $sql = $this->con->prepare("select id_cliente from clientes where email = :email");
            $sql->bindValue(':email', strtolower($email));
        } else {
            $sql = $this->con->prepare("select id_cliente from clientes where email = :email and id_cliente <> :id");
            $sql->bindValue(':email', strtolower($email));
            $sql->bindValue(':id', $ignoreId);
        }
        $sql->execute();

        return $sql->rowCount() > 0;
    }

    public function autenticar($email, $senha){
        $sql = $this->con->prepare("select * from clientes where email = :email and senha = :senha");
        $email = strtolower($email);
        $senha = strtolower($senha);

        $sql->bindValue(':email', $email);
        $sql->bindValue(':senha', $senha);
        $sql->execute();

        $count = $sql->rowCount();
        $cliente = null;

        if($count == 1){ // achou o cliente
            $cliente = $sql->fetch(PDO::FETCH_OBJ);
        }

        return $cliente;
    }

}


?>