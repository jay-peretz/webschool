$(document).ready(function() {	 
 var classes;
 $.ajax({
       type: "GET",
       url: "../lesson-maker/get-syllabi.php",
       datatype: "json"
      }).done(function( data) {
         classes = $.parseJSON(data);	 
		  $.each(classes, function(index, value) {
			  $("#syllabus-menu").append('<li><a class="selectClass" data-ID="'+value.syllabus_id+'">'+value.srjc_id+'</a></li>');		   
		  });
		  $("#syllabus-menu > li:first-child").addClass("active");
		  $(".selectClass").click(function() {
			  $(".selectClass").parent().removeClass("active");
			  $(this).parent().addClass("active");
			  syllabus_id = $(this).attr("data-ID");
			  showSubmissions(syllabus_id);
		  });
		  showSubmissions("3");
	  });
	function showSubmissions(syllabus_id)	 {
		 $("#submissionscontent").html('');
		$("#classheader").html("Submissions for "+classes[syllabus_id].srjc_id + " &mdash; " + classes[syllabus_id].course_name );
		$.ajax({
          type: "GET",
		  data: { syllabus_id: syllabus_id },
          url: "get-submissions.php",
          datatype: "json"
      }).done(function( data) {
           submissions = $.parseJSON(data);	
		 console.log(submissions); 
		 for (i = 0; i < submissions.length; i++) {
			 var submissionclass = submissions[i].value ? "graded" : "well";
			 var content = '<h5 class="'+submissionclass+'"><a href="mailto:'+submissions[i].email+'">'+submissions[i].first_name+' '+submissions[i].last_name+'</a> submitted '+submissions[i].description+' on '+submissions[i].submitted+' GRADE: '+submissions[i].value+' of Weight: '+submissions[i].weight+' &nbsp;<input type=text size="5" />&nbsp;<button data-homeworkid="'+submissions[i].homework_id+'" class="btn submitgrade" type="button">Submit</button></h5>';
			        
						  if (submissions[i].URL) {
							  content += '<p class=formanswers><a href="'+submissions[i].URL+'">'+submissions[i].URL+'</a> &nbsp;&mdash;&nbsp;'+submissions[i].comment+'</p>';
						  }
						  if (submissions[i].testanswers) {
							  $.each(submissions[i].testanswers, function (index3, value3) {
									  var answerclass = (value3.correct == value3.answer) ? "testanswergreen" : "testanswerred";
								  content += "<p class="+answerclass+">"+value3.question+' '+value3.correct+' - '+value3.correcttext+' <strong>Answer: '+value3.answer+" - "+value3.wronganswer+"</strong></p>";
								  
							  });
						  } else 
						  if (submissions[i].formsanswers) {
							  $.each(submissions[i].formsanswers, function (index3, value3) {
								  content += "<p class=formanswers>"+value3.question+'</p><p>'+value3.answer+"</p>";
							  });
						   };
					  
 			 
			 $("#submissionscontent").append(content);
			 }
			 $(".submitgrade").off("click");
			 $(".submitgrade").on("click", function() {
				 //alert($(this).parent().children("input:first").val() + $(this).attr("data-student") + $(this).attr("data-assignment"));
				 $.ajax({
					   type: "POST",
					   url: "post-grade.php",
					   data: {homeworkid:$(this).attr("data-homeworkid"), grade: $(this).parent().children("input:first").val()},
					   datatype: "json"
					}).done(function(data) {
						alert("Grade was posted.");
						showSubmissions(syllabus_id);
					});
			 });
			 
		 
	  });
		 
	  
		
	};
	
	
});