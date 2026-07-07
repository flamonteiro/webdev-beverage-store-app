<?php        
      require_once '../utils/funcoesUteis.php';
      require_once 'includes/cabecalho.inc.php';

      // Recupera o histórico de compras/vendas da sessão
      $compras = isset($_SESSION['compras']) ? $_SESSION['compras'] : [];

      // Variáveis para calcular os indicadores do topo
      $totalVendasMatriz = count($compras);
      $faturamentoTotal = 0;
      $faturamentoFrete = 0;

      foreach($compras as $compra) {
          $faturamentoTotal += $compra->getValorTotal();
          $faturamentoFrete += $compra->getValorTotalFrete();
      }

      // Evita divisão por zero se não houver vendas
      $ticketMedio = $totalVendasMatriz > 0 ? ($faturamentoTotal / $totalVendasMatriz) : 0;
?>

<div class="container my-4">
  <h1 class="text-center mb-4 fw-bold text-secondary">Histórico de Vendas</h1>

  <!-- Cards de Resumo Financeiro -->
  <div class="row g-3 mb-5">
    <div class="col-md-4">
      <div class="card bg-success text-white shadow-sm">
        <div class="card-body text-center">
          <h6 class="card-title text-uppercase opacity-75">Faturamento Total</h6>
          <h2 class="display-6 fw-bold">R$ <?= number_format($faturamentoTotal, 2, ',', '.') ?></h2>
          <p class="card-text small">Valor total acumulado em produtos</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card bg-warning text-dark shadow-sm">
        <div class="card-body text-center">
          <h6 class="card-title text-uppercase opacity-75">Total Arrecadado (Frete)</h6>
          <h2 class="display-6 fw-bold">R$ <?= number_format($faturamentoFrete, 2, ',', '.') ?></h2>
          <p class="card-text small">Repassado para custos de envio</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card bg-dark text-white shadow-sm">
        <div class="card-body text-center">
          <h6 class="card-title text-uppercase opacity-75">Ticket Médio</h6>
          <h2 class="display-6 fw-bold">R$ <?= number_format($ticketMedio, 2, ',', '.') ?></h2>
          <p class="card-text small">Valor médio gasto por pedido</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Tabela de Pedidos -->
  <div class="card shadow-sm">
    <div class="card-header bg-dark text-white py-3">
      <h5 class="mb-0 fw-bold">🛒 Lista de Pedidos Realizados</h5>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover text-center align-middle mb-0">
          <thead class="table-primary">
            <tr>
              <th style="width: 10%;">ID Venda</th>
              <th>Cliente (CNPJ)</th>
              <th>Data da Compra</th>
              <th>Valor dos Itens</th>
              <th>Valor do Frete</th>
              <th>Total Geral</th>
              <th style="width: 12%;">Detalhes</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php if(empty($compras)) { ?>
              <tr>
                <td colspan="7" class="text-muted py-5 fs-5">
                  Nenhuma venda realizada até o momento.
                </td>
              </tr>
            <?php } else { 
              foreach($compras as $compra) { 
                $totalGeralPedido = $compra->getValorTotal() + $compra->getValorTotalFrete();
            ?>
              <tr>
                <td>#<?= $compra->getIdCompra() ?></td>
                <!-- Exibe os dados do cliente vinculado ao pedido (ou id_cliente caso não possua o objeto completo) -->
                <td>
                  <strong><?= method_exists($compra, 'getCliente') ? $compra->getCliente()->getNome() : "ID Cliente: " . $compra->getIdCliente() ?></strong>
                </td>
                <td><?= date("d/m/Y", strtotime($compra->getDataCompra())) ?></td>
                <td>R$ <?= number_format($compra->getValorTotal(), 2, ',', '.') ?></td>
                <td class="text-muted">R$ <?= number_format($compra->getValorTotalFrete(), 2, ',', '.') ?></td>
                <td class="text-success fw-bold">R$ <?= number_format($totalGeralPedido, 2, ',', '.') ?></td>
                <td>
                  <!-- Link para uma página futura onde lista os itens_compra daquele ID específico -->
                  <a href="detalhesPedido.php?id=<?= $compra->getIdCompra() ?>" class="btn btn-outline-primary btn-sm fw-bold">
                    Ver Itens
                  </a>
                </td>
              </tr>
            <?php }} ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php
       require_once 'includes/rodape.inc.php';
?>