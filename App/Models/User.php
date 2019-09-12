<?php
  class User extends Model {
    private $connection;
    private $table = 'users';

    public $id;
    public $name;
    public $email;
    public $password;
    private $password_hash;
    private $created_at;
    private $updated_at;

    public function __construct() {
      $db = Database::connect();
      $this->connection = $db;
    }

    public function findOne() {
     $this->email = $this->secureInput($this->email);

      $query = 'SELECT * FROM ' . $this->table . ' WHERE email = :email';
      $stmt = $this->connection->prepare($query);
      $stmt->execute(['email' => $this->email]);
      
      $stmt->execute(['email'=>$this->email]);
      
      $response = $stmt->fetch();

      return $response;
    }

    public function create() {
      $this->name = $this->secureInput($this->name);
      $this->email = $this->secureInput($this->email);
      $this->password = $this->secureInput($this->password);

      $this->password_hash = password_hash($this->password, PASSWORD_BCRYPT);

      $query = 'INSERT INTO ' . $this->table . 
      ' (name, email, password_hash) VALUES(:name, :email, :password_hash)';


      $stmt = $this->connection->prepare($query);

      $stmt->bindParam('name', $this->name);
      $stmt->bindParam('email', $this->email);
      $stmt->bindParam('password_hash', $this->password_hash);

      if ($stmt->execute()) {
        return ['name' => $this->name, 'email' => $this->email];
      }

      return new Error('Algo deu errado');
    }

    public function checkPassword() {
      $this->email = $this->secureInput($this->email);
      $this->password = $this->secureInput($this->password);


      if (!isset($this->password)) {
        throw new Error("You can't check the password if you don't have a password set");
        return;
      }

      if (!isset($this->email)) {
        throw new Error("You can't check the password if you don't have an email set");
        return;
      }

      if (!isset($this->password_hash)) {
        $user_data = $this->findOne($this->email);
        $this->password_hash = $user_data->password_hash;
      }

      return password_verify($this->password, $this->password_hash);
    }
  }