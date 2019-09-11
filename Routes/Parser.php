<?php

  class Parser {

    private static function parseURL($url) {
      $request_url = str_replace('/pratonosso/', '', $url);

      if ($request_url[strlen($request_url) - 1] === '/') {
        $request_url = substr($request_url, 0, -1);
      }

      return $request_url;
    }

    private static function checkIfHasParams($route) {
      if (substr_count($route, '/:')) {
        return true;
      }
      return false;
    }
    
    private static function checkParamPosition($route) {
      return strpos($route, ':');
    }

    private static function splitRouteWithParam($route) {
      $pos = self::checkParamPosition($route);
      $route_without_param = substr($route, 0, $pos);
      $param_name = substr($route, $pos + 1);

      return compact('route_without_param', 'param_name');
    }

    private static function compareRouteWithParam($request_url, $route) {
      if (strpos($request_url, $route) !== false) {
        return true;
      } 
      return false;
    }

    private static function getParamValue($request_url, $route, $param_name, $param_pos) { 
      // Check if "/:param" contains the last "/" in the url
      if (strrpos($route, '/') === $param_pos -1) {
        $regex = '/\w+/';

        $params = [$param_name => substr($request_url, $param_pos)];
        $matches = preg_match($regex, $params[$param_name]);
        
        if ($matches) {
          return $params;
        }
      }
    }

    public static function dispatch($route, $class_method) {
      $request_url = self::parseURL($_SERVER['REQUEST_URI']);

      $hasParam = self::checkIfHasParams($route);

      // Route support params
      if ($hasParam) {
        $splited_route = self::splitRouteWithParam($route);
        extract($splited_route);
        $route_matches = self::compareRouteWithParam($request_url, $route_without_param);

        if ($route_matches) {
          $param_pos = self::checkParamPosition($route);
          $params = self::getParamValue($request_url, $route, $param_name, $param_pos);

          return self::callController($class_method, $params);
        }
      }

      // Route does not support params
      if ($request_url === $route) {
        return self::callController($class_method, null);
      }
    }

    private static function callController($class_method, $params) {
        $class_method = explode('@', $class_method);
        $class = $class_method[0];
        $method = $class_method[1];

        require_once 'App/Controllers/' . $class . '.php';

        if ($params) {
          return call_user_func([new $class, $method], $params);
        }

        return call_user_func([new $class, $method]);
    }
  }

?>