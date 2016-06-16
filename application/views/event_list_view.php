<div style="display: none;" class="se-pre-con"></div>
<div id="masonryWr" class="row" >
<style>
.detail a {
    color: #000;
    text-decoration: none;
}
.detail a:hover, .detail a:focus {
	text-decoration: none;
	color: #F5A623;
}
.once-only {
	width: 130px;
}
</style>
<?php

foreach($events as $key=>$val)
{

		
	 ?>
		 <div class="person">
                <div class="row persona">
                  <div class="col-xs-4 col-sm-3 text-center"> 
                    <span class="detail"><a href="<?php echo base_url();?>index.php/event_detail_talent/<?php echo $val['event_id']; ?>"><img style="width: 120px; height: 120px;" src="<?php echo $val['event_pic']; ?>"></a></span>
                  </div>
                  <div class="col-xs-8 col-sm-6">
                    <span class="detail"><a href="<?php echo base_url();?>index.php/event_detail_talent/<?php echo $val['event_id']; ?>"><h3><?php echo $val['event_name']; ?>
                    </h3></a></span>
                     <?php
						$startdatetime = $val['start_datetime'];
						$start_datetime = date('D dS M Y h:i A', strtotime($startdatetime));
						
						$enddatetime = $val['end_datetime'];
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
                          </span><?php echo $val['location']; ?>
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
					  <input type="hidden" value="<?php echo $val['event_id']; ?>" id="apply<?php echo $val['event_id']; ?>">
					   <?php 
							$invitedid = $val['invited_details'];
							$confirmed = $val['confirmed_details_event'];
						if($invitedid == "0") { ?>
							<a class=
                           "btn btn-submit btn-lg largeHeight once-only btn_confirms" value="<?php echo $val['event_id']; ?>"
                           role="button" id="btn1" textbox_id="#apply<?php echo $val['event_id']; ?>">Apply
						 </a>
						<?php } ?>
						
						<?php 
						if($invitedid == "1") { ?>
							<a class=
                           "btn btn-submit btn-lg largeHeight once-only btn_confirms disabled" value="<?php echo $val['event_id']; ?>"
                           role="button" id="btn1" textbox_id="#apply<?php echo $val['event_id']; ?>">Applied
						 </a>
						<?php } ?>
						
						
						
                      </p>
					  <p class="centerText">
						 <a class="btn btn-danger btn-lg largeHeight once-only" href="<?php echo base_url();?>index.php/event_detail_talent/<?php echo $val['event_id']; ?>"
							   role="button">View details</a>
						</p>
                    </div>
                  </div>
                </div>
                <hr>
              </div>  
			  
			  <!-- Modal -->
			  <div class="modal fade" id="myModala" role="dialog">
				<div class="modal-dialog">
				
				  <!-- Modal content-->
				  <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">Notification</h4>
					</div>
					<div class="modal-body">
					 <div class="form-group">
					  <label for="rejectreason">Already applied for an event this time.</label>
					</div>
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
 
  $(".btn_confirms").click(function()
	 {
	  var textbox_id = $(this).attr('textbox_id');
	  var textbox_val = $(textbox_id).val();
	  applytoevent(textbox_val);
	  $(this).attr('disabled', true);
	  $(this).text('Applied');
	 });
	
  function applytoevent(textbox_val){
		var talent_id = "<?php echo $this->session->userdata('talent_id');  ?>";
		var event_id = textbox_val;
			
			var url = 'http://smaatapps.com/nector/webservice/index.php/talent_apply_event';
			
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
					/*if(message == "0") {
							//window.location.reload();
							$('#myModala').modal('show');
						}*/
				}
			
			});

	}
	
	$('#myModala').on('hidden.bs.modal', function () {
		 location.reload();
		});
  </script>
