<?php
require_once __DIR__ . '/../dao/clienteDAO.inc.php';
require_once __DIR__ . '/../models/cliente.inc.php';

class AuthController{
    private $clienteDao;

    function __construct($clienteDao = null){
        $this->clienteDao = $clienteDao;
    }

    private function getClienteDao() {
        if ($this->clienteDao === null) {
            $this->clienteDao = new ClienteDao();
        }
        return $this->clienteDao;
    }

    public function cadastrar($nome, $cnpj, $endereco, $id_cidade, $email, $senha)
    {
        $dao = $this->getClienteDao();
        if($dao->emailExiste($email)){
            return false;
        }

        $cliente = new Cliente();
        $cliente->setCliente($nome, $cnpj, $endereco, $id_cidade, $email, $senha);

        return $dao->cadastrar($cliente);
    }

    public function autenticar($email, $senha)
    {
        return $this->getClienteDao()->autenticar($email, $senha);
    }

    public function alterar($id_cliente, $nome, $cnpj, $endereco, $id_cidade, $email, $senha)
    {
        $dao = $this->getClienteDao();
        if($dao->emailExiste($email, $id_cliente)){
            return false;
        }

        $cliente = new Cliente();
        $cliente->setCliente($nome, $cnpj, $endereco, $id_cidade, $email, $senha);

        return $dao->alterar($id_cliente, $cliente);
    }

    public function excluir($id_cliente)
    {
        try {
            return $this->getClienteDao()->excluir($id_cliente);
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') {
                return false;
            }
            throw $e;
        }
    }

    public function listar()
    {
        return $this->getClienteDao()->listar();
    }

    public function buscarPorId($id_cliente)
    {
        return $this->getClienteDao()->buscarPorId($id_cliente);
    }

    private function iniciarSessao()
    {
        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }
    }

    public function logarCliente($cliente)
    {
        $this->iniciarSessao();
        $_SESSION['cliente_logado'] = $cliente;
        $_SESSION['tipo_usuario'] = 'cliente';
    }

    public function logarAdmin($admin)
    {
        $this->iniciarSessao();
        $_SESSION['admin_logado'] = $admin;
        $_SESSION['tipo_usuario'] = 'admin';
    }

    public function estaLogadoComoCliente()
    {
        $this->iniciarSessao();
        return isset($_SESSION['cliente_logado']) && isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'cliente';
    }

    public function estaLogadoComoAdmin()
    {
        $this->iniciarSessao();
        return isset($_SESSION['admin_logado']) && isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'admin';
    }

    public function getClienteLogado()
    {
        $this->iniciarSessao();
        return isset($_SESSION['cliente_logado']) ? $_SESSION['cliente_logado'] : null;
    }

    public function getAdminLogado()
    {
        $this->iniciarSessao();
        return isset($_SESSION['admin_logado']) ? $_SESSION['admin_logado'] : null;
    }

    public function deslogar()
    {
        $this->iniciarSessao();
        unset($_SESSION['cliente_logado']);
        unset($_SESSION['admin_logado']);
        unset($_SESSION['tipo_usuario']);
        
        $_SESSION = array();
        
        if (ini_get("session.use_cookies") && !headers_sent()) {
            $params = session_get_cookie_params();
            @setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        
        if (session_status() === PHP_SESSION_ACTIVE) {
            @session_destroy();
        }
    }
}

?>
