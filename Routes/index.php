<?php
  // Views
  Route::get('/', 'PresentationController@renderIndex');
  Route::get('cadastro', 'SignUpController@renderIndex');
  Route::get('entrar', 'SignInController@renderIndex');
  Route::get('sobre-nos', 'AboutController@renderIndex');
  Route::get('ajuda', 'HelpController@renderIndex');


  Route::get('inicio', 'DashboardController@renderIndex', true);
  Route::get('minhas-receitas', 'RecipeController@renderIndex', true);
  Route::get('minhas-receitas/:id', 'RecipeController@renderShow', true);
  Route::get('receitas/criar', 'RecipeController@renderStore', true);
  Route::get('receitas/editar/:id', 'RecipeController@renderUpdate', true);

  // Just Logic
  Route::get('users/create', 'UserController@create');
  Route::get('session/create', 'SessionController@create');
  Route::get('session/delete', 'SessionController@delete', true);

  Route::get('recipes/store', 'RecipeController@store', true);
  Route::get('receitas/excluir/:id', 'RecipeController@delete', true);
  Route::get('recipes/update/:id', 'RecipeController@update', true);
?>