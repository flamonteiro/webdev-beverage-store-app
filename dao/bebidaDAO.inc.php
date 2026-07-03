<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/bebida.inc.php';

class BebidaDao{
    private $con;

    function __construct(){
        $conexao = new Conexao();
        $this->con = $conexao->getConexao();
    }

    public function cadastrar(Bebida $bebida){
        $sql = $this->con->prepare("insert into bebidas (nome, volume, preco, peso, qde_estoque, fabricante) values (:nome, :volume, :preco, :peso, :qde_estoque, :fabricante)");

        $sql->bindValue(':nome', $bebida->getNome());
        $sql->bindValue(':volume', $bebida->getVolume());
        $sql->bindValue(':preco', $bebida->getPreco());
        $sql->bindValue(':peso', $bebida->getPeso());
        $sql->bindValue(':qde_estoque', $bebida->getQde_estoque());
        $sql->bindValue(':fabricante', $bebida->getFabricante());

        return $sql->execute();
    }

    public function alterar($id_bebida, Bebida $bebida){
        $sql = $this->con->prepare("update bebidas set nome = :nome, volume = :volume, preco = :preco, peso = :peso, qde_estoque = :qde_estoque, fabricante = :fabricante where id_bebida = :id");

        $sql->bindValue(':nome', $bebida->getNome());
        $sql->bindValue(':volume', $bebida->getVolume());
        $sql->bindValue(':preco', $bebida->getPreco());
        $sql->bindValue(':peso', $bebida->getPeso());
        $sql->bindValue(':qde_estoque', $bebida->getQde_estoque());
        $sql->bindValue(':fabricante', $bebida->getFabricante());
        $sql->bindValue(':id', $id_bebida);

        return $sql->execute();
    }

    public function excluir($id_bebida){
        $sql = $this->con->prepare("delete from bebidas where id_bebida = :id");
        $sql->bindValue(':id', $id_bebida);

        return $sql->execute();
    }

    public function listar(){
        $sql = $this->con->query("select * from bebidas order by nome");
        $bebidas = array();

        while($row = $sql->fetch(PDO::FETCH_OBJ)){
            $bebidas[] = $this->hidratar($row);
        }

        return $bebidas;
    }

    public function buscarPorId($id_bebida){
        $sql = $this->con->prepare("select * from bebidas where id_bebida = :id");
        $sql->bindValue(':id', $id_bebida);
        $sql->execute();

        $row = $sql->fetch(PDO::FETCH_OBJ);

        return $row === false ? null : $this->hidratar($row);
    }

    private function hidratar($row){
        $bebida = new Bebida();
        $bebida->setBebida($row->nome, $row->volume, $row->preco, $row->peso, $row->qde_estoque, $row->fabricante);
        $bebida->id_bebida = $row->id_bebida;

        return $bebida;
    }

}

?>
