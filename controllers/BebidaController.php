<?php
require_once __DIR__ . '/../dao/bebidaDAO.inc.php';
require_once __DIR__ . '/../models/bebida.inc.php';

class BebidaController{
    private $bebidaDao;

    function __construct(){
        $this->bebidaDao = new BebidaDao();
    }

    public function cadastrar($nome, $volume, $preco, $peso, $qde_estoque, $fabricante, $imagem = 'drinklogo.jpg')
    {
        $bebida = new Bebida();
        $bebida->setBebida($nome, $volume, $preco, $peso, $qde_estoque, $fabricante, $imagem);

        return $this->bebidaDao->cadastrar($bebida);
    }

    public function alterar($id_bebida, $nome, $volume, $preco, $peso, $qde_estoque, $fabricante, $imagem = 'drinklogo.jpg')
    {
        $bebida = new Bebida();
        $bebida->setBebida($nome, $volume, $preco, $peso, $qde_estoque, $fabricante, $imagem);

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

function uploadImagemBebida($default = 'drinklogo.jpg')
{
    if (!isset($_FILES['pImagem']) || $_FILES['pImagem']['error'] === UPLOAD_ERR_NO_FILE) {
        return $default;
    }

    if ($_FILES['pImagem']['error'] !== UPLOAD_ERR_OK) {
        return $default;
    }

    $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'webp', 'avif', 'gif'];
    $extensao = strtolower(pathinfo($_FILES['pImagem']['name'], PATHINFO_EXTENSION));

    if (!in_array($extensao, $extensoesPermitidas) || getimagesize($_FILES['pImagem']['tmp_name']) === false) {
        return $default;
    }

    $nomeArquivo = uniqid('bebida_') . '.' . $extensao;
    $destino = __DIR__ . '/../views/imagens/' . $nomeArquivo;

    if (!move_uploaded_file($_FILES['pImagem']['tmp_name'], $destino)) {
        return $default;
    }

    return $nomeArquivo;
}

if (isset($_REQUEST['opcao'])) {
    session_start();
    $opcao = $_REQUEST['opcao'];
    $controller = new BebidaController();

    if ($opcao == 1) { // cadastrar
        $controller->cadastrar(
            $_REQUEST['pNome'],
            $_REQUEST['pVolume'],
            $_REQUEST['pPreco'],
            $_REQUEST['pPeso'],
            $_REQUEST['pQdeEstoque'],
            $_REQUEST['pFabricante'],
            uploadImagemBebida('drinklogo.jpg')
        );
        header("Location: BebidaController.php?opcao=2");
    } else if ($opcao == 2 || $opcao == 6) { // listar
        $_SESSION['bebidas'] = $controller->listar();

        if ($opcao == 2) {
            header("Location: ../views/exibirBebidas.php");
        } else {
            header("Location: ../views/showroomBebidas.php");
        }
    } else if ($opcao == 3) { // excluir
        $controller->excluir((int) $_REQUEST['id']);
        header("Location: BebidaController.php?opcao=2");
    } else if ($opcao == 4) { // buscar para alterar
        $_SESSION['bebida'] = $controller->buscarPorId((int) $_REQUEST['id']);
        header("Location: ../views/atualizarBebida.php");
    } else if ($opcao == 5) { // alterar
        $controller->alterar(
            (int) $_REQUEST['pIdBebida'],
            $_REQUEST['pNome'],
            $_REQUEST['pVolume'],
            $_REQUEST['pPreco'],
            $_REQUEST['pPeso'],
            $_REQUEST['pQdeEstoque'],
            $_REQUEST['pFabricante'],
            uploadImagemBebida($_REQUEST['pImagemAtual'] ?? 'drinklogo.jpg')
        );
        header("Location: BebidaController.php?opcao=2");
    }
}

?>
