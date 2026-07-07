<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/item.inc.php';
require_once __DIR__ . '/../models/pedido.inc.php';

class PedidoDao{
    private $con;

    function __construct(){
        $conexao = new Conexao();
        $this->con = $conexao->getConexao();
    }

    private function getIdCompra(){ //retorna o último id_compra registrado na tabela
        $sql = $this->con->query("select MAX(id_compra) as maior from compras");

        $row = $sql->fetch(PDO::FETCH_OBJ);
        return $row->maior;
    }

    public function incluirItens($idCompra, $carrinho){
        foreach ($carrinho as $item) {
            $sql = $this->con->prepare("insert into itens_compra (id_bebida, quantidade, valor_item, id_compra) values (:idBebida, :q, :val, :idCompra)");

            $sql->bindValue(':idBebida', $item->getBebida()->getId_bebida());
            $sql->bindValue(':q', $item->getQuantidade());
            $sql->bindValue(':val', $item->getValorItem());
            $sql->bindValue(':idCompra', $idCompra);
            $sql->execute();
        }
    }

    public function incluirCompra(Pedido $pedido, $carrinho){
        $sql = $this->con->prepare("insert into compras (id_cliente, data_compra, valor_total, valortotal_frete) values (:idCliente, :data, :valorTotal, :valorFrete)");

        $sql->bindValue(':idCliente', $pedido->getId_cliente());
        $sql->bindValue(':data', date('Y-m-d', $pedido->getDataCompra()));
        $sql->bindValue(':valorTotal', $pedido->getValorTotal());
        $sql->bindValue(':valorFrete', $pedido->getValortotalFrete());
        $sql->execute();

        $id = $this->getIdCompra();
        $this->incluirItens($id, $carrinho);

        return $id;
    }

    public function listar(){
        $sql = $this->con->query("select * from compras order by data_compra desc");
        $compras = array();

        while($row = $sql->fetch(PDO::FETCH_OBJ)){
            $compras[] = $this->hidratar($row);
        }

        return $compras;
    }

    public function buscarPorId($id_compra){
        $sql = $this->con->prepare("select * from compras where id_compra = :id");
        $sql->bindValue(':id', $id_compra);
        $sql->execute();

        $row = $sql->fetch(PDO::FETCH_OBJ);

        return $row === false ? null : $this->hidratar($row);
    }

    public function listarItens($id_compra){
        $sql = $this->con->prepare("select * from itens_compra where id_compra = :id");
        $sql->bindValue(':id', $id_compra);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_OBJ);
    }

    private function hidratar($row){
        $pedido = new Pedido($row->id_cliente, $row->valor_total, $row->valortotal_frete);
        $pedido->setIdCompra($row->id_compra);
        $pedido->setDataCompra(strtotime($row->data_compra));

        return $pedido;
    }

}

?>
