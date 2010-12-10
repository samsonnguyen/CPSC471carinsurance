<div id="container">
	
  <!-- p id="fm-intro" required for 'hide optional fields' function -->
  <p id="fm-intro">Fields in <strong>bold</strong> are required.</p>

  <form name="searchclaim" id="fm-form" method="post" action="claim.php?action=search&form=claimno" >
    <fieldset>
    	<legend>Search By Claim Number</legend>
	 	<div class="fm-req">
      		<label for="fm-claimid">Claim Number:</label>
      		<input id="fm-claimid" name="fm-claimid" type="text" />
    	</div>
     </fieldset>
	 <div id="fm-submit" class="fm-opt">
      <input name="Search" value="Search" type="submit" />
    </div>
	</form>
      <form name="searchclaim" id="fm-form" method="post" action="claim.php?action=search&form=thirdparty" >
    <fieldset>
    	<legend>Search By Third Party Info</legend>
    	<p>Use * for wildcards</p>
	 	<div class="fm-opt">
      		<label for="fm-tp-name">Third Party Name:</label>
      		<input id="fm-tp-name" name="fm-tp-name" type="text" />
    	</div>
    	<div class="fm-opt">
      		<label for="fm-tp-insurer">Insurer:</label>
      		<input id="fm-tp-insurer" name="fm-tp-insurer" type="text" />
    	</div>
    	<div class="fm-opt">
      		<label for="fm-tp-model">Vehicle Model:</label>
      		<input id="fm-tp-model" name="fm-tp-model" type="text" />
    	</div>
    	<div class="fm-opt">
      		<label for="fm-tp-license">Party License Number:</label>
      		<input id="fm-tp-license" name="fm-tp-license" type="text" />
    	</div>
     </fieldset>
	 <div id="fm-submit" class="fm-opt">
      <input name="Search" value="Search" type="submit" />
    </div>
	</form>
	      <form name="searchclaim" id="fm-form" method="post" action="claim.php?action=search&form=client" >
    <fieldset>
    	<legend>Search By Client</legend>
    	<p>Use * for wildcards</p>
	 	<div class="fm-opt">
      		<label for="fm-cl-clientid">Client ID:</label>
      		<input id="fm-cl-clientid" name="fm-cl-clientid" type="text" />
    	</div>
    	<div class="fm-opt">
      		<label for="fm-cl-vin">Vehicle VIN:</label>
      		<input id="fm-cl-vin" name="fm-cl-vin" type="text" />
    	</div>
     </fieldset>
	 <div id="fm-submit" class="fm-opt">
      <input name="Search" value="Search" type="submit" />
    </div>
	</form>
	
</div>
