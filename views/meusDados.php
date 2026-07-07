<?php
    require_once '../dao/cidadeDAO.inc.php';
    require_once '../helpers/session.php';
    require_once 'includes/cabecalho.inc.php';

    exigirLogin();

    $cliente = $_SESSION['cliente'];
    $cidadeDao = new CidadeDao();
    $cidades = $cidadeDao->listar();

    $erro = $_SESSION['erroCadastro'] ?? null;
    unset($_SESSION['erroCadastro']);
?>

<h1 class="text-center">Meus Dados</h1>

<?php if ($erro) { ?>
  <div class="alert alert-danger text-center" role="alert"><?= htmlspecialchars($erro) ?></div>
<?php } ?>
<?php if (isset($_GET['sucesso'])) { ?>
  <div class="alert alert-success text-center" role="alert">Dados atualizados com sucesso.</div>
<?php } ?>

<div class="row">
  <div class="col-lg-8 mx-auto">
    <form class="row g-3" action="../controllers/AuthController.php" method="post">

      <div class="col-md-8">
        <label for="pNome" class="form-label">Nome do Estabelecimento</label>
        <input type="text" class="form-control" name="pNome" value="<?= htmlspecialchars($cliente->nome) ?>" required>
      </div>

      <div class="col-md-4">
        <label for="pCnpj" class="form-label">CNPJ</label>
        <input type="text" class="form-control" name="pCnpj" value="<?= htmlspecialchars($cliente->cnpj) ?>" required>
      </div>

      <div class="col-12">
        <label for="pEndereco" class="form-label">Endereço</label>
        <input type="text" class="form-control" name="pEndereco" value="<?= htmlspecialchars($cliente->endereco) ?>" required>
      </div>

      <div class="col-md-6">
        <label for="pIdCidade" class="form-label">Cidade</label>
        <select class="form-select" name="pIdCidade" required>
          <?php foreach ($cidades as $cidade) { ?>
            <option value="<?= $cidade->getId_cidade() ?>" <?= $cidade->getId_cidade() == $cliente->id_cidade ? 'selected' : '' ?>>
              <?= htmlspecialchars($cidade->getCidade()) ?> - <?= htmlspecialchars($cidade->getEstado()) ?>
            </option>
          <?php } ?>
        </select>
      </div>

      <div class="col-md-6">
        <label for="pEmail" class="form-label">Email</label>
        <input type="email" class="form-control" name="pEmail" value="<?= htmlspecialchars($cliente->email) ?>" required>
      </div>

      <div class="col-md-6">
        <label for="pSenha" class="form-label">Nova Senha</label>
        <input type="password" class="form-control" name="pSenha" minlength="6" placeholder="Deixe em branco para manter a atual">
      </div>

      <div class="col-12 mt-4">
        <button type="submit" class="btn btn-success">Salvar Alterações</button>
      </div>

      <input type="hidden" name="pOpcao" value="4">
    </form>
  </div>
</div>

<?php require_once 'includes/rodape.inc.php'; ?>
