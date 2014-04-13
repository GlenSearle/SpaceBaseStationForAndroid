<?PHP



function calcAzimuth( $lat1deg, $lon1deg, $lat2deg, $lon2deg ) {	
	$lat1 = deg2rad($lat1deg);
	$lon1 = deg2rad($lon1deg);
	$lat2 = deg2rad($lat2deg);
	$lon2 = deg2rad($lon2deg);
	return rad2deg( atan2( sin( $lon2 - $lon1 ) * cos( $lat2 ), cos( $lat1 ) * sin( $lat2 ) - sin( $lat1 ) * cos( $lat2 ) * cos( $lon2 - $lon1 ) ) );
}		
	

	
		
?>