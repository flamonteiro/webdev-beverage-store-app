<?php
require_once __DIR__ . '/../dao/bebidaDAO.inc.php';
require_once __DIR__ . '/../models/bebida.inc.php';
require_once __DIR__ . '/../models/item.inc.php';

class VendaController
{
    private $bebidaDao;

    function __construct($bebidaDao = null){
        $this->bebidaDao = $bebidaDao;
    }

    private function getBebidaDao() {
        if ($this->bebidaDao === null) {
            $this->bebidaDao = new BebidaDao();
        }
        return $this->bebidaDao;
    }

    private function iniciarSessao()
    {
        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }
    }

    private function array_search2($chave, $vetor){
        $index = -1;
        for($i=0; $i<count($vetor); $i++){
            if($chave == $vetor[$i]->getBebida()->getId_bebida()){
                $index = $i;
                break;
            }
        }
        return $index;
    }

    public function adicionarAoCarrinho($id_bebida, $quantidade = 1)
    {
        $this->iniciarSessao();
        $carrinho = $this->getCarrinho();
        
        $key = $this->array_search2($id_bebida, $carrinho);
        if ($key != -1) {
            for ($i = 0; $i < $quantidade; $i++) {
                $carrinho[$key]->setQuantidade();
            }
            $carrinho[$key]->setValorItem();
        } else {
            $bebidaDao = $this->getBebidaDao();
            $bebida = $bebidaDao->buscarPorId($id_bebida);
            if ($bebida) {
                $item = new Item($bebida);
                for ($i = 1; $i < $quantidade; $i++) {
                    $item->setQuantidade();
                }
                $item->setValorItem();
                $carrinho[] = $item;
            }
        }
        
        $_SESSION['carrinho'] = $carrinho;
    }

    public function atualizarCarrinho($id_bebida, $quantidade)
    {
        $this->iniciarSessao();
        $carrinho = $this->getCarrinho();
        
        $key = $this->array_search2($id_bebida, $carrinho);
        if ($quantidade <= 0) {
            if ($key != -1) {
                unset($carrinho[$key]);
                sort($carrinho);
            }
        } else {
            if ($key != -1) {
                $carrinho[$key]->setQuantidade($quantidade);
                $carrinho[$key]->setValorItem();
            } else {
                $bebidaDao = $this->getBebidaDao();
                $bebida = $bebidaDao->buscarPorId($id_bebida);
                if ($bebida) {
                    $item = new Item($bebida);
                    $item->setQuantidade($quantidade);
                    $item->setValorItem();
                    $carrinho[] = $item;
                }
            }
        }
        
        $_SESSION['carrinho'] = $carrinho;
    }

    public function removerDoCarrinho($id_bebida)
    {
        $this->iniciarSessao();
        $carrinho = $this->getCarrinho();
        
        $key = $this->array_search2($id_bebida, $carrinho);
        if ($key != -1) {
            unset($carrinho[$key]);
            sort($carrinho);
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
