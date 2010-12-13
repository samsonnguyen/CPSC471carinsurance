<div id="container">
	
  <!-- p id="fm-intro" required for 'hide optional fields' function -->
  <p id="fm-intro">Fields in <strong>bold</strong> are required.</p>

  <form name="addticket" id="fm-form" method="post" action="tickets.php?action=add&form" >
    <fieldset>
		    <legend>Ticket Information</legend>
    <div class="fm-req"><label for="fm-clientid">Client:</label> <select
	id="fm-clientid" name="fm-clientid">
	<?php if(isset($_GET['client'])){
      		Client::getAllClients($_GET['client']);
      	} else if (isset($_POST['fm-clientid'])){
			Client::getAllClients($_POST['fm-clientid']);
      	} else {
      		Client::getAllClients();
      	} ?>
	</select></div>
    <div class="fm-req">
      <label for="fm-infraction_no">Infraction Number:</label>
      <input name="fm-infraction_no" id="fm-infraction_no" type="text" value="<?php print $_POST['fm-infraction_no'];?>" />
    </div>
    <div class="fm-req">

      <label for="fm-officer_name">Officer Name:</label>
      <input id="fm-officer_name" name="fm-officer_name" type="text" value="<?php print $_POST['fm-officer_name'];?>" />
    </div>
    <div class="fm-opt">
      <label for="fm-officer_no">Officer Number:</label>
      <input name="fm-officer_no" id="fm-officer_no" type="text" value="<?php print $_POST['fm-officer_no'];?>" />
    </div>
    <div class="fm-req">
      <label for="fm-classification">Classification:</label>
      <select id="fm-classification" name="fm-classification">
		<option value='A' <?php if($_POST['fm-classification']=="A") print "selected";?>>Civil Infraction</option>
		<option value='B' <?php if($_POST['fm-classification']=="B") print "selected";?>>Criminal Infraction</option>
		<option value='C' <?php if($_POST['fm-classification']=="C") print "selected";?>>Misdemeanor</option>
		<option value='D' <?php if($_POST['fm-classification']=="D") print "selected";?>>Felony</option>
	  </select>
    </div>
    <div class="fm-req">
      <label for="fm-date">Date:</label>
      <a>Month:</a>
	  <select id="fm-month" name="fm-month">
		<option value='01' <?php if($_POST['fm-month']=="01") print "selected";?>>January</option>
		<option value='02' <?php if($_POST['fm-month']=="02") print "selected";?>>February</option>
		<option value='03' <?php if($_POST['fm-month']=="03") print "selected";?>>March</option>
		<option value='04' <?php if($_POST['fm-month']=="04") print "selected";?>>April</option>
		<option value='05' <?php if($_POST['fm-month']=="05") print "selected";?>>May</option>
		<option value='06' <?php if($_POST['fm-month']=="06") print "selected";?>>June</option>
		<option value='07' <?php if($_POST['fm-month']=="07") print "selected";?>>July</option>
		<option value='08' <?php if($_POST['fm-month']=="08") print "selected";?>>August</option>
		<option value='09' <?php if($_POST['fm-month']=="09") print "selected";?>>September</option>
		<option value='10' <?php if($_POST['fm-month']=="10") print "selected";?>>October</option>
		<option value='11' <?php if($_POST['fm-month']=="11") print "selected";?>>November</option>
		<option value='12' <?php if($_POST['fm-month']=="12") print "selected";?>>December</option>
      </select>
	  
	  <span>Day:</span>
	  <select id="fm-day" name="fm-day">
      	<option value='01' <?php if($_POST['fm-day']=="01") print "selected";?>>01</option>
		<option value='02' <?php if($_POST['fm-day']=="02") print "selected";?>>02</option>
		<option value='03' <?php if($_POST['fm-day']=="03") print "selected";?>>03</option>
		<option value='04' <?php if($_POST['fm-day']=="04") print "selected";?>>04</option>
		<option value='05' <?php if($_POST['fm-day']=="05") print "selected";?>>05</option>
		<option value='06' <?php if($_POST['fm-day']=="06") print "selected";?>>06</option>
		<option value='07' <?php if($_POST['fm-day']=="07") print "selected";?>>07</option>
		<option value='08' <?php if($_POST['fm-day']=="08") print "selected";?>>08</option>
		<option value='09' <?php if($_POST['fm-day']=="09") print "selected";?>>09</option>
		<option value='10' <?php if($_POST['fm-day']=="10") print "selected";?>>10</option>
		<option value='11' <?php if($_POST['fm-day']=="11") print "selected";?>>11</option>
		<option value='12' <?php if($_POST['fm-day']=="12") print "selected";?>>12</option>
		<option value='13' <?php if($_POST['fm-day']=="13") print "selected";?>>13</option>
		<option value='14' <?php if($_POST['fm-day']=="14") print "selected";?>>14</option>
		<option value='15' <?php if($_POST['fm-day']=="15") print "selected";?>>15</option>
		<option value='16' <?php if($_POST['fm-day']=="16") print "selected";?>>16</option>
		<option value='17' <?php if($_POST['fm-day']=="17") print "selected";?>>17</option>
		<option value='18' <?php if($_POST['fm-day']=="18") print "selected";?>>18</option>
		<option value='19' <?php if($_POST['fm-day']=="19") print "selected";?>>19</option>
		<option value='20' <?php if($_POST['fm-day']=="20") print "selected";?>>20</option>
		<option value='21' <?php if($_POST['fm-day']=="21") print "selected";?>>21</option>
		<option value='22' <?php if($_POST['fm-day']=="22") print "selected";?>>22</option>
		<option value='23' <?php if($_POST['fm-day']=="23") print "selected";?>>23</option>
		<option value='24' <?php if($_POST['fm-day']=="24") print "selected";?>>24</option>
		<option value='25' <?php if($_POST['fm-day']=="25") print "selected";?>>25</option>
		<option value='26' <?php if($_POST['fm-day']=="26") print "selected";?>>26</option>
		<option value='27' <?php if($_POST['fm-day']=="27") print "selected";?>>27</option>
		<option value='28' <?php if($_POST['fm-day']=="28") print "selected";?>>28</option>
		<option value='29' <?php if($_POST['fm-day']=="29") print "selected";?>>29</option>
		<option value='30' <?php if($_POST['fm-day']=="30") print "selected";?>>30</option>
		<option value='31' <?php if($_POST['fm-day']=="30") print "selected";?>>31</option>
		</select>
	  
		<a>Year:</a>
		<input name= "fm-year"	id="fm-year" type="text" value="<?php print $_POST['fm-year'];?>" />
	  
    </div>

    </fieldset>
    <div id="fm-submit" class="fm-req">
      <input name="Submit" value="Submit" type="submit" />
    </div>
  </form>
</div>
