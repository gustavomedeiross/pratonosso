<?php
  require_once 'App/Models/User.php';

  class SessionController extends Controller {
    public function create() {
      $email = $_POST['email'];
      $password = $_POST['password'];

      $user = new User();

      $user->email = $email;
      $user->password = $password;

      $user_exists = $user->findOne();

      if (!$user_exists) {
        $_SESSION['error'] = 'Email não registrado';
        return header('Location: /pratonosso/entrar');
      }

      if (!$user->checkPassword()) {
        $_SESSION['error'] = 'Senha incorreta';
        return header('Location: /pratonosso/entrar');
      }

      $user->id = $user_exists->id;
      $user->name = $user_exists->name;

      $_SESSION['user_id'] = $user->id;
      $_SESSION['user_name'] = $user->name;
      $_SESSION['user_email'] = $user->email;

      header('Location: /pratonosso/minhas-receitas');
    }

    public function delete() {
      unset($_SESSION['user_id']);
      unset($_SESSION['user_name']);
      unset($_SESSION['user_email']);

      header('Location: /pratonosso/');
    }
  }
?>