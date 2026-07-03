<?php
require_once __DIR__ . '/../config/database.php';

try {
    $conexao = new Conexao();
    $con = $conexao->getConexao();
    echo "Conexão OK!\n";

    $sql = $con->query("select count(*) as total from clientes");
    $row = $sql->fetch(PDO::FETCH_OBJ);
    echo "Tabela clientes acessível, total de registros: {$row->total}\n";
} catch (PDOException $e) {
    echo "Falha na conexão: " . $e->getMessage() . "\n";
}
