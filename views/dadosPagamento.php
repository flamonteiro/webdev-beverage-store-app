<?php
     require_once 'includes/cabecalho.inc.php';
?>

<h1 class="text-center my-4">Opção de Pagamento</h1>

<div class="row">
  <div class="col-lg-6 mx-auto">
    <form action="../controllers/PedidoController.php" method="get" class="card p-4 shadow-sm">
      <p class="fs-5 mb-3">Escolha a sua opção de pagamento:</p>

      <div class="form-check mb-2">
        <input class="form-check-input" type="radio" name="pag" value="boleto" id="pagBoleto" required>
        <label class="form-check-label" for="pagBoleto">Boleto Bancário</label>
      </div>
      <div class="form-check mb-4">
        <input class="form-check-input" type="radio" name="pag" value="cartao" id="pagCartao">
        <label class="form-check-label" for="pagCartao">Cartão de Crédito</label>
      </div>

      <input type="hidden" value="1" name="opcao">
      <button type="submit" class="btn btn-success">Efetuar Pagamento</button>
    </form>
  </div>
</div>

<?php
       require_once('includes/rodape.inc.php');
?>