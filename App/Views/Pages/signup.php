 

<div class="row">
  <div class="col-md-6 mx-auto">
    <div class="card card-body">
      <h3 class="text-center">Nova Conta</h3>
      
      <form action="/pratonosso/users/create" method="POST">
        <div class="form-group">
          <label for="name">Nome</label>
          <input type="text" name="name" class='form-control' placeholder="ex: Joaquim da Silva" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" class='form-control' placeholder="ex: exemplo@gmail.com" required>
        </div>
        <div class="form-group">
          <label for="password">Senha</label>
          <input type="password" name="password" class="form-control" placeholder="Sua senha" required>
        </div>
        <div class="form-group">
          <label for="">Confirmação de senha</label>
          <input type="password" name="confirm_password" class="form-control" placeholder="Confirme a sua senha" required>
        </div>

        <?php
        // Errors
          if (isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $error) {
              echo '<div class="alert alert-danger">
              '. $error . '
              </div>';
            }
          }

          unset($_SESSION['errors']);
        ?>

        <button type="submit" class='btn btn-primary btn-block'>Criar Conta</button>
      </form>
    </div>
  </div>
</div>