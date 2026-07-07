<?php        
      require_once '../models/bebida.inc.php';
      require_once '../models/cidade.inc.php';
      require_once '../helpers/session.php';
      require_once 'includes/cabecalho.inc.php';

      exigirAdmin();

      // Recupera os dados das sessões
      $bebidas = isset($_SESSION['bebidas']) ? $_SESSION['bebidas'] : [];
      $cidades = isset($_SESSION['cidades']) ? $_SESSION['cidades'] : [];

      // Cálculos rápidos para os Cards de Indicadores
      $totalBebidasCadastradas = count($bebidas);
      $totalCidadesAtendidas = count($cidades);

      $totalEstoqueGeral = 0;
      $bebidasAlertaEstoque = 0;
      foreach($bebidas as $b) {
          $totalEstoqueGeral += $b->getQde_estoque();
          if($b->getQde_estoque() < 10) { // Alerta se o estoque for menor que 10 unidades
              $bebidasAlertaEstoque++;
          }
      }
?>

<div class="container-fluid my-4">
  <h1 class="text-center mb-4 fw-bold text-secondary">Dashboard de Controle Geral</h1>

  <!-- Linha de Cards de Indicadores Rápidos -->
  <div class="row g-3 mb-5">
    <div class="col-md-3">
      <div class="card bg-primary text-white h-100 shadow-sm">
        <div class="card-body text-center">
          <h6 class="card-title text-uppercase opacity-75">Tipos de Bebidas</h6>
          <h2 class="display-5 fw-bold"><?= $totalBebidasCadastradas ?></h2>
          <p class="card-text small">Cadastradas no sistema</p>
        </div>
      </div>
    </div>
    
    <div class="col-md-3">
      <div class="card bg-success text-white h-100 shadow-sm">
        <div class="card-body text-center">
          <h6 class="card-title text-uppercase opacity-75">Total em Estoque</h6>
          <h2 class="display-5 fw-bold"><?= $totalEstoqueGeral ?></h2>
          <p class="card-text small">Unidades físicas armazenadas</p>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card bg-info text-white h-100 shadow-sm">
        <div class="card-body text-center">
          <h6 class="card-title text-uppercase opacity-75">Cidades Atendidas</h6>
          <h2 class="display-5 fw-bold"><?= $totalCidadesAtendidas ?></h2>
          <p class="card-text small">Com rotas de frete configuradas</p>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card <?= $bebidasAlertaEstoque > 0 ? 'bg-danger' : 'bg-secondary' ?> text-white h-100 shadow-sm">
        <div class="card-body text-center">
          <h6 class="card-title text-uppercase opacity-75">Estoque Crítico</h6>
          <h2 class="display-5 fw-bold"><?= $bebidasAlertaEstoque ?></h2>
          <p class="card-text small">Bebidas com menos de 10 unid.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Linha de Tabelas Lado a Lado (Visão Geral) -->
  <div class="row g-4">
    
    <!-- Coluna 1: Controle de Bebidas -->
    <div class="col-xl-7">
      <div class="card shadow-sm">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-middle py-3">
          <h5 class="mb-0 fw-bold align-self-center">📦 Visão Geral do Estoque de Bebidas</h5>
          <a href="cadastrarBebida.php" class="btn btn-outline-light btn-sm fw-bold">+ Nova Bebida</a>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-hover text-center align-middle mb-0">
              <thead class="table-secondary sticky-top">
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Volume</th>
                  <th>Preço</th>
                  <th>Qde.</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php if(empty($bebidas)) { ?>
                  <tr><td colspan="6" class="text-muted py-4">Nenhuma bebida cadastrada.</td></tr>
                <?php } else {
                  foreach($bebidas as $bebida) {
                    $critico = $bebida->getQde_estoque() < 10;
                ?>
                  <tr class="<?= $critico ? 'table-danger' : '' ?>">
                    <td><?= $bebida->getId_bebida() ?></td>
                    <td><strong><?= $bebida->getNome() ?></strong></td>
                    <td><?= $bebida->getVolume() ?></td>
                    <td>R$ <?= number_format($bebida->getPreco(), 2, ',', '.') ?></td>
                    <td>
                      <span class="badge <?= $critico ? 'bg-danger' : 'bg-dark' ?> fs-6">
                        <?= $bebida->getQde_estoque() ?>
                      </span>
                    </td>
                    <td>
                      <a href='../controllers/BebidaController.php?opcao=4&id=<?= $bebida->getId_bebida() ?>' class='btn btn-success btn-sm' title="Editar">A</a>
                    </td>
                  </tr>
                <?php }} ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Coluna 2: Cidades e Logística -->
    <div class="col-xl-5">
      <div class="card shadow-sm">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-middle py-3">
          <h5 class="mb-0 fw-bold align-self-center">📍 Cidades e Fretes</h5>
          <a href="cadastrarCidade.php" class="btn btn-outline-light btn-sm fw-bold">+ Nova Cidade</a>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-hover text-center align-middle mb-0">
              <thead class="table-secondary sticky-top">
                <tr>
                  <th>Cidade/UF</th>
                  <th>CEP</th>
                  <th>Frete (por Peso)</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php if(empty($cidades)) { ?>
                  <tr><td colspan="4" class="text-muted py-4">Nenhuma cidade cadastrada.</td></tr>
                <?php } else {
                  foreach($cidades as $cidade) {
                ?>
                  <tr>
                    <td><strong><?= $cidade->getCidade() ?></strong> - <?= $cidade->getEstado() ?></td>
                    <td><small class="text-muted"><?= $cidade->getCEP() ?></small></td>
                    <td>R$ <?= number_format($cidade->getValorfrete_porPeso(), 2, ',', '.') ?></td>
                    <td>
                      <a href='../controllers/CidadeController.php?opcao=4&id=<?= $cidade->getId_cidade() ?>' class='btn btn-success btn-sm' title="Editar">A</a>
                    </td>
                  </tr>
                <?php }} ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<?php
       require_once 'includes/rodape.inc.php';
?>