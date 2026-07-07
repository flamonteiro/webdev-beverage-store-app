
<?php
    require_once '../models/bebida.inc.php';
    require_once '../helpers/session.php';
    require_once 'includes/cabecalho.inc.php';

    exigirAdmin();

    $bebida = $_SESSION['bebida'];
?>

<p>
<h1 class="text-center">Alteração de Bebida</h1>
<p>

<form class="row g-3" action="../controllers/BebidaController.php" method="post" enctype="multipart/form-data">

  <div class="col-md-2">
    <label for="pIdBebida" class="form-label">ID</label>
    <input type="text" class="form-control" name="pIdBebida" value="<?= $bebida->getId_bebida() ?>" readonly>
  </div>

  <div class="col-md-7">
    <label for="pNome" class="form-label">Nome</label>
    <input type="text" class="form-control" name="pNome" value="<?= $bebida->getNome() ?>">
  </div>

  <div class="col-md-3">
    <label for="pVolume" class="form-label">Volume</label>
    <input type="text" class="form-control" name="pVolume" value="<?= $bebida->getVolume() ?>" placeholder="Ex: 350ml">
  </div>

  <div class="col-md-3">
    <label for="pPreco" class="form-label">Preço</label>
    <input type="text" class="form-control" name="pPreco" value="<?= $bebida->getPreco() ?>">
  </div>

  <div class="col-md-3">
    <label for="pPeso" class="form-label">Peso (kg)</label>
    <input type="text" class="form-control" name="pPeso" value="<?= $bebida->getPeso() ?>">
  </div>

  <div class="col-md-3">
    <label for="pFabricante" class="form-label">Fabricante</label>
    <input type="text" class="form-control" name="pFabricante" value="<?= $bebida->getFabricante() ?>">
  </div>

  <div class="col-md-3">
    <label for="pQdeEstoque" class="form-label">Qde Estoque</label>
    <input type="text" class="form-control" name="pQdeEstoque" value="<?= $bebida->getQde_estoque() ?>">
  </div>

  <div class="col-md-6">
    <label for="pImagem" class="form-label">Imagem</label>
    <div class="mb-2">
      <img src="imagens/<?= $bebida->getImagem() ?>" alt="<?= $bebida->getNome() ?>" style="height: 60px; width: auto;" onerror="this.src='imagens/drinklogo.jpg'">
    </div>
    <input type="file" class="form-control" name="pImagem" accept="image/png, image/jpeg, image/webp, image/avif, image/gif">
    <div class="form-text">Deixe em branco para manter a imagem atual.</div>
    <input type="hidden" name="pImagemAtual" value="<?= $bebida->getImagem() ?>">
  </div>

  <div class="col-12 text-center mt-4">
    <button type="submit" class="btn btn-success">Alterar</button>
  </div>

  <!-- ALTERAR VALUE CONFORME O CONTROLLER -->
  <input type="hidden" name="opcao" value="5">
</form>

<?php
       require_once 'includes/rodape.inc.php';
?>