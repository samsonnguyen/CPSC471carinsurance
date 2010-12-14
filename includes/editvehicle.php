<div id="container">
  <!-- p id="fm-intro" required for 'hide optional fields' function -->
  <p id="fm-intro">Fields in <strong>bold</strong> are required.</p>

  <form name="addvehicle" id="fm-form" method="post" action="vehicle.php?action=update&form&vehicle=<?php print $vehicleVIN;?>" >
    <fieldset>
    <legend>Vehicle Information</legend>
    <div class="fm-req">
      <label for="fm-vin">VIN Number:</label>
      <input name="fm-vin" id="fm-vin" type="text" disabled <?php print "value=\"$vehicleVIN\"";?>/>
    </div>
    <div class="fm-req">

      <label for="fm-year">Year:</label>
      <input id="fm-year" name="fm-year" type="text" <?php print "value=\"".$info['Year']."\"";?>/>
    </div>
    <div class="fm-opt">
      <label for="fm-make">Make:</label>
      <input name="fm-make" id="fm-make" type="text" <?php print "value=\"".$info['Make']."\"";?>/>
    </div>
    <div class="fm-opt">
      <label for="fm-model">Model:</label>
      <input name="fm-model" id="fm-model" type="text" <?php print "value=\"".$info['Model']."\"";?>/>
    </div>
    <div class="fm-opt">
    	<label for="fm-trim">Trim:</label>
    	<input name="fm-trim" id="fm-trim" type="text" title="Trim (eg. base, sport, GS-R, LS, RS etc)" <?php print "value=\"".$info['Trim']."\"";?>/>
    </div>
     <div class="fm-opt">
    	<label for="fm-color">Color:</label>
    	<input name="fm-color" id="fm-color" type="text" title="Color max 10 characters" <?php print "value=\"".$info['Color']."\"";?>/>
    </div>
    <div class="fm-req">
    	<label for="fm-value">Est. Value:</label>
    	<input name="fm-value" id="fm-value" type="text" <?php print "value=\"".$info['Value']."\"";?>/>
    </div>
    <div class="fm-licenseplate">
    	<label for="fm-licenseplate">License Plate No:</label>
    	<input name="fm-licenseplate" id="fm-licenseplate" type="text" <?php print "value=\"".$info['License_Plate_No']."\"";?>/>
    </div>
    <div class="fm-displacement">
    	<label for="fm-displacement">Displacement:</label>
    	<input name="fm-displacement" id="fm-displacement" type="text" <?php print "value=\"".$info['Displacement']."\"";?>/>
    </div>
    </fieldset>

    <fieldset>
    <legend>Vehicle Owner</legend>
    <div class="fm-req"><label for="fm-clientid"><a href="client.php?action=update&client=<?php print $info['Client_ID']?>">Client:</a></label> <select
	id="fm-clientid" name="fm-clientid">
	<?php Client::getAllClients($info['Client_ID']); ?>
	</select></div>
    <div class="fm-req">
      <label for="fm-mileage">Avg Daily Mileage:</label>
      <input id="fm-mileage" name="fm-mileage" type="text" <?php print "value=\"".$info['Ave_Daily_Miles']."\"";?>/>
    </div>
    <div class="fm-req">
      <label for="fm-type">Type:</label>
      <select id="fm-type" name="fm-type">
        <option value="">Choose a type</option>
        <option value="c" <?php if($info['Type']=="c") print "selected";?>>Passenger Car</option>
        <option value="v" <?php if($info['Type']=="v") print "selected";?>>Minivan</option>
        <option value="t" <?php if($info['Type']=="t") print "selected";?>>Truck</option>
        <option value="m" <?php if($info['Type']=="m") print "selected";?>>Motorcyle</option>
        <option value="n" <?php if($info['Type']=="n") print "selected";?>>Commercial Truck</option>
        <option value="o" <?php if($info['Type']=="o") print "selected";?>>Other</option>
      </select>
    </div>
   <div class="fm-multi">
      <div class="fm-commercial">
      	<span>Commercial Vehicle</span>
        <label for="fm-commercial-false">
        <input name="fm-commercial" type="radio" id="fm-commericla-false" value="0" <?php if($info['Commercial']==0){print "checked";}?> />
       	No</label>
        <label for="fm-commercial-true">
        <input id="fm-commercial-true" name="fm-commercial" type="radio" value="1" <?php if($info['Commercial']==1){print "checked";}?> />
        Yes</label>
      </div>
    </div>
    </fieldset>
    <div id="fm-submit" class="fm-req">
      <input name="Submit" value="Submit" type="submit" />
    </div>
  </form>
</div>