<?php
require_once __DIR__ . '/../dao/clienteDAO.inc.php';
require_once __DIR__ . '/../models/cliente.inc.php';
require_once __DIR__ . '/../helpers/session.php';

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
            $_SESSION['erroLogin'] = 'Email ou senha invalidos.';
            header("Location: ../views/formLogin.php?erro=1");
        }
    } else if ($pOpcao == 2) { // logout
        session_destroy();
        header("Location: ../views/index.php");
    } else if ($pOpcao == 3) { // cadastrar novo cliente - publico, sempre como usuario comum (tipo 'C')
        $controller = new AuthController();
        $cadastradoPeloAdmin = isset($_SESSION['cliente']) && $_SESSION['cliente']->tipo === 'A';

        try {
            if ($_REQUEST['pSenha'] !== $_REQUEST['pSenhaConfirma']) {
                throw new InvalidArgumentException('As senhas nao coincidem.');
            }

            $sucesso = $controller->cadastrar(
                $_REQUEST['pNome'],
                $_REQUEST['pCnpj'],
                $_REQUEST['pEndereco'],
                (int) $_REQUEST['pIdCidade'],
                $_REQUEST['pEmail'],
                $_REQUEST['pSenha']
            );

            if (!$sucesso) {
                throw new InvalidArgumentException('Este email ja esta cadastrado.');
            }

            if ($cadastradoPeloAdmin) {
                // admin cadastrando um cliente pelo painel: mantem a sessao do admin
                header("Location: ../views/cadastrarCliente.php?sucesso=1");
            } else {
                // visitante se autocadastrando: loga automaticamente como o novo cliente
                $_SESSION['cliente'] = $controller->autenticar($_REQUEST['pEmail'], $_REQUEST['pSenha']);

                if (isset($_SESSION['carrinho'])) {
                    header("Location: ../views/dadosCompra.php");
                } else {
                    header("Location: ../views/showroomBebidas.php");
                }
            }
        } catch (InvalidArgumentException $e) {
            $_SESSION['erroCadastro'] = $e->getMessage();
            // guarda o que foi digitado (exceto senhas) para o formulario nao vir vazio apos o redirect
            $_SESSION['dadosCadastro'] = [
                'pNome' => $_REQUEST['pNome'],
                'pCnpj' => $_REQUEST['pCnpj'],
                'pEndereco' => $_REQUEST['pEndereco'],
                'pIdCidade' => $_REQUEST['pIdCidade'],
                'pEmail' => $_REQUEST['pEmail'],
            ];
            header("Location: ../views/cadastrarCliente.php?erro=1");
        }
    } else if ($pOpcao == 4) { // alterar dados do cliente logado
        exigirLogin();

        $controller = new AuthController();
        $idCliente = $_SESSION['cliente']->id_cliente;
        $senha = trim($_REQUEST['pSenha']) !== '' ? $_REQUEST['pSenha'] : $_SESSION['cliente']->senha;

        try {
            $sucesso = $controller->alterar(
                $idCliente,
                $_REQUEST['pNome'],
                $_REQUEST['pCnpj'],
                $_REQUEST['pEndereco'],
                (int) $_REQUEST['pIdCidade'],
                $_REQUEST['pEmail'],
                $senha
            );

            if (!$sucesso) {
                throw new InvalidArgumentException('Este email ja esta em uso por outro cliente.');
            }

            $_SESSION['cliente'] = $controller->autenticar($_REQUEST['pEmail'], $senha);
            header("Location: ../views/meusDados.php?sucesso=1");
        } catch (InvalidArgumentException $e) {
            $_SESSION['erroCadastro'] = $e->getMessage();
            header("Location: ../views/meusDados.php?erro=1");
        }
    }
}

?>
