<div id="container"><!--   p id="fm-intro" required for 'hide optional fields' function -->
	<p id="fm-intro">Fields in <strong>bold</strong> are required.</p>
	<form name="addcompany" id="fm-form" method="post" action="company.php?addcompany">
	<fieldset>
		<legend>Company Information</legend>
		<div class="fm-req"><label for="fm-comlicno">Com License No:</label>
			<input name="fm-comlicno" id="fm-comlicno" type="text" value="<?php print $_POST['fm-comlicno'];?>" />
		</div>
		<div class="fm-req">
			<label for="fm-name">Company Name:</label>
			<input id="fm-name" name="fm-name" type="text" value="<?php print $_POST['fm-name'];?>" />
		</div>
	</fieldset>
	<fieldset>
		<legend>Address</legend>
		<div class="fm-opt">
			<label for="fm-addr">Address:</label>
			<input id="fm-addr" name="fm-addr" type="text" value="<?php print $_POST['fm-addr'];?>" />
		</div>
		<div class="fm-opt">
			<label for="fm-city">City:</label>
			<input id="fm-city" name="fm-city" type="text" value="<?php print $_POST['fm-city'];?>" />
		</div>
		<div class="fm-opt">
			<label for="fm-province">Province:</label>
			<select	id="fm-province" name="fm-province">
				<option value="">Choose a province</option>
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
		<legend>Contact Information</legend>
		<div class="fm-req">
			<label for="fm-manager">Manager:</label>
			<input id="fm-manager" name="fm-manager" type="text" value="<?php print $_POST['fm-manager'];?>" />
		</div>
		<div class="fm-req">
			<label for="fm-telephone">Telephone:</label>
			<input id="fm-telephone" name="fm-telephone" type="text" title="Enter Phone Number in xxx-xxx-xxxx format" value="<?php print $_POST['fm-telephone'];?>" />
		</div>
	</fieldset>
	<fieldset>
		<legend>Policy Information</legend>
		<div class="fm-req">
			<label for="fm-policy">Policy:</label>
			<select id="fm-policy" name="fm-policy">
				<?php Policy::getAllCompanyPolicy(); ?>
			</select>
		</div>
	</fieldset>
	<div id="fm-submit" class="fm-req">
		<input name="Submit" value="Submit"	type="submit" />
	</div>
	</form>
</div>
