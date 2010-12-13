<div id="container"><!-- p id="fm-intro" required for 'hide optional fields' function -->
<p id="fm-intro">Fields in <strong>bold</strong> are required.</p>

<form name="addclaim" id="fm-form" method="post"
	action="claim.php?action=update&form&claim=<?php print $claimID; ?>">
<fieldset><legend>Claim Information</legend>
<div class="fm-req"><label for="fm-claimid">Claim Number:</label> <input
	id="fm-claimid" name="fm-claimid" type="text" disabled
	<?php print "value=\"".$claim['Claim_No']."\" ";?> /></div>
<div class="fm-req"><label for="fm-amount">Claim Amount:</label> <input
	id="fm-amount" name="fm-amount" type="text"
	<?php print "value=\"".$claim['Amount']."\" ";?> /></div>
<div class="fm-req"><?php 
$token="-./ ";
$year = strtok($claim['Date'],$token);
$month = strtok($token);
$day = strtok($token);
?> <label for="fm-date">Date:</label> <span>Month:</span> <select
	id="fm-month" name="fm-month">
	<option value='01' <?php if($month==1){print "selected ";} ?>>January</option>
	<option value='02' <?php if($month==2){print "selected ";} ?>>February</option>
	<option value='03' <?php if($month==3){print "selected ";} ?>>March</option>
	<option value='04' <?php if($month==4){print "selected ";} ?>>April</option>
	<option value='05' <?php if($month==5){print "selected ";} ?>>May</option>
	<option value='06' <?php if($month==6){print "selected ";} ?>>June</option>
	<option value='07' <?php if($month==7){print "selected ";} ?>>July</option>
	<option value='08' <?php if($month==8){print "selected ";} ?>>August</option>
	<option value='09' <?php if($month==9){print "selected ";} ?>>September</option>
	<option value='10' <?php if($month==10){print "selected ";} ?>>October</option>
	<option value='11' <?php if($month==11){print "selected ";} ?>>November</option>
	<option value='12' <?php if($month==12){print "selected ";} ?>>December</option>
</select> <span>Day:</span> <select id="fm-day" name="fm-day">
	<option value='01' <?php if($day==1){print "selected ";} ?>>01</option>
	<option value='02' <?php if($day==2){print "selected ";} ?>>02</option>
	<option value='03' <?php if($day==3){print "selected ";} ?>>03</option>
	<option value='04' <?php if($day==4){print "selected ";} ?>>04</option>
	<option value='05' <?php if($day==5){print "selected ";} ?>>05</option>
	<option value='06' <?php if($day==6){print "selected ";} ?>>06</option>
	<option value='07' <?php if($day==7){print "selected ";} ?>>07</option>
	<option value='08' <?php if($day==8){print "selected ";} ?>>08</option>
	<option value='09' <?php if($day==9){print "selected ";} ?>>09</option>
	<option value='10' <?php if($day==10){print "selected ";} ?>>10</option>
	<option value='11' <?php if($day==11){print "selected ";} ?>>11</option>
	<option value='12' <?php if($day==12){print "selected ";} ?>>12</option>
	<option value='13' <?php if($day==13){print "selected ";} ?>>13</option>
	<option value='14' <?php if($day==14){print "selected ";} ?>>14</option>
	<option value='15' <?php if($day==15){print "selected ";} ?>>15</option>
	<option value='16' <?php if($day==16){print "selected ";} ?>>16</option>
	<option value='17' <?php if($day==17){print "selected ";} ?>>17</option>
	<option value='18' <?php if($day==18){print "selected ";} ?>>18</option>
	<option value='19' <?php if($day==19){print "selected ";} ?>>19</option>
	<option value='20' <?php if($day==20){print "selected ";} ?>>20</option>
	<option value='21' <?php if($day==21){print "selected ";} ?>>21</option>
	<option value='22' <?php if($day==22){print "selected ";} ?>>22</option>
	<option value='23' <?php if($day==23){print "selected ";} ?>>23</option>
	<option value='24' <?php if($day==24){print "selected ";} ?>>24</option>
	<option value='25' <?php if($day==25){print "selected ";} ?>>25</option>
	<option value='26' <?php if($day==26){print "selected ";} ?>>26</option>
	<option value='27' <?php if($day==27){print "selected ";} ?>>27</option>
	<option value='28' <?php if($day==28){print "selected ";} ?>>28</option>
	<option value='29' <?php if($day==29){print "selected ";} ?>>29</option>
	<option value='30' <?php if($day==30){print "selected ";} ?>>30</option>
	<option value='31' <?php if($day==31){print "selected ";} ?>>31</option>
</select> <span>Year:</span> <input name="fm-year" id="fm-year"
	type="text" <?php print "value=\"$year\" ";?> /></div>
<div class="fm-req"><label for="fm-description">Description:</label> <textarea
	name="fm-description" id="fm-description"><?php print $claim['Description']?></textarea>
</div>

<div class="fm-req"><label for="fm-status">Status:</label> <select
	id="fm-status" name="fm-status">
	<option value="0" <?php if($claim['Status']==0){print "selected ";} ?>>Pending</option>
	<option value="1" <?php if($claim['Status']==1){print "selected ";} ?>>Completed</option>
	<option value="2" <?php if($claim['Status']==2){print "selected ";} ?>>Filed</option>
	<option value="3" <?php if($claim['Status']==3){print "selected ";} ?>>Declined</option>
</select></div>

</fieldset>
<fieldset><legend>Third Party information</legend>
<div class="fm-req"><label for="fm-tp-name">Name:</label> <input
	id="fm-tp-name" name="fm-tp-name" type="text"
	<?php print "value=\"".$thirdparty['Party_Name']."\" ";?> /></div>
<div class="fm-req"><label for="fm-tp-insurer">Insurer Name:</label> <input
	id="fm-tp-insurer" name="fm-tp-insurer" type="text"
	<?php print "value=\"".$thirdparty['Insurer_Name']."\" ";?> /></div>
<div class="fm-req"><label for="fm-tp-phone">Insurer Phone:</label> <input
	id="fm-tp-phone" name="fm-tp-phone" type="text"
	<?php print "value=\"".$thirdparty['Phone']."\" ";?> /></div>
<div class="fm-req"><label for="fm-tp-address">Insurer Address:</label>
<input id="fm-tp-address" name="fm-tp-address" type="text"
<?php print "value=\"".$thirdparty['Address']."\" ";?> /></div>
<div class="fm-req"><label for="fm-tp-rep">Representative:</label> <input
	id="fm-tp-rep" name="fm-tp-rep" type="text"
	<?php print "value=\"".$thirdparty['Insurer_Rep']."\" ";?> /></div>
<div class="fm-req"><label for="fm-tp-year">Vehicle Year:</label> <input
	id="fm-tp-year" name="fm-tp-year" type="text"
	<?php print "value=\"".$thirdparty['Vehicle_Year']."\" ";?> /></div>
<div class="fm-req"><label for="fm-tp-make">Make:</label> <input
	id="fm-tp-make" name="fm-tp-make" type="text"
	<?php print "value=\"".$thirdparty['Vehicle_Make']."\" ";?> /></div>
<div class="fm-req"><label for="fm-tp-model">Model:</label> <input
	id="fm-tp-model" name="fm-tp-model" type="text"
	<?php print "value=\"".$thirdparty['Vehicle_Model']."\" ";?> /></div>
<div class="fm-req"><label for="fm-tp-license">Driver's License Number:</label>
<input id="fm-tp-license" name="fm-tp-license" type="text"
<?php print "value=\"".$thirdparty['Party_License_No']."\" ";?> /></div>
</fieldset>
<fieldset><legend>Client Involved with this Claim</legend>
<div class="fm-req"><label for="fm-cl-clientid">Client ID:</label> <input
	id="fm-cl-clientid" name="fm-cl-clientid" type="text"
	<?php print "value=\"".$claims['Client_ID']."\" ";?> /></div>
<div class="fm-req"><label for="fm-cl-vin">Vehicle VIN:</label> <input
	id="fm-cl-vin" name="fm-cl-vin" type="text"
	<?php print "value=\"".$claims['VIN']."\" ";?> /></div>
</fieldset>
<div class="fm-multi">
<div class="fm-atfault"><span>Is the Client at fault?</span> <label
	for="fm-atfaultyes"> <input name="fm-atfault" type="radio"
	id="fm-atfaultyes" value="1"
	<?php if($claim['Client_At_Fault']==1){print "checked ";}?> /> Yes</label>
<label for="fm-atfaultno"> <input id="fm-atfaultno" name="fm-atfault"
	type="radio" value="0"
	<?php if($claim['Client_At_Fault']==0){print "checked ";}?> /> No</label>
</div>
</div>
<div id="fm-submit" class="fm-req"><input name="Submit" value="Submit"
	type="submit" /></div>
</form>
</div>
