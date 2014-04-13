<?
/*Testing the phPredict library
 * 
 * 
 */
date_default_timezone_set('Europe/London');

require_once 'Predict.php';
require_once 'Predict/Sat.php';
require_once 'Predict/QTH.php';
require_once 'Predict/Time.php';
require_once 'Predict/TLE.php';

$start = microtime(true);

// The observer or groundstation is called QTH in ham radio terms
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
//print_r($filtered[1]);
//die();
//$passRise=array();
//$passRise=$predict->filterVisiblePasses($results)->aos;

foreach($filtered as $key => $value){
	$aos=$value->visible_aos;
	$los=$value->visible_los;
	print $aos."\n";
	print $los."\n";
}

//var_dump($passRise);

?>