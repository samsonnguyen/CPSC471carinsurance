<?php
/*
 * Check if the use is logged in using session data
 */
function isLoggedIn(){
	if(isset($_SESSION['user'])){
		return true; //User logged int
	} else{
		return false; //User not logged in
	}
}

function getUserPermissions(){
	if (isset($_SESSION['permission'])){
		return $_SESSION['permission'];
	} else {
		return 0;
	}
}

function getAge($birthdate){
	$token="-./ ";
	$p1 = strtok($birthdate,$token);
	$p2 = strtok($token);
	$p3 = strtok($token);
	$currentDate = getdate();
	$currentyear = $currentDate[year];
	$currentday = $currentDate[mday];
	$currentmonth = $currentDate[mon];
	$age = $currentyear-$p1; //calculate age
	if ($currentmonth < $p2){
		//Birthdate has not passed yet
		$age--;
	} else if ($currentyear == $p2 && $currentday<$p3){
		$age--;
	}
	return $age;
}

function input2date($idate)
{
	$token="-./ ";

	$p1 = strtok($idate,$token);
	$p2 = strtok($token);
	$p3 = strtok($token);
	$p4 = strtok($token);

	$date="";
	$y=""; $m=""; $d="";

	// check 'd.m.y'
	if (($p1>0 && $p1<32) &&
	($p2>0 && $p2<13) &&
	($p3>32))
	{
		$y=$p3;
		$m=$p2;
		$d=$p1;
	}

	// check 'y.m.d'
	if ($y == "" &&
	($p1>32) &&
	($p2>0 && $p2<13) &&
	($p3>0 && $p3<32))
	{
		$y=$p1;
		$m=$p2;
		$d=$p3;
	}

	// check 'd.m'
	if ($y == "" &&
	($p3=="") &&
	($p2>0 && $p2<13) &&
	($p1>0 && $p1<32))
	{
		$y=date("Y");
		$m=$p2;
		$d=$p1;
	}

	// check 'd'
	if ($y == "" &&
	($p3=="") &&
	($p2=="") &&
	($p1>0 && $p1<32))
	{
		$y=date("Y");
		$m=date("m");
		$d=$p1;
	}

	// add 1900 or 2000 to year
	if ($y!="" && $y<=99)
	{
		if ($y>=70) $y = $y + 1900;
		if ($y<70) $y = $y + 2000;
	}

	if ($y!="")
	{
		if (checkdate($m, $d, $y))
		$date="$y-$m-$d";
	}

	return $date;
}
?>