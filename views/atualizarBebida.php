
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
      <img id="imgPreview" src="imagens/<?= $bebida->getImagem() ?>" alt="<?= $bebida->getNome() ?>" style="height: 60px; width: auto;" onerror="this.src='imagens/drinklogo.jpg'">
    </div>
    <input type="file" class="form-control" id="pImagem" name="pImagem" accept="image/png, image/jpeg, image/webp, image/avif, image/gif">
    <div class="form-text">Deixe em branco para manter a imagem atual.</div>
    <button type="button" class="btn btn-outline-danger btn-sm mt-2 d-none" id="btnRemoverImagem">Remover imagem selecionada</button>
    <input type="hidden" name="pImagemAtual" value="<?= $bebida->getImagem() ?>">
  </div>

  <script>
    (function () {
      var input = document.getElementById('pImagem');
      var preview = document.getElementById('imgPreview');
      var btnRemover = document.getElementById('btnRemoverImagem');
      var imagemAtual = 'imagens/<?= addslashes($bebida->getImagem()) ?>';

      input.addEventListener('change', function () {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            preview.src = e.target.result;
          };
          reader.readAsDataURL(input.files[0]);
          btnRemover.classList.remove('d-none');
        }
      });

      btnRemover.addEventListener('click', function () {
        input.value = '';
        preview.src = imagemAtual;
        btnRemover.classList.add('d-none');
      });
    })();
  </script>

  <div class="col-12 text-center mt-4">
    <button type="submit" class="btn btn-success">Alterar</button>
  </div>

  <!-- ALTERAR VALUE CONFORME O CONTROLLER -->
  <input type="hidden" name="opcao" value="5">
</form>

<?php
       require_once 'includes/rodape.inc.php';
?>