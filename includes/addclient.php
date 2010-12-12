<div id="container">
<!--   p id="fm-intro" required for 'hide optional fields' function -->
  <p id="fm-intro">Fields in <strong>bold</strong> are required.</p>

  <form name="addclient" id="fm-form" method="post" action="client.php?addclient" >
    <fieldset>
    <legend>Personal information</legend>
    <div class="fm-req">
      <label for="fm-firstname">First name:</label>
      <input name="fm-firstname" id="fm-firstname" type="text" value="<?php print $_POST['fm-firstname'];?>" />
    </div>
    <div class="fm-opt">

      <label for="fm-middlename">Middle name:</label>
      <input id="fm-middlename" name="fm-middlename" type="text" value="<?php print $_POST['fm-middlename'];?>" />
    </div>
    <div class="fm-req">
      <label for="fm-lastname">Last name:</label>
      <input name="fm-lastname" id="fm-lastname" type="text" value="<?php print $_POST['fm-lastname'];?>" />
    </div>
    <div class="fm-req">
    	<label for="fm-license_no">License Number:</label>
    	<input name="fm-license_no" id="fm-license_no" type="text" value="<?php print $_POST['fm-license_no'];?>" />
    </div>
     <div class="fm-req">
    	<label for="fm-birthdate">Birthdate:</label>
    	<input name="fm-birthdate" id="fm-birthdate" type="text" title="Enter Birthdate in yyy-mm-dd format" value="<?php print $_POST['fm-birthdate'];?>" />
    </div>
    <div class="fm-multi">
      <div class="fm-gender">
      	<span>Gender</span>
        <label for="fm-gender-male">
        <input name="fm-gender" type="radio" id="fm-gender-male" value="m"
        <?php
        	if(!isset($_POST['fm-gender']) or $_POST['fm-gender']=="m"){
        		print "checked";
        	} 
        ?> />
        Male</label>
        <label for="fm-gender-female">
        <input id="fm-gender-female" name="fm-gender" type="radio" value="f" <?php if($_POST['fm-gender']=="f") print "checked";?>/>
        Female</label>
      </div>
    </div>
    </fieldset>

    <fieldset>
    <legend>Address </legend>
    <div class="fm-opt">
      <label for="fm-addr">Address:</label>
      <input id="fm-addr" name="fm-addr" type="text" value="<?php print $_POST['fm-addr'];?>" />
    </div>
    <div class="fm-opt">
      <label for="fm-city">City or Town:</label>

      <input id="fm-city" name="fm-city" type="text" value="<?php print $_POST['fm-city'];?>" />
    </div>
    <div class="fm-opt">
      <label for="fm-province">Province:</label>
      <select id="fm-province" name="fm-province">
        <option value="" <?php if(!isset($_POST['fm-province']))print "selected"; ?>>Choose a province</option>
        <option value="AB" <?php if($_POST['fm-province']=="AB") print "selected";?>>Alberta</option>
        <option value="BC" <?php if($_POST['fm-province']=="BC") print "selected";?>>British Columbia</option>
        <option value="NB" <?php if($_POST['fm-province']=="NB") print "selected";?>>New Brunswick</option>
        <option value="NF" <?php if($_POST['fm-province']=="NF") print "selected";?>>Newfoundland</option>
        <option value="NT" <?php if($_POST['fm-province']=="NT") print "selected";?>>Northwest Territories</option>
        <option value="NS" <?php if($_POST['fm-province']=="NS") print "selected";?>>Nova Scotia</option>
        <option value="ON" <?php if($_POST['fm-province']=="ON") print "selected";?>>Ontario</option>
        <option value="PE" <?php if($_POST['fm-province']=="PE") print "selected";?>>Prince Edward Island</option>
        <option value="PQ" <?php if($_POST['fm-province']=="PQ") print "selected";?>>Quebec</option>
        <option value="SK" <?php if($_POST['fm-province']=="SK") print "selected";?>>Saskatchewan</option>
        <option value="YT" <?php if($_POST['fm-province']=="YT") print "selected";?>>Yukon Territory</option>
      </select>
    </div>
    <div class="fm-req">
      <label for="fm-postalcode">Postal code:</label>
      <input id="fm-postalcode" name="fm-postalcode" type="text" value="<?php print $_POST['fm-postalcode'];?>" />
    </div>
    </fieldset>
    <fieldset>

    <legend>Contact information</legend>
    <div class="fm-req">
      <label for="fm-telephone">Telephone:</label>
      <input id="fm-telephone" name="fm-telephone" type="text" title="Enter Phone Number in xxx-xxx-xxxx format"  value="<?php print $_POST['fm-telephone'];?>" />
    </div>
    </fieldset>
    <fieldset>
    <legend>Policy Information</legend>
 	<div class="fm-opt"><label for="fm-policy">Private Policy:</label> <select
	id="fm-policy" name="fm-policy">
	<?php Policy::getAllPrivatePolicy(); ?>
	</select></div>
	<b>OR</b><br/>
    <div class="fm-opt">
    	<label for="fm-company">Company:</label>
    	<input id="fm-company" name="fm-company" type="text"></input><i> (Leave blank for private policy)</i>
    </div>
    </fieldset>
    <fieldset>
    <legend>Driving History</legend>
    <div class="fm-req">
    	<label for="fm-yearsexp">Driving Experience (Years):</label>
    	<input name="fm-yearsexp" id="fm-yearsexp" type="text" title="Enter a number"  value="<?php print $_POST['fm-yearsexp'];?>" />
    </div>
    <div class="fm-multi">
      <div class="fm-training">
      	<span>Driver training</span>
        <label for="fm-trainingno">
        <input name="fm-training" type="radio" id="fm-trainingno" value="0"
        <?php
        	if(!trim($_POST['fm-training'])=='' or $_POST['fm-training']=="0"){
        		print "checked";
        	} 
        ?>/>
        No</label>
        <label for="fm-trainingyes">
        <input id="fm-trainingyes" name="fm-training" type="radio" value="1" <?php if($_POST['fm-training']=="1") print "checked";?> />
        Yes</label>
      </div>
    </div>
    </fieldset>
    <div id="fm-submit" class="fm-req">
      <input name="Submit" value="Submit" type="submit" />

    </div>
  </form>
</div>
