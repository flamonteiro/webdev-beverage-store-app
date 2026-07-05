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

$venda = new VendaController();

$venda->limparCarrinho();
assertTrue(count($venda->getCarrinho()) === 0, 'carrinho inicializado como vazio');

$venda->adicionarAoCarrinho(10, 2);
$venda->adicionarAoCarrinho(20, 1);
$carrinho = $venda->getCarrinho();
assertTrue(isset($carrinho[10]) && $carrinho[10] === 2, 'adicionarAoCarrinho() adiciona novos itens');
assertTrue(isset($carrinho[20]) && $carrinho[20] === 1, 'adicionarAoCarrinho() aceita multiplos itens distintos');

$venda->adicionarAoCarrinho(10, 3);
$carrinho = $venda->getCarrinho();
assertTrue($carrinho[10] === 5, 'adicionarAoCarrinho() incrementa quantidade de itens existentes');

$venda->atualizarCarrinho(20, 4);
$carrinho = $venda->getCarrinho();
assertTrue($carrinho[20] === 4, 'atualizarCarrinho() substitui a quantidade anterior');

$venda->removerDoCarrinho(10);
$carrinho = $venda->getCarrinho();
assertTrue(!isset($carrinho[10]), 'removerDoCarrinho() deleta o item selecionado');

$venda->limparCarrinho();
assertTrue(count($venda->getCarrinho()) === 0, 'limparCarrinho() esvazia totalmente o carrinho');

resumoTestes();
?>
