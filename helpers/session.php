<?php

require_once __DIR__ . '/../dao/cidadeDAO.inc.php';

function exigirLogin()
{
    if (!isset($_SESSION['cliente'])) {
        header("Location: ../views/formLogin.php");
        exit;
    }
}

function exigirAdmin()
{
    exigirLogin();

    if ($_SESSION['cliente']->tipo !== 'A') {
        header("Location: ../views/index.php?acessoNegado=1");
        exit;
    }
}

function calcularTotaisCarrinho()
{
    $total = 0;
    $pesoTotal = 0;
    foreach ($_SESSION['carrinho'] ?? [] as $item) {
        $total += $item->getValorItem();
        $pesoTotal += $item->getPesoItem();
    }
    $_SESSION['total'] = $total;
    $_SESSION['pesoTotal'] = $pesoTotal;

    $cidadeDao = new CidadeDao();
    $cidade = $cidadeDao->buscarPorId($_SESSION['cliente']->id_cidade);
    $_SESSION['frete'] = $cidade->getValorfrete_porPeso() * $pesoTotal;
    $_SESSION['pesoLimiteCidade'] = $cidade->getPeso();
    $_SESSION['excedeLimitePeso'] = $pesoTotal > $cidade->getPeso();
}

?>
