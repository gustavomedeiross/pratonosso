<?php
  class Database {
    static private $db_host = '';
    static private $db_name = '';
    static private $db_username = '';
    static private $db_password = '';
    static private $connection;

    private function __construct() {
      // Prevent more than one instance of database connections
    }

    public static function connect() {
      if (!isset(self::$connection)) {
        // Assign env values
        self:: $db_host = env('DB_HOST');
        self::$db_name = env('DB_NAME');
        self::$db_username = env('DB_USERNAME');
        self::$db_password = env('DB_PASSWORD');

        try {
          self::$connection = new PDO('mysql:host=' . self::$db_host . ';dbname=' . self::$db_name,
          self::$db_username,
          self::$db_password
        );

          self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
          self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $err) {
          echo 'Connection Error: ' . $err->getMessage();
        }

        return self::$connection;
      }

      return self::$connection;

    }
  }