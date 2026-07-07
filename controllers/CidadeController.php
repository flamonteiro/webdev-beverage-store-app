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

if (isset($_REQUEST['opcao'])) {
    session_start();
    $opcao = $_REQUEST['opcao'];
    $controller = new CidadeController();

    if ($opcao == 1) { // cadastrar
        $controller->cadastrar(
            $_REQUEST['cCidade'],
            $_REQUEST['cEstado'],
            $_REQUEST['cCEP'],
            $_REQUEST['cValorFrete'],
            $_REQUEST['cPeso']
        );
        header("Location: CidadeController.php?opcao=2");
    } else if ($opcao == 2) { // listar
        $_SESSION['cidades'] = $controller->listar();
        header("Location: ../views/exibirCidades.php");
    } else if ($opcao == 3) { // excluir
        $controller->excluir((int) $_REQUEST['id']);
        header("Location: CidadeController.php?opcao=2");
    } else if ($opcao == 4) { // buscar para alterar
        $_SESSION['cidade'] = $controller->buscarPorId((int) $_REQUEST['id']);
        header("Location: ../views/atualizarCidade.php");
    } else if ($opcao == 5) { // alterar
        $controller->alterar(
            (int) $_REQUEST['cIdCidade'],
            $_REQUEST['cCidade'],
            $_REQUEST['cEstado'],
            $_REQUEST['cCEP'],
            $_REQUEST['cValorFrete'],
            $_REQUEST['cPeso']
        );
        header("Location: CidadeController.php?opcao=2");
    }
}

?>
