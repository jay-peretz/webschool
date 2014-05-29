$(document).ready(function() {	 
  var students,
      gradebook;
  getStudents();
	
});

function getStudents() {
    $.ajax({
       type: "GET",
       url: "get-students.php",
       datatype: "json"
      }).done(function( data) {
         students = $.parseJSON(data);	
		  $.each(students, function(index, value) {
			  $("#students").append('<li><a class="selectStudent" data-class="'+value.syllabus_syllabus_id+'" data-ID="'+value.email+'">'+value.first_name+' '+value.last_name+'</a></li>');		   
		  });		 
		  $(".selectStudent").click(function() {
              $("#students .active").removeClass("active");
              $(this).parent().addClass("active");
              $("#studentName").html($(this).text());
              showStudent($(this).attr("data-ID"),$(this).attr("data-class"));
              
		  });
          /*$(document).keydown(function(e) {
              if (e.keyCode == 38 ) {
              } else 
              if (e.keyCode == 39 ) {
              }          
          });*/
	  });

}
function showStudent(email, syllabusID) {
    $.ajax({
        type:"POST",
        url: "get-participation.php",
        data:{student:email},
        datatype:"json"
        }).done(function(data) {
            var resultdata = $.parseJSON(data);
            $("#studentParticipation").html('&nbsp;&nbsp;'+resultdata.posts+'&nbsp;&nbsp;Forum Posts&nbsp;&nbsp;'+resultdata.reviews+'&nbsp;&nbsp;Comments');
        });
       
        
    $.ajax({
       type: "GET",
       url: "get-gradebook.php",
       data:{email:email, syllabus:syllabusID},
       datatype: "json"
        }).done(function(data) {
            gradebook = $.parseJSON(data);
             console.log(gradebook);
            var content = '';
            $.each(gradebook, function(index2, value2) {
          //      var grade = value2.value ? value2.value : "ungraded";
		//	  content += '<hr /><p class="row assignments"><strong>'+value2.name+'&nbsp;&nbsp;  '+grade+'</strong>&nbsp;<input type=text width=20 />&nbsp;<button data-email="'+email+'" data-gradeid="'+value2.grade_id+'" data-assignment="'+value2.assignment_id+'" class="btn submitgrade" type="button">Submit</button></p>';      
        content += '<hr /><h5 class="row assignments">'+value2.name+'</h5>';
              if (value2.homeworks) {
                  var totalweight = 0;
					  $.each(value2.homeworks, function(index3, value3) {
                        totalweight = totalweight + parseInt(value3.weight);
						  var submitted = new Date(value3.submitted);
						  var exercisedue = new Date(value3.due_date);
                          var description = value3.description.length > 20 ? value3.description.substring(0,20) : value3.description;
						   var graderclass = value3.grade ? "graded" : "well";
                          content += '<p class="homeworks ' + graderclass + '"><strong>'+description+'</strong> worth <strong> '+value3.weight+' </strong> points. <br> Due: <strong>'+exercisedue.toDateString() +' </strong> Submitted: <strong>'+submitted.toDateString()+"</strong><br>Grade:&nbsp;<strong>"+ value3.grade+'</strong> &nbsp; &nbsp; <input type=text width=10 />&nbsp;<button data-homework="'+value3.homework_id+'" class="btn submitgrade" type="button">Submit</button></p>';
						  if (value3.url) {
							  content += '<p class="pagesubmission"><a href='+value3.url+'>'+value3.url+'</a></p>';
						  }
						  if (value3.testanswers) {
							  $.each(value3.testanswers, function (index4, value4) {
									  var answerclass = (value4.correct == value4.answer) ? "testanswergreen" : "testanswerred";
								  content += "<p class="+answerclass+">"+value4.question+' '+value4.correct+' - '+value4.correcttext+' <strong>Answer: '+value4.answer+" - "+value4.wronganswer+"</strong></p>";
								  
							  });
						  } else 
						  if (value3.formsanswers) {
							  $.each(value3.formsanswers, function (index5, value5) {
								  content += "<p class=formanswers>"+value5.answer+"</p>";
							  });
						   };
					  });
                      content += "<p>Total Points: "+totalweight+"</p>";
				  };
            });
            $("#grades").html(content);
             $(".submitgrade").off("click");
			 $(".submitgrade").on("click", function() {
				 $.ajax({
					   type: "POST",
					   url: "../submissions/post-grade.php",
					   data: {grade: $(this).parent().children("input:first").val(), homeworkid: $(this).attr("data-homework")},
					   datatype: "json"
					}).done(function(data) {
						alert("Grade was posted.");
						showStudent(email, syllabusID);
					});
			 });
        });
}
	