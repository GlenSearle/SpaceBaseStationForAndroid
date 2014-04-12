<?php

 /*Script to find the overhead orbits for a given long/lat and set of satellites
  * Input the current longitude and latitude and satelllite list and time required
  * Output the overhead passes and requisite data for passes
  */
  
  //Get the data from passes
 
 include 'calculator.php';
 include 'Testing/where_iss.php';
 
  
 $longitude=$_GET('longitude');
 $latitude=$_GET('latitude');
 $satellites=$_GET('satellite list url');
 $timeStart=$_GET('start time');
 $timeEnd=$_GET('end time');
 
 
 $satelliteList=file_get_contents($sats);
 
 // Calculate satellite passes overhead for each satellite and tabulate into an array.
 
 // Split file into loop for each satellite.
 
 $satList=array();
 $satList=parseSatellites($satelliteList);
 print_r($satList);
 
 
 $predict  = new Predict();   
 $qth      = new Predict_QTH();
 
 $qth->alt = 40; // Altitude in meters -  feed into function

 $qth->lat = 51.497010;   // Latitude North
 $qth->lon = -0.178984;
 
 $tleFile = file('examples/iss.tle'); // Load up the ISS data file from NORAD | get this as a functional input
	$tle     = new Predict_TLE($tleFile[0], $tleFile[1], $tleFile[2]); // Instantiate it | run this through a foreach loop
	$sat     = new Predict_Sat($tle); // Load up the satellite data |
	$now     = Predict_Time::get_current_daynum(); // get the current time as Julian Date (daynum)
	
	// Get the passes and filter visible passes
	$results  = $predict->get_passes($sat, $qth, $now, 1) ;
	//print_r( $filtered = $predict->filterVisiblePasses($results) );
	$filtered = $predict->filterVisiblePasses($results);
 
 
 foreach($satlist as $satellites){
 	//evaluate each satellite for passes overhead
 	
	
 }

?>