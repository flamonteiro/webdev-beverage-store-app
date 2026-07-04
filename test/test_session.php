<?php
require_once __DIR__ . '/test_helper.php';
require_once __DIR__ . '/../helpers/session.php';

echo "== Testes do Helper de Sessao ==\n";

if (!isset($_SESSION)) {
    $_SESSION = array();
}

Sessao::definir('nome_distribuidora', 'Cervejaria e Cia');
assertTrue(Sessao::obter('nome_distribuidora') === 'Cervejaria e Cia', 'definir() e obter() gravam e leem dados da sessao');

assertTrue(Sessao::existe('nome_distribuidora') === true, 'existe() retorna true para chaves que foram definidas');
assertTrue(Sessao::existe('chave_inexistente') === false, 'existe() retorna false para chaves nao definidas');

Sessao::excluir('nome_distribuidora');
assertTrue(Sessao::existe('nome_distribuidora') === false, 'excluir() remove a chave da sessao');
assertTrue(Sessao::obter('nome_distribuidora') === null, 'obter() retorna null (ou o default) para chaves excluidas');
assertTrue(Sessao::obter('nome_distribuidora', 'Default') === 'Default', 'obter() respeita o valor default fornecido');

$dadosCliente = (object)[
    'id_cliente' => 42,
    'nome' => 'Cliente Especial',
    'email' => 'cliente@especial.com'
];
Sessao::logarCliente($dadosCliente);
assertTrue(Sessao::estaLogadoComoCliente() === true, 'logarCliente() define o estado de logado como cliente');
assertTrue(Sessao::estaLogadoComoAdmin() === false, 'cliente logado nao eh admin');
assertTrue(Sessao::getClienteLogado()->nome === 'Cliente Especial', 'getClienteLogado() recupera os dados do cliente');

$dadosAdmin = (object)[
    'id_admin' => 1,
    'nome' => 'Administrador Geral'
];
Sessao::logarAdmin($dadosAdmin);
assertTrue(Sessao::estaLogadoComoAdmin() === true, 'logarAdmin() define o estado de logado como admin');
assertTrue(Sessao::estaLogadoComoCliente() === false, 'admin logado nao eh cliente');
assertTrue(Sessao::getAdminLogado()->nome === 'Administrador Geral', 'getAdminLogado() recupera os dados do admin');

Sessao::deslogar();
assertTrue(Sessao::estaLogadoComoCliente() === false, 'deslogar() limpa login de cliente');
assertTrue(Sessao::estaLogadoComoAdmin() === false, 'deslogar() limpa login de admin');

Sessao::setFlash('sucesso', 'Cadastro realizado com sucesso!');
assertTrue(Sessao::getFlash('sucesso') === 'Cadastro realizado com sucesso!', 'getFlash() recupera a mensagem salva');
assertTrue(Sessao::getFlash('sucesso') === null, 'getFlash() remove a mensagem apos a primeira leitura (flash)');

Sessao::limparCarrinho();
assertTrue(count(Sessao::getCarrinho()) === 0, 'carrinho inicializado como vazio');

Sessao::adicionarAoCarrinho(10, 2);
Sessao::adicionarAoCarrinho(20, 1);
$carrinho = Sessao::getCarrinho();
assertTrue(isset($carrinho[10]) && $carrinho[10] === 2, 'adicionarAoCarrinho() adiciona novos itens');
assertTrue(isset($carrinho[20]) && $carrinho[20] === 1, 'adicionarAoCarrinho() aceita multiplos itens distintos');

Sessao::adicionarAoCarrinho(10, 3);
$carrinho = Sessao::getCarrinho();
assertTrue($carrinho[10] === 5, 'adicionarAoCarrinho() incrementa quantidade de itens existentes');

Sessao::atualizarCarrinho(20, 4);
$carrinho = Sessao::getCarrinho();
assertTrue($carrinho[20] === 4, 'atualizarCarrinho() substitui a quantidade anterior');

Sessao::removerDoCarrinho(10);
$carrinho = Sessao::getCarrinho();
assertTrue(!isset($carrinho[10]), 'removerDoCarrinho() deleta o item selecionado');

Sessao::limparCarrinho();
assertTrue(count(Sessao::getCarrinho()) === 0, 'limparCarrinho() esvazia totalmente o carrinho');

resumoTestes();
?>
