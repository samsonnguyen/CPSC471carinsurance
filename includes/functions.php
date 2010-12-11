<?php
/**
 * Check if the user is logged in using session data
 */
function isLoggedIn(){
	if(isset($_SESSION['user'])){
		return true; //User logged int
	} else{
		return false; //User not logged in
	}
}

/**
 * Reads the session and returns the permission
 */
function getUserPermissions(){
	if (isset($_SESSION['permission'])){
		return $_SESSION['permission'];
	} else {
		return 0;
	}
}

/**
 * Calculates an age of a person by comparing to
 * the current date date should be in the format
 * YYYY-MM-DD
 * @param unknown_type $birthdate
 */
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

/**
 * Converts a string into mysql compatible dates
 * Enter description here ...
 * @param unknown_type $idate
 */
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

/**
 * Converts a string with astericks(*) into mysql wildcard type strings.
 * EXAMPLE: *2123123***23*dsd -> %2123123___23_dsd
 * @param unknown_type $str
 */
function convertToLike($str){
	$tempStr = $str;
	if (substr($str,-1)=='*'){//If the last character is an astericks change into %
		$tempStr = substr_replace($tempStr,'%', -1);
	}
	if (substr($tempStr,0,1)=='*'){//If the first character is an astericks change into %
		$tempStr = substr_replace($tempStr,'%', 0,1);
	}
	//Convert the rest of the astericks into underscores
	$tempStr = str_replace('*','_',$tempStr);
	return $tempStr;
}

/**
 * Prints permission's errors
 */
function printAccessDeniedMsg(){
	if (!isLoggedIn()){
		print "<a href='index.php'><span class='denied'>Please login for access</span></a>\n";
	} else {
		print "<span class='denied'>Access Denied</span>\n";
	}
}
?>