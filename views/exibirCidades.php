<?php        
      require_once '../classes/cidade.inc.php'; // Incluindo a classe de cidade correspondente
      require_once '../utils/funcoesUteis.php';
      require_once 'includes/cabecalho.inc.php';

      // Carrega a lista de cidades
      $cidades = $_SESSION['cidades'];
?>

<h1 class="text-center my-4">Cidades Cadastradas</h1>

<div class="table-responsive">
  <table class="table table-light table-hover table-bordered text-center align-middle">
    <thead class="table-primary">
      <tr>
        <th style="width: 8%;">ID</th>
        <th>Cidade</th>
        <th>Estado</th>
        <th>CEP</th>
        <th>Frete por Peso</th>
        <th>Peso Base</th>
        <th style="width: 12%;">Operação</th>
      </tr>
    </thead>
    <tbody class="table-group-divider">
      <?php foreach($cidades as $cidade) { ?>
        <tr>
          <td><?= $cidade->getIdCidade() ?></td>
          <td><strong><?= $cidade->getCidade() ?></strong></td>
          <td><?= $cidade->getEstado() ?></td>
          <td><?= $cidade->getCEP() ?></td>
          <td>R$ <?= number_format($cidade->getValorFretePorPeso(), 2, ',', '.') ?></td>
          <td><?= $cidade->getPeso() ?> kg</td>
          <td>
            
            <a href='../controllers/inserirController.php?opcao=4&id=<?= $cidade->getIdCidade() ?>' class='btn btn-success btn-sm' title="Alterar">A</a>
            <a href='../controllers/inserirController.php?opcao=3&id=<?= $cidade->getIdCidade() ?>' class='btn btn-danger btn-sm' title="Excluir">X</a>
          </td>
        </tr>
      <?php } ?>
    </tbody> 
  </table>
</div>

<?php
       require_once 'includes/rodape.inc.php';
?>