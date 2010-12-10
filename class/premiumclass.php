<?php
//Constants
define(FILENAME, "baseprice.txt");


class premiumClass{
	//Local Variables
	var $base_price=0; //Malik, dont use static variables

	/**
	 * Read from the file upon class construction, Alternative way is to use the database to store this information
	 * For now I have decided to use the price since the base price is in a way independant of the data in the database.
	 */
	function __construct(){
		$f = fopen(FILENAME, "r"); //write to a text file
		$this->base_price = fgets($f); //set the base price
		fclose($f); 
	}
	
	/**
	 * find all the tickets, and history of the client
	 * Does not set the risk into the client
	 * @param unknown_type $clientID
	 */
	function calculateClientRisk($clientID){
		$risk = 0;//Initiate risk value
		$sql = "SELECT Age, Gender, Years_Exp, Training FROM Client WHERE Client_ID='$clientid'";
		$result = mysql_query($sql) or die(mysql_error());
		$client = mysql_fetch_assoc($result);
		//AGE Calculation, for every 5 years after 16, subtract 100 points
		$age = $client['Age'];
		$risk = $risk-((age/5)*100);
		//If gender is male, we add some risk
		if ($client['Gender']=='m'){
			$risk = $risk + 100;
		}
		//Tickets calculation
		$sql = "SELECT Classification, Date FROM Ticket WHERE Client_ID='$clientid'";
		$result = mysql_query($sql) or die(mysql_error());
		$i=0;
		while ($info = mysql_fetch_assoc($result)){
			$ticket[$i] = $info;
			$i++;
		}
		for ($i=0;$i<count($ticket); $i++){
			//for all tickets check the age of it, if less than 4 count into our risk
			if (getAge($ticket[$i]['Date']) < 4){
				switch ($ticket[$i]['Classification']){
					case 'A':
						$risk = $risk + 100;
						break;
					case 'B':
						$risk = $risk + 200;
						break;
					case 'C':
						$risk = $risk + 400;
						break;
					case 'D':
						$risk = $risk + 800;
						break;
				} //end switch-case			
			} //end if
		} //end for loop
		
		//Driving experience calculation {for every year of previous driving experience, decrease risk
		$risk = $risk - ($client['Year_Exp']*30);
		
		//Driver training, if client passed driving school one time reduction.
		$risk = $risk - 50;
		
		return $risk;//return
	}
	
	/**
	 * For policy_no, we find all clients and vehicles listed under the policy
	 * calculate the premium 
	 */
	function calculatePremium($policy_no){
		
	}
	
	/**
	 * for vehicle vin, calculate it's risk based on ave_daily_miles, type, and value
	 * 0 Risk for a year<1980 passenger car, driven daily 0 miles, and value under $1000
	 */
	function calculateVehicleRisk($vin){
		//Get vehicle
		$risk = 0;//Initiate risk value
		$sql = "SELECT Year, Value, Type, Ave_Daily_Miles FROM Vehicle WHERE VIN='$vin'";
		$result = mysql_query($sql) or die(mysql_error());
		$vehicle = mysql_fetch_assoc($result); //should be only one result
		//Calculate with daily miles
		$risk = $risk + $vehicle['Ave_Daily_Miles']*50;
		//Calculate with years
		if ($vehicle['Year']>1980){
			$risk = $risk + ($vehicle['Year']-1980)*50;
		}
		//For every $1000 increase risk by 100
		if ($vehicle['Value']>1000){
			$risk = $risk + (($vehicle['Value']/1000)*100);
		}
		return $risk;
		
	}
	
	/**
	 * Update premiums for ALL policies, WARNING THIS MAY TAKE A LONG TIME
	 * Enter description here ...
	 */
	function batchPremiumUpdate(){
		
	}
	
	/**
	 * We need to either store this as a file, or in the databse...
	 * If we do it as a file then
	 * Enter description here ...
	 * @param unknown_type $price
	 */
	public function setBasePrice($price){
		$f = fopen(FILENAME, "w"); //write to a text file
		fwrite($f, $price); 
		fclose($f); 
		$this->base_price = $price; // sets the base price for premiums;
	}

	public function getBasePrice(){
		return $this->base_price; // returns the base price for premiums;
	}

}
?>
