<?php
require_once __DIR__ . '/test_helper.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../dao/cidadeDAO.inc.php';

$con = (new Conexao())->getConexao();
$dao = new CidadeDao();

function buscarCidade($con, $id_cidade){
    $sql = $con->prepare("select * from cidades where id_cidade = :id");
    $sql->bindValue(':id', $id_cidade);
    $sql->execute();
    return $sql->fetch(PDO::FETCH_OBJ);
}

echo "== CidadeDao ==\n";

// cadastrar
$cidade = new Cidade();
$cidade->setCidade('Vitoria Teste', 'ES', '29000-000', 0.05);
$dao->cadastrar($cidade);

$sql = $con->prepare("select * from cidades where cidade = :cidade");
$sql->bindValue(':cidade', 'Vitoria Teste');
$sql->execute();
$row = $sql->fetch(PDO::FETCH_OBJ);

assertTrue($row !== false, 'cadastrar() insere a cidade');
assertTrue($row->estado === 'ES', 'cadastrar() grava o estado corretamente');

$id = $row->id_cidade;

// alterar
$cidadeAlterada = new Cidade();
$cidadeAlterada->setCidade('Vitoria Teste', 'ES', '29000-111', 0.08);
$dao->alterar($id, $cidadeAlterada);

$row2 = buscarCidade($con, $id);
assertTrue($row2->CEP === '29000-111', 'alterar() atualiza o CEP');
assertTrue((float)$row2->valorfrete_porPeso === 0.08, 'alterar() atualiza o valor do frete');

// buscarPorId
$cidadeBuscada = $dao->buscarPorId($id);
assertTrue($cidadeBuscada instanceof Cidade, 'buscarPorId() retorna um objeto Cidade');
assertTrue($cidadeBuscada->getId_cidade() == $id, 'buscarPorId() retorna o id correto');
assertTrue($cidadeBuscada->getCEP() === '29000-111', 'buscarPorId() reflete os dados atualizados');
assertTrue($dao->buscarPorId(999999) === null, 'buscarPorId() retorna null para id inexistente');

// listar
$cidades = $dao->listar();
$encontrada = null;
foreach($cidades as $c){
    if($c->getId_cidade() == $id){
        $encontrada = $c;
    }
}
assertTrue($encontrada !== null, 'listar() inclui a cidade cadastrada');
assertTrue($encontrada->getCidade() === 'Vitoria Teste', 'listar() traz os dados corretos');

// excluir
$dao->excluir($id);
$row3 = buscarCidade($con, $id);
assertTrue($row3 === false, 'excluir() remove a cidade');

resumoTestes();
