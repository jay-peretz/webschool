$(document).ready(function() {
	var forumArchive = "2014-08-12",
    syllabus_id = 3;
 var mailforum = function(topic, comment, syllabus) {
        $.ajax({
	       type: "POST",
           url: "new-forum-mail.php",
		   data: {topic: topic, comment: comment, syllabus: syllabus},
           datatype: "json"
	    }).done(function(data) {
		});
    }
	
	var getforum = function() {
		var forum;
		$.ajax({
	       type: "GET",
           url: "get-forum.php",
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
					   url: "new-forum.php",
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
           url: "new-forum.php",
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