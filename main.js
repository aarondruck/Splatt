var ChatAnywhere	= function(){
	
	var isiPhone = navigator.userAgent.toLowerCase().indexOf("iphone");
		var isiPad = navigator.userAgent.toLowerCase().indexOf("ipad");
		  	var isiPod = navigator.userAgent.toLowerCase().indexOf("ipod");
		
		if(isiPhone > -1)
		{
		    //Redirect to iPhone Version of the website.
		  //$(".footer").html('<form id="chat-form" action="#"><input class="input" id="chat-input" type="text" /><input class="submit" id="chat-submit" type="submit" value="Send" /></form><hr/>');
		  $('head').load('draw/index.php');
		}
		if(isiPad > -1)
		{
			alert("iPad");
		    //Redirect to iPad Version of the website.
		}
	
	var channelName	= jQuery.url.param("channel")	|| "wsanywhere-chat";
	var username	= jQuery.url.param("user")	|| "user-"+Math.floor(Math.random()*9999);
	
	// TODO put that in jQuery ? what is this ? obsolete ?
	var statusEl	= document.getElementById("chat-status")
	var textAreaEl	= document.getElementById("chat-textarea")
	var usernameEl	= document.getElementById("chat-username")
	var formEl	= document.getElementById("chat-form");
	var inputEl	= document.getElementById("chat-input")
	// var get Image from server here for inputEl
	var submitEl	= document.getElementById("chat-submit");

	var setUsername	= function(username){
		jQuery("#container .header .username").empty().text(username)
	}
	setUsername(username)
	jQuery("#container .header .channel.value").text(channelName)
	var setStatus	= function(status){
		jQuery("#container .header .status").text(status)
	}
	var updateChatArea	= function(tmplClass, tmplData){
		$( "#container ."+ tmplClass).tmpl(tmplData)
			.appendTo("#container .chatArea");
		// scroll to the bottom
		var chatAreaEl	= jQuery("#container .chatArea").get(0);
		chatAreaEl.scrollTop = jQuery("#container .chatArea").height();
	}
	var setMessage	= function(tmplData){
		updateChatArea("tmplChatMessage", tmplData)
	}
	var setJoin	= function(tmplData){
		updateChatArea("tmplChatJoin", tmplData)
	}
	var setRename	= function(tmplData){
		updateChatArea("tmplChatRename", tmplData)
	}
	
	jQuery("#container .header .editButton").click(function(){
		var selector	= "#container .header .username";
		var oldUsername	= jQuery("#container .header .username").text();
		jQuery(selector).empty();
		jQuery("<input type='text'/>").attr("value", oldUsername).appendTo(selector);
		jQuery(selector+ " input").focus();
		jQuery(selector+ " input").blur(function(){
			var newUsername	= jQuery(selector+ " input").val();
			jQuery("#container .footer .input").focus();
			if( !newUsername )	return;
			setUsername(newUsername);
			sendRename(oldUsername, newUsername)
		})
	})
	
	var socketUrl	= "ws://example.com/"+channelName;
	var socket	= new EasyWebSocket(socketUrl);
	socket.onopen	= function(){
		setStatus("Connected");
		sendJoin(username);
	}
	socket.onmessage= function(event){
		var event	= JSON.parse(event.data);
		//console.log("event", event)
		if( event.type == "message" ){
			setMessage(event.data);			
		}else if( event.type == "join" ){
			setJoin(event.data);
		}else if( event.type == "left" ){
		}else if( event.type == "rename" ){
			setRename(event.data);
		}else{
			//console.log("unhandled event in socket message")
		}
	}
	socket.onclose	= function(){
		setStatus("Closed");
	}
	jQuery("#container .footer form").submit(function(){
		var username	= jQuery("#container .header .username").text()
		var message	= inputEl.value;
		if( !message )	return false;
		sendMessage(username, inputEl.value);
		inputEl.value	= "";
		return false;
	})
	var socketSend	= function(data){
		//console.log("socketSend", data)
		socket.send(JSON.stringify(data));
	}
	var sendMessage	= function(username, message){
		socketSend({
			type	: "message", // change the type?
			data	: {
				username: username,
				message	: inputEl.value + " TRIGGER"		
				//image				
			}
		});
	}
	var sendJoin	= function(username){
		socketSend({
			type	: "join",
			data	: {
				username: username,
			}
		});
	}
	var sendLeave	= function(username){
		socketSend({
			type	: "leave",
			data	: {
				username: username,
			}
		});
	}
	var sendRename	= function(oldUsername, newUsername){
		socketSend({
			type	: "rename",
			data	: {
				newUsername: newUsername,
				oldUsername: oldUsername
			}
		});
	}
}
jQuery(function(){	
	var chat	= new ChatAnywhere();
})
