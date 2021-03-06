<?php 
error_reporting(0);
include('client_header.php'); ?>
<body>
  <?php 
	error_reporting(0);
	include('settings_menu_xs.php'); ?>
  <div class="container">
    <div class="row">
      <?php 
	error_reporting(0);
	include('settings_menu.php'); ?>
      <div class="col-sm-8 whiteBG invitebox topmargin30 profile">
        <div>
		<h5 id="alertmsg" class="error_msg"></h5>
          <div class="row">
            <div class="col-xs-12">
              <h1>Password
              </h1>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <hr>
              <h4>Change Password
              </h4>     
            </div>                
          </div>
          <div class="prepend-top form-group">
		  <?php $password = $client_profile[0]['password']; 
			if($password == "") { ?>
				<form target="_top" data-toggle="validator" id="myForm" action="">
					<label class="pull-left required" for="">current password
					</label>
					<input class="form-control" name="" id="current_password" type="password" maxlength="85" value="" disabled>
					<label class="pull-left required" for="">new password
					</label>
					<input class="form-control" name="" id="new_password" type="password" maxlength="85" value="" disabled>
					<div class="help-block">Minimum of 6 characters</div>
					<label class="pull-left required" for="">confirm password
					</label>
					<input class="form-control" name="" id="" type="password" data-match="#new_password" data-match-error="Whoops, these don't match" maxlength="85" value="" disabled>
					<div class="help-block with-errors"></div>
					<div class="invitebutton">
					  <p class="centerText btn-group">
						<button id="submit" name="submit" type="button" class="btn btn-submit btn-search largeHeight" disabled>Update password</button>
					  </p>
					</div>
				</form>
			<?php }
		  ?>
		  
		  <?php if($password != "") { ?>
		  <form target="_top" data-toggle="validator" id="myForm" action="">
            <label class="pull-left required" for="">current password
            </label>
            <input class="form-control" name="" id="current_password" type="password" maxlength="85" value="">
            <label class="pull-left required" for="">new password
            </label>
            <input class="form-control" name="" id="new_password" type="password" maxlength="85" value="" required>
			<div class="help-block">Minimum of 6 characters</div>
            <label class="pull-left required" for="">confirm password
            </label>
            <input class="form-control" name="" id="" type="password" data-match="#new_password" data-match-error="Whoops, these don't match" maxlength="85" value="">
			<div class="help-block with-errors"></div>
            <div class="invitebutton">
              <p class="centerText btn-group">
                <button id="submit" name="submit" type="button" class="btn btn-submit btn-search largeHeight">Update password</button>
              </p>
            </div>
			</form>
			<?php }
		  ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php 
	error_reporting(0);
	include('client_footer.php'); ?>
  
  <script>
		
		$( "#submit" ).click(function() {
		  passupdate();
		});
		
		function passupdate(){
			var current_password = $("#current_password").val();
			var new_password = $("#new_password").val();
			var client_id = <?php echo $client_profile[0]['client_id']; ?>; 
			
				var url = 'http://smaatapps.com/nector/webservice/index.php/client_update_password';
				
				$.ajax({
					'type' : 'POST',
					'url': url,
					'data': {'client_id':client_id,'current_password':current_password,'new_password':new_password},
					//'dataType': 'json',
					success: function(data) {
						//alert(JSON.stringify(data));
						var message = JSON.stringify(data['StatusCode']);
						var message = message.replace(/\"/g, "");
						
						if(message == "1") {								
							window.location.reload();
						}
						else {
							var alertmessage = JSON.stringify(data['message']);
							$("#alertmsg").text(alertmessage);
							$("html, body").animate({ scrollTop: 0 }, "slow");
						}
					}
				
				});
	
		}


	</script>
</body>
</html>
