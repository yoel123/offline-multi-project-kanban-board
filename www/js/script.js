$(document).ready(function(){
 $('select').formSelect();
	$(".color_picker").spectrum({
		color: "#f00",
		preferredFormat: "hex"
	});

  $(".single_todo").draggable({
    revert: true
  });

  $(".canban_cat").droppable({
    accept: '.single_todo',
    drop: function(event, ui) {
      $(this).append($(ui.draggable));
	  var todo_id = $(ui.draggable).attr('todo_id');
	  var cat_id = $(ui.draggable).parent().attr('cat_id');
	  console.log(todo_id)
	  console.log(cat_id+"cat")
	  //do ajax call
	  $.post( "/edit_todo_cat/"+todo_id, { 'cat_id': cat_id })
    }
  });

  $(".single_todo").dblclick( function(e) {
	var todo_id = $(this).attr('todo_id');
    //send to edit todo
	window.location="/edit_todo/"+todo_id;
  });
  


  
});//end dom ready

