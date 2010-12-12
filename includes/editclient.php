<div id="container">
  <!-- p id="fm-intro" required for 'hide optional fields' function -->
  <p id="fm-intro">Fields in <strong>bold</strong> are required.</p>

  <form name="addclient" id="fm-form" method="post" action="client.php?action=update&client=<?php print $clientid?>&form" >
    <fieldset>
    <legend>Personal information</legend>
    <div class="fm-opt">
    	<label for="fm-clientid">Client ID:</label>
    	<input name="fm-clientid" disabled id="fm-clientid" type="text" value="<?php print $clientid;?>"/>
    </div>
    <div class="fm-req">
      <label for="fm-firstname">First name:</label>
      <input name="fm-firstname" id="fm-firstname" type="text" value="<?php print $info['FName'];?>"/>
    </div>
    <div class="fm-opt">

      <label for="fm-middlename">Middle name:</label>
      <input id="fm-middlename" name="fm-middlename" type="text" value="<?php print $info['MName'];?>"/>
    </div>
    <div class="fm-req">
      <label for="fm-lastname">Last name:</label>
      <input name="fm-lastname" id="fm-lastname" type="text" value="<?php print $info['LName'];?>"/>
    </div>
    <div class="fm-req">
    	<label for="fm-license_no">License Number:</label>
    	<input name="fm-license_no" id="fm-license_no" type="text" value="<?php print $info['License_No'];?>"/>
    </div>
     <div class="fm-req">
    	<label for="fm-birthdate">Birthdate:</label>
    	<input name="fm-birthdate" id="fm-birthdate" type="text" title="Enter Birthdate in yyy-mm-dd format" value="<?php print $info['Birthdate'];?>"/>
    </div>
    <div class="fm-multi">
      <div class="fm-gender">
      	<span>Gender</span>
        <label for="fm-gender-male">
        <input name="fm-gender" type="radio" id="fm-gender-male" value="m" <?php if($info['Gender']=='m'){ print "checked=\"checked\"";} ?> />
        Male</label>
        <label for="fm-gender-female">
        <input id="fm-gender-female" name="fm-gender" type="radio" value="f" <?php if($info['Gender']=='f'){ print "checked=\"checked\"";} ?>/>
        Female</label>
      </div>
    </div>
    </fieldset>

    <fieldset>
    <legend>Address </legend>
    <div class="fm-opt">
      <label for="fm-addr">Address:</label>
      <input id="fm-addr" name="fm-addr" type="text" value="<?php print $info['Address'];?>"/>
    </div>
    <div class="fm-opt">
      <label for="fm-city">City or Town:</label>

      <input id="fm-city" name="fm-city" type="text" value="<?php print $info['City'];?>"/>
    </div>
    <div class="fm-opt">
      <label for="fm-province">Province:</label>
      <select id="fm-province" name="fm-province">
        <option value="" <?php if ($info['Province']=="") {print "selected";}?>>Choose a province</option>
        <option value="AB" <?php if ($info['Province']=="AB") {print "selected";}?>>Alberta</option>
        <option value="BC" <?php if ($info['Province']=="BC") {print "selected";}?>>British Columbia</option>
        <option value="NB" <?php if ($info['Province']=="NB") {print "selected";}?>>New Brunswick</option>
        <option value="NF" <?php if ($info['Province']=="NF") {print "selected";}?>>Newfoundland</option>
        <option value="NT" <?php if ($info['Province']=="NT") {print "selected";}?>>Northwest Territories</option>
        <option value="NS" <?php if ($info['Province']=="NS") {print "selected";}?>>Nova Scotia</option>
        <option value="ON" <?php if ($info['Province']=="ON") {print "selected";}?>>Ontario</option>
        <option value="PE" <?php if ($info['Province']=="PE") {print "selected";}?>>Prince Edward Island</option>
        <option value="PQ" <?php if ($info['Province']=="PQ") {print "selected";}?>>Quebec</option>
        <option value="SK" <?php if ($info['Province']=="SK") {print "selected";}?>>Saskatchewan</option>
        <option value="YT" <?php if ($info['Province']=="YT") {print "selected";}?>>Yukon Territory</option>
      </select>
    </div>
    <div class="fm-req">
      <label for="fm-postalcode">Zip code:</label>
      <input id="fm-postalcode" name="fm-postalcode" type="text" value="<?php print $info['PostalCode'];?>"/>
    </div>
    </fieldset>
    <fieldset>

    <legend>Contact information</legend>
    <div class="fm-req">
      <label for="fm-telephone">Telephone:</label>
      <input id="fm-telephone" name="fm-telephone" type="text" title="Enter Phone Number in xxxxxxxxxx format" value="<?php print $info['Phone'];?>"/>
    </div>
    </fieldset>
    <fieldset>
    <legend>Policy Information</legend>
   <div class="fm-opt"><label for="fm-policy">Private Policy:</label> <select
	id="fm-policy" name="fm-policy">
	<?php Policy::getAllPrivatePolicy($info['Policy_No']); ?>
	</select></div>
	<b>OR</b><br/>
    <div class="fm-opt">
    	<label for="fm-company">Company:</label>
    	<input id="fm-company" name="fm-company" type="text" value="<?php print $info['Company'];?>"></input><i> (Leave blank for private policy)</i>
    </div>
    </fieldset>
    
        <fieldset>
    <legend>Driving History</legend>
    <div class="fm-req">
    	<label for="fm-yearsexp">Driving Experience (Years):</label>
    	<input name="fm-yearsexp" id="fm-yearsexp" type="text" title="Enter Birthdate in yyy-mm-dd format" value="<?php print $info['Years_Exp'];?>"/>
    </div>
    <div class="fm-multi">
      <div class="fm-training">
      	<span>Driver training</span>
        <label for="fm-trainingno">
        <input name="fm-training" type="radio" id="fm-trainingno" value="0" <?php if($info['Training']=='0'){ print "checked";} ?> />
        No</label>
        <label for="fm-trainingyes">
        <input id="fm-trainingyes" name="fm-training" type="radio" value="1" <?php if($info['Training']=='1'){ print "checked";} ?> />
        Yes</label>
      </div>
    </div>
    </fieldset>
    <div id="fm-submit" class="fm-req">
      <input name="Submit" value="Submit" type="submit" />

    </div>
  </form>
</div>