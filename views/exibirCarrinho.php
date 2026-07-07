<?php
      require_once '../classes/item.inc.php';
      require_once 'includes/cabecalho.inc.php';
?>

<h1 class="text-center my-4">Carrinho de Compra</h1>

<!-- OBS: CHECAR COM BACKEND/DADOS -->
<!-- <?php
     if(isset($_REQUEST['status'])){
            require_once 'includes/carrinhoVazio.inc.php';
     } else {
            $carrinho = $_SESSION['carrinho'];
            $cont = 1;
            $soma = 0;
?> -->

<div class="table-responsive">
  <table class="table table-light table-striped table-bordered text-center align-middle">
    <thead class="table-danger">
      <tr>
        <th style="width: 8%;">Item No</th>
        <th>ID</th>
        <th>Nome</th>
        <th>Volume</th>
        <th>Fabricante</th>
        <th>Preço Unitário</th>
        <th>Quantidade</th>
        <th>Total Item</th>                
        <th style="width: 10%;">Remover</th>
      </tr>
    </thead>
    <tbody class="table-group-divider">
      <?php foreach($carrinho as $item){ ?>
        <tr>
          <td><?= $cont ?></td>
          <td><?= $item->getBebida()->getIdBebida() ?></td>
          <td><strong><?= $item->getBebida()->getNome() ?></strong></td>
          <td><?= $item->getBebida()->getVolume() ?></td>
          <td><?= $item->getBebida()->getFabricante() ?></td>
          <td>R$ <?= number_format($item->getBebida()->getPreco(), 2, ',', '.') ?></td>
          <td><?= $item->getQuantidade() ?></td>
          <td>R$ <?= number_format($item->getValorItem(), 2, ',', '.') ?></td>
          <td>
            <a href="../controllers/inserirController.php?opcao=2&index=<?= $cont - 1 ?>" class='btn btn-danger btn-sm' title="Remover item">X</a>
          </td>   
        </tr>

      <?php 
          $cont++;
          $soma += $item->getValorItem();
        } 
      ?>
         
      <tr>
        <td colspan="9" class="text-end pe-4">
          <span class="fs-4 text-danger fw-bold">
            Valor Total = R$ <?= number_format($soma, 2, ',', '.') ?>
          </span>
        </td>
      </tr>
    </tbody>
  </table> 
</div>

<div class="container text-center my-5">
  <div class="row g-3">
    <div class="col-md-4">
      <a class="btn btn-warning w-100 fw-bold" role="button" href="../controllers/inserirController.php?opcao=6">
        Continuar Comprando
      </a>
    </div>
    <div class="col-md-4">
      <a class="btn btn-danger w-100 fw-bold" role="button" href="../controllers/inserirController.php?opcao=3">
        Esvaziar Carrinho
      </a>
    </div>
    <div class="col-md-4">
      <a class="btn btn-success w-100 fw-bold" role="button" href="../controllers/inserirController.php?opcao=5&total=<?= $soma ?>">
        Finalizar Compra
      </a>
    </div>
  </div>
</div>

<?php
     }
     require_once 'includes/rodape.inc.php';
?>