<?php
require_once __DIR__ . '/test_helper.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../dao/bebidaDAO.inc.php';

$con = (new Conexao())->getConexao();
$dao = new BebidaDao();

function buscarBebida($con, $id_bebida){
    $sql = $con->prepare("select * from bebidas where id_bebida = :id");
    $sql->bindValue(':id', $id_bebida);
    $sql->execute();
    return $sql->fetch(PDO::FETCH_OBJ);
}

echo "== BebidaDao ==\n";

// cadastrar
$bebida = new Bebida();
$bebida->setBebida('Cerveja Teste', '350ml', 5.50, 0.35, 100, 'Fabricante Teste');
$dao->cadastrar($bebida);

$sql = $con->prepare("select * from bebidas where nome = :nome");
$sql->bindValue(':nome', 'Cerveja Teste');
$sql->execute();
$row = $sql->fetch(PDO::FETCH_OBJ);

assertTrue($row !== false, 'cadastrar() insere a bebida');
assertTrue((int)$row->qde_estoque === 100, 'cadastrar() grava o estoque corretamente');

$id = $row->id_bebida;

// alterar
$bebidaAlterada = new Bebida();
$bebidaAlterada->setBebida('Cerveja Teste', '350ml', 6.00, 0.35, 80, 'Fabricante Teste');
$dao->alterar($id, $bebidaAlterada);

$row2 = buscarBebida($con, $id);
assertTrue((float)$row2->preco === 6.00, 'alterar() atualiza o preco');
assertTrue((int)$row2->qde_estoque === 80, 'alterar() atualiza o estoque');

// buscarPorId
$bebidaBuscada = $dao->buscarPorId($id);
assertTrue($bebidaBuscada instanceof Bebida, 'buscarPorId() retorna um objeto Bebida');
assertTrue($bebidaBuscada->getId_bebida() == $id, 'buscarPorId() retorna o id correto');
assertTrue((float)$bebidaBuscada->getPreco() === 6.00, 'buscarPorId() reflete os dados atualizados');
assertTrue($dao->buscarPorId(999999) === null, 'buscarPorId() retorna null para id inexistente');

// listar
$bebidas = $dao->listar();
$encontrada = null;
foreach($bebidas as $b){
    if($b->getId_bebida() == $id){
        $encontrada = $b;
    }
}
assertTrue($encontrada !== null, 'listar() inclui a bebida cadastrada');
assertTrue($encontrada->getNome() === 'Cerveja Teste', 'listar() traz os dados corretos');

// excluir
$dao->excluir($id);
$row3 = buscarBebida($con, $id);
assertTrue($row3 === false, 'excluir() remove a bebida');

// validacoes do model (nao usa banco)
assertThrows(function(){
    (new Bebida())->setBebida('Cerveja Teste', '350', 5.50, 0.35, 100, 'Fabricante Teste');
}, InvalidArgumentException::class, 'setBebida() rejeita volume sem unidade');

assertThrows(function(){
    (new Bebida())->setBebida('Cerveja Teste', 'abc', 5.50, 0.35, 100, 'Fabricante Teste');
}, InvalidArgumentException::class, 'setBebida() rejeita volume nao numerico');

assertThrows(function(){
    (new Bebida())->setBebida('Cerveja Teste', '350ml', 5.50, 0.35, 10.5, 'Fabricante Teste');
}, InvalidArgumentException::class, 'setBebida() rejeita estoque nao inteiro');

resumoTestes();
