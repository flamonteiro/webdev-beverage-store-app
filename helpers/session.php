<?php

function exigirAdmin()
{
    if (!isset($_SESSION['cliente'])) {
        header("Location: ../views/formLogin.php");
        exit;
    }

    if ($_SESSION['cliente']->tipo !== 'A') {
        header("Location: ../views/index.php?acessoNegado=1");
        exit;
    }
}

?>
