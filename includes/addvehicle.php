<div id="container">
  <!-- p id="fm-intro" required for 'hide optional fields' function -->
  <p id="fm-intro">Fields in <strong>bold</strong> are required.</p>

  <form name="addvehicle" id="fm-form" method="post" action="vehicle.php?action=add&form" >
    <fieldset>
    <legend>Vehicle Information</legend>
    <div class="fm-req">
      <label for="fm-vin">VIN Number:</label>
      <input name="fm-vin" id="fm-vin" type="text" value="<?php print $_POST['fm-vin'];?>" />
    </div>
    <div class="fm-req">

      <label for="fm-year">Year:</label>
      <input id="fm-year" name="fm-year" type="text" value="<?php print $_POST['fm-year'];?>" />
    </div>
    <div class="fm-opt">
      <label for="fm-make">Make:</label>
      <input name="fm-make" id="fm-make" type="text" value="<?php print $_POST['fm-make'];?>" />
    </div>
    <div class="fm-opt">
      <label for="fm-model">Model:</label>
      <input name="fm-model" id="fm-model" type="text" value="<?php print $_POST['fm-model'];?>" />
    </div>
    <div class="fm-opt">
    	<label for="fm-trim">Trim:</label>
    	<input name="fm-trim" id="fm-trim" type="text" title="Trim (eg. base, sport, GS-R, LS, RS etc)" value="<?php print $_POST['fm-trim'];?>" />
    </div>
     <div class="fm-opt">
    	<label for="fm-color">Color:</label>
    	<input name="fm-color" id="fm-color" type="text" title="Color max 10 characters" value="<?php print $_POST['fm-color'];?>" />
    </div>
    <div class="fm-req">
    	<label for="fm-value">Est. Value:</label>
    	<input name="fm-value" id="fm-value" type="text" value="<?php print $_POST['fm-value'];?>" />
    </div>
    <div class="fm-licenseplate">
    	<label for="fm-licenseplate">License Plate No:</label>
    	<input name="fm-licenseplate" id="fm-licenseplate" type="text" value="<?php print $_POST['fm-licenseplate'];?>" />
    </div>
    <div class="fm-displacement">
    	<label for="fm-displacement">Displacement:</label>
    	<input name="fm-displacement" id="fm-displacement" type="text" value="<?php print $_POST['fm-displacement'];?>" />
    </div>
    </fieldset>

    <fieldset>
    <legend>Vehicle Owner</legend>
    <div class="fm-req"><label for="fm-clientid">Client:</label> <select
	id="fm-clientid" name="fm-clientid">
	<?php if(isset($_GET['client'])){
      		Client::getAllClients($_GET['client']);
      	} else if (isset($_POST['fm-clientid'])){
			Client::getAllClients($_POST['fm-clientid']);
      	} else {
      		Client::getAllClients();
      	} ?>
	</select></div>
    <div class="fm-req">
      <label for="fm-mileage">Avg Daily Mileage:</label>
      <input id="fm-mileage" name="fm-mileage" type="text" value="<?php print $_POST['fm-mileage'];?>" />
    </div>
    <div class="fm-opt">
      <label for="fm-type">Type:</label>
      <select id="fm-type" name="fm-type">
        <option value="" <?php if(!isset($_POST['fm-type']))print "selected"; ?>>Choose a type</option>
        <option value="c" <?php if($_POST['fm-typee']=="c") print "selected";?>>Passenger Car</option>
        <option value="v" <?php if($_POST['fm-typee']=="v") print "selected";?>>Minivan</option>
        <option value="t" <?php if($_POST['fm-typee']=="t") print "selected";?>>Truck</option>
        <option value="m" <?php if($_POST['fm-typee']=="m") print "selected";?>>Motorcyle</option>
        <option value="n" <?php if($_POST['fm-typee']=="n") print "selected";?>>Commercial Truck</option>
        <option value="o" <?php if($_POST['fm-typee']=="o") print "selected";?>>Other</option>
      </select>
    </div>
   <div class="fm-multi">
      <div class="fm-commercial">
      	<span>Commercial Vehicle</span>
        <label for="fm-commercial-false">
        <input name="fm-commercial" type="radio" id="fm-commercial-false" value="0" checked />
       	No</label>
        <label for="fm-commercial-true">
        <input id="fm-commercial-true" name="fm-commercial" type="radio" value="1" />
        Yes</label>
      </div>
    </div>
    </fieldset>
    <div id="fm-submit" class="fm-req">
      <input name="Submit" value="Submit" type="submit" />
    </div>
  </form>
</div>
