<?php
  // Views
  Route::get('/', 'PresentationController@index');
  Route::get('cadastro', 'SignUpController@index');
  Route::get('entrar', 'SignInController@index');
  Route::get('sobre-nos', 'AboutController@index');
  Route::get('inicio', 'DashboardController@index', true);

  // Route::get('receita/cadastrar', 'RecipeController@store');

  // Just Logic
  Route::get('users/create', 'UserController@create');
  Route::get('session/create', 'SessionController@create');
  Route::get('session/delete', 'SessionController@delete', true);
?>