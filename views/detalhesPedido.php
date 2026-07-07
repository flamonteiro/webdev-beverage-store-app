<?php
      require_once '../controllers/PedidoController.php';
      require_once '../dao/bebidaDAO.inc.php';
      require_once '../helpers/session.php';
      require_once "includes/cabecalho.inc.php";

      exigirAdmin();

      $id_compra = (int) $_GET['id'];

      $pedidoController = new PedidoController();
      $pedido = $pedidoController->buscarPorId($id_compra);
      $itens = $pedidoController->listarItens($id_compra);
      $bebidaDao = new BebidaDao();
?>

<div class="container my-4">
  <h1 class="text-center mb-4 fw-bold text-secondary">Detalhes do Pedido #<?= $id_compra ?></h1>

  <?php if($pedido === null) { ?>
    <div class="alert alert-warning text-center">Pedido não encontrado.</div>
  <?php } else { ?>

  <div class="card mb-4 shadow-sm">
    <div class="card-body">
      <p class="mb-1"><b>Data da Compra:</b> <?= date("d/m/Y", $pedido->getDataCompra()) ?></p>
      <p class="mb-1"><b>Valor dos Itens:</b> R$ <?= number_format($pedido->getValorTotal(), 2, ',', '.') ?></p>
      <p class="mb-1"><b>Valor do Frete:</b> R$ <?= number_format($pedido->getValortotalFrete(), 2, ',', '.') ?></p>
      <p class="mb-0"><b>Total Geral:</b> R$ <?= number_format($pedido->getValorTotal() + $pedido->getValortotalFrete(), 2, ',', '.') ?></p>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-striped text-center align-middle">
      <thead class="table-primary">
        <tr>
          <th>Bebida</th>
          <th>Volume</th>
          <th>Quantidade</th>
          <th>Valor do Item</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($itens as $item) {
              $bebida = $bebidaDao->buscarPorId($item->id_bebida);
        ?>
          <tr>
            <td><?= $bebida !== null ? $bebida->getNome() : "Bebida #".$item->id_bebida ?></td>
            <td><?= $bebida !== null ? $bebida->getVolume() : '-' ?></td>
            <td><?= $item->quantidade ?></td>
            <td>R$ <?= number_format($item->valor_item, 2, ',', '.') ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  <?php } ?>

  <div class="text-center mt-4">
    <a href="../controllers/PedidoController.php?opcao=2" class="btn btn-secondary">Voltar para o Histórico</a>
  </div>
</div>

<?php require_once 'includes/rodape.inc.php'; ?>
