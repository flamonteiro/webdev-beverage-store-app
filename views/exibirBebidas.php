<?php        
      require_once '../models/bebida.inc.php';
      require_once 'includes/cabecalho.inc.php';

      $bebidas = $_SESSION['bebidas'];
?>

<h1 class="text-center my-4">Bebidas no Estoque</h1>

<div class="table-responsive">
  <table class="table table-light table-hover table-bordered text-center align-middle">
    <thead class="table-primary">
      <tr>
        <th style="width: 8%;">ID</th>
        <th>Nome</th>
        <th>Volume</th>
        <th>Peso</th>
        <th>Preço Unitário</th>
        <th>Qde. Estoque</th>
        <th>Fabricante</th>
        <th style="width: 12%;">Operação</th>
      </tr>
    </thead>
    <tbody class="table-group-divider">
      <?php foreach($bebidas as $bebida) { ?>
        <tr>
          <td><?= $bebida->getId_bebida() ?></td>
          <td><strong><?= $bebida->getNome() ?></strong></td>
          <td><?= $bebida->getVolume() ?></td>
          <td><?= $bebida->getPeso() ?> kg</td>
          <td>R$ <?= number_format($bebida->getPreco(), 2, ',', '.') ?></td>
          <td><?= $bebida->getQde_estoque() ?></td>
          <td><?= $bebida->getFabricante() ?></td>
          <td>
            <a href='../controllers/BebidaController.php?opcao=4&id=<?= $bebida->getId_bebida() ?>' class='btn btn-success btn-sm' title="Alterar">A</a>
            <a href='../controllers/BebidaController.php?opcao=3&id=<?= $bebida->getId_bebida() ?>' class='btn btn-danger btn-sm' title="Excluir">X</a>
          </td>
        </tr>
      <?php } ?>
    </tbody> 
  </table>
</div>

<?php
       require_once 'includes/rodape.inc.php';
?>