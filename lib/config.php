<?php

	   $host = "dtdb-dev.chibwsimd7gb.ap-southeast-1.rds.amazonaws.com:3306";
	   
	   
	  /* $dbuser = "smaatapp_dogy";
	 	$db_password = "dogyTales123$";
		$database="smaatapp_dogyTales";*/
		$dbuser ="dtuser";
	 	$db_password ="Ze5rewefEc";
		$database="dogytales";

	   //$host = "localhost";
	  /* $dbuser = "smaatapp_dogy";
	 	$db_password = "dogyTales123$";
		$database="smaatapp_dogyTales";*/
		// $dbuser ="root";
	 	//$db_password ="";
		//$database="dogytales";
		    
 	    /* $dbuser = "smaatapp_mdiet";
	 	$db_password = "mdiet$123";
		$database="smaatapp_mdiet";    */
	 
    mysql_connect($host,$dbuser,$db_password) or die ("Error connecting to DB");
	$selectDb=mysql_select_db($database) ;	
	if($selectDb)
	{
		//echo "successfully done";	
	}

?>