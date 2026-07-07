<?php
require_once __DIR__ . '/test_helper.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../dao/cidadeDAO.inc.php';
require_once __DIR__ . '/../dao/clienteDAO.inc.php';

$con = (new Conexao())->getConexao();
$cidadeDao = new CidadeDao();
$dao = new ClienteDao();

function buscarCliente($con, $id_cliente){
    $sql = $con->prepare("select * from clientes where id_cliente = :id");
    $sql->bindValue(':id', $id_cliente);
    $sql->execute();
    return $sql->fetch(PDO::FETCH_OBJ);
}

echo "== ClienteDao ==\n";

// precisa de uma cidade existente pra usar como id_cidade
$cidade = new Cidade();
$cidade->setCidade('Vila Velha Teste', 'ES', '29100-000', 0.05);
$cidadeDao->cadastrar($cidade);

$sqlCidade = $con->prepare("select id_cidade from cidades where cidade = :cidade");
$sqlCidade->bindValue(':cidade', 'Vila Velha Teste');
$sqlCidade->execute();
$id_cidade = $sqlCidade->fetch(PDO::FETCH_OBJ)->id_cidade;

// cadastrar
$cliente = new Cliente();
$cliente->setCliente('Cliente Teste', '12345678900010', 'Rua Teste, 123', $id_cidade, 'Teste@Email.com', 'Senha123');
$dao->cadastrar($cliente);

$sql = $con->prepare("select * from clientes where nome = :nome");
$sql->bindValue(':nome', 'Cliente Teste');
$sql->execute();
$row = $sql->fetch(PDO::FETCH_OBJ);

assertTrue($row !== false, 'cadastrar() insere o cliente');
assertTrue($row->email === 'teste@email.com', 'cadastrar() grava o email em minusculo');

$id = $row->id_cliente;

// emailExiste
assertTrue($dao->emailExiste('teste@email.com') === true, 'emailExiste() encontra email cadastrado');
assertTrue($dao->emailExiste('naoexiste@email.com') === false, 'emailExiste() nao encontra email inexistente');
assertTrue($dao->emailExiste('teste@email.com', $id) === false, 'emailExiste() ignora o proprio id ao editar');

// autenticar
$autenticado = $dao->autenticar('teste@email.com', 'Senha123');
assertTrue($autenticado !== null, 'autenticar() aceita email e senha corretos');
assertTrue($dao->autenticar('teste@email.com', 'SenhaErrada') === null, 'autenticar() rejeita senha errada');

// alterar
$clienteAlterado = new Cliente();
$clienteAlterado->setCliente('Cliente Teste', '12345678900010', 'Rua Nova, 456', $id_cidade, 'teste@email.com', 'NovaSenha456');
$dao->alterar($id, $clienteAlterado);

$row2 = buscarCliente($con, $id);
assertTrue($row2->endereco === 'Rua Nova, 456', 'alterar() atualiza o endereco');
assertTrue($dao->autenticar('teste@email.com', 'NovaSenha456') !== null, 'alterar() atualiza a senha');

// buscarPorId
$clienteBuscado = $dao->buscarPorId($id);
assertTrue($clienteBuscado instanceof Cliente, 'buscarPorId() retorna um objeto Cliente');
assertTrue($clienteBuscado->getId_cliente() == $id, 'buscarPorId() retorna o id correto');
assertTrue($clienteBuscado->getEndereco() === 'Rua Nova, 456', 'buscarPorId() reflete os dados atualizados');
assertTrue($dao->buscarPorId(999999) === null, 'buscarPorId() retorna null para id inexistente');

// listar
$clientes = $dao->listar();
$encontrado = null;
foreach($clientes as $c){
    if($c->getId_cliente() == $id){
        $encontrado = $c;
    }
}
assertTrue($encontrado !== null, 'listar() inclui o cliente cadastrado');
assertTrue($encontrado->getEmail() === 'teste@email.com', 'listar() traz os dados corretos');

// excluir
$dao->excluir($id);
$row3 = buscarCliente($con, $id);
assertTrue($row3 === false, 'excluir() remove o cliente');

// limpeza da cidade usada no teste
$cidadeDao->excluir($id_cidade);

resumoTestes();
