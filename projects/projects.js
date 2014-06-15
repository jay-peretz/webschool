// JavaScript Document
$(document).ready(function() {
	$("#write-comment").modal('hide');
	function getStudents() {
		$.ajax({
       type: "GET",
       url: "get-students.php",
       datatype: "json",
       async: false
      }).done(function(data) {
		   students = $.parseJSON(data);
	  });
	  return students;
	};
	function listProjects() {
		var projectList = "";
		$("#project-list").html(projectList);		
		$.each(students,function(index,value) {
			if (students[index].type === "student") {	
			    var description = students[index].project_description?students[index].project_description:"";	
				var course = students[index].syllabus_syllabus_id==1?"HTML5":"MySQL &amp; PHP";
				projectList += '<p><strong>'+students[index].first_name+'</strong>&mdash;'+course+'&mdash;'+description+'<button data-id="'+index+'" class="btn btn-mini btn-info comment-open" type="button">Comment</button></p>';	
				if (students[index].comments) {
					$.each(students[index].comments,function(index2,value2) {
						projectList += '<p class="muted review">'+value2.first_name+'&nbsp;&mdash;&nbsp;'+value2.comment+'</p>';
					});
				}
			}
		});	
		$("#project-list").html(projectList);
		$(".comment-open").unbind("click");
		$(".comment-open").click(function() {
			$("#submit-comment").attr("data-id",$(this).attr("data-id"));
			$("#projecttext").text($(this).parent().text().length > 200?$(this).parent().text().substring(0,200)+" ... ":$(this).parent().text().substring(0,$(this).parent().text().length-8));
			$("#write-comment").modal('show');
		});
	}
	$("#submit-comment").click(function() {
		
		$.ajax({
			type:"POST",
			data:{comment:$("#enter-comment").val(), student_email: user , id : $(this).attr("data-id")},
			url: "put-project-comment.php",
       		datatype: "json"
		}).done(function(data) {
			data = $.parseJSON(data);
			if (!students[$("#submit-comment").attr("data-id")].comments) {
					students[$("#submit-comment").attr("data-id")].comments = {};
			}
			students[$("#submit-comment").attr("data-id")].comments[data.commentid] = {first_name : data.first_name, id_project_comment: data.commentid , comment:$("#enter-comment").val() , student_email: user };
			alert("Your comment was entered.");
			listProjects();  
			$("#write-comment").modal('hide');	
			$("#enter-comment").val("");
		});
	});
	var students = getStudents();
	console.log(students);	
	listProjects();  
});