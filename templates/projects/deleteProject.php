<?php
  echo "Are you sure you want to delete this project?";
?>

$('#showConfirm').click(function(){​
  $('#myConfirm').confirmDelete({
	message: "Are you sure you want to delete?",
	success: function(){
	  $('#myAlert').deleteAlert({
	    message: "Success!"
	  })
	},
	cancel: function(){
	    $('#myAlert').deleteAlert({
		message: "Cancelled"
	    })
	}
   })
})
