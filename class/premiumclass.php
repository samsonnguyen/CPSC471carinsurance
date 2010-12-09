<?php
class premiumClass{

	public static $base_price=0;
	
	/**
	 * find all the tickets, and history of the client
	 * Set the risk into the client
	 * @param unknown_type $clientID
	 */
	function calculateClientRisk($clientID){
		
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
	
	public static function setBasePrice($price){
	self::$base_price = $price; // sets the base price for premiums;
	}

	public static function getBasePrice(){
	return self::$base_price; // returns the base price for premiums;
	}

}
?>
