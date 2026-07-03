<?php
require_once __DIR__ . '/../dao/cidadeDAO.inc.php';
require_once __DIR__ . '/../models/cidade.inc.php';

class CidadeController{
    private $cidadeDao;

    function __construct(){
        $this->cidadeDao = new CidadeDao();
    }

    public function cadastrar($cidade, $estado, $CEP, $valorfrete_porPeso, $peso)
    {
        $cidadeObj = new Cidade();
        $cidadeObj->setCidade($cidade, $estado, $CEP, $valorfrete_porPeso, $peso);

        return $this->cidadeDao->cadastrar($cidadeObj);
    }

    public function alterar($id_cidade, $cidade, $estado, $CEP, $valorfrete_porPeso, $peso)
    {
        $cidadeObj = new Cidade();
        $cidadeObj->setCidade($cidade, $estado, $CEP, $valorfrete_porPeso, $peso);

        return $this->cidadeDao->alterar($id_cidade, $cidadeObj);
    }

    public function excluir($id_cidade)
    {
        return $this->cidadeDao->excluir($id_cidade);
    }

    public function listar()
    {
        return $this->cidadeDao->listar();
    }

    public function buscarPorId($id_cidade)
    {
        return $this->cidadeDao->buscarPorId($id_cidade);
    }

}

?>
