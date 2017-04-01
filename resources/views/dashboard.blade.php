<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Bootstrap Chat Box Example</title>
    <!-- BOOTSTRAP CORE STYLE CSS -->

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- CORE BOOTSTRAP SCRIPTS  FILE -->
    <script src="assets/js/bootstrap.js"></script>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME  CSS -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE CSS -->
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<body>

  <nav class="navbar navbar-inverse navbar-fixed-top " style="height:60px;">
	<div class="container-fluid">
		<div class="navbar-header">

			<a class="navbar-brand" href="#">minichat</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#">Login</a></li>
				<li><a href="#">SignUp</a></li>

				<li>
					<a href="\profile">{{ Auth::user()->name }} </a></li>
          <input type="hidden" id="email" value="{{ Auth::user()->email }}"/>
				</li>
				<li class=" navbarli"><a href="{{ url('/auth/logout') }}">Logout</a></li>
			</ul>
			<form style="width:250px;margin-right:20px;;" class="navbar-form navbar-right">
				<ul class="list-group" style="width:inherit;" style="background:white;" id="searchfriend">

				</ul>
			</form>
		</div>
	</div>
</nav>
    <div class="container-fluid" style="margin-top:40px;">
        <div class="row pad-top pad-bottom">


            <div class=" col-lg-9 col-md-9 col-sm-9">
                <div class="chat-box-div">
                    <div class="chat-box-head">
                        GROUP CHAT HISTORY

                    </div>
                    <div class="panel-body chat-box-main row" id="msgbox" style="background:black;">


                      </div>
                    <div class="chat-box-footer">
                        <div class="input-group">
                            <input type="text" id="comment" class="form-control" placeholder="Enter Text Here...">
                            <span class="input-group-btn">
                                <button class="btn btn-info" id="sendie" type="button">SEND</button>
                            </span>
                        </div>
                    </div>

                </div>

            </div>
            <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="chat-box-online-div">
                    <div class="chat-box-online-head" id="totaluser">

                    </div>
                    <div class="panel-body chat-box-online" id="online-box">

                                          </div>

                </div>

            </div>
        </div>
    </div>

    <script>
    var instanse=false;
    var state=0;
    var allow=false;

    function call_update()
    {


      updateChat();
    instanse=false;
        setTimeout(call_update,5000);

    }
    $('document').ready(function(){



      function Chat () {
          this.update = updateChat;
          this.send = sendChat;
          this.getStateAndLoad = getStateAndLoadChat;
      }

      var chat =  new Chat();

    chat.getStateAndLoad();
    $('#sendie').click(function(e) {

               var message=$('#comment').val();
               $('#comment').val('');
               $(this).attr("disabled", true);
    if(message=='')
    {

    }
    else {
    // send

    chat.send(message);
    }
    });

    });



    //load the inital chat


    //gets the state of the chat
    function getStateAndLoadChat() {

    	if(!instanse){

    		instanse = true;


    		$.ajax({
    			type: "POST",
    			url: "forum",
    			data: {'function': 'getStateAndLoad' },
    			dataType: "json",
    			success: function(data) {

            console.log(data);
            if(data.messages)
            {

                      var messagearr=data.messages;
                        state = data.state;
                      //load the chat
                          allow=true;
                    loaddata(messagearr);

            }

            instanse = false;


    call_update();

            }
    		});
    	}
      instanse = false;
    }
    function loaddata(messagearr)
    {
console.log("hello");
console.log(allow);
      if(allow)
      {
    var email=$("#email").val();
    console.log(email);
      for(i=0;i<messagearr.length;i++)
      {

        console.log("hello");
        if(messagearr[i].email==email)
        {
          $("#msgbox").append('<div class="chat-box-right  "style= "background:#4DDB94">'+messagearr[i].message+'</div><div class="chat-box-name-right">YOU<img src="assets/img/user.png" alt="bootstrap Chat box user image" class="img-circle" /></div><hr class="hr-clas" />');
        }
        else {
          $("#msgbox").append('<div class="chat-box-left " style="background:#ffb473;">'+messagearr[i].message+'</div><div class="chat-box-name-left">'+messagearr[i].username+'<img src="assets/img/user.png" alt="bootstrap Chat box user image" class="img-circle" /></div><hr class="hr-clas" />');

        }



             $("#sendie").attr("disabled", false);
            $("#msgbox").scrollTop('50000');




      }
    }
    }
    //Updates the chat
    function updateChat() {

    	if(!instanse){
    		instanse = true;

    		$.ajax({
    			type: "POST",
    			url: "forum",
    			data: {'function': 'update','state': state},
    			dataType: "json",
    			success: function(data) {
console.log(data);
            if(data.text==false)
            {

              $("#totaluser").text('ONLINE USERS(0)');
$("#online-box").empty();
              if(data.user.length!=0)
              {
                totaluser=data.user.length;
                $("#totaluser").text('ONLINE USERS('+totaluser+')');
                for(i=0;i<data.user.length;i++)
                {
                  var user=data.user;
                  $('#online-box').append('<div class="chat-box-online-left"><img src="assets/img/user.png" alt="bootstrap Chat box user image" class="img-circle" />'+user[i]+'<br />( <small>Active from 3 hours</small> )</div>  <hr class="hr-clas-low" />');

                }
            }
            }
            else if(data.msg.length==0)
            {

            }
            else {
            var messagearr=data.msg;
            loaddata(messagearr);
              state = data.state;
      instanse = false;
    			}
        }
    		});
    	}
    	else {
    		setTimeout(updateChat, 1500);

    	}
    }

    //send the message
    function sendChat(message) {


    	$.ajax({
    		type: "POST",
    		url: "forum",
    		data: {'function': 'send','message':message},
    		dataType: "json",
    		success: function(data){
          console.log(data);
          updateChat();
    		}
    	});
    }




    </script>


    <!-- USING SCRIPTS BELOW TO REDUCE THE LOAD TIME -->
    <!-- CORE JQUERY SCRIPTS FILE -->

</body>

</html>
