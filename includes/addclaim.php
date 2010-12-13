<div id="container">
	
  <!-- p id="fm-intro" required for 'hide optional fields' function -->
  <p id="fm-intro">Fields in <strong>bold</strong> are required.</p>

  <form name="addclaim" id="fm-form" method="post" action="claim.php?action=add&form" >
    <fieldset>
    	<legend>Claim Information</legend>
	 	<div class="fm-req">
      		<label for="fm-amount">Claim Amount:</label>
      		<input id="fm-amount" name="fm-amount" type="text" value="<?php print $_POST['fm-amount'];?>" />
    	</div>
      <div class="fm-req">
      <label for="fm-date">Date:</label>
      <span>Month:</span>
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
	  
		<span>Year:</span>
		<input name= "fm-year" id="fm-year" type="text" value="<?php print $_POST['fm-year'];?>" />
    </div>
    <div class="fm-opt">
      <label for="fm-description">Description:</label>
      <textarea name="fm-description" id="fm-description"><?php print $_POST['fm-description'];?></textarea>
    </div>
    
    <div class="fm-req">
      <label for="fm-status">Status:</label>
	  <select id="fm-status" name="fm-status">
		<option value="0"  <?php if($_POST['fm-status']=="0") print "selected";?>>Pending</option>
		<option value="1" <?php if($_POST['fm-status']=="1") print "selected";?>>Completed</option>
		<option value="2" <?php if($_POST['fm-status']=="2") print "selected";?>>Filed</option>
		<option value="3" <?php if($_POST['fm-status']=="3") print "selected";?>>Declined</option>
      </select>
      </div>
	
    </fieldset>
    <fieldset>
    <legend>Third Party information</legend>
    <div class="fm-req">
      <label for="fm-tp-name">Name:</label>
	  <input id="fm-tp-name" name="fm-tp-name" type ="text" value="<?php print $_POST['fm-tp-name'];?>" />
    </div>
    <div class="fm-req">
      <label for="fm-tp-insurer">Insurer Name:</label>
	  <input id="fm-tp-insurer" name="fm-tp-insurer" type ="text" value="<?php print $_POST['fm-tp-insurer'];?>" />
    </div>
    <div class="fm-req">
      <label for="fm-tp-phone">Insurer Phone:</label>
	  <input id="fm-tp-phone" name="fm-tp-phone" type ="text" value="<?php print $_POST['fm-tp-phone'];?>" />
    </div>
    <div class="fm-req">
      <label for="fm-tp-address">Insurer Address:</label>
	  <input id="fm-tp-address" name="fm-tp-address" type ="text" value="<?php print $_POST['fm-tp-address'];?>" />
    </div>
        <div class="fm-req">
      <label for="fm-tp-rep">Representative:</label>
	  <input id="fm-tp-rep" name="fm-tp-rep" type ="text" value="<?php print $_POST['fm-tp-rep'];?>" />
    </div>
     <div class="fm-req">
      <label for="fm-tp-year">Vehicle Year:</label>
	  <input id="fm-tp-year" name="fm-tp-year" type ="text" value="<?php print $_POST['fm-tp-year'];?>" />
    </div>
    <div class="fm-req">
      <label for="fm-tp-make">Make:</label>
	  <input id="fm-tp-make" name="fm-tp-make" type ="text" value="<?php print $_POST['fm-tp-make'];?>" />
    </div>
        <div class="fm-req">
      <label for="fm-tp-model">Model:</label>
	  <input id="fm-tp-model" name="fm-tp-model" type ="text" value="<?php print $_POST['fm-tp-model'];?>" />
    </div>
    <div class="fm-req">
      <label for="fm-tp-license">Driver's License Number:</label>
	  <input id="fm-tp-license" name="fm-tp-license" type ="text" value="<?php print $_POST['fm-tp-license'];?>" />
    </div>
    </fieldset>
    <fieldset>
    <legend>Client Involved with this Claim</legend>
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
      <label for="fm-cl-vin">Vehicle VIN:</label>
	  <input id="fm-cl-vin" name="fm-cl-vin" type ="text"
	  <?php if(isset($_GET['vehicle'])){
	  	print "value=\"".$_GET['vehicle']."\" ";
	  } else {
	  	print "value=\"".$_POST['fm-cl-vin']."\" ";
	  }?> 
	  />
    </div>
    </fieldset>
    <div class="fm-multi">
      <div class="fm-atfault">
      	<span>Is the Client at fault?</span>
        <label for="fm-atfaultyes">
        <input name="fm-atfault" type="radio" id="fm-atfaultyes" value="1" checked="checked" />
        Yes</label>
        <label for="fm-atfaultno">
        <input id="fm-atfaultno" name="fm-atfault" type="radio" value="0" />
        No</label>
      </div>
    </div>
    <div id="fm-submit" class="fm-req">
      <input name="Submit" value="Submit" type="submit" />
    </div>
  </form>
</div>
