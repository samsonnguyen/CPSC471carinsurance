<?php
require 'db.php';
/*
 * IMPORTANT!! NOT TO BE RUN ON THE DATABASE MORE THAN ONCE.
 * THIS IS AN INITIAL INSTALL FOR SETUP ONLY!
 * THIS FILE IS JUST TO ILLUSTRATE THE QUERIES THAT WERE USED TO
 * CREATE THE INITIAL DATABASE SCHEMA.
 * IMPORTANT!!
 */

/*
 * Create mySql tables for the database to store client account
 * information and history
 */
mysql_query("CREATE TABLE Client
	(	Client_ID 	INT			NOT	NULL AUTO_INCREMENT,
		FName		VARCHAR(20)	NOT NULL,
		MName		VARCHAR(20),
		LName		VARCHAR(20) NOT NULL,
		Address		VARCHAR(50),
		City		VARCHAR(20),
		PostalCode	CHAR(6),
		Province	CHAR(2) NOT NULL,
		Phone		INT,
		Birthdate	DATE,
		License_No	CHAR(9),
		Gender		CHAR,
		Age			INT,
		Company		INT,
		Policy_No	INT,
		Years_Exp	INT	DEFAULT 0,
		Training	BOOLEAN DEFAULT 0 NOT NULL,
	PRIMARY KEY (Client_ID),
	FOREIGN KEY (Company) REFERENCES Company(Commercial_License_No)
		ON DELETE SET NULL			ON UPDATE CASCADE,
	FOREIGN KEY (Policy_No) REFERENCES Private_Policy(Policy_No)
		ON DELETE CASCADE			ON UPDATE CASCADE);") or die(mysql_error());  

//Create Company table
mysql_query("CREATE TABLE Company(
		Commercial_License_No 	INT	NOT	NULL,
		CName		VARCHAR(20)	NOT NULL,
		Address		VARCHAR(50),
		City		VARCHAR(20),
		PostalCode	CHAR(6),
		Province	CHAR(2),
		Phone		INT,
		Manager		VARCHAR(20),
		Policy_No	INT,
	PRIMARY KEY (Commercial_License_No),
	FOREIGN KEY (Policy_No) REFERENCES Company_Policy(Policy_No)
		ON DELETE SET NULL			ON UPDATE CASCADE);")
or die(mysql_error());

//Create Company_Policy table
mysql_query("CREATE TABLE Company_Policy
	(	Policy_No 		INT	NOT	NULL AUTO_INCREMENT,
		Premium_Rate	INT	NOT NULL,
		Coverage		INT,
		Num_of_Employees	INT,	
	PRIMARY KEY (Policy_No));")
or die(mysql_error());

// Create Private_Policy table
mysql_query("CREATE TABLE Private_Policy
	(	Policy_No 		INT	NOT	NULL AUTO_INCREMENT,
		Premium_Rate	INT	NOT NULL,
		Coverage		INT,	
	PRIMARY KEY (Policy_No));")
or die(mysql_error());

//Creat Ticket table
mysql_query("CREATE TABLE Ticket
	(	Client_ID		INT		NOT NULL,
		Infraction_No	INT		NOT NULL,
		Officer_Name	VARCHAR(20) NOT NULL,
		Officer_No		INT,
		Classification	CHAR,
		Date			DATE	NOT NULL,
	PRIMARY KEY (Client_ID,Infraction_No),
	FOREIGN KEY (Client_ID) REFERENCES Client(Client_ID)
		ON DELETE CASCADE			ON UPDATE CASCADE);")
or die(mysql_error());

//Create Vehicle table
mysql_query("CREATE TABLE Vehicle
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
	FOREIGN KEY (Client_ID) REFERENCES Client(Client_ID)
		ON DELETE CASCADE			ON UPDATE CASCADE);")
or die(mysql_error());

//Create Claim table
mysql_query("CREATE TABLE Claim
	(	Claim_No		INT	NOT NULL	AUTO_INCREMENT,
		Amount			INT NOT NULL,
		Date			DATE,
		Description		VARCHAR(200),
		Status			CHAR,
		Client_At_Fault	BOOLEAN,
	PRIMARY KEY (Claim_No));")
or die(mysql_error());

//Create Claims table (weak entity)
mysql_query("CREATE TABLE Claims
	(	Client_ID	INT		NOT NULL,
		Claim_No	INT		NOT NULL,
		VIN			CHAR(17)		NOT NULL,
	PRIMARY KEY (Client_ID,Claim_No,VIN),
	FOREIGN KEY (Client_ID) REFERENCES Client(Client_ID)
		ON DELETE CASCADE			ON UPDATE CASCADE,
	FOREIGN KEY (Claim_No) REFERENCES Claim(Claim_No)
		ON DELETE CASCADE			ON UPDATE CASCADE,
	FOREIGN KEY (VIN) REFERENCES Vehicle(VIN)
		ON DELETE CASCADE			ON UPDATE CASCADE);")
or die(mysql_error());

//Create Third_Party table
mysql_query("CREATE TABLE Third_Party
	(	Claim_No		INT		NOT NULL,
		Party_Name		VARCHAR(20)	NOT NULL,
		Insurer_Name	VARCHAR(20) NOT NULL,
		Phone			INT,
		Address			VARCHAR(30),
		Insurer_Rep		VARCHAR(20),
		Vehicle_Year	INT,
		Vehicle_Make	VARCHAR(15),
		Vehicle_Model	VARCHAR(20),
		Party_License_No	VARCHAR(8) NOT NULL,
	PRIMARY KEY (Claim_No,Party_Name),
	FOREIGN KEY (Claim_No) REFERENCES Claim(Claim_ID)
		ON DELETE CASCADE		ON UPDATE CASCADE);")
or die(mysql_error());
//Finished main datatables
echo "Tables Created!\n";

/*
 * Create admin database tables for the admin backend
 * Password will be text, Encryption is out of the contexts of
 * this course, therefore we are not worried about security
 * Permissions will dictate the level of access that the use has.
 */
mysql_query("CREATE TABLE Employees
	(	Employee_ID		INT	NOT NULL AUTO_INCREMENT,
		Username		VARCHAR(20)	NOT NULL,
		Password		VARCHAR(20) NOT NULL,
		Permissions		CHAR,
	PRIMARY KEY (Employee_ID));")
or die(mysql_error());

//Finished employee tables
echo "Employee Table Created! Database Install was successful";
?>
