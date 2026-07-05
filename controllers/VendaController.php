<?php

class VendaController
{
    private function iniciarSessao()
    {
        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }
    }

    public function adicionarAoCarrinho($id_bebida, $quantidade = 1)
    {
        $this->iniciarSessao();
        $carrinho = $this->getCarrinho();
        
        if (isset($carrinho[$id_bebida])) {
            $carrinho[$id_bebida] += $quantidade;
        } else {
            $carrinho[$id_bebida] = $quantidade;
        }
        
        $_SESSION['carrinho'] = $carrinho;
    }

    public function atualizarCarrinho($id_bebida, $quantidade)
    {
        $this->iniciarSessao();
        $carrinho = $this->getCarrinho();
        
        if ($quantidade <= 0) {
            unset($carrinho[$id_bebida]);
        } else {
            $carrinho[$id_bebida] = $quantidade;
        }
        
        $_SESSION['carrinho'] = $carrinho;
    }

    public function removerDoCarrinho($id_bebida)
    {
        $this->iniciarSessao();
        $carrinho = $this->getCarrinho();
        
        if (isset($carrinho[$id_bebida])) {
            unset($carrinho[$id_bebida]);
        }
        
        $_SESSION['carrinho'] = $carrinho;
    }

    public function getCarrinho()
    {
        $this->iniciarSessao();
        return isset($_SESSION['carrinho']) ? $_SESSION['carrinho'] : array();
    }

    public function limparCarrinho()
    {
        $this->iniciarSessao();
        unset($_SESSION['carrinho']);
    }
}

?>
