<?php
   // connect to mongodb
	
   
   $uri = "mongodb://smaatapps:smaat123@ds127399.mlab.com:27399/heroku_5tt1944k";

/* 
 * We recommend explictly configuring a connection timeout (see tips & tricks
 * below). Specify the replica set name to avoid connection errors.
 */ 

$client = new MongoClient($uri);
 echo "Connection to database successfully";
?>
