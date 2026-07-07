
<?php
  include_once '../models/bebida.inc.php';
  require_once '../dao/bebidaDAO.inc.php';
  include_once 'includes/cabecalho.inc.php';
  $bebidas = (new BebidaDao())->listar();
?>
<style>
  .produto-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    border: 1px solid rgba(0, 0, 0, 0.08);
  }
  .produto-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.12);
  }
  .produto-card .card-img-top {
    height: 220px;
    object-fit: cover;
  }
  .produto-card .fabricante-badge {
    letter-spacing: 0.03em;
    text-transform: uppercase;
    font-size: 0.7rem;
  }
</style>

<h1 class="text-center">Show room de bebidas</h1>
<p>

<?php if(isset($_GET['semestoque'])) { ?>
  <div class="alert alert-warning text-center" role="alert">
    Quantidade solicitada indisponível em estoque para essa bebida.
  </div>
<?php } ?>

<div class="row row-cols-1 row-cols-md-5 g-4">

<?php
  foreach($bebidas as $bebida){
?>

<div class="col">
    <div class="card h-100 shadow-sm rounded-4 overflow-hidden produto-card">
      <img src="imagens/<?= $bebida->getImagem() ?>" class="card-img-top" alt="<?= $bebida->getNome() ?>" onerror="this.src='imagens/drinklogo.jpg'">
      <div class="card-body d-flex flex-column">
        <h5 class="card-title"><?= $bebida->getNome() ?></h5>
        <p class="card-text"><?= $bebida->getVolume() ?></p>
        <span class="badge bg-light text-secondary align-self-end fabricante-badge"><?= $bebida->getFabricante() ?></span>
        <h4 class="card-title text-danger fw-bold mt-2">R$<?= number_format($bebida->getPreco(), 2, ',', '.') ?></h4>
        <div class="mt-auto">
        <?php if($bebida->getQde_estoque() > 0) { ?>
          <form action="../controllers/CarrinhoController.php" method="get" class="d-flex gap-2">
            <input type="hidden" name="opcao" value="1">
            <input type="hidden" name="id" value="<?= $bebida->getId_bebida() ?>">
            <input type="number" name="quantidade" value="1" min="1" max="<?= $bebida->getQde_estoque() ?>" class="form-control form-control-sm" style="width: 70px;">
            <button type="submit" class="btn btn-danger btn-sm flex-fill">Comprar</button>
          </form>
        <?php } else { ?>
          <button type="button" class="btn btn-secondary btn-sm w-100" disabled>Sem estoque</button>
        <?php } ?>
        </div>
      </div>
    </div>
</div>

<?php
  }
?>
</div>

<?php require_once "includes/rodape.inc.php" ?>