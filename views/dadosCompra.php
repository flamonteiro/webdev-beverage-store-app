<?php
      require_once '../models/item.inc.php';
      require_once '../dao/cidadeDAO.inc.php';
      require_once '../helpers/session.php';
      require_once "includes/cabecalho.inc.php";

      exigirLogin();
      calcularTotaisCarrinho();

      $carrinho = $_SESSION['carrinho'];
      $cliente = $_SESSION['cliente'];
      $total = $_SESSION['total'];
      $frete = $_SESSION['frete'];
      $cidade = (new CidadeDao())->buscarPorId($cliente->id_cidade);
?>

<h1 class="text-center my-4">Dados do Cliente</h1>

<div class="card mb-4">
  <div class="card-body" style="font-size: 1.15rem;">
    <p class="mb-2"><b>Nome:</b> <?= $cliente->nome ?></p>
    <p class="mb-2"><b>CNPJ:</b> <?= $cliente->cnpj ?></p>
    <p class="mb-2"><b>Endereço:</b> <?= $cliente->endereco ?></p>
    <p class="mb-2"><b>Cidade:</b> <?= $cidade->getCidade() ?> - <?= $cidade->getEstado() ?></p>
    <p class="mb-0"><b>Email:</b> <?= $cliente->email ?></p>
  </div>
</div>

<hr>

<h1 class="text-center my-4">Dados da Compra</h1>

<div class="table-responsive">
  <table class="table table-bordered table-striped text-center align-middle">
    <thead class="table-success">
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Volume</th>
        <th>Fabricante</th>
        <th>Preço Unitário</th>
        <th>Quantidade</th>
        <th>Valor Item</th>                
      </tr>
    </thead>
    <tbody class="table-group-divider">
      <?php foreach($carrinho as $item){ ?>
        <tr>
          <td><?= $item->getBebida()->getId_bebida() ?></td>
          <td><?= $item->getBebida()->getNome() ?></td>
          <td><?= $item->getBebida()->getVolume() ?></td>
          <td><?= $item->getBebida()->getFabricante() ?></td>
          <td>R$ <?= number_format($item->getBebida()->getPreco(), 2, ',', '.') ?></td>
          <td><?= $item->getQuantidade() ?></td>
          <td>R$ <?= number_format($item->getValorItem(), 2, ',', '.') ?></td>
        </tr>
      <?php } ?>

      <tr>
        <td colspan="6" class="text-end pe-4">Valor dos Itens</td>
        <td>R$ <?= number_format($total, 2, ',', '.') ?></td>
      </tr>
      <tr>
        <td colspan="6" class="text-end pe-4">Valor do Frete</td>
        <td>R$ <?= number_format($frete, 2, ',', '.') ?></td>
      </tr>
      <tr>
        <td colspan="6" class="text-end pe-4">
          <span class="fs-4 text-danger fw-bold">Valor Total</span>
        </td>
        <td>
          <span class="fs-4 text-danger fw-bold">R$ <?= number_format($total + $frete, 2, ',', '.') ?></span>
        </td>
      </tr>
    </tbody>
  </table>
</div>

<div class="container text-center my-5">
  <div class="row">
    <div class="col">
      <a class="btn btn-success btn-lg" role="button" href="dadosPagamento.php">
        <b>Efetuar o Pagamento</b>
      </a>
    </div>                 
  </div>
</div>

<!-- Rodape -->
<?php require_once "includes/rodape.inc.php" ?>