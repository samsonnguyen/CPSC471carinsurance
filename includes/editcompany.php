<?php // TODO Incomplete ?>
<div id="container"><!--   p id="fm-intro" required for 'hide optional fields' function -->
	<p id="fm-intro">Fields in <strong>bold</strong> are required.</p>
	<form name="editcompany" id="fm-form" method="post" action="company.php?action=update&company=<?php print $companyno?>&form" >
	<fieldset>
		<legend>Company Information</legend>
		<div class="fm-req"><label for="fm-comlicno">Com License No:</label>
			<input name="fm-comlicno" id="fm-comlicno" type="text" value="<?php print $companyno;?>"/>
		</div>
		<div class="fm-req">
			<label for="fm-name">Company Name:</label>
			<input id="fm-name" name="fm-name" type="text" value="<?php print $info['CName'];?>" />
		</div>
	</fieldset>
	<fieldset>
		<legend>Address</legend>
		<div class="fm-opt">
			<label for="fm-addr">Address:</label>
			<input id="fm-addr" name="fm-addr" type="text" value="<?php print $info['Address'];?>" />
		</div>
		<div class="fm-opt">
			<label for="fm-city">City:</label>
			<input id="fm-city" name="fm-city" type="text" value="<?php print $info['City'];?>" />
		</div>
		<div class="fm-opt">
			<label for="fm-province">Province:</label>
			<select	id="fm-province" name="fm-province">
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
		<legend>Contact Information</legend>
		<div class="fm-req">
			<label for="fm-manager">Manager:</label>
			<input id="fm-manager" name="fm-manager" type="text" value="<?php print $info['Manager'];?>"/>
		</div>
		<div class="fm-req">
			<label for="fm-telephone">Telephone:</label>
			<input id="fm-telephone" name="fm-telephone" type="text" title="Enter Phone Number in xxx-xxx-xxxx format" value="<?php print $info['Phone'];?>" />
		</div>
	</fieldset>
	<fieldset>
		<legend>Policy Information</legend>
		<div class="fm-req">
			<label for="fm-policy">Policy:</label>
			<select id="fm-policy" name="fm-policy">
				<?php Policy::getAllCompanyPolicy($info['Policy_No']); ?>
			</select>
		</div>
	</fieldset>
	<div id="fm-submit" class="fm-req">
		<input name="Submit" value="Submit"	type="submit" />
	</div>
	</form>
</div>
