<?php
class premiumClass{

	private $base_price=0; //Malik, dont use static variables
	
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
	 */
	function calculateVehicleRisk($vin){
		
	}
	
	/**
	 * Update premiums for ALL policies, WARNING THIS MAY TAKE A LONG TIME
	 * Enter description here ...
	 */
	function batchPremiumUpdate(){
		
	}
	
	public function setBasePrice($price){
		$this->$base_price = $price; // sets the base price for premiums;
	}

	public function getBasePrice(){
		return $this->$base_price; // returns the base price for premiums;
	}

}
?>
