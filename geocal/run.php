<?php
/**
 * Where ISS
 *
 * A test of the Predict port
 *
 */

date_default_timezone_set('Europe/London');

require_once 'Predict.php';
require_once 'Predict/Sat.php';
require_once 'Predict/QTH.php';
require_once 'Predict/Time.php';
require_once 'Predict/TLE.php';

// Track execution time of this script
$start = microtime(true);

// The observer or groundstation is called QTH in ham radio terms
$predict  = new Predict();
$qth      = new Predict_QTH();

// Space App Challange London
$qth->lat = 51.497010; // Latitude North
$qth->lon = -0.178984; // Longitude East
$qth->alt = 40; // Altitude in meters

// Taken from http://celestrak.com/NORAD/elements/stations.txt
$tleFile = file('sats.tle');

$resultsArray = array();
$lineCounter = 0;

while (isset($tleFile[$lineCounter+2])) {

	$tle     = new Predict_TLE($tleFile[$lineCounter], $tleFile[$lineCounter+1], $tleFile[$lineCounter+2]);
	
	$lineCounter += 3;
		
	$sat     = new Predict_Sat($tle); // Load up the satellite data
	$now     = Predict_Time::get_current_daynum(); // get the current time as Julian Date (daynum)
	
	// Get the time, but use time() function for testing
	$time   = time();
	$sat_geodetic = new Predict_Geodetic();
	$daynum = Predict_Time::unix2daynum($time);
		
	$sat_geodetic = new Predict_Geodetic();
	
	$sat->jul_utc = $daynum;
	$sat->tsince = ($sat->jul_utc - $sat->jul_epoch) * Predict::xmnpda;
	
	/* call the norad routines according to the deep-space flag */
	$sgpsdp = Predict_SGPSDP::getInstance($sat);
	if ($sat->flags & Predict_SGPSDP::DEEP_SPACE_EPHEM_FLAG) {
		$sgpsdp->SDP4($sat, $sat->tsince);
	} else {
		$sgpsdp->SGP4($sat, $sat->tsince);
	}
	
	Predict_Math::Convert_Sat_State($sat->pos, $sat->vel);
	
	// Get the velocity of the satellite
	$sat->vel->w = sqrt($sat->vel->x * $sat->vel->x + $sat->vel->y * $sat->vel->y + $sat->vel->z * $sat->vel->z);
	$sat->velo = $sat->vel->w;
	Predict_SGPObs::Calculate_LatLonAlt($sat->jul_utc, $sat->pos, $sat_geodetic);

	// Get the Azimuth and Elevation
	$obs_set      = new Predict_ObsSet();
	$obs_geodetic = new Predict_Geodetic();
	$obs_geodetic->lon   = $qth->lat * $predict::de2ra;
	$obs_geodetic->lat   = $qth->lon * $predict::de2ra;
	$obs_geodetic->alt   = $qth->alt / 1000.0;
	$obs_geodetic->theta = 0;
    Predict_SGPObs::Calculate_Obs($sat->jul_utc, $sat->pos, $sat->vel, $obs_geodetic, $obs_set);

	
	// See if a pass is ongoing
	$los = $predict->find_los($sat, $qth, $daynum, $daynum);
	$aos = $predict->find_aos($sat, $qth, $daynum, $daynum);

	$vis = ( $los < $aos );

	if ( $vis ) {

		$theLat = Predict_Math::Degrees( $sat_geodetic->lat ); 
		$theLon = Predict_Math::Degrees( $sat_geodetic->lon );

		include_once('geofunc.php');
		$theAzimuth = calcAzimuth($qth->lat, $qth->lon, $theLat, $theLon);
		$theElevation = calcAltitude($qth->lat, $qth->lon, 6371, $theLat, $theLon, 6371+$sat->alt );

		if ($theLon > 180) {
			$theLon -= 360;
		}
		
		// Debugging output
		echo $theLat . "," . $theLon . ',' . $theAzimuth . ',' . $theElevation . "\n";
		// Save results
		array_push($resultsArray, trim($sat->tle->catnr) . ',' . $theLat . ',' . $theLon . ',' . $theAzimuth . ',' . $theElevation);
	}

}

// Sort so the best sat is first
sort($resultsArray);

// Save the file to sebd to the Aerduino
if (isset($resultsArray[0])) {
	$destSat = explode(',', $resultsArray[0]);
	file_put_contents( 'command.txt', "GA " . round($destSat[3], 2) . "\nGO " . round($destSat[4], 2) . "\n" );
}


?>