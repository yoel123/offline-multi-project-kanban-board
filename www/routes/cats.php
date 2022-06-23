<?php

//categories
Route::add('/admin/categories',function(){
	include('header.php');
	$board_id = get_board_id();
	$html = "<a href='/'>back</a>";
	$html .= "<h1>categories</h1>";
	$table_categories = new ycrud($PDO,"categories");
	$all_categories = $table_categories ->get_where("board_id = ".$board_id);
	$html .= ycrud_table("categories",$all_categories,array('name'),"/add_categories");
	
	
	$view = new Template(); 
	$view->title = "admin categories"; 
	$view->content = $html; 
	echo $view->render('./templates/main.ytpl'); 
	
});

	
// add categories form
Route::add('/add_categories',function(){
	include('header.php');
	$board_id = get_board_id();
	//html form
    $form_categories = new yform("add_categories","POST","add_categories","");
	$form_categories->text("name","","text","name",0,"placeholder txt");
	$form_categories->text("board_id","","hidden","board_id",0,"","",$board_id);
		
	$form_categories ->submit("sub","submit");
	$html = $form_categories ->create();
		
    $view = new Template(); 
	$view->title = "admin categories"; 
	$view->content = $html; 
	echo $view->render('./templates/main.ytpl');
});	
	
// edit categories form
Route::add('/edit_categories/([a-z-0-9]*)',function($id){
	include('header.php');
	
	//get post data
	$table_categories = new ycrud($PDO,"categories");
	$get_categories = $table_categories ->get_where("id='".$id."'")[0];

	//html form
    $form_categories = new yform("/edit_categories/".$get_categories ['id']."","POST","add_post","");
	$form_categories->text("name","","text","name",0,"placeholder txt","s12",$get_categories["name"]);
	
	$form_categories ->submit("sub","submit");
	$html = $form_categories ->create();
			
    $view = new Template(); 
	$view->title = "admin posts"; 
	$view->content = $html; 
	echo $view->render('./templates/main.ytpl');
});
//delete categories
	
Route::add('/delete_categories/([a-z-0-9]*)',function($id){
    include('header.php');
	$table_categories = new ycrud($PDO,"categories");
	$table_categories ->ydelete($id);
	yheader("/admin/categories");
});
		
	Route::add('/add_categories',function(){

    include('header.php');
	
	$table_categories = new ycrud($PDO,"categories");
	if(isset($_POST["sub"]))
	{
		$new_post = array(
		
		'name'=>$_POST['name'],
		'board_id'=>$_POST['board_id']
		);
		$table_categories ->create($new_post);
	}
	yheader("/admin/categories");
	
},"post");
		
	Route::add('/edit_categories/([a-z-0-9]*)',function($id){

    include('header.php');
	
	$table_categories = new ycrud($PDO,"categories");
	if(isset($_POST["sub"]))
	{
		$new_post = array(
		
		'name'=>$_POST['name'],

		);
		$table_categories ->update($id,$new_post);
	}
	yheader("/admin/categories");
	
},"post");
?>