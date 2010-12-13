<div id="container"><!-- p id="fm-intro" required for 'hide optional fields' function -->
<p id="fm-intro">Fields in <strong>bold</strong> are required.</p>

<form name="searchid" id="fm-form" method="post" action="company.php?action=search&form=comlicno">
<fieldset><legend>Search By Commercial License Number</legend>
<div class="fm-req"><label for="fm-comlicno">Com Lic Number:</label> <input
	name="fm-comlicno" id="fm-comlicno" type="text" /></div>
</fieldset>
<div id="fm-submit" class="fm-opt"><input name="Search" value="Search"
	type="submit" /></div>
</form>

<form name="searchid" id="fm-form" method="post" action="company.php?action=search&form=policy">
<fieldset><legend>Search By Policy</legend>
<div class="fm-req"><label for="fm-policy">Policy:</label> <select
	id="fm-policy" name="fm-policy">
	<option value="" selected>Any</option>
	<?php Policy::getAllCompanyPolicy(); ?>
</select></div>
</fieldset>
<div id="fm-submit" class="fm-opt"><input name="Search" value="Search"
	type="submit" /></div>
</form>

<form name="searchclient" id="fm-form" method="post" action="company.php?action=search&form=info">
<fieldset><legend>Search By Information</legend>
<p>Use * for wildcards</p>
<div class="fm-opt"><label for="fm-name">Company Name:</label> <input
	name="fm-name" id="fm-name" type="text" /></div>
<div class="fm-opt"><label for="fm-manager">Manager Name:</label> <input
	name="fm-manager" id="fm-manager" type="text" /></div>
<div class="fm-opt"><label for="fm-city">City or Town:</label> <input
	id="fm-city" name="fm-city" type="text" /></div>
<div class="fm-opt"><label for="fm-phone">Phone:</label> <input
	id="fm-phone" name="fm-phone" type="text" /></div>
<div class="fm-opt"><label for="fm-province">Province:</label> <select
	id="fm-province" name="fm-province">
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
</select></div>
</fieldset>

<div id="fm-submit" class="fm-req"><input name="Search" value="Search"
	type="submit" /></div>
</form>
</div>
