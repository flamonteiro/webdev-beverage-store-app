<?php
class Sessao
{
    public static function iniciar()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function definir($chave, $valor)
    {
        self::iniciar();
        $_SESSION[$chave] = $valor;
    }

    public static function obter($chave, $padrao = null)
    {
        self::iniciar();
        return isset($_SESSION[$chave]) ? $_SESSION[$chave] : $padrao;
    }

    public static function existe($chave)
    {
        self::iniciar();
        return isset($_SESSION[$chave]);
    }

    public static function excluir($chave)
    {
        self::iniciar();
        if (self::existe($chave)) {
            unset($_SESSION[$chave]);
        }
    }

    public static function destruir()
    {
        self::iniciar();
        $_SESSION = array();
        
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        
        session_destroy();
    }

    public static function logarCliente($cliente)
    {
        self::iniciar();
        self::definir('cliente_logado', $cliente);
        self::definir('tipo_usuario', 'cliente');
    }

    public static function logarAdmin($admin)
    {
        self::iniciar();
        self::definir('admin_logado', $admin);
        self::definir('tipo_usuario', 'admin');
    }

    public static function estaLogadoComoCliente()
    {
        return self::existe('cliente_logado') && self::obter('tipo_usuario') === 'cliente';
    }

    public static function estaLogadoComoAdmin()
    {
        return self::existe('admin_logado') && self::obter('tipo_usuario') === 'admin';
    }

    public static function getClienteLogado()
    {
        return self::obter('cliente_logado');
    }

    public static function getAdminLogado()
    {
        return self::obter('admin_logado');
    }

    public static function deslogar()
    {
        self::excluir('cliente_logado');
        self::excluir('admin_logado');
        self::excluir('tipo_usuario');
        self::destruir();
    }

    public static function setFlash($chave, $mensagem)
    {
        self::iniciar();
        $_SESSION['flash'][$chave] = $mensagem;
    }

    public static function getFlash($chave)
    {
        self::iniciar();
        if (isset($_SESSION['flash'][$chave])) {
            $mensagem = $_SESSION['flash'][$chave];
            unset($_SESSION['flash'][$chave]);
            return $mensagem;
        }
        return null;
    }

    public static function adicionarAoCarrinho($id_bebida, $quantidade = 1)
    {
        self::iniciar();
        $carrinho = self::obter('carrinho', array());
        
        if (isset($carrinho[$id_bebida])) {
            $carrinho[$id_bebida] += $quantidade;
        } else {
            $carrinho[$id_bebida] = $quantidade;
        }
        
        self::definir('carrinho', $carrinho);
    }

    public static function atualizarCarrinho($id_bebida, $quantidade)
    {
        self::iniciar();
        $carrinho = self::obter('carrinho', array());
        
        if ($quantidade <= 0) {
            unset($carrinho[$id_bebida]);
        } else {
            $carrinho[$id_bebida] = $quantidade;
        }
        
        self::definir('carrinho', $carrinho);
    }

    public static function removerDoCarrinho($id_bebida)
    {
        self::iniciar();
        $carrinho = self::obter('carrinho', array());
        
        if (isset($carrinho[$id_bebida])) {
            unset($carrinho[$id_bebida]);
        }
        
        self::definir('carrinho', $carrinho);
    }

    public static function getCarrinho()
    {
        return self::obter('carrinho', array());
    }

    public static function limparCarrinho()
    {
        self::excluir('carrinho');
    }
}
?>
