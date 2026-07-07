<?php
$GLOBALS['__testes_ok'] = 0;
$GLOBALS['__testes_falha'] = 0;

function assertTrue($condicao, $descricao){
    if($condicao){
        echo "[OK] $descricao\n";
        $GLOBALS['__testes_ok']++;
    } else {
        echo "[FALHOU] $descricao\n";
        $GLOBALS['__testes_falha']++;
    }
}

function assertThrows(callable $callback, $exceptionClass, $descricao){
    try {
        $callback();
        assertTrue(false, $descricao);
    } catch (\Throwable $e) {
        assertTrue($e instanceof $exceptionClass, $descricao);
    }
}

function resumoTestes(){
    $ok = $GLOBALS['__testes_ok'];
    $falha = $GLOBALS['__testes_falha'];
    echo "\n$ok passaram, $falha falharam.\n";
}
