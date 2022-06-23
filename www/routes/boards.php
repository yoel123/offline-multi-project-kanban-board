<?php
//board
Route::add('/admin/board',function(){
	include('header.php');
	$html = "<a href='/'>back</a>";
	$html .= "<h1>change board</h1>";
	$table_board = new ycrud($PDO,"board");
	$all_board = $table_board ->get_all();
	$html .= ycrud_table_board("board",$all_board,array('name'),"/add_board");
	
	
	$view = new Template(); 
	$view->title = "admin board"; 
	$view->content = $html; 
	echo $view->render('./templates/main.ytpl'); 
	
});

Route::add('/change_board/([a-z-0-9]*)',function($id){
	include('header.php');
	$_SESSION["board_id"] = $id;
	yheader("/");
});
// add board form
Route::add('/add_board',function(){
	include('header.php');

	//html form
    $form_board = new yform("add_board","POST","add_board","");
	$form_board->text("name","","text","name",0,"placeholder txt");
		
	$form_board ->submit("sub","submit");
	$html = $form_board ->create();
		
    $view = new Template(); 
	$view->title = "admin board"; 
	$view->content = $html; 
	echo $view->render('./templates/main.ytpl');
});	
	
// edit board form
Route::add('/edit_board/([a-z-0-9]*)',function($id){
	include('header.php');
	
	//get post data
	$table_board = new ycrud($PDO,"board");
	$get_board = $table_board ->get_where("id='".$id."'")[0];

	//html form
    $form_board = new yform("/edit_board/".$get_board ['id']."","POST","add_post","");
	$form_board->text("name","","text","name",0,"placeholder txt","s12",$get_board["name"]);
		
	$form_board ->submit("sub","submit");
	$html = $form_board ->create();
			
    $view = new Template(); 
	$view->title = "admin posts"; 
	$view->content = $html; 
	echo $view->render('./templates/main.ytpl');
});
//delete board
	
Route::add('/delete_board/([a-z-0-9]*)',function($id){
    include('header.php');
	$table_board = new ycrud($PDO,"board");
	$table_board ->ydelete($id);
	yheader("/admin/board");
});
		
	Route::add('/add_board',function(){

    include('header.php');
	
	$table_board = new ycrud($PDO,"board");
	if(isset($_POST["sub"]))
	{
		$new_post = array(
		
		'name'=>$_POST['name']
		);
		$table_board ->create($new_post);
	}
	yheader("/admin/board");
	
},"post");
		
	Route::add('/edit_board/([a-z-0-9]*)',function($id){

    include('header.php');
	
	$table_board = new ycrud($PDO,"board");
	if(isset($_POST["sub"]))
	{
		$new_post = array(
		
		'name'=>$_POST['name']
		);
		$table_board ->update($id,$new_post);
	}
	yheader("/admin/board");
	
},"post");
?>