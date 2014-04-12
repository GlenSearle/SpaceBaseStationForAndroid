<?php
include 'phppredict.php';

// php script to calculate optimum satellite choice for a given time, data requirement and cost

// import satellite data into environment from file

//split each TLE into separate satellite data sets

 echo 'Starting Prediction';

$file_loc='satellites.txt';
$satfile= file($file_loc);

$count=0;
$set=0;
$linenumber=0;
 //read file and split into array elements for each line 
var_dump($satfile);
$satellites = array();
foreach($satfile as $lines)
{	
	if($count % 3 !== 0){
		$satellites[$set][$count]= $lines;
		++$count;
		echo 'line read';
		$linenumber++;
	
	}elseif($count==0){
		$satellites[$set][$count]= $lines;
		++$count;
		echo 'line read';
		++$linenumber;
		
	}
	elseif($count % 3 == 0){
		++$set;
		echo $set;
		$count=0;
		echo $count;
		$satellites[$set][$count]=$lines;
		++$linenumber;
		echo 'new set ';
		
	}else{
		echo 'error';
	}
}	

echo 'finished reading ';
var_dump ($satellites);
 	




?>