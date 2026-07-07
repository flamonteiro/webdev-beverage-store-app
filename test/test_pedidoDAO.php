<?php
require_once __DIR__ . '/test_helper.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../dao/cidadeDAO.inc.php';
require_once __DIR__ . '/../dao/clienteDAO.inc.php';
require_once __DIR__ . '/../dao/bebidaDAO.inc.php';
require_once __DIR__ . '/../dao/pedidoDAO.inc.php';

$con = (new Conexao())->getConexao();
$cidadeDao = new CidadeDao();
$clienteDao = new ClienteDao();
$bebidaDao = new BebidaDao();
$pedidoDao = new PedidoDao();

echo "== PedidoDao ==\n";

// setup: cidade, cliente e bebida de teste
$cidade = new Cidade();
$cidade->setCidade('Serra Teste', 'ES', '29160-000', 0.05);
$cidadeDao->cadastrar($cidade);
$id_cidade = $con->query("select id_cidade from cidades where cidade = 'Serra Teste'")->fetch(PDO::FETCH_OBJ)->id_cidade;

$cliente = new Cliente();
$cliente->setCliente('Cliente Pedido Teste', '98765432100010', 'Rua Pedido, 1', $id_cidade, 'pedido@teste.com', 'Senha123');
$clienteDao->cadastrar($cliente);
$id_cliente = $con->query("select id_cliente from clientes where email = 'pedido@teste.com'")->fetch(PDO::FETCH_OBJ)->id_cliente;

$bebida = new Bebida();
$bebida->setBebida('Refrigerante Teste', '2L', 8.00, 50, 'Fabricante Teste');
$bebidaDao->cadastrar($bebida);
$row_bebida = $con->query("select id_bebida from bebidas where nome = 'Refrigerante Teste'")->fetch(PDO::FETCH_OBJ);
$bebidaCadastrada = $bebidaDao->buscarPorId($row_bebida->id_bebida);

// monta o carrinho: 1 item, 3 unidades
$item = new Item($bebidaCadastrada);
$item->setQuantidade();
$item->setQuantidade();
$item->setValorItem();

$carrinho = array($item);

// incluirCompra
$pedido = new Pedido($id_cliente, $item->getValorItem(), 2.50);
$id_compra = $pedidoDao->incluirCompra($pedido, $carrinho);

assertTrue($id_compra !== null, 'incluirCompra() retorna o id da compra gerada');

// buscarPorId
$compra = $pedidoDao->buscarPorId($id_compra);
assertTrue($compra !== null, 'buscarPorId() encontra a compra cadastrada');
assertTrue($compra instanceof Pedido, 'buscarPorId() retorna um objeto Pedido');
assertTrue((int)$compra->getId_cliente() === (int)$id_cliente, 'buscarPorId() traz o id_cliente correto');
assertTrue((float)$compra->getValorTotal() === (float)$item->getValorItem(), 'buscarPorId() traz o valor_total correto');
assertTrue($pedidoDao->buscarPorId(999999) === null, 'buscarPorId() retorna null para id inexistente');

// listar
$compras = $pedidoDao->listar();
$encontrada = null;
foreach($compras as $c){
    if((int)$c->getIdCompra() === (int)$id_compra){
        $encontrada = $c;
    }
}
assertTrue($encontrada !== null, 'listar() inclui a compra cadastrada');

// listarItens
$itens = $pedidoDao->listarItens($id_compra);
assertTrue(count($itens) === 1, 'listarItens() retorna a quantidade correta de itens');
assertTrue((int)$itens[0]->id_bebida === (int)$bebidaCadastrada->getId_bebida(), 'listarItens() traz o id_bebida correto');
assertTrue((int)$itens[0]->quantidade === 3, 'listarItens() traz a quantidade correta');

// limpeza
$stmt = $con->prepare("delete from itens_compra where id_compra = :id");
$stmt->bindValue(':id', $id_compra);
$stmt->execute();

$stmt = $con->prepare("delete from compras where id_compra = :id");
$stmt->bindValue(':id', $id_compra);
$stmt->execute();

$clienteDao->excluir($id_cliente);
$bebidaDao->excluir($bebidaCadastrada->getId_bebida());
$cidadeDao->excluir($id_cidade);

resumoTestes();
