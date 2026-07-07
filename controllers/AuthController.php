<?php
require_once __DIR__ . '/../dao/clienteDAO.inc.php';
require_once __DIR__ . '/../models/cliente.inc.php';

class AuthController{
    private $clienteDao;

    function __construct(){
        $this->clienteDao = new ClienteDao();
    }

    public function cadastrar($nome, $cnpj, $endereco, $id_cidade, $email, $senha)
    {
        if($this->clienteDao->emailExiste($email)){
            return false;
        }

        $cliente = new Cliente();
        $cliente->setCliente($nome, $cnpj, $endereco, $id_cidade, $email, $senha);

        return $this->clienteDao->cadastrar($cliente);
    }

    public function autenticar($email, $senha)
    {
        return $this->clienteDao->autenticar($email, $senha);
    }

    public function alterar($id_cliente, $nome, $cnpj, $endereco, $id_cidade, $email, $senha)
    {
        if($this->clienteDao->emailExiste($email, $id_cliente)){
            return false;
        }

        $cliente = new Cliente();
        $cliente->setCliente($nome, $cnpj, $endereco, $id_cidade, $email, $senha);

        return $this->clienteDao->alterar($id_cliente, $cliente);
    }

    public function excluir($id_cliente)
    {
        return $this->clienteDao->excluir($id_cliente);
    }

    public function listar()
    {
        return $this->clienteDao->listar();
    }

    public function buscarPorId($id_cliente)
    {
        return $this->clienteDao->buscarPorId($id_cliente);
    }

}

if (isset($_REQUEST['pOpcao'])) {
    session_start();
    $pOpcao = $_REQUEST['pOpcao'];

    if ($pOpcao == 1) { // autenticar
        $controller = new AuthController();
        $cliente = $controller->autenticar($_REQUEST['pEmail'], $_REQUEST['pSenha']);

        if ($cliente != null) {
            $_SESSION['cliente'] = $cliente;

            if (isset($_SESSION['carrinho'])) {
                header("Location: ../views/dadosCompra.php");
            } else {
                header("Location: ../views/showroomBebidas.php");
            }
        } else {
            header("Location: ../views/formLogin.php?erro=1");
        }
    } else if ($pOpcao == 2) { // logout
        session_destroy();
        header("Location: ../views/index.php");
    }
}

?>
