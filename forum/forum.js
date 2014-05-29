$(document).ready(function() {
	
	var getforum = function() {
		var forum;
		$.ajax({
	       type: "GET",
           url: "get-forum.php",
           datatype: "json"
	    }).done(function(data) {
			forum = $.parseJSON(data);
			console.log(forum);
			var content = '';
			$.each(forum, function(index,noreply) {
				content += '<div class="row"><div class="span5 noreply"><strong>'+noreply.topic+'</strong><br>'+noreply.comment+'<br>'+noreply.first_name+'&nbsp;&mdash;&nbsp;'+noreply.submitted+'</div><div class="span6 input-append"><input class="span5" type=text placeholder="Enter a Reply" /><button type="button" class="reply-button btn" data-id="'+noreply.forum_id+'">Reply</button></div></div>';
				if (noreply.replies) {
					$.each(noreply.replies, function(index2, reply) {
						content += '<div class="row"><div class="span4 reply">'+reply.comment+'<br>'+reply.first_name+'&nbsp;&mdash;&nbsp;'+reply.submitted+'</div><div class="span6 input-append"><input class="span5" type=text placeholder="Enter a Reply" /><button type="button" class="reply-button btn" data-id="'+index2+'">Reply</button></div></div>';
						if (reply.deepreplies) {
							$.each(reply.deepreplies  , function(index3, deepreply) {
								content += '<div class="row"><div class="span4 deepreply">'+deepreply.comment+'<br>'+deepreply.first_name+'&nbsp;&mdash;&nbsp;'+deepreply.submitted+'</div><div class="span6 input-append"><input class="span5" type=text placeholder="Enter a Reply" /><button type="button" class="reply-button btn" data-id="'+index3+'">Reply</button></div></div>';
								if (deepreply.deeperreplies) {
									$.each(deepreply.deeperreplies  , function(index4, deeperreply) {
										content += '<div class="row"><div class="span4 deeperreply">'+deeperreply.comment+'<br>'+deeperreply.first_name+'&nbsp;&mdash;&nbsp;'+deeperreply.submitted+'</div></div>';
									})
								}
							})
						}
					})
				}
			});
			$("#forum-list").html(content);
			$(".reply-button").off("click");
		
			$(".reply-button").on("click", function() {				
					var comment = $(this).parent().children(":first").val();
					var parent = $(this).attr("data-id");
					$.ajax({
					   type: "POST",
					   url: "new-forum.php",
					   data: {comment:comment, user : user, inreplyto: parent},
					   datatype: "json"
					}).done(function(data) {
						alert("Your comment was added.");
						getforum();
					});
					
			});		
	    });
	}
	getforum();
    
    $("#newpostbtn").on("click", function() {
		var comment = $("#newpost").val();
        var topic = $("#forumtopic").val();
		$.ajax({
	       type: "POST",
           url: "new-forum.php",
		    data: {topic: topic, comment:comment, user : user},
           datatype: "json"
	    }).done(function(data) {
			alert("Your comment was added.");
			getforum();
		});
		
	});
    
	
});