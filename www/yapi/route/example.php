<?php


// Include router class
include('yapi/route/Route.php');
//need to change : "404_handler": "/index.php", in settings.json

// Add base route (startpage)
Route::add('/',function(){
    echo 'Welcome :-) <a href="/contact-form">bla</a>';
	/*$routes = Route::$routes;
	foreach($routes as $route) {
	  echo $route['expression'].' ('.$route['method'].')';
	}*/
});

Route::add('/banana',function(){
    echo 'banana';
});

// Simple test route that simulates static html file
Route::add('/test.html',function(){
    echo 'Hello from test.html';
});

// Post route example
Route::add('/contact-form',function(){
    echo '<form method="post"><input type="text" name="test" /><input type="submit" value="send" /></form>';
},'get');

// Post route example
Route::add('/contact-form',function(){
    echo 'Hey! The form has been sent:<br/>';
    print_r($_POST);
},'post');

// Accept only numbers as parameter. Other characters will result in a 404 error
Route::add('/foo/([0-9]*)/bar',function($var1){
    echo $var1.' is a great number!';
});


//Route::add('/arrow/([a-z-0-9-]*)', fn($foo) => 'This is a working arrow function example. Parameter: '.$foo );

Route::run('/');
	




?>
