<div style="display: none;" class="se-pre-con"></div>
<div id="masonryWr" class="row" >
<style>
.detail a {
    color: #000;
    text-decoration: none;
}
.detail a:hover, .detail a:focus {
	text-decoration: none;
	color: #D8BE2A;
}
.once-only {
	width: 130px;
}
</style>
<?php

foreach($invited_events as $key=>$val)
{
		
	 ?>
		 <div class="person">
                <div class="row persona">
                  <div class="col-xs-4 col-sm-3 text-center">
                    <span class="detail"><a href="<?php echo base_url();?>index.php/event_detail_talent_invited/<?php echo $val['event_id']; ?>"><img style="width: 120px; height: 120px;" src="<?php echo $val['event_details'][0]['event_pic']; ?>"></a></span>
                  </div>
                  <div class="col-xs-8 col-sm-6">
                    <span class="detail"><a href="<?php echo base_url();?>index.php/event_detail_talent_invited/<?php echo $val['event_id']; ?>"><h3><?php echo $val['event_details'][0]['event_name']; ?>
                    </h3></a></span>
					<?php
						$startdatetime = $val['event_details'][0]['start_datetime'];
						$start_datetime = date('D dS M Y h:i A', strtotime($startdatetime));
						
						$enddatetime = $val['event_details'][0]['end_datetime'];
						$end_datetime = date('D dS M Y h:i A', strtotime($enddatetime));
					?>
                     <h4><?php echo $start_datetime; ?> - <?php echo $end_datetime; ?>
                    </h4>
                     <?php 
						$datetime1 = new DateTime($start_datetime);
						$datetime2 = new DateTime($end_datetime);
						$interval = $datetime1->diff($datetime2);
						$total_hours = $interval->format('%a days %h hours %i minutes'); 
						
						$total_days = $interval->format('%a'); 
						$total_hrs = $interval->format('%h'); 
						if($total_days != 0) {
							$total_hrs = $total_hrs + ($total_days * 24);
						}
						
						$total_mins = $interval->format('%i'); 
						
						$mins = round($total_mins/60 * 100);
						$hrs_mins = $total_hrs . "." . $mins;
						
					    $total_pay = $hrs_mins * 25;
					?>
                    <div class="row uppercase">
                      <div class="col-xs-12">
                        <p>
                          <span class=
                                "glyphicon glyphicon-pushpin">
                          </span><?php echo $val['event_details'][0]['location']; ?>
                        </p>
						<p class="text-info">
                          <span class=
                                "glyphicon glyphicon-usd">
                          </span>Approximate pay is $<?php echo $total_pay; ?>
                        </p>
                      </div>
                     
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <div class="invitebutton">
						<p class="centerText">
						 <a class="btn btn-danger btn-lg largeHeight once-only" href="<?php echo base_url();?>index.php/event_detail_talent_invited/<?php echo $val['event_id']; ?>"
							   role="button">View details</a>
						</p>
						<p class="centerText">
						  <input type="hidden" value="<?php echo $val['event_id']; ?>" id="apply<?php echo $val['event_id']; ?>">			
								<a class=
							   "btn btn-submit btn-lg largeHeight once-only btn_confirms" value="<?php echo $val['event_id']; ?>"
							   role="button" id="btn1" textbox_id="#apply<?php echo $val['event_id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;Accept&nbsp;&nbsp;&nbsp;&nbsp;
							 </a>
							<a role="button" class="btn btn-danger btn-lg largeHeight reject-btn" data-toggle="modal" data-target="#myModal">&nbsp;&nbsp;&nbsp;Reject&nbsp;&nbsp;&nbsp;</a>
						 </p>					   
                    </div>
                  </div>
                </div>
                <hr>
              </div>

			  <!-- Modal -->
			  <div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog">
				
				  <!-- Modal content-->
				  <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">Reject</h4>
					</div>
					<div class="modal-body">
					 
					<input type="hidden" value="<?php echo $val['event_id']; ?>" id="reject<?php echo $val['event_id']; ?>">					  
						<a class=
					   "btn btn-danger btn-lg largeHeight once-only btn_rejects" value="<?php echo $val['event_id']; ?>"
					   role="button" id="btn2" textbox_id2="#reject<?php echo $val['event_id']; ?>">Reject
					 </a>	
					</div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				  </div>
				  
				</div>
			  </div>
	<?php
	
	
}

?>
</div>
<script>
	
</script>

<script>
 
  $(".btn_confirms").click(function()
	 {
	  var textbox_id = $(this).attr('textbox_id');
	  var textbox_val = $(textbox_id).val(); 
	  applytoevent(textbox_val);
	  $(this).attr('disabled', true);
	  $(this).text('Accepted');
	  $(".btn_rejects").attr('disabled', true);
	 });
	 
	
  function applytoevent(textbox_val){
		var talent_id = "<?php echo $this->session->userdata('talent_id');  ?>";
		var event_id = textbox_val;
			
			var url = 'http://smaatapps.com/nector/webservice/index.php/accept_event_by_talent';
			
			$.ajax({
				'type' : 'POST',
				'url': url,
				'data': {'talent_id':talent_id,'event_id':event_id},
				//'dataType': 'json',
				beforeSend: function(){
					 $(".se-pre-con").show();
				   },
				   complete: function(){
					 $(".se-pre-con").hide();
				   },
				success: function(data) {
					var message = JSON.stringify(data['StatusCode']);
					var message = message.replace(/\"/g, "");
					//alert(JSON.stringify(data['Message']));
					if(message == "1") {
							window.location.reload();
						}
				}
			
			});

	}
  </script>
  
  <script>
 
  $(".btn_rejects").click(function()
	 {
	  var textbox_id2 = $(this).attr('textbox_id2'); 
	  var textbox_val2 = $(textbox_id2).val(); 
	  rejectevent(textbox_val2); 
	  $(".reject-btn").attr('disabled', true);
	  $(".reject-btn").text('Rejected');
	  $(this).attr('disabled', true);
	  $(this).text('Rejected');
	  $(".btn_confirms").attr('disabled', true);
	  $('#myModal').modal('hide');
	 });
	 
	
  function rejectevent(textbox_val2){
		var talent_id = "<?php echo $this->session->userdata('talent_id');  ?>";
		var event_id = textbox_val2;
		var reason = $("#rejectreason").val();
			
			var url = 'http://smaatapps.com/nector/webservice/index.php/reject_event_by_talent';
			
			$.ajax({
				'type' : 'POST',
				'url': url,
				'data': {'talent_id':talent_id,'event_id':event_id,'talent_reject_reason':reason},
				//'dataType': 'json',
				beforeSend: function(){
					 $(".se-pre-con").show();
				   },
				   complete: function(){
					 $(".se-pre-con").hide();
				   },
				success: function(data) {
					var message = JSON.stringify(data['StatusCode']);
					var message = message.replace(/\"/g, "");
					//alert(JSON.stringify(data['Message']));
					if(message == "1") {
							window.location.reload();
						}
				}
			
			});

	}
  </script>
