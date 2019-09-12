<div class="row">
  <div class="col-md-6 mx-auto">
    <div class="card card-body">
      <h3 class="text-center">Iniciar Sessão</h3>
      <form method="POST" action="session/create">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" class='form-control' placeholder="exemplo@pratonosso.com" required>
        </div>
        <div class="form-group">
          <label for="password">Sua Senha</label>
          <input type="password" name="password" class="form-control" placeholder="Sua senha" required>
        </div>
        <?php
        // Errors
          if (isset($_SESSION['error'])) {
              echo '<div class="alert alert-danger">
              '. $_SESSION['error'] . '
              </div>';
          }

          unset($_SESSION['error']);
        ?>
        <button type="submit" class='btn btn-primary btn-block'>Entrar</button>
      </form>
    </div>
  </div>
</div>