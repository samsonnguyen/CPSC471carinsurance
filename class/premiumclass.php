<?php
//CONSTANTS FOR CLIENT RISK
define(FILENAME, "baseprice.txt");
define(CLIENT_AGE_MULTIPLE, 100); //For every 5 year after 16 subtract this
define(CLIENT_YEARS_MULTIPLE, 30); //For every year of driving exp, decrease risk by this
define(CLIENT_TRAINING, 50); //ONE TIME reduction of this if the client had training
define(TICKET_A_MULTIPLE,100); //Light offence
define(TICKET_B_MULTIPLE,200);
define(TICKET_C_MULTIPLE,400);
define(TICKET_D_MULTIPLE,800); //Serious offence
//CONSTANTS FOR VEHICLE RISK
define(VEHICLE_MILEAGE_MULTIPLE, 20); //For every mile daily driven, increase risk by this
define(VEHICLE_YEAR_MULTIPLE, 30); //For every year after 1980, increase risk by this
define(VEHICLE_VALUE_MULTIPLE, 100); //For every $1000 in value, increase by this
//CONSTANTS FOR PREMIUM CALCULATION
define(COMPANY_EMP_MULTIPLE, 1000); //UNIT in DOLLARS, for every employee covered in the policy, increase by this amount
define(COVERAGE_MULTIPLE, 10000); //UNIT IN DOLLARS, as coverage increases by 1, 


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
		$risk = $risk-((age/5)*CLIENT_AGE_MULTIPLE);
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
						$risk = $risk + TICKET_A_MULTIPLE;
						break;
					case 'B':
						$risk = $risk + TICKET_B_MULTIPLE;
						break;
					case 'C':
						$risk = $risk + TICKET_C_MULTIPLE;
						break;
					case 'D':
						$risk = $risk + TICKET_D_MULTIPLE;
						break;
				} //end switch-case			
			} //end if
		} //end for loop
		
		//Driving experience calculation {for every year of previous driving experience, decrease risk
		$risk = $risk - ($client['Year_Exp']*CLIENT_YEARS_MULTIPLE);
		
		//Driver training, if client passed driving school one time reduction.
		$risk = $risk - CLIENT_TRAINING;
		
		return $risk;//return
	}
	
	/**
	 * For policy_no, we find all clients and vehicles listed under the policy
	 * calculate the premium 
	 */
	function calculatePremium($policy_no){
		$base = $this->base_price;
		$sql = "(SELECT Coverage, #_Of_Employees FROM CompanyPolicy) UNION (SELECT Coverage FROM PrivatePolicy) WHERE Policy_No='$policy_no'";;
		$result = mysql_query($sql) or die(mysql_error());
		$policy = mysql_fetch_assoc($result);
		$premium = $this->base_price; //set this as the base price
		$premium = $premium + (($policy['Coverage']/100)*COVERAGE_MULTIPLE); //Linear increase as coverage increases. Coverage should be like a percentage
		if (isset($policy['#_Of_Employees'])){
			//This policy is a company policy
			$premium = $premium + $policy['#_Of_Employees']*COMPANY_EMP_MULTIPLE;
		}
		return $premium;
		
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
		$risk = $risk + $vehicle['Ave_Daily_Miles']*VEHICLE_MILEAGE_MULTIPLE;
		//Calculate with years
		if ($vehicle['Year']>1980){
			$risk = $risk + ($vehicle['Year']-1980)*VEHICLE_YEAR_MULTIPLE;
		}
		//For every $1000 increase risk by 100
		if ($vehicle['Value']>1000){
			$risk = $risk + (($vehicle['Value']/1000)*VEHICLE_VALUE_MULTIPLE);
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
