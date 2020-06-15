$(document).ready(function(){ 
	//check Username availability...
  	$("#username").blur(function(){
  		var username = $(this).val();
  		$.ajax({
  			url:"check/checkuser.php",
  			method: "POST",
  			data: {username:username},
  			dataType:"text",
  			success: function(data){
  				$('#userstatus').html(data);
  			}
  		});
  	});

	//Autocomplete textbox
  	$("#skill").keyup(function(){
  		var skill = $(this).val();
  		if(skill != ""){
  			$.ajax({
  			url:"check/checkskill.php",
  			method: "POST",
  			data: {skill:skill},
  			dataType:"text",
  			success: function(data){
  				$('#statusskill').fadeIn();
  				$('#statusskill').html(data);
  			}
  		});
  		}
  	});

	$(document).on('click', 'li', function(){
  		$("#skill").val($(this).text());
  		$('#statusskill').fadeOut();
  	});

	//Show Password button

  $("#showpassword").on('click', function(){
    var pass = $("#password");
    var fieldtype = pass.attr('type');
    if(fieldtype == 'password'){
      pass.attr('type', 'text');
      $(this).text("Hide Password");
    }else{
      pass.attr('type', 'password');
      $(this).text("Show Password");
    }
  });

  //Auto Refresh Div Content
  $("#autosubmit").click(function(){
      var content = $("#body").val();

      if($.trim(content) != ""){
        $.ajax({
            url:"check/checkrefresh.php",
            method: "POST",
            data: {body:content},
            dataType:"text",
            success: function(data){
                 $("#body").val("");
            }
        });
        return false;
      }
  });

  setInterval(function(){
      $("#refreshstatus").load("check/getrefresh.php").fadeIn('slow');
  }, 1000);


  //Live Data Search
  $("#livesearch").keyup(function(){
      var live = $(this).val();
      if(live != ""){
        $.ajax({
            url:"check/searchlive.php",
            method: "POST",
            data: {search:live},
            dataType:"text",
            success: function(data){
              $('#searchstatus').html(data);
            }
        });
      }else{
          $('#searchstatus').html("");
      }
  });

    //Auto Save Data
    function autoSave(){
      var content = $("#content").val();
      var contentid = $("#contentid").val();
       if(content != ''){
          $.ajax({
              url:"check/saveauto.php",
              method: "POST",
              data: {content:content, contentid:contentid},
              dataType:"text",
              success: function(data){
                 if(data != ''){
                    $('#contentid').val(data);
                 }
                 $('#statussave').text("Content Save as Draft...");
                 setInterval(function(){
                    $('#statussave').text('');
                 }, 2000);
              }
          });
      }
       
   }

    setInterval(function(){
        autoSave();
    }, 10000);

 });  