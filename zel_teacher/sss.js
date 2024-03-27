function delete_course(cid = null) {
	if(cid) {
		var r = confirm("Are You Sure To Delete Course?");
		if(r==true){
			$.ajax({
				url: './delete_course.php',
				type: 'post',
				data: {cid : cid},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Course Deleted Successfully!");
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
function approve_student(euid = null) {
	if(euid) {
		var r = confirm("Are You Sure To Approve Stuent?");
		if(r==true){
			$.ajax({
				url: './approve_student.php',
				type: 'post',
				data: {euid : euid},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Student Approve Successfully!");
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
function reject_student(euid = null) {
	if(euid) {
		var r = confirm("Are You Sure To Reject Student?");
		if(r==true){
			$.ajax({
				url: './reject_student.php',
				type: 'post',
				data: {euid : euid},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Student Rejected Successfully!");
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
function delete_student(euid = null) {
	if(euid) {
		var r = confirm("Are You Sure To Delete Student?");
		if(r==true){
			$.ajax({
				url: './delete_student.php',
				type: 'post',
				data: {euid : euid},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Student Deleted Successfully!");
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
function delete_cr(cr_id = null) {
	if(cr_id) {
		var r = confirm("Are You Sure To Delete Classroom?");
		if(r==true){
			$.ajax({
				url: './delete_cr.php',
				type: 'post',
				data: {cr_id : cr_id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Classroom Deleted Successfully!");
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
function approve_cr(cr_id = null) {
	if(cr_id) {
		var r = confirm("Are You Sure To Delete Classroom?");
		if(r==true){
			$.ajax({
				url: './approve_cr.php',
				type: 'post',
				data: {cr_id : cr_id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Classroom Deleted Successfully!");
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
function reject_cr(cr_id = null) {
	if(cr_id) {
		var r = confirm("Are You Sure To Delete Classroom?");
		if(r==true){
			$.ajax({
				url: './reject_cr.php',
				type: 'post',
				data: {cr_id : cr_id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Classroom Deleted Successfully!");
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
function add_allotment(euid = null, cr_id = null) {
	if(euid) {
		//alert(cr_id);
		var r = confirm("Are You Sure To Add Allotment?");
		if(r==true){
			$.ajax({
				url: './add_allotment.php',
				type: 'post',
				data: {euid : euid,cr_id : cr_id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Allotment Added Successfully!");
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
function delete_allotment(cr_st_id = null) {
	if(cr_st_id) {
		var r = confirm("Are You Sure To Delete Allotment?");
		if(r==true){
			$.ajax({
				url: './delete_allotment.php',
				type: 'post',
				data: {cr_st_id : cr_st_id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Allotment Deleted Successfully!");
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
function delete_assignment(ass_id = null) {
	if(ass_id) {
		var r = confirm("Are You Sure To Delete Assignment?");
		if(r==true){
			$.ajax({
				url: './delete_assignment.php',
				type: 'post',
				data: {ass_id : ass_id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Assignment Entry Deleted Successfully!");
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
function delete_meet(meet_id = null) {
	if(meet_id) {
		var r = confirm("Are You Sure To Delete Meet?");
		if(r==true){
			$.ajax({
				url: './delete_meet.php',
				type: 'post',
				data: {meet_id : meet_id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Meet Entry Deleted Successfully!");
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
function delete_answer(aa_id = null) {
	if(aa_id) {
		var r = confirm("Are You Sure To Delete Answer Sheet?");
		if(r==true){
			$.ajax({
				url: './delete_answer.php',
				type: 'post',
				data: {aa_id : aa_id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Answer Sheet Deleted Successfully!");
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