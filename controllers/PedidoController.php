<?php
require_once __DIR__ . '/../dao/pedidoDAO.inc.php';
require_once __DIR__ . '/../models/pedido.inc.php';

class PedidoController{
    private $pedidoDao;

    function __construct(){
        $this->pedidoDao = new PedidoDao();
    }

    public function finalizarCompra($id_cliente, $valor_total, $valortotal_frete, $carrinho)
    {
        $pedido = new Pedido($id_cliente, $valor_total, $valortotal_frete);

        return $this->pedidoDao->incluirCompra($pedido, $carrinho);
    }

    public function listar()
    {
        return $this->pedidoDao->listar();
    }

    public function buscarPorId($id_compra)
    {
        return $this->pedidoDao->buscarPorId($id_compra);
    }

    public function listarItens($id_compra)
    {
        return $this->pedidoDao->listarItens($id_compra);
    }

}

?>
