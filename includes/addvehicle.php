<div id="container">
  <!-- p id="fm-intro" required for 'hide optional fields' function -->
  <p id="fm-intro">Fields in <strong>bold</strong> are required.</p>

  <form name="addvehicle" id="fm-form" method="post" action="vehicle.php?action=add&form" >
    <fieldset>
    <legend>Vehicle Information</legend>
    <div class="fm-req">
      <label for="fm-vin">VIN Number:</label>
      <input name="fm-vin" id="fm-vin" type="text" />
    </div>
    <div class="fm-req">

      <label for="fm-year">Year:</label>
      <input id="fm-year" name="fm-year" type="text" />
    </div>
    <div class="fm-opt">
      <label for="fm-make">Make:</label>
      <input name="fm-make" id="fm-make" type="text" />
    </div>
    <div class="fm-opt">
      <label for="fm-model">Model:</label>
      <input name="fm-model" id="fm-model" type="text" />
    </div>
    <div class="fm-opt">
    	<label for="fm-trim">Trim:</label>
    	<input name="fm-trim" id="fm-trim" type="text" title="Trim (eg. base, sport, GS-R, LS, RS etc)"/>
    </div>
     <div class="fm-opt">
    	<label for="fm-color">Color:</label>
    	<input name="fm-color" id="fm-color" type="text" title="Color max 10 characters"/>
    </div>
    <div class="fm-opt">
    	<label for="fm-value">Est. Value:</label>
    	<input name="fm-value" id="fm-value" type="text"/>
    </div>
    <div class="fm-licenseplate">
    	<label for="fm-licenseplate">License Plate No:</label>
    	<input name="fm-licenseplate" id="fm-licenseplate" type="text"/>
    </div>
    <div class="fm-displacement">
    	<label for="fm-displacement">Displacement:</label>
    	<input name="fm-displacement" id="fm-displacement" type="text"/>
    </div>
    </fieldset>

    <fieldset>
    <legend>Vehicle Owner</legend>
    <div class="fm-req">
      <label for="fm-clientid">Client ID:</label>
      <input id="fm-clientid" name="fm-clientid" type="text"
      <?php
      if(isset($_GET['client'])){
      		print "value=\"".$_GET['client']."\"";
      }?> />
    </div>
    <div class="fm-opt">
      <label for="fm-mileage">Average Daily Miles:</label>
      <input id="fm-mileage" name="fm-mileage" type="text" />
    </div>
    <div class="fm-opt">
      <label for="fm-type">Type:</label>
      <select id="fm-type" name="fm-type">
        <option value="" selected="selected">Choose a type</option>
        <option value="c">Passenger Car</option>
        <option value="v">Minivan</option>
        <option value="t">Truck</option>
        <option value="m">Motorcyle</option>
        <option value="n">Commercial Truck</option>
        <option value="o">Other</option>
      </select>
    </div>
   <div class="fm-multi">
      <div class="fm-commercial">
      	<span>Commercial Vehicle</span>
        <label for="fm-commercial-false">
        <input name="fm-commercial" type="radio" id="fm-commericla-false" value="0" checked />
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
