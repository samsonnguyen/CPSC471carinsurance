<div id="container">
  <!-- p id="fm-intro" required for 'hide optional fields' function -->
  <p id="fm-intro">Fields in <strong>bold</strong> are required.</p>

  	<!-- create a choice of whether to search by Id or by information -->
  
   <form name="searchclientid" id="fm-form" method="post" action="vehicle.php?action=search&form=client" >
      <fieldset>
    <legend>Search By Client ID</legend>
	<div class="fm-req"><label for="fm-clientID">Client:</label> <select
	id="fm-clientID" name="fm-clientID">
	<?php Client::getAllClients(); ?>
	</select></div>
	</fieldset>
	    <div id="fm-submit" class="fm-req">
      <input name="Search" value="Search" type="submit" />

    </div>
	</form>
  
  <form name="searchvehiclevin" id="fm-form" method="post" action="vehicle.php?action=search&form=vin" >
	<fieldset>
	<legend>Search By Vehicle VIN</legend>
	<p>Use * for wildcards</p>
    <div class="fm-req">
      <label for="fm-vin">VIN:</label>
      <input name="fm-vin" id="fm-vin" type="text" />
    </div>
    </fieldset>  
    <div id="fm-submit" class="fm-req">
      <input name="Search" value="Search" type="submit" />
    </div>
  </form>
  
    <form name="searchvehicleinfo" id="fm-form" method="post" action="vehicle.php?action=search&form=info" >
	<fieldset>
	<legend>Search By Vehicle Information</legend>
	<p>Use * for wildcards</p>
    <div class="fm-opt">
      <label for="fm-year">Year:</label>
      <input name="fm-year" id="fm-year" type="text" />
    </div>
    <div class="fm-opt">
      <label for="fm-make">Make:</label>
      <input name="fm-make" id="fm-make" type="text" />
    </div>
    <div class="fm-opt">
      <label for="fm-model">Model:</label>
      <input name="fm-model" id="fm-model" type="text" />
    </div>
    </fieldset>  
    <div id="fm-submit" class="fm-req">
      <input name="Search" value="Search" type="submit" />
    </div>
  </form>
</div>
