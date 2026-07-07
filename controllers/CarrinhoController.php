<?php
require_once __DIR__ . '/../dao/bebidaDAO.inc.php';
require_once __DIR__ . '/../models/item.inc.php';
require_once __DIR__ . '/../helpers/session.php';

function buscarItemCarrinho($id_bebida, $carrinho){
    foreach ($carrinho as $index => $item) {
        if ($item->getBebida()->getId_bebida() == $id_bebida) {
            return $index;
        }
    }
    return -1;
}

if (isset($_REQUEST['opcao'])) {
    session_start();

    // administrador nao pode fazer compras com seu próprio perfil
    if (isset($_SESSION['cliente']) && $_SESSION['cliente']->tipo === 'A') {
        header("Location: ../views/exibirDashboard.php");
        exit;
    }

    $opcao = $_REQUEST['opcao'];
    $bebidaDao = new BebidaDao();

    if ($opcao == 1) { // adicionar ao carrinho
        $id = (int) $_REQUEST['id'];
        $quantidade = max(1, (int) $_REQUEST['quantidade']);

        $bebida = $bebidaDao->buscarPorId($id);
        $carrinho = $_SESSION['carrinho'] ?? [];
        $index = buscarItemCarrinho($id, $carrinho);
        $quantidadeAtual = $index !== -1 ? $carrinho[$index]->getQuantidade() : 0;

        if ($bebida !== null && ($quantidadeAtual + $quantidade) <= $bebida->getQde_estoque()) {
            if ($index !== -1) {
                for ($i = 0; $i < $quantidade; $i++) {
                    $carrinho[$index]->setQuantidade();
                }
                $carrinho[$index]->setValorItem();
            } else {
                $item = new Item($bebida);
                for ($i = 1; $i < $quantidade; $i++) {
                    $item->setQuantidade();
                }
                $item->setValorItem();
                $carrinho[] = $item;
            }

            $_SESSION['carrinho'] = $carrinho;
            header("Location: ../views/exibirCarrinho.php");
        } else {
            header("Location: ../views/showroomBebidas.php?semestoque=1");
        }
    } else if ($opcao == 2) { // remover item
        $index = (int) $_REQUEST['index'];
        $carrinho = $_SESSION['carrinho'] ?? [];
        unset($carrinho[$index]);
        $_SESSION['carrinho'] = array_values($carrinho);
        header("Location: ../views/exibirCarrinho.php");
    } else if ($opcao == 3) { // esvaziar carrinho
        unset($_SESSION['carrinho']);
        header("Location: ../views/exibirCarrinho.php");
    } else if ($opcao == 5) { // ir para finalizacao da compra
        exigirLogin();
        header("Location: ../views/dadosCompra.php");
    }
}

?>
