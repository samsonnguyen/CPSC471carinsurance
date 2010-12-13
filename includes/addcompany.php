<div id="container"><!--   p id="fm-intro" required for 'hide optional fields' function -->
	<p id="fm-intro">Fields in <strong>bold</strong> are required.</p>
	<form name="addcompany" id="fm-form" method="post" action="company.php?addcompany">
	<fieldset>
		<legend>Company Information</legend>
		<div class="fm-req"><label for="fm-comlicno">Com License No:</label>
			<input name="fm-comlicno" id="fm-comlicno" type="text" />
		</div>
		<div class="fm-req">
			<label for="fm-name">Company Name:</label>
			<input id="fm-name" name="fm-name" type="text" />
		</div>
	</fieldset>
	<fieldset>
		<legend>Address</legend>
		<div class="fm-opt">
			<label for="fm-addr">Address:</label>
			<input id="fm-addr" name="fm-addr" type="text" />
		</div>
		<div class="fm-opt">
			<label for="fm-city">City:</label>
			<input id="fm-city" name="fm-city" type="text" />
		</div>
		<div class="fm-opt">
			<label for="fm-province">Province:</label>
			<select	id="fm-province" name="fm-province">
				<option value="" selected="selected">Choose a province</option>
				<option value="AB">Alberta</option>
				<option value="BC">British Columbia</option>
				<option value="NB">New Brunswick</option>
				<option value="NF">Newfoundland</option>
				<option value="NT">Northwest Territories</option>
				<option value="NS">Nova Scotia</option>
				<option value="ON">Ontario</option>
				<option value="PE">Prince Edward Island</option>
				<option value="PQ">Quebec</option>
				<option value="SK">Saskatchewan</option>
				<option value="YT">Yukon Territory</option>
			</select>
		</div>
		<div class="fm-req">
			<label for="fm-postalcode">Zip code:</label>
			<input id="fm-postalcode" name="fm-postalcode" type="text" />
		</div>
	</fieldset>
	<fieldset>
		<legend>Contact Information</legend>
		<div class="fm-req">
			<label for="fm-manager">Manager:</label>
			<input id="fm-manager" name="fm-manager" type="text" />
		</div>
		<div class="fm-req">
			<label for="fm-telephone">Telephone:</label>
			<input id="fm-telephone" name="fm-telephone" type="text" title="Enter Phone Number in xxx-xxx-xxxx format" />
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
