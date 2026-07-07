<?php

function exigirLogin()
{
    if (!isset($_SESSION['cliente'])) {
        header("Location: ../views/formLogin.php");
        exit;
    }
}

function exigirAdmin()
{
    exigirLogin();

    if ($_SESSION['cliente']->tipo !== 'A') {
        header("Location: ../views/index.php?acessoNegado=1");
        exit;
    }
}

?>
