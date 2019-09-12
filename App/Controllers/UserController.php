<?php  
  require_once 'App/Models/User.php';

  class UserController extends Controller {
    public function create() {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $confirm_password = $_POST['confirm_password'];

      $user = new User();

      $user->name = $name;
      $user->email = $email;
      $user->password = $password;

      // Validations
      $errors = [];

      if (strlen($password) < 6) {
        array_push($errors, 'A senha precisa ter no mínimo 6 caracteres');
      }

      if ($password !== $confirm_password) {
        array_push($errors, 'As senhas não estão iguais');
      }

      if ($user->findOne()) {
        array_push($errors, 'Esse email já está registrado');
      }

      if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        return header('Location: /pratonosso/cadastro');
      }

      return $user->create();

    }
  }
?>