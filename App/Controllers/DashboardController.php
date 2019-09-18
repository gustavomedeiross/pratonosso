<?php
  class DashboardController extends Controller {
    public function renderIndex() {
      $this->render('Pages/dashboard');
    }
  }