<?php

//todo
Route::add('/admin/todo',function(){
	include('header.php');
	$html = "<a href='/'>back</a>";
	$html .= "<h1>todo</h1>";
	$table_todo = new ycrud($PDO,"todo");
	$all_todo = $table_todo ->get_all();
	$html .= ycrud_table("todo",$all_todo,array('name'),"/add_todo");
	
	
	$view = new Template(); 
	$view->title = "admin todo"; 
	$view->content = $html; 
	echo $view->render('./templates/main.ytpl'); 
	
});

	
// add todo form
Route::add('/add_todo',function(){
	include('header.php');
	$board_id = get_board_id();
	$cats = new ycrud($PDO,"categories");
	$cats_by_board = $cats->get_where("board_id = ".$board_id);
	
	$select_data = yform::convert_to_select_data($cats_by_board,"id","name",$selected = false);
	
	//html form
    $form_todo = new yform("add_todo","POST","add_todo","");
	$form_todo->text("name","","text","name",0,"placeholder txt");
	$form_todo->textarea("desc","","",0,"the content");
	//$form_todo->text("cat_id","","text","cat_id",0,"placeholder txt");
	$form_todo->select("cat_id","","category",$select_data,"placeholder");

	$form_todo->text("color","color_picker","text","color",0,"");
		
	$form_todo ->submit("sub","submit");
	$html = $form_todo ->create();
		
    $view = new Template(); 
	$view->title = "admin todo"; 
	$view->content = $html; 
	echo $view->render('./templates/main.ytpl');
});	
	
// edit todo form
Route::add('/edit_todo/([a-z-0-9]*)',function($id){
	include('header.php');
	
	//get post data
	$table_todo = new ycrud($PDO,"todo");
	$get_todo = $table_todo ->get_where("id='".$id."'")[0];

	//html form
    $form_todo = new yform("/edit_todo/".$get_todo ['id']."","POST","add_post","");
	$form_todo->text("name","","text","name",0,"placeholder txt","s12",$get_todo["name"]);
	$form_todo->textarea("desc","","",0,$get_todo["desc"]);
	$form_todo->text("color","color_picker","text","color",0,"","s12",$get_todo["color"]);
	$form_todo->custom('<a href="/delete_todo/'.$id.'" class="btn red">remove todo</a>');
		
	$form_todo ->submit("sub","submit");
	$html = $form_todo ->create();
			
    $view = new Template(); 
	$view->title = "admin posts"; 
	$view->content = $html; 
	echo $view->render('./templates/main.ytpl');
});
//delete todo
	
Route::add('/delete_todo/([a-z-0-9]*)',function($id){
    include('header.php');
	$table_todo = new ycrud($PDO,"todo");
	$table_todo ->ydelete($id);
	yheader("/");
});
		
Route::add('/add_todo',function(){

    include('header.php');
	
	$table_todo = new ycrud($PDO,"todo");
	if(isset($_POST["sub"]))
	{
		$new_post = array(
		
		'name'=>$_POST['name'],
		'desc'=>$_POST['desc'],
		'cat_id'=>$_POST['cat_id'],
		'color'=>$_POST['color']
		);
		$table_todo ->create($new_post);
	}
	yheader("./");
	
},"post");
		
Route::add('/edit_todo_cat/([a-z-0-9]*)',function($id){
	
    include('header.php');
	
	$table_todo = new ycrud($PDO,"todo");
	$new_post = array(
	'cat_id'=>$_POST['cat_id']
	);
	$table_todo ->update($id,$new_post);

	//yheader("/admin/todo");
	
},"post");

Route::add('/edit_todo/([a-z-0-9]*)',function($id){

    include('header.php');
	
	$table_todo = new ycrud($PDO,"todo");
	if(isset($_POST["sub"]))
	{
		$new_post = array(
		
		'name'=>$_POST['name'],
		'desc'=>$_POST['desc'],
		'color'=>$_POST['color']
		);
		$table_todo ->update($id,$new_post);
	}
	yheader("/");
	
},"post");

?>