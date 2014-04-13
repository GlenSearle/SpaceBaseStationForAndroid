<?PHP

function calcAzimuth( $lat1deg, $lon1deg, $lat2deg, $lon2deg ) {	
	$lat1 = deg2rad($lat1deg);
	$lon1 = deg2rad($lon1deg);
	$lat2 = deg2rad($lat2deg);
	$lon2 = deg2rad($lon2deg);
	return rad2deg( atan2( sin( $lon2 - $lon1 ) * cos( $lat2 ), cos( $lat1 ) * sin( $lat2 ) - sin( $lat1 ) * cos( $lat2 ) * cos( $lon2 - $lon1 ) ) );
}		
	
function calcAltitude( $lat1deg, $lon1deg, $height1, $lat2deg, $lon2deg, $height2 ) {
	$lat = deg2rad($lat1deg) - deg2rad($lat2deg);
	$lon = deg2rad($lon1deg) - deg2rad($lon2deg);

	$c = sqrt(pow(2*sin($lon/2)*$height2,2)+pow(2*sin($lat/2)*$height2,2));
	$alpha = asin($c*$height2/2);
	$f = $c/$height2*$height1;
	return rad2deg(atan(($height2-$height1)/$f));

}

	
		
?>