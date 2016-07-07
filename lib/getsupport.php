<?php 

		error_reporting(E_ALL);
		require_once "config.php";
		
		if($_REQUEST['userId'] != ""){
				
				$userId=$_REQUEST['userId'];
		
				$getsupport=mysql_query("SELECT * FROM `supporter` LIMIT 1,6");
				
				$getsupportcount=mysql_num_rows($getsupport);	
				
				$response='{"success":"true","error_code":"0","message":"success","supporter":[';
				$responseinner = "";
				
						while($result=mysql_fetch_array($getsupport))
						{
						
								if(!empty($result)){
								
									$supporter_id = $result['supporter_id']; 
									$supporter_level = $result['supporter_level']; 
									$supporter_icon = $result['supporter_icon']; 
									$responseinner.='{"supporter_id":"'.$supporter_id.'","supporter_level":"'.$supporter_level.'","supporter_icon":"'.$supporter_icon.'"}';
									$responseinner.=',';

								}
								else
								{
									
									$responseinner.='{"supporter_id":"","supporter_level":"","supporter_icon":""}';
									$responseinner.=',';
								
								}

						
						
						}		
						
						$response .= substr($responseinner,0,-1);
						
						
						
						
						
			$response.=']';
			//echo "SELECT userLogin.id,userLogin.emailId,supporter.supporter_id,supporter.supporter_level,supporter.supporter_icon FROM userLogin LEFT JOIN supporter ON supporter.supporter_id = userLogin.supporter_id where userLogin.id='$userId'";
						$usersupport=mysql_query("SELECT userLogin.id,userLogin.username,userLogin.accountType,userLogin.emailId,supporter.supporter_id,supporter.supporter_level,supporter.supporter_icon FROM userLogin LEFT JOIN supporter ON supporter.supporter_id = userLogin.supporter_id where userLogin.id='$userId'");
						
						
						$usersupportcount=mysql_num_rows($usersupport);
						while($results=mysql_fetch_array($usersupport))
						{
									
								$profileId = $results['id'];
								$username = $results['username'];
								$profile_type = $results['accountType'];
								$supporter_type_id = $results['supporter_id'];
								$supporter_type = $results['supporter_level'];
								$supporter_icon = "https://s3.amazonaws.com/dogysupport/".$results['supporter_icon'];
								$response .=",";
								$response .='"my_info":{"profileId":"'.$profileId.'","username":"'.$username.'","profile_type":"'.$profile_type.'","supporter_type_id":"'.$supporter_type_id.'","supporter_type":"'.$supporter_type.'","supporter_image":"'.$supporter_icon.'"}';
						}
			$response.='}';
		}
		else
		{
				
				$response='{"success":"Failed","error_code":"1","message":"Invalid userId key Or value"}';


		}
		
		echo $response;	
?>