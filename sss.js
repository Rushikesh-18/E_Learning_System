function delete_compliant(comp_id = null) {
	if(comp_id) {
		var r = confirm("Are You Sure To Delete Compliant?");
		if(r==true){
			$.ajax({
				url: './delete_compliant.php',
				type: 'post',
				data: {comp_id : comp_id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Compliant Deleted Successfully!");
						 $("#mes").html("ookkk");
					} else {
					} // /else
				} // /success
			});  // /ajax function to remove the order
	} else{
		location.reload();
	}
	}
	else {
		alert('error! refresh the page again');
	}	
}