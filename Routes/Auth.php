<?php
  class AuthMiddleware {
    public function verify() {
      if (!isset($_SESSION['user_name']) || !isset($_SESSION['user_email'])) {
        session_destroy();
        header('Location: /pratonosso/');
      }
    }
  }