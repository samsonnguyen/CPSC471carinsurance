<?php
//CONSTANTS FOR CLIENT RISK
define(FILENAME, "baseprice.txt");
define(CLIENT_AGE_MULTIPLE, 10); //For every 5 year after 16 subtract this
define(CLIENT_YEARS_MULTIPLE, 30); //For every year of driving exp, decrease risk by this
define(CLIENT_TRAINING, 50); //ONE TIME reduction of this if the client had training
define(TICKET_A_MULTIPLE,10); //Light offence
define(TICKET_B_MULTIPLE,20);
define(TICKET_C_MULTIPLE,40);
define(TICKET_D_MULTIPLE,80); //Serious offence
//CONSTANTS FOR VEHICLE RISK
define(VEHICLE_MILEAGE_MULTIPLE, 10); //For every mile daily driven, increase risk by this
define(VEHICLE_YEAR_MULTIPLE, 5); //For every year after 1980, increase risk by this
define(VEHICLE_VALUE_MULTIPLE, 50); //For every $1000 in value, increase by this
//CONSTANTS FOR PREMIUM CALCULATION
define(COMPANY_EMP_MULTIPLE, 500); //UNIT in DOLLARS, for every employee covered in the policy, increase by this amount
define(COVERAGE_MULTIPLE, 200); //UNIT IN DOLLARS, as coverage increases by 1, 
define(CLIENT_RISK_MULTIPLE, 10);
define(VEHICLE_RISK_MULTIPLE, 0.25);

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
		$sql = "SELECT Age, Gender, Years_Exp, Training FROM Client WHERE Client_ID='$clientID'";
		$result = mysql_query($sql) or die(mysql_error());
		$client = mysql_fetch_assoc($result);
		//AGE Calculation, for every 5 years after 16, subtract 100 points
		$age = $client['Age'];
		$risk = $risk-(($age/5)*CLIENT_AGE_MULTIPLE);
		//If gender is male, we add some risk
		if ($client['Gender']=='m'){
			$risk = $risk + 100;
		}
		//Tickets calculation
		$sql = "SELECT Classification, Date FROM Ticket WHERE Client_ID='$clientID'";
		$result = mysql_query($sql) or die(mysql_error());
		$i=0;
		while ($info = mysql_fetch_array($result,MYSQL_ASSOC)){
			$ticket[$i] = $info;
			$i++;
		}
		for ($i=0;$i<count($ticket); $i++){
			//for all tickets check the age of it, if less than 4 count into our risk
			if (getAge($ticket[$i]['Date']) <= 4){
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
		$risk = $risk -($client['Year_Exp']*CLIENT_YEARS_MULTIPLE);
		
		if ($client['Training']==1){
			//Driver training, if client passed driving school one time reduction.
			$risk = $risk - CLIENT_TRAINING;
		}
		return $risk;//return
	}
	
	/**
	 * For policy_no, we find all clients and vehicles listed under the policy
	 * calculate the premium 
	 */
	function calculatePremium($policy_no,$clientrisk,$vehiclerisk, $isCompany){
		//print $policy_no;
		$premium = $this->base_price; //Set initial base price
		if ($isCompany){
			//Policy exists in the company policy
			$sql = "SELECT Coverage, Num_Of_Employees, Premium FROM Company_Policy WHERE Policy_No='$policy_no'";
			$result = mysql_query($sql);
			$policy = mysql_fetch_assoc($result);
			//print $policy['Num_Of_Employees'];
			$premium = $premium + ($policy['Num_Of_Employees']*COMPANY_EMP_MULTIPLE);
			//print $premium;
		} else {
			//Policy exists in the private policy
			$sql = "SELECT Coverage FROM Private_Policy, Premium WHERE Policy_No='$policy_no'";
			$result = mysql_query($sql) or die(mysql_error());
			$policy = mysql_fetch_assoc($result);
		}
		//print $policy['Coverage'];
		$premium = $premium + (($policy['Coverage']+1)*COVERAGE_MULTIPLE); //Linear increase as coverage increases. Coverage should be like a percentage

		$premium = $premium + ($clientrisk * CLIENT_RISK_MULTIPLE);
		$premium = $premium + ($vehiclerisk * VEHICLE_RISK_MULTIPLE);
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
	 * returns true if the procedure was successful.
	 */
	function batchPremiumUpdate(){
		$sql = "SELECT Client_ID, Client.Policy_No, Company FROM Client JOIN Private_Policy ON Private_Policy.Policy_No=Client.Policy_No WHERE Company='0'";
		$privateresult = mysql_query($sql) or die(mysql_error());
		$sql = "SELECT Client_ID, Client.Policy_No, Company FROM Client JOIN Company_Policy ON Company_Policy.Policy_No=Client.Policy_No WHERE Company!='0'";
		$companyresult = mysql_query($sql) or die(mysql_error());
		while ($client = mysql_fetch_array($privateresult,MYSQL_ASSOC)){
			//Private
			$clientRisk = $this->calculateClientRisk($client['Client_ID']); //Clients risk
			println("Client ".$client['Client_ID']." : ".$clientRisk);
			$sql = "SELECT VIN FROM Vehicle WHERE Client_ID='".$client['Client_ID']."'"; //Get all vehicles from this client
			$result = mysql_query($sql) or die(mysql_error());
			$vehiclerisk=0;
			while($vehicle = mysql_fetch_row($result)){
				$vehiclerisk = $vehiclerisk + $this->calculateVehicleRisk($vehicle[0]); //for every vehicle add it's risk
				println("Client ".$client['Client_ID']." : v ".$vehiclerisk);
			}
			$premium = $this->calculatePremium($client['Policy_No'],$clientRisk,$vehiclerisk, false);
			//update
			$sql = "UPDATE Private_Policy SET Premium_Rate='$premium' WHERE Policy_No='".$client['Policy_No']."'";
			mysql_query($sql) or die(mysql_error());
			print "Private ".$client["Policy_No"]." : ".$premium."<br />\n";
			
		}
		
		while ($client = mysql_fetch_array($companyresult,MYSQL_ASSOC)){
			//company
			$clientRisk = $this->calculateClientRisk($client['Client_ID']); //Clients risk
			//println("Client ".$client['Client_ID']." : ".$clientRisk);
			$sql = "SELECT VIN FROM Vehicle WHERE Client_ID='".$client['Client_ID']."'"; //Get all vehicles from this client
			$result = mysql_query($sql) or die(mysql_error());
			$vehiclerisk=0;
			while($vehicle = mysql_fetch_row($result)){
				$vehiclerisk = $vehiclerisk + $this->calculateVehicleRisk($vehicle[0]); //for every vehicle add it's risk
				//println("Client ".$client['Client_ID']." : v ".$vehicleRisk);
			}
			//Company exists
			$premium = $this->calculatePremium($client['Policy_No'],$clientRisk,$vehiclerisk,true);
			//Update
			$sql = "UPDATE Company_Policy SET Premium_Rate='$premium' WHERE Policy_No='".$client['Policy_No']."'";
			mysql_query($sql) or die(mysql_error());
			print "Company ".$client['Policy_No']." : ".$premium."<br />\n";
		}
		return true;
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
