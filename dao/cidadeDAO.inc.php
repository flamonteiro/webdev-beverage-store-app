	id_cidade	cidade	estado	CEP	valorfrete_porPeso	peso	
<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/cidade.inc.php';

class CidadeDao{
    private $con;

    function __construct(){
        $conexao = new Conexao();
        $this->con = $conexao->getConexao();
    }

    public function cadastrar(Cidade $cidade){
        $sql = $this->con->prepare("insert into cidades (cidade, estado, CEP, valorfrete_porPeso, peso) values (:cidade, :estado, :cep, :valorfrete_porPeso, :peso)");

        $sql->bindValue(':cidade', $cidade->getCidade());
        $sql->bindValue(':estado', $cidade->getEstado());
        $sql->bindValue(':cep', $cidade->getCEP());
        $sql->bindValue(':valorfrete_porPeso', $cidade->getValorfrete_porPeso());
        $sql->bindValue(':peso', $cidade->getPeso());

        return $sql->execute();
    }

    public function alterar($id_cidade, Cidade $cidade){
        $sql = $this->con->prepare("update cidades set cidade = :cidade, estado = :estado, CEP = :cep, valorfrete_porPeso = :valorfrete_porPeso, peso = :peso where id_cidade = :id");

        $sql->bindValue(':cidade', $cidade->getCidade());
        $sql->bindValue(':estado', $cidade->getEstado());
        $sql->bindValue(':cep', $cidade->getCEP());
        $sql->bindValue(':valorfrete_porPeso', $cidade->getValorfrete_porPeso());
        $sql->bindValue(':peso', $cidade->getPeso());
        $sql->bindValue(':id', $id_cidade);

        return $sql->execute();
    }

    public function excluir($id_cidade){
        $sql = $this->con->prepare("delete from cidades where id_cidade = :id");
        $sql->bindValue(':id', $id_cidade);

        return $sql->execute();
    }

    public function listar(){
        $sql = $this->con->query("select * from cidades order by cidade");
        $cidades = array();

        while($row = $sql->fetch(PDO::FETCH_OBJ)){
            $cidades[] = $this->hidratar($row);
        }

        return $cidades;
    }

    public function buscarPorId($id_cidade){
        $sql = $this->con->prepare("select * from cidades where id_cidade = :id");
        $sql->bindValue(':id', $id_cidade);
        $sql->execute();

        $row = $sql->fetch(PDO::FETCH_OBJ);

        return $row === false ? null : $this->hidratar($row);
    }

    private function hidratar($row){
        $cidade = new Cidade();
        $cidade->setCidade($row->cidade, $row->estado, $row->CEP, $row->valorfrete_porPeso, $row->peso);
        $cidade->id_cidade = $row->id_cidade;

        return $cidade;
    }

}


?>