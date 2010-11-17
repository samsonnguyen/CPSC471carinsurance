<?php
require 'db.php';


// Create a MySQL table in the selected database
mysql_query("CREATE TABLE Client
	(	Client_ID 	INT			NOT	NULL AUTO_INCREMENT,
		Name		VARCHAR(20)	NOT NULL,
		Address		VARCHAR(50),
		Phone		INT,
		Birthdate	INT,
		Licence_No	CHAR(9),
		Gender		CHAR,
		Age			INT,
		Company		INT,
		Policy_No	INT,
	PRIMARY KEY (Client_ID),
	FOREIGN KEY (Company) REFERENCES Company(Commercial_License_No),
	FOREIGN KEY (Policy_No) REFERENCES Private_Policy(Policy_No)); ")
 	or die(mysql_error());  
	
mysql_query("CREATE TABLE Company(
		Commercial_License_No 	INT	NOT	NULL,
		Name		VARCHAR(20)	NOT NULL,
		Address		VARCHAR(50),
		Phone		INT,
		Manager		VARCHAR(20),
		Policy_No	INT,
	PRIMARY KEY (Commercial_License_No),
	FOREIGN KEY (Policy_No) REFERENCES Company_Policy(Policy_No));")
 	or die(mysql_error());  
	
mysql_query("	CREATE TABLE Company_Policy
	(	Policy_No 		INT	NOT	NULL AUTO_INCREMENT,
		Premium_Rate	INT	NOT NULL,
		Coverage		INT,
		#_Of_Employees	INT,	
	PRIMARY KEY (Policy_No));")
 	or die(mysql_error());  

mysql_query("	CREATE TABLE Private_Policy
	(	Policy_No 		INT	NOT	NULL AUTO_INCREMENT,
		Premium_Rate	INT	NOT NULL,
		Coverage		INT,	
	PRIMARY KEY (Policy_No));")
 	or die(mysql_error());  
	
mysql_query("	CREATE TABLE Ticket
	(	Client_ID		INT		NOT NULL,
		Infraction_No	INT		NOT NULL,
		Officer_Name	VARCHAR(20) NOT NULL,
		Officer_No		INT,
		Classification	CHAR,
		Date			DATE	NOT NULL,
	PRIMARY KEY (Client_ID,Infraction_No),
	FOREIGN KEY (Client_ID) REFERENCES Client(Client_ID));")
 	or die(mysql_error());  
	
mysql_query("	CREATE TABLE Clients_Under_Policy
	(	Client_ID		INT		NOT NULL,
		Client_Under	INT		NOT NULL,
	PRIMARY KEY (Client_ID,Client_Under),
	FOREIGN KEY (Client_ID) REFERENCES Client(Client_ID),
	FOREIGN KEY (Client_Under) REFERENCES Client(Client_ID));")
 	or die(mysql_error());  
		
mysql_query("	CREATE TABLE Vehicle
	(	VIN				CHAR(17)		NOT NULL,
		Year			NUMERIC(4,0)	NOT NULL,
		Make			VARCHAR(15),
		Model			VARCHAR(20),
		Trim			VARCHAR(10),
		Color			VARCHAR(10),
		Value			INT,
		Risk			INT,
		License_Plate_No	VARCHAR(8)		NOT NULL,
		Ave_Daily_Miles	INT,
		#_Of_Wheels		SHORTINT,
		Displacement	INT,
		Client_ID		INT		NOT NULL,
		Type			CHAR,
		Commercial		BOOLEAN,
	PRIMARY KEY (VIN),
	FOREIGN KEY (Client_ID) REFERENCES Client(Client_ID));")
 	or die(mysql_error());  
	
mysql_query("	CREATE TABLE Claim
	(	Claim_No		INT	NOT NULL	AUTO_INCREMENT,
		Amount			INT NOT NULL,
		Date			DATE,
		Description		VARCHAR(200),
		Status			CHAR,
		Client_At_Fault	BOOLEAN,
	PRIMARY KEY (Claim_No));")
 	or die(mysql_error());  
	
mysql_query("	CREATE TABLE Claims
	(	Client_ID	INT		NOT NULL,
		Claim_No	INT		NOT NULL,
		VIN			CHAR(17)		NOT NULL,
	PRIMARY KEY (Client_ID,Claim_No,VIN),
	FOREIGN KEY (Client_ID) REFERENCES Client(Client_ID),
	FOREIGN KEY (Claim_No) REFERENCES Claim(Claim_No),
	FOREIGN KEY (VIN) REFERENCES Vehicle(VIN));")
 	or die(mysql_error());  
	
mysql_query("	CREATE TABLE Third_Party
	(	Claim_No		INT		NOT NULL,
		Party_Name		VARCHAR(20)	NOT NULL,
		Insurer_Name	VARCHAR(20) NOT NULL,
		Phone			INT,
		Address			VARCHAR(30),
		Insurer_Rep		VARCHAR(20),
		Vehicle_Year	INT,
		Vehicle_Make	VARCHAR(15),
		Vehicle_Model	VARCHAR(20),
		Party_License_No	VARCHAR(8),
	PRIMARY KEY (Claim_No,Party_Name),
	FOREIGN KEY (Claim_No) REFERENCES Claim(Claim_ID));")
 	or die(mysql_error());  

echo "Tables Created! Database Install was successful";

?>
