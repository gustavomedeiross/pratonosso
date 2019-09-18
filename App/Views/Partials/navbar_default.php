<nav class="navbar navbar-expand-sm navbar-light bg-light mb-5">
  <div class="container">

    <a class="navbar-brand text-muted" href="/pratonosso/">Prato Nosso</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Olá, <?php  echo $_SESSION['user_name'] ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <!-- <a class="dropdown-item" href="/pratonosso/perfil">Meu Perfil</a> -->
              <a class="dropdown-item" href="/pratonosso/minhas-receitas">Minhas Receitas</a>
              <a class="dropdown-item" href="/pratonosso/receitas/criar">Nova Receita</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-danger" href="/pratonosso/session/delete">Sair</a>
            </div>
          </li>

        <li class="nav-item">
          <a class="nav-link" href="/pratonosso/sobre-nos">Sobre</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/pratonosso/ajuda">Ajuda</a>
        </li>
      </ul>
    </div>
  </div>
</nav>