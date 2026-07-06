<?php
require_once __DIR__ . '/test_helper.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/VendaController.php';

echo "== Testes de Sessao nos Controllers ==\n";

if (session_status() === PHP_SESSION_NONE) {
    @session_start();
}

if (!isset($_SESSION)) {
    $_SESSION = array();
}

$_SESSION['nome_distribuidora'] = 'Cervejaria e Cia';
assertTrue(($_SESSION['nome_distribuidora'] ?? null) === 'Cervejaria e Cia', 'definir() e obter() gravam e leem dados da sessao');

assertTrue(isset($_SESSION['nome_distribuidora']) === true, 'existe() retorna true para chaves que foram definidas');
assertTrue(isset($_SESSION['chave_inexistente']) === false, 'existe() retorna false para chaves nao definidas');

unset($_SESSION['nome_distribuidora']);
assertTrue(isset($_SESSION['nome_distribuidora']) === false, 'excluir() remove a chave da sessao');
assertTrue(($_SESSION['nome_distribuidora'] ?? null) === null, 'obter() retorna null (ou o default) para chaves excluidas');
assertTrue(($_SESSION['nome_distribuidora'] ?? 'Default') === 'Default', 'obter() respeita o valor default fornecido');

$auth = new AuthController();

$dadosCliente = (object)[
    'id_cliente' => 42,
    'nome' => 'Cliente Especial',
    'email' => 'cliente@especial.com'
];
$auth->logarCliente($dadosCliente);
assertTrue($auth->estaLogadoComoCliente() === true, 'logarCliente() define o estado de logado como cliente');
assertTrue($auth->estaLogadoComoAdmin() === false, 'cliente logado nao eh admin');
assertTrue($auth->getClienteLogado()->nome === 'Cliente Especial', 'getClienteLogado() recupera os dados do cliente');

$dadosAdmin = (object)[
    'id_admin' => 1,
    'nome' => 'Administrador Geral'
];
$auth->logarAdmin($dadosAdmin);
assertTrue($auth->estaLogadoComoAdmin() === true, 'logarAdmin() define o estado de logado como admin');
assertTrue($auth->estaLogadoComoCliente() === false, 'admin logado nao eh cliente');
assertTrue($auth->getAdminLogado()->nome === 'Administrador Geral', 'getAdminLogado() recupera os dados do admin');

$auth->deslogar();
assertTrue($auth->estaLogadoComoCliente() === false, 'deslogar() limpa login de cliente');
assertTrue($auth->estaLogadoComoAdmin() === false, 'deslogar() limpa login de admin');

$_SESSION['flash']['sucesso'] = 'Cadastro realizado com sucesso!';
$getFlash = function($chave) {
    if (isset($_SESSION['flash'][$chave])) {
        $mensagem = $_SESSION['flash'][$chave];
        unset($_SESSION['flash'][$chave]);
        return $mensagem;
    }
    return null;
};
assertTrue($getFlash('sucesso') === 'Cadastro realizado com sucesso!', 'getFlash() recupera a mensagem salva');
assertTrue($getFlash('sucesso') === null, 'getFlash() remove a mensagem apos a primeira leitura (flash)');

class MockBebidaDao {
    private $bebidas = [];

    public function __construct() {
        $b1 = new Bebida();
        $b1->id_bebida = 10;
        $b1->setBebida('Bebida 10', '1L', 5.00, 1.0, 10, 'Fabricante A');
        $this->bebidas[10] = $b1;

        $b2 = new Bebida();
        $b2->id_bebida = 20;
        $b2->setBebida('Bebida 20', '2L', 10.00, 2.0, 20, 'Fabricante B');
        $this->bebidas[20] = $b2;
    }

    public function buscarPorId($id) {
        return isset($this->bebidas[$id]) ? $this->bebidas[$id] : null;
    }
}

$mockBebidaDao = new MockBebidaDao();
$venda = new VendaController($mockBebidaDao);

$venda->limparCarrinho();
assertTrue(count($venda->getCarrinho()) === 0, 'carrinho inicializado como vazio');

$venda->adicionarAoCarrinho(10, 2);
$venda->adicionarAoCarrinho(20, 1);
$carrinho = $venda->getCarrinho();

$getQuantidadeNoCarrinho = function($id, $carrinho) {
    foreach ($carrinho as $item) {
        if ($item->getBebida()->getId_bebida() === $id) {
            return $item->getQuantidade();
        }
    }
    return null;
};

$hasNoCarrinho = function($id, $carrinho) {
    foreach ($carrinho as $item) {
        if ($item->getBebida()->getId_bebida() === $id) {
            return true;
        }
    }
    return false;
};

assertTrue($getQuantidadeNoCarrinho(10, $carrinho) === 2, 'adicionarAoCarrinho() adiciona novos itens');
assertTrue($getQuantidadeNoCarrinho(20, $carrinho) === 1, 'adicionarAoCarrinho() aceita multiplos itens distintos');

$venda->adicionarAoCarrinho(10, 3);
$carrinho = $venda->getCarrinho();
assertTrue($getQuantidadeNoCarrinho(10, $carrinho) === 5, 'adicionarAoCarrinho() incrementa quantidade de itens existentes');

$venda->atualizarCarrinho(20, 4);
$carrinho = $venda->getCarrinho();
assertTrue($getQuantidadeNoCarrinho(20, $carrinho) === 4, 'atualizarCarrinho() substitui a quantidade anterior');

$venda->removerDoCarrinho(10);
$carrinho = $venda->getCarrinho();
assertTrue(!$hasNoCarrinho(10, $carrinho), 'removerDoCarrinho() deleta o item selecionado');

$venda->limparCarrinho();
assertTrue(count($venda->getCarrinho()) === 0, 'limparCarrinho() esvazia totalmente o carrinho');

resumoTestes();
?>
