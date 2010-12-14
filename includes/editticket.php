<div id="container">
  <!-- p id="fm-intro" required for 'hide optional fields' function -->
  <p id="fm-intro">Fields in <strong>bold</strong> are required.</p>

  <form name="addticket" id="fm-form" method="post" action="tickets.php?action=update&form&ticket=<?php print $infraction_no;?>" >
    <fieldset>
    <legend>Ticket Information</legend>
    <div class="fm-req"><label for="fm-clientid"><a href="client.php?action=update&client=<?php print $info['Client_ID']?>">Client:</a></label> <select
	id="fm-clientid" name="fm-clientid">
	<?php Client::getAllClients($info['Client_ID']); ?>
	</select></div>
    <div class="fm-req">

      <label for="fm-infraction_no">Infraction Number:</label>
      <input id="fm-infraction_no" name="fm-infraction_no" type="text" <?php print "value=\"".$info['Infraction_No']."\"";?>/>
    </div>
    <div class="fm-req">
      <label for="fm-officer_name">Officer Name:</label>
      <input name="fm-officer_name" id="fm-officer_name" type="text" <?php print "value=\"".$info['Officer_Name']."\"";?>/>
    </div>
    <div class="fm-opt">
      <label for="fm-officer_no">Officer Number:</label>
      <input name="fm-officer_no" id="fm-officer_no" type="text" <?php print "value=\"".$info['Officer_No']."\"";?>/>
    </div>
    <div class="fm-req">
      <label for="fm-classification">Classification:</label>
      <select id="fm-classification" name="fm-classification">
		<option value='A' <?php if($info['Classification']=="A") print "selected";?>>Civil Infraction</option>
		<option value='B' <?php if($info['Classification']=="B") print "selected";?>>Criminal Infraction</option>
		<option value='C' <?php if($info['Classification']=="C") print "selected";?>>Misdemeanor</option>
		<option value='D' <?php if($info['Classification']=="D") print "selected";?>>Felony</option>
	  </select>
    </div>
	
	<div class="fm-req">
			<?php 
				$token="-./ ";
				$year = strtok($info['Date'],$token);
				$month = strtok($token);
				$day = strtok($token);
			?>
			<label for="fm-date">Date:</label>
			<span>Month:</span>
			<select id="fm-month" name="fm-month">
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
			</select>
			<span>Day:</span>
			<select id="fm-day" name="fm-day">
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
			</select>
			<span>Year:</span>
			<input name="fm-year" id="fm-year" type="text" <?php print "value=\"$year\" ";?> />
		</div>
	
    </fieldset>
    <div id="fm-submit" class="fm-req">
      <input name="Submit" value="Submit" type="submit" />
    </div>
  </form>
</div>