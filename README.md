Controller methods:

```php
  $this->set($data); // Must be an associative array
  $this->render('ViewPath'); // From The views folder
```

Get params through Controller methods:

```php
class MyController {
  method($payload) {
    extract($payload);
    // Now I can get the variables set in the routes
  }
}
```

Set routes:

```php
  // The second argument must have the name of the file/controller and the method
  Route::get('my/route', 'MyController@method');

  // Set dynamic params
  Route::get('my/route/:myparam', 'MyController@method');
```
