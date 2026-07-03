<?php
require_once __DIR__ . '/../dao/bebidaDAO.inc.php';
require_once __DIR__ . '/../models/bebida.inc.php';

class BebidaController{
    private $bebidaDao;

    function __construct(){
        $this->bebidaDao = new BebidaDao();
    }

    public function cadastrar($nome, $volume, $preco, $peso, $qde_estoque, $fabricante)
    {
        $bebida = new Bebida();
        $bebida->setBebida($nome, $volume, $preco, $peso, $qde_estoque, $fabricante);

        return $this->bebidaDao->cadastrar($bebida);
    }

    public function alterar($id_bebida, $nome, $volume, $preco, $peso, $qde_estoque, $fabricante)
    {
        $bebida = new Bebida();
        $bebida->setBebida($nome, $volume, $preco, $peso, $qde_estoque, $fabricante);

        return $this->bebidaDao->alterar($id_bebida, $bebida);
    }

    public function excluir($id_bebida)
    {
        return $this->bebidaDao->excluir($id_bebida);
    }

    public function listar()
    {
        return $this->bebidaDao->listar();
    }

    public function buscarPorId($id_bebida)
    {
        return $this->bebidaDao->buscarPorId($id_bebida);
    }

}

?>
