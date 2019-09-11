<?php 
  require_once 'Routes/Parser.php';

  class Route {
    private static $validRoutes = array();

    public static function get($route, $class_method) {
      array_push(self::$validRoutes, $route);

      Parser::dispatch($route, $class_method);
    }
  }

?>