<div id="container">
  <!-- p id="fm-intro" required for 'hide optional fields' function -->
  <p id="fm-intro">Fields in <strong>bold</strong> are required.</p>

  	<!-- create a choice of whether to search by Id or by information -->
  
   <form name="searchid" id="fm-form" method="post" action="client.php?action=search&form=clientid" >
      <fieldset>
    <legend>Search By ID</legend>
	<div class="fm-req">
      <label for="fm-clientID">Client ID:</label>
      <input name="fm-clientID" id="fm-clientID" type="text" />
    </div>
	</fieldset>
	    <div id="fm-submit" class="fm-opt">
      <input name="Search" value="Search" type="submit" />

    </div>
	</form>
  
  <?php // TODO Search by Policy ?>
  <form name="searchid" id="fm-form" method="post" action="client.php?action=search&form=policy">

<fieldset><legend>Search By Policy</legend>
<div class="fm-req"><label for="fm-policyc">Company Policy:</label> <select
	id="fm-policyc" name="fm-policyc">
	<option value="" selected>Any</option>
	<?php Policy::getAllCompanyPolicy(); ?>
</select></div>
<div class="fm-req"><label for="fm-policyp">Private Policy:</label> <select
	id="fm-policyp" name="fm-policyp">
	<option value="" selected>Any</option>
	<?php Policy::getAllPrivatePolicy(); ?>
</select></div>
</fieldset>
  <fieldset>
			<div class="fm-multi">
				<div class="fm-type">
				<span>Policy Type:</span>
				<label for="fm-typeprivate">
				<input name="fm-type" type="radio" id="fm-typeprivate" value="p" checked="checked" />Private</label>
				<label for="fm-typecompany">
				<input name="fm-type" type="radio" id="fm-typecompany" value="c" />Company</label>
				</div>
		    </div>
		</fieldset>
<div id="fm-submit" class="fm-opt"><input name="Search" value="Search"
	type="submit" /></div>
</form>
  
  <form name="searchclient" id="fm-form" method="post" action="client.php?action=search&form=info" >
	<fieldset>
	<legend>Search By Information</legend>
	<p>Use * for wildcards</p>
    <div class="fm-opt">
      <label for="fm-firstname">First name:</label>
      <input name="fm-firstname" id="fm-firstname" type="text" />
    </div>

    <div class="fm-opt">
      <label for="fm-lastname">Last name:</label>
      <input name="fm-lastname" id="fm-lastname" type="text" />
    </div>
    <div class="fm-opt">
    	<label for="fm-license_no">License Number:</label>
    	<input name="fm-license_no" id="fm-license_no" type="text" />
    </div>
	    <div class="fm-opt">
    	<label for="fm-policy">Policy Number:</label>
    	<input name="fm-policy" id="fm-policy" type="text" />
    </div>
    <div class="fm-opt">
      <label for="fm-city">City or Town:</label>
      <input id="fm-city" name="fm-city" type="text" />
    </div>
        <div class="fm-opt">
      <label for="fm-phone">Phone:</label>
      <input id="fm-phone" name="fm-phone" type="text" />
    </div>
    <div class="fm-opt">
      <label for="fm-province">Province:</label>
      <select id="fm-province" name="fm-province">
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
    </fieldset>
  
    <div id="fm-submit" class="fm-req">
      <input name="Search" value="Search" type="submit" />

    </div>
  </form>
</div>
