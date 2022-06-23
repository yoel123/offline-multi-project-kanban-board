<?php

error_reporting(-1);
// Include router class
include('yapi/route/Route.php');

//need to change : "404_handler": "/index.php", in settings.json
include('routes/todos.php');
include('routes/cats.php');
include('routes/boards.php');


// Add base route (startpage)
Route::add('/',function(){
    include('header.php');
	

	$board_id = get_board_id();
	
	
	//get table objects
	$board = new ycrud($PDO,"board");
	$categories = new ycrud($PDO,"categories");
	$todo = new ycrud($PDO,"todo");
	
	//here i will put the todos in an array each position is a diffrent cat
	$todo_by_cat = array();
	
	//call boarf name by board id
	$board_row = $board->get_by_id($board_id);
	//call all cats (by board id)
	$all_cats = $categories->get_where("board_id = ".$board_id);
	
	//call all todos by cats
	foreach($all_cats as $cat)
	{
		//pupulate todo by cat put cat name as array pos and call all todos
		//by cat id
		$todo_by_cat[$cat['name']] = $todo->get_where("cat_id = ".$cat['id']);
	}
	
	
	$view = new Template(); 
	$view->title = "kanban board"; 
	$view->board_name = $board_row['name']; 
	$view->board_id = $board_id; 
	$view->cats = $all_cats;
	$view->todosr = $todo_by_cat;
	
	echo $view->render('./templates/index.ytpl'); 
});

Route::add('/code_gen',function(){
	 include('crud_gen.php');
});

Route::add('/export',function(){
	include('header.php');

	
});

Route::add('/code_gen',function(){
	 include('crud_gen.php');
},"post");








// Accept only numbers as parameter. Other characters will result in a 404 error
Route::add('/foo/([0-9]*)/([a-z-0-9]*)',function($var1,$v2){
    echo $var1.$v2.' is a great number!';
});

Route::run('/');
	

	/*

	
	*/



?>
