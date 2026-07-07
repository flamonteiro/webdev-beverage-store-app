
<?php
    require_once '../models/cidade.inc.php';
    require_once '../helpers/session.php';
    require_once 'includes/cabecalho.inc.php';

    exigirAdmin();

    $cidade = $_SESSION['cidade'];
?>

<p>
<h1 class="text-center">Alteração de Cidade</h1>
<p>

<form class="row g-3" action="../controllers/CidadeController.php" method="post">

  <div class="col-md-2">
    <label for="cIdCidade" class="form-label">ID</label>
    <input type="text" class="form-control" name="cIdCidade" value="<?= $cidade->getId_cidade() ?>" readonly>
  </div>

  <div class="col-md-6">
    <label for="cCidade" class="form-label">Cidade</label>
    <input type="text" class="form-control" name="cCidade" value="<?= $cidade->getCidade() ?>" maxLength="30">
  </div>

  <div class="col-md-2">
    <label for="cEstado" class="form-label">Estado (UF)</label>
    <input type="text" class="form-control" name="cEstado" value="<?= $cidade->getEstado() ?>" maxLength="2">
  </div>

  <div class="col-md-4">
    <label for="cCEP" class="form-label">CEP</label>
    <input type="text" class="form-control" name="cCEP" value="<?= $cidade->getCEP() ?>" maxLength="9">
  </div>

  <div class="col-md-6">
    <label for="cValorFrete" class="form-label">Valor do Frete (por Peso)</label>
    <input type="text" class="form-control" name="cValorFrete" value="<?= $cidade->getValorfrete_porPeso() ?>">
  </div>

  <div class="col-md-6">
    <label for="cPeso" class="form-label">Peso Limite/Base (kg)</label>
    <input type="text" class="form-control" name="cPeso" value="<?= $cidade->getPeso() ?>">
  </div>

  <div class="col-12 text-center mt-4">
    <button type="submit" class="btn btn-success">Alterar</button>
  </div>

  <input type="hidden" name="opcao" value="5">
</form>

<?php
       require_once 'includes/rodape.inc.php';
?>
