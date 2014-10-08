$(document).ready(function() {
	var syllabus;
    var profileObject;
	$("#submit-homework , #update-homework , #update-review, #write-review").modal("hide");
	var getProfile = function(user) {
		$.ajax({
			type: "GET",
			url: getRootPath()+"lesson-maker/get-profile.php",
			data: { email: user, syllabus_id:syllabus_id },
			datatype: "json"
		}).done(function( data) {
			data = $.parseJSON(data);
		//	console.log(data);
            profileObject = data;
			$('#fullname').text(data.first_name + " " + data.last_name);
			$("#mygravatar").attr("src","http://www.gravatar.com/avatar/"+data.gravatar_hash);
			if (data.gallery_URL) {
				$('#galleryurl').text(data.gallery_URL);
			}
			if (data.github_userid) {
				$('#githubaccount').text(data.github_userid);
			}	
			if (data.project_description) {
				$('#myproject').val(data.project_description);
			}	
            if (data.getforumemail == 1) {
                
                $('#getemail').prop('checked',true);
            }
		});
	};
    var getNews = function() {
		$.ajax({
			type: "GET",
			url: getRootPath()+"lesson-maker/get-news.php",
			datatype: "json"
		}).done(function( data) {
			var news = $.parseJSON(data);
            var newsitem = "";
            $.each(news, function(index, value) {
			     newsitem += '<p><a target=_blank href="'+value.url+'">'+value.headline+'</a></p>';           
            });
            $("#news").html(newsitem);
		});
	}();
	function getRootPath() {
		var r = "";
		for ( var i = window.location.pathname.substring(scriptPath.length).split("/").length-1; i > 0; --i ) {
			r += "../";
		};
		return r;
	}
	function listGrades() {
		var gradeList = "";
		$("#grade-list").html(gradeList);
		gradeList += '<table class="table table-condensed table-striped"><tbody>';
		$.each(syllabus.students,function(index,value) {
			if (syllabus.students[index].project_description) {
				projectList += '<tr><td>'+syllabus.students[index].first_name+'</td><td>'+syllabus.students[index].project_description+'</td></tr>';			
			} else {
				projectList += '<tr><td>'+syllabus.students[index].first_name+'</td><td></td></tr>';
			}
		});
		projectList += '</tbody></table>';
		$("#project-list").html(projectList);
	}
	function listProjects() {
		var projectList = "";
		$("#project-list").html(projectList);
		projectList += '<table class="table table-condensed table-striped"><tbody>';
		$.each(syllabus.students,function(index,value) {
			if (syllabus.students[index].project_description) {
				projectList += '<tr><td>'+syllabus.students[index].first_name+'</td><td>'+syllabus.students[index].project_description+'</td></tr>';			
			} else {
				projectList += '<tr><td>'+syllabus.students[index].first_name+'</td><td></td></tr>';
			}
		});
		projectList += '</tbody></table>';
		$("#project-list").html(projectList);
	}
	function showLesson(lessonID) {
		$.ajax({
			type: "GET",
			url: getRootPath()+"xanthippe/lesson.php",
			data: { lesson_id: lessonID },
			datatype: "json"
		}).done(function( data) {
			data = $.parseJSON(data);
			lesson = data[lessonID];
			// console.log(lesson);
			$("#lesson-topic").html(lesson.topics);
			$("#lesson-desc").html(lesson.description);
			
			
			var lessoncontent = "";
            lessoncontent += '<div class="lessonsidebar">';
            if (lesson.slides != "") {
                lessoncontent += '<p><a target="_blank" class=btn id="lesson-notes" href="'+getRootPath()+'slides/index.php?lesson='+lessonID+'" >Lecture Notes</a></p>';
            }
            // display any reading assignments for this lesson
			if (lesson.reads) {
				lessoncontent += "<h3>Reading</h3>";
				$.each(lesson.reads, function(index, value) {
					if (lesson.reads[index].title && lesson.reads[index].reading_url) {
						lessoncontent += '<p><a href="'+lesson.reads[index].reading_url+'"><strong>'+lesson.reads[index].title+'</strong>&nbsp;'+lesson.reads[index].description+'</a></p>';
					} else if (!lesson.reads[index].title && lesson.reads[index].reading_url)  {
						lessoncontent += '<p><a href="'+lesson.reads[index].reading_url+'">'+lesson.reads[index].description+'</a></p>';
					} else if (lesson.reads[index].title && !lesson.reads[index].reading_url) {
						lessoncontent += '<p><strong>'+lesson.reads[index].title+'</strong>&nbsp;'+lesson.reads[index].description+'</p>';
					} else {
						lessoncontent += '<p>'+lesson.reads[index].description+'</p>';
					}
				});
			}
			// display any explore links for this lesson
			if (lesson.explores) {
				lessoncontent += "<h3>Explore </h3>";
				$.each(lesson.explores, function(index, value) {
					lessoncontent += '<p><a href="'+lesson.explores[index].url+'">'+lesson.explores[index].description+'</a></p>';
				});
			}
            // display any wrapup comments for this lesson
           if (lesson.wrapup) {
               lessoncontent += "<h3>Weekly Wrapup </h3>";
			    lessoncontent +=  "<div class=wrapup>"+lesson.wrapup+"</div>";
			} 
            lessoncontent +=  "</div>";
			if (lesson.blogpost) {
				lessoncontent += "<div class=blog>"+lesson.blogpost+"</div>";
			};
			// display any assignments for this lesson
			if (lesson.assignments) {
				
				$.each(lesson.assignments, function(assignment_id, assignment) {
					if (assignment.name)
						lessoncontent += '<div class="row assignmentrow"  data-assignment="'+assignment_id+'"><h5 class="span6">'+assignment.name+'</h5>';
                
					else
			lessoncontent += '<div class="row assignmentrow"   data-assignment="">';
                  
					// display any exercises for this assignment
					if (assignment.exercises) {
						$.each(assignment.exercises, function(exercise_id, exercise) {
							lessoncontent += '<p class="exercise span6"><a ';
							if (exercise.type != '' && exercise.closed != "1" && exercise.private != "1") {
								lessoncontent += 'data-exercise="'+exercise_id+'" class="btn btn-mini submit-hw ';
								switch (exercise.type) {
									case 'test': lessoncontent += 'btn-success">Take'; break;
									case 'form': lessoncontent += 'btn-primary">Answer'; break;
									default: lessoncontent += 'btn-danger">Submit';
								}
							} else
								lessoncontent += 'class="btn btn-mini btn-inverse">' + ((exercise.closed == "1" || exercise.private == "1")? 'Closed' : '&nbsp;');
							lessoncontent += '</a>&nbsp;';
							if (exercise.url) {
								lessoncontent += '<a href="'+exercise.url+'">'+exercise.description+'</a></p>';
							} else {
								lessoncontent += exercise.description+'</p>';
							}
							lessoncontent += '<p class="span2"><em>Value '+exercise.weight+'<br>'+(exercise.due_date ? "Due "+exercise.due_date : (assignment.due_date ? "Due "+assignment.due_date : "&nbsp;"))+'</em></p>';
							// display any homework submissions for this exercise
							if (exercise.homeworks && (exercise.type == 'url' || exercise.type == 'form')) {
								lessoncontent += '<div data-exercise="'+ exercise_id +'" class="span5">'
								$.each(exercise.homeworks,function(index2,value2) {
								//	lessoncontent += '<p class="muted"><a data-reviewee='+ value2.first_name+' data-homework="'+ index2+'" class="btn btn-mini thumbs thumbsup" href="#write-review"><i class="icon-thumbs-up"></i></a><a data-reviewee='+ value2.first_name+'  data-homework="'+ index2 +'"  class="btn btn-mini thumbs thumbsdown" href="#write-review"><i class="icon-thumbs-down"></i></a>&nbsp;&nbsp;';
									
									switch (exercise.type) {
										case "url":
                                        lessoncontent += '<p class="muted"><a data-reviewee='+ value2.first_name+' data-homework="'+ index2+'" class="btn btn-mini thumbs thumbsup" href="#write-review"><i class="icon-thumbs-up"></i></a>&nbsp;&nbsp;';
											//does the submission have a url link
											lessoncontent += value2.URL ? '<a href="'+value2.URL+'">'+value2.first_name+'</a>' : value2.first_name;
											lessoncontent += '&mdash; '+(value2.comment ? value2.comment : '')+'&nbsp;';
                                        lessoncontent += (value2.student_email === user) ? '<a class="btn btn-mini remove-homework" data-id="'+ index2 +'"><i class="icon-remove"></i></a></p>' : '</p>';
											break;
										case "form":
											lessoncontent += '<p><a data-reviewee='+ value2.first_name+' data-homework="'+ index2+'" class="btn btn-mini thumbs thumbsup" href="#write-review"><i class="icon-thumbs-up"></i></a>&nbsp;&nbsp;<a data-homework="'+ index2 +'" class="view-hw">'+value2.first_name+'</a>';
											lessoncontent += '&mdash; ';
											//display the first non-empty field as the comment
											for (var value3 in value2.answers) {
												if (value2.answers[value3].text) {
													//limit to only 80 characters
													lessoncontent += value2.answers[value3].text.length > 500 ? value2.answers[value3].text.substring(0,500) + '...' : value2.answers[value3].text+"</p>";
													break;
												}
											}
											lessoncontent += '&nbsp;';
											break;
										case "test":
											lessoncontent += '<a data-homework="'+ index2 +'" class="view-hw">'+value2.first_name+'</a>&nbsp;';
											break;
									}
									// is this submission by the current logged in user
									
									// display any reviews of a homework submission
									if (value2.reviews) {
										$.each(value2.reviews,function(index3, value3) {
											lessoncontent += '<p class="muted review">&nbsp;&nbsp;';
											//thumbs up or thumbs down
											lessoncontent += (value3.grade == 1) ?'<i class="icon-thumbs-up"></i>' : '<i class="icon-thumbs-down"></i>';
											lessoncontent += '&nbsp;&nbsp;'+value3.comment+'&nbsp;&mdash;&nbsp;'+value3.first_name+'';
											// is this review by the current logged in user
											lessoncontent += (value3.student_email === user) ? '&nbsp;<a class="btn btn-mini remove-review" data-id="'+ index3 +'"><i class="icon-remove"></i></a></p>' : '</p>';
										});
									} 
								});
								lessoncontent += '</div>'
							}
						});
					}
					lessoncontent += '</div>';
				});
			}
           
          lessoncontent += '<div class="clearfloats"></div>';
    
            
			$("#lesson-info").html(lessoncontent);
            prettyPrint();
			// set event to submit homework
			$(".submit-hw").click(function() {
				var a_id = $(this).parent().parent().attr("data-assignment");
				var e_id = $(this).attr("data-exercise");
				$("#submit-exercise").attr("assignment-id",a_id);
				$("#submit-exercise").attr("exercise-id",e_id);
				exercisecontent = "";
				switch (lesson.assignments[a_id].exercises[e_id].type) {
					case "url":
						exercisecontent += '<p class="span5">URL of page</p><p id="exercise-link" class="span5" contenteditable=true></p><p class="span5">Comment</p><p class="span5"><textarea columns=600 rows=2 class="span5" id="exercise-comment" name="exercise-comment"></textarea></p>';
						break;
					case "form":
						$.each(lesson.assignments[a_id].exercises[e_id].questions,function(index, question) {
							exercisecontent += '<p class="span5">'+question.text+'</p><p class="span5"><textarea columns=600 rows=2 class="span5" id="exercise-q'+index+'" name="exercise-q'+index+'" maxlength="2000"></textarea></p>';
						});
						break;
					case "test":
						$.each(lesson.assignments[a_id].exercises[e_id].questions,function(index, question) {
						//	exercisecontent += '<p class="span5">'+escapeHtml(question.text)+'&nbsp;<small><strong>('+question.value+'&nbsp;Point'+(question.value != 1 ? 's' : '')+')</strong></small><br />';
						    exercisecontent += '<p class="span5">'+question.text+'<br />';
							$.each(question.options,function(index2, option) {
								if (typeof index2 === 'string')
									index2 = parseInt(index2);
								exercisecontent += '<input type="radio" name="exercise-q'+index+'" id="exercise-q'+index+'-o'+index2+'" value="'+index2+'" /><label for="exercise-q'+index+'-o'+index2+'">'+String.fromCharCode(96 + index2)+') '+option+'</label>';
							});
							exercisecontent += '</p>';
						});
						break;
				}
				$("#exercise-content").html(exercisecontent);
				$("#submit-homework").modal("show");
			});
			// set event to view a homework submission
			$(".view-hw").click(function() {
				var a_id = $(this).parent().parent().parent().attr("data-assignment");
				var e_id = $(this).parent().parent().attr("data-exercise");
				var h_id = $(this).attr("data-homework");
				homeworkcontent = "";
				switch (lesson.assignments[a_id].exercises[e_id].type) {
					case "url":
						//homeworkcontent += '<p class="span5">URL of page</p><p id="exercise-link" class="span5" contenteditable=true></p><p class="span5">Comment</p><p class="span5"><textarea columns=600 rows=2 class="span5" id="exercise-comment" name="exercise-comment"></textarea></p>';
						break;
					case "form":
						$.each(lesson.assignments[a_id].exercises[e_id].questions,function(index, value) {
							homeworkcontent += '<p class="span5"><strong>'+value.text+'</strong></p><blockquote class="span5">'+lesson.assignments[a_id].exercises[e_id].homeworks[h_id].answers[index].text+'</blockquote>';
						});
						break;
					case "test":
						var earned = 0;
						var total = 0;
						$.each(lesson.assignments[a_id].exercises[e_id].questions,function(index, value) {
							homeworkcontent += '<p class="span5"><strong>'+escapeHtml(value.text)+'</strong></p>';
							var answer = lesson.assignments[a_id].exercises[e_id].homeworks[h_id].answers[index];
							homeworkcontent += '<dl class="span5 dl-horizontal"><dt>Answer Given:</dt><dd>'+(answer ? escapeHtml(value.options[lesson.assignments[a_id].exercises[e_id].homeworks[h_id].answers[index]]) : 'Not answered')+'</dd>';
							if ( value.correct ) {
								homeworkcontent += '<dt>Best Answer:</dt><dd>'+escapeHtml(value.options[value.correct])+'</dd>';
								var score = answer ? lesson.assignments[a_id].exercises[e_id].homeworks[h_id].scores[index] : 0;
								earned += parseInt(score);
								total += parseInt(value.value);
								homeworkcontent += '<dt>Points Earned:</dt><dd><span class="label label-'+(score <= 0 ? 'important' : score < value.value ? 'warning' : 'success')+'">'+score+' out of '+value.value+'</span></dd>';
							}
							homeworkcontent += '</dl>';
						});
						homeworkcontent += '<dl class="span5 dl-horizontal"><dt><strong>Total Points:</strong><dd><strong>'+earned+' out of '+total+'</dd>';
						break;
				}
				$("#homework-content").html(homeworkcontent);
				$("#view-homework").modal("show");
			});
			// set event to enter a review of a homework submission
			$(".thumbs").click(function() {
				$("#review-grade").removeClass("icon-thumbs-up").removeClass("icon-thumbs-down");
				if ($(this).hasClass("thumbsup")) {
					$("#review-grade").addClass("icon-thumbs-up");
				} else {
					$("#review-grade").addClass("icon-thumbs-down");
				}
				$("#review-subject").html($(this).attr("data-reviewee"));
				$("#submit-review").attr("homework-id",$(this).attr("data-homework"));
                $("#review-comment").val("");
				$("#write-review").modal("show");
			});	
			$(".remove-homework").click(function() {
				$("#delete-hw ").attr("homework-id",$(this).attr("data-id"));
				$("#update-homework").modal("show");
			});
			$("#delete-hw").unbind('click');
			$("#delete-hw").click(function() {
				var homeworkID = $(this).attr("homework-id");
				$("#update-homework").modal("hide");
				$.ajax({
					type: "POST",
					url: getRootPath()+"lesson-maker/remove-homework.php", 
					data: { homework: homeworkID }
				}).done(function(data) {
					alert("Your submission was deleted.");
					showLesson(lessonID);
					syllabus.students[user].homeworks[homeworkID] = {};
				});
			});
			$(".remove-review").click(function() {
				$("#delete-rev ").attr("data-id",$(this).attr("data-id"));
				$("#update-review").modal("show");
			});
			$("#delete-rev").unbind('click');
			$("#delete-rev").click(function() {
				var reviewID = $(this).attr("data-id");
				$.ajax({
					type: "POST",
					url: getRootPath()+"lesson-maker/remove-review.php", 
					data: { review: reviewID }
				}).done(function(data) {
					alert("Your review was deleted.");
					showLesson(lessonID);
				});
			});
		}); //close ajax done
        var getHW =  function() {
           $.ajax({
			type: "GET",
			url: getRootPath()+"lesson-maker/get-homework.php",
			data: { email: user, syllabus_id:syllabus_id },
			datatype: "json"
		}).done(function( data) {
            data = $.parseJSON(data);
             $("#homework-list tr.hwr").remove();
           //  console.log(data);
            $.each(data, function(index, value) {
                var submitted = value.submitted?value.submitted:'&mdash;';
                var graded = value.graded?value.graded:'&mdash;';
                var grade = value.grade?value.grade:'&mdash;';
                var desc = value.description.length>25?value.description.substring(0,25)+"...":value.description;
                homeworkrow = "<tr class=hwr><td>";
                homeworkrow += desc;
                homeworkrow += "<td>"+value.due_date+"</td>";
                homeworkrow += "<td>"+submitted+"</td>";
                homeworkrow += "<td>"+grade+" of "+value.weight+"</td>";
                homeworkrow += "</tr></td>";
                $("#homework-list").append(homeworkrow);
            });
        });
        }
        getHW();
  	}
	
	$.ajax({
		type: "GET",
		url: getRootPath()+"xanthippe/syllabus.php",
		data: { syllabus_id: syllabus_id },
		datatype: "json"
	}).done(function( data) {
		data = $.parseJSON(data);
		syllabus = data[syllabus_id];
	//	console.log(syllabus);
		$("#course-info , title").html(syllabus.course_name+"&nbsp;|&nbsp;"+syllabus.srjc_id+"&nbsp;|&nbsp;"+syllabus.semester);
        $("#cccconfer .modal-body").html(syllabus.lecture_instructions);
		var i = 1;
		$.each(syllabus.lessons, function(index, value) {
            var lessonClass = (value.is_active == 0 && profileObject.type == 'student') ? "lesson-listing" : "lesson-listing isactive";
            $("#lesson-list").append('<tr class="'+lessonClass+'" data-index='+i+' data-id='+value.lesson_id+'><td>'+value.lesson_date+'</td><td>'+value.topics+'</td></tr>');
			++i;
		});
		$(".isactive").click(function() {
			currentLesson = $(this).attr("data-index");
			showLesson($(this).attr("data-id"));
			history.pushState({i: currentLesson}, 'Title', scriptPath + "/" + syllabusURI + (currentLesson == currentWeek ? '' : '/' + currentLesson));
			$(".lesson-listing").removeClass("info");
			$(this).addClass("info");
		});
		window.addEventListener("popstate", function(e) {
			currentLesson = e.state ? e.state.i : startLesson;
			showLesson($("table#lesson-list tbody tr").eq(currentLesson).attr("data-id"));
			$(".lesson-listing").removeClass("info");
			$("table#lesson-list tbody tr").eq(currentLesson).addClass("info");
		});
		if (syllabus.students) {
			$.each(syllabus.students, function(index, value) {
				if (value.type == "instructor") {
					$("#student-list").append('<p data-id='+value.email+' class="student-listing"><strong>'+value.first_name+'</strong></p>');
				} else {
					$("#student-list").append('<p data-id='+value.email+' class="student-listing">'+value.first_name+'</p>');
				}
			});
			$(".student-listing").click(function() {
				//sylla
				$("#studentname").text(syllabus.students[$(this).attr("data-id")].first_name);
				$("#studentavatar").attr("src","http://www.gravatar.com/avatar/"+syllabus.students[$(this).attr('data-id')].gravatar_hash);
				if (syllabus.students[$(this).attr("data-id")].github_userid) {
					var githublink = "<a href=http://www.github.com/"+syllabus.students[$(this).attr("data-id")].github_userid+"/"+syllabus.repository+">"+syllabus.students[$(this).attr("data-id")].github_userid+"</a>";
					$("#studentgithub").html(githublink);
				} else {
					$("#studentgithub").html("");  
				}
				if (syllabus.students[$(this).attr("data-id")].gallery_URL) {
					var gallerylink = '<a href="'+syllabus.students[$(this).attr("data-id")].gallery_URL+'">'+syllabus.students[$(this).attr("data-id")].gallery_URL+'</a>';
					$("#studentgalleryurl").html(gallerylink);
				} else {
					$("#studentgalleryurl").html("");  
				}
				if (syllabus.students[$(this).attr("data-id")].project_description) {
					
					$("#projectdesc").text(syllabus.students[$(this).attr("data-id")].project_description);
				} else {
					$("#projectdesc").html("");  
				}
				
				$("#viewprofile").modal('show');
			});
		};
		startLesson = currentLesson;
		$("table#lesson-list tbody tr").eq(currentLesson).addClass("info");
		$("table#lesson-list tbody tr").eq(currentWeek).addClass("warning");
		showLesson($("table#lesson-list tbody tr").eq(currentLesson).attr("data-id"));
		listProjects();
	});
	
	$("#general-info").hide();
	$("#general-info-hdr").click(function() {
		$("#general-info").slideToggle('slow');
	});
	$("#logout").click(function() {
		navigator.id.logout();
		
	});
	navigator.id.watch({
		loggedInUser: null,
		onlogin: function (assertion) {
		},
		// This wont ever fire in the example.
		onlogout: function () {
			$.ajax({
				type: "GET",
				url: getRootPath()+"xanthippe/service/auth/index.php"
			}).done(function( data) {
				document.location.reload();
			});
		}
	});
	$('#studentid').text(user);
	getProfile(user);
	$("#update-profile").click(function() {
            var emailflag;
            if ($('#getemail').prop('checked')) {
                emailflag = 1;
            } else {
                emailflag = 0;
            }
			var profile = {email:user,syllabus_id:syllabus_id,gallery_URL:$('#galleryurl').text() , github_userid:$('#githubaccount').text() , project_description: $('#myproject').val(),emailflag: emailflag}
			$.ajax({
				type: "POST",
				url: getRootPath()+"lesson-maker/put-profile.php",
				data: { profile: profile },
				datatype: "json"
			}).done(function( data) {
				alert("Your Profile Was Updated");
				getProfile(user);
				syllabus.students[user].project_description = profile.project_description;
				syllabus.students[user].gallery_URL = profile.gallery_URL;
				syllabus.students[user].github_userid = profile.github_userid;
                
				$("#myprofile").modal('hide');
			});
		
	});
	//   submit homework
	
	$("#submit-exercise").click(function() {
		var a_id = $("#submit-exercise").attr("assignment-id");
		var e_id = $("#submit-exercise").attr("exercise-id");
		var homework = {student_email:user,exercise_id:e_id};
		switch (lesson.assignments[a_id].exercises[e_id].type) {
			case "url":
				homework.exerciseLink = $("#exercise-link").text();
				homework.exerciseComment = $("#exercise-comment").val();
				break;
			case "form":
				var answers = new Array();
				$.each(lesson.assignments[a_id].exercises[e_id].questions,function(index, value) {
					answers[index] = $("#exercise-q"+index).val();
				});
				homework.formAnswers = JSON.stringify(answers);
				break;
			case "test":
				var answers = new Array();
				$.each(lesson.assignments[a_id].exercises[e_id].questions,function(index, value) {
					answers[index] = $("input[name=exercise-q"+index+"]:checked").val();
				});
				homework.testAnswers = JSON.stringify(answers);
				break;
		}
		$.ajax({
			type:"POST",
			url: getRootPath()+"lesson-maker/submit-homework.php",
			data: homework,
			datatype:"json"
		}).done(function(data) {
			$("#submit-homework").modal('hide');
			if ( data ) {
				alert("Your exercise was submitted");
				var data = $.parseJSON(data);
				//	   syllabus.lessons[data.lesson_id].exercises[data.exercise_exercise_id].homeworks[data.homework_id] = data;
				var newsubmission = {comment:data.comment, first_name:data.first_name, homework_id:data.homework_id, student_email:data.student_email, topics: syllabus.lessons[data.lesson_id].topics, url:data.URL};
				if (!syllabus.students[data.student_email].homeworks) {
					syllabus.students[data.student_email].homeworks = {};
				}
				// update the student record with the new submission
				syllabus.students[data.student_email].homeworks[data.homework_id] = newsubmission;
				showLesson(data.lesson_id);
			} else
				alert("Sorry! The deadline for this submission has passed and can no longer be submitted.");
		});
	});
	$("#submit-review").click(function() {
		var grade;
		if ($("#review-grade").hasClass("icon-thumbs-up")) {
			grade=1;
		} else {
			grade=0;
		}
		var review = {comment:$("#review-comment").val(), student_email: user , homework_id:$("#submit-review").attr("homework-id"), grade:grade};
		$.ajax({
			type:"POST",
			url: getRootPath()+"lesson-maker/put-review.php",
			data: review,
			datatype:"json"
		}).done(function(data) {
			alert("Your comment was entered");
			var data = $.parseJSON(data);
			$("#write-review").modal('hide');
			// syllabus.lessons[data.lesson_id].exercises[data.exercise_id].homeworks[data.homework_homework_id].reviews[data.review_id] = data;
			showLesson(data.lesson_id);
		});
	});
    if (Modernizr.touch) {
        $("body").swiperight(function() {
            if (currentLesson>1) {
                
                $("table#lesson-list tbody tr").eq(currentLesson).removeClass("info");
                currentLesson -= 1;
                history.pushState({i: currentLesson}, 'Title', scriptPath + "/" + syllabusURI + (currentLesson == currentWeek ? '' : '/' + currentLesson));
                $("table#lesson-list tbody tr").eq(currentLesson).addClass("info");
                
                showLesson($("table#lesson-list tbody tr").eq(currentLesson).attr("data-id"));
            }
            
        });
        $("body").swipeleft(function() {
            if (currentLesson < Object.keys(syllabus.lessons).length) {
                
                $("table#lesson-list tbody tr").eq(currentLesson).removeClass("info");
                currentLesson += 1;
                history.pushState({i: currentLesson}, 'Title', scriptPath + "/" + syllabusURI + (currentLesson == currentWeek ? '' : '/' + currentLesson));
                $("table#lesson-list tbody tr").eq(currentLesson).addClass("info");
                
                showLesson($("table#lesson-list tbody tr").eq(currentLesson).attr("data-id"));
            }
        });
    }
    var mailforum = function(topic, comment, syllabus) {
        $.ajax({
	       type: "POST",
           url: getRootPath()+"forum/new-forum-mail.php",
		   data: {topic: topic, comment: comment, syllabus: syllabus},
           datatype: "json"
	    }).done(function(data) {
		});
    }
	
	var getforum = function() {
		var forum;
		$.ajax({
	       type: "GET",
           url: getRootPath()+"forum/get-forum.php",
           data: {archivedate: forumArchive, syllabus: syllabus_id},
           datatype: "json"
	    }).done(function(data) {
			forum = $.parseJSON(data);
			var content = '';
			$.each(forum, function(index,noreply) {
				content += '<div class="row"><div class="span5 noreply"><strong>'+noreply.topic+'</strong><br>'+noreply.comment+'<br>'+noreply.first_name+'&nbsp;&mdash;&nbsp;'+noreply.submitted+'</div><div class="span6 input-append"><input class="span5" type=text placeholder="Enter a Reply" /><button type="button" class="reply-button btn" data-id="'+noreply.forum_id+'">Reply</button></div></div>';
				if (noreply.replies) {
					$.each(noreply.replies, function(index2, reply) {
						content += '<div class="row"><div class="span5 reply">'+reply.comment+'<br>'+reply.first_name+'&nbsp;&mdash;&nbsp;'+reply.submitted+'</div><div class="span6 input-append"><input class="span5" type=text placeholder="Enter a Reply" /><button type="button" class="reply-button btn" data-id="'+reply.forum_id+'">Reply</button></div></div>';
						if (reply.deepreplies) {
							$.each(reply.deepreplies  , function(index3, deepreply) {
								content += '<div class="row"><div class="span5 deepreply">'+deepreply.comment+'<br>'+deepreply.first_name+'&nbsp;&mdash;&nbsp;'+deepreply.submitted+'</div><div class="span6 input-append"><input class="span5" type=text placeholder="Enter a Reply" /><button type="button" class="reply-button btn" data-id="'+deepreply.forum_id+'">Reply</button></div></div>';
								if (deepreply.deeperreplies) {
									$.each(deepreply.deeperreplies  , function(index4, deeperreply) {
										content += '<div class="row"><div class="span5 deeperreply">'+deeperreply.comment+'<br>'+deeperreply.first_name+'&nbsp;&mdash;&nbsp;'+deeperreply.submitted+'</div></div>';
									})
								}
							})
						}
					})
				}
			});
			$("#forum-list").html(content);
			$("#newpost").val('');
            $("#forumtopic").val('');
			$(".reply-button").off("click");
		
			$(".reply-button").on("click", function() {				
					var comment = $(this).parent().children(":first").val();
					var parent = $(this).attr("data-id");
                   var forumdata = {comment:comment, user : user, inreplyto: parent, syllabus: syllabus_id};
					$.ajax({
					   type: "POST",
					   url: getRootPath()+"forum/new-forum.php",
					   data: forumdata,
					   datatype: "json"
					}).done(function(data) {
						alert("Your comment was added.");
						getforum();
                        var data = $.parseJSON(data);
                       if (data.comment != "")  {
                            mailforum(data.topic, data.comment, data.syllabus);
                        }
					});
					
			});		
	    });
	}
	getforum();
	$("#newpostbtn").on("click", function() {
		var comment = $("#newpost").val();
        var topic = $("#forumtopic").val();
        var forumdata = {topic: topic, comment:comment, user : user, syllabus: syllabus_id};
		$.ajax({
	       type: "POST",
           url: getRootPath()+"forum/new-forum.php",
		    data: forumdata,
           datatype: "json"
	    }).done(function(data) {
			alert("Your comment was added.");
            var data = $.parseJSON(data);
			getforum();
            if (data.comment != "")  {
                mailforum(data.topic, data.comment, data.syllabus);
            }
		});
		
	});
    
});

function escapeHtml(unsafe) {
	return unsafe
		.replace(/&/g, "&amp;")
		.replace(/</g, "&lt;")
		.replace(/>/g, "&gt;")
		.replace(/"/g, "&quot;")
		.replace(/'/g, "&#039;");
}