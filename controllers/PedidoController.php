<?php
require_once __DIR__ . '/../dao/pedidoDAO.inc.php';
require_once __DIR__ . '/../dao/bebidaDAO.inc.php';
require_once __DIR__ . '/../models/pedido.inc.php';
require_once __DIR__ . '/../helpers/session.php';

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

if (isset($_REQUEST['opcao'])) {
    session_start();
    $opcao = $_REQUEST['opcao'];

    if ($opcao == 1) { // finalizar compra
        exigirLogin();

        $cliente = $_SESSION['cliente'];
        $carrinho = $_SESSION['carrinho'];
        $valorTotal = $_SESSION['total'];
        $valorFrete = $_SESSION['frete'];

        $controller = new PedidoController();
        $controller->finalizarCompra($cliente->id_cliente, $valorTotal, $valorFrete, $carrinho);

        $bebidaDao = new BebidaDao();
        foreach ($carrinho as $item) {
            $bebidaDao->baixarEstoque($item->getBebida()->getId_bebida(), $item->getQuantidade());
        }

        unset($_SESSION['carrinho']);
        unset($_SESSION['total']);
        unset($_SESSION['frete']);

        header("Location: ../views/boleto/meuBoleto.php?metodo=" . urlencode($_REQUEST['pag'] ?? 'cartao'));
    } else if ($opcao == 2) { // listar historico de vendas - restrito ao administrador
        exigirAdmin();

        $controller = new PedidoController();
        $_SESSION['compras'] = $controller->listar();

        header("Location: ../views/exibirHistorico.php");
    }
}

?>
