<?php
    require_once '../dao/cidadeDAO.inc.php';
    require_once '../helpers/session.php';
    require_once 'includes/cabecalho.inc.php';

    exigirAdmin(); // cadastro de clientes e restrito ao administrador

    $cidadeDao = new CidadeDao();
    $cidades = $cidadeDao->listar();

    $erro = $_SESSION['erroCadastro'] ?? null;
    unset($_SESSION['erroCadastro']);
?>

<h1 class="text-center">Cadastro de Cliente</h1>

<?php if ($erro) { ?>
  <div class="alert alert-danger text-center" role="alert"><?= htmlspecialchars($erro) ?></div>
<?php } ?>
<?php if (isset($_GET['sucesso'])) { ?>
  <div class="alert alert-success text-center" role="alert">Cliente cadastrado com sucesso.</div>
<?php } ?>

<div class="row">
  <div class="col-lg-8 mx-auto">
    <form class="row g-3" action="../controllers/AuthController.php" method="post">

      <div class="col-md-8">
        <label for="pNome" class="form-label">Nome do Estabelecimento</label>
        <input type="text" class="form-control" name="pNome" required>
      </div>

      <div class="col-md-4">
        <label for="pCnpj" class="form-label">CNPJ</label>
        <input type="text" class="form-control" name="pCnpj" required>
      </div>

      <div class="col-12">
        <label for="pEndereco" class="form-label">Endereço</label>
        <input type="text" class="form-control" name="pEndereco" required>
      </div>

      <div class="col-md-6">
        <label for="pIdCidade" class="form-label">Cidade</label>
        <select class="form-select" name="pIdCidade" required>
          <option value="" disabled selected>Selecione a cidade</option>
          <?php foreach ($cidades as $cidade) { ?>
            <option value="<?= $cidade->getId_cidade() ?>"><?= htmlspecialchars($cidade->getCidade()) ?> - <?= htmlspecialchars($cidade->getEstado()) ?></option>
          <?php } ?>
        </select>
      </div>

      <div class="col-md-6">
        <label for="pEmail" class="form-label">Email</label>
        <input type="email" class="form-control" name="pEmail" required>
      </div>

      <div class="col-md-6">
        <label for="pSenha" class="form-label">Senha</label>
        <input type="password" class="form-control" name="pSenha" minlength="6" required>
      </div>

      <div class="col-md-6">
        <label for="pSenhaConfirma" class="form-label">Confirmar Senha</label>
        <input type="password" class="form-control" name="pSenhaConfirma" minlength="6" required>
      </div>

      <div class="col-12 mt-4">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <button type="reset" class="btn btn-danger">Cancelar</button>
      </div>

      <input type="hidden" name="pOpcao" value="3">
    </form>
  </div>
</div>

<?php require_once 'includes/rodape.inc.php'; ?>
