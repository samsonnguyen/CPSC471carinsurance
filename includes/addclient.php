<div id="container">
  <!-- p id="fm-intro" required for 'hide optional fields' function -->
  <p id="fm-intro">Fields in <strong>bold</strong> are required.</p>

  <form name="addclient" id="fm-form" method="post" action="client.php?addclient" >
    <fieldset>
    <legend>Personal information</legend>
    <div class="fm-req">
      <label for="fm-firstname">First name:</label>
      <input name="fm-firstname" id="fm-firstname" type="text" />
    </div>
    <div class="fm-opt">

      <label for="fm-middlename">Middle name:</label>
      <input id="fm-middlename" name="fm-middlename" type="text" />
    </div>
    <div class="fm-req">
      <label for="fm-lastname">Last name:</label>
      <input name="fm-lastname" id="fm-lastname" type="text" />
    </div>
    <div class="fm-req">
    	<label for="fm-license_no">License Number:</label>
    	<input name="fm-license_no" id="fm-license_no" type="text" />
    </div>
     <div class="fm-req">
    	<label for="fm-birthdate">Birthdate:</label>
    	<input name="fm-birthdate" id="fm-birthdate" type="text" title="Enter Birthdate in yyy-mm-dd format"/>
    </div>
    <div class="fm-multi">
      <div class="fm-gender">
      	<span>Gender</span>
        <label for="fm-gender-male">
        <input name="fm-gender" type="radio" id="fm-gender-male" value="m" checked="checked" />
        Male</label>
        <label for="fm-gender-female">
        <input id="fm-gender-female" name="fm-gender" type="radio" value="f" />
        Female</label>
      </div>
    </div>
    </fieldset>

    <fieldset>
    <legend>Address </legend>
    <div class="fm-opt">
      <label for="fm-addr">Address:</label>
      <input id="fm-addr" name="fm-addr" type="text" />
    </div>
    <div class="fm-opt">
      <label for="fm-city">City or Town:</label>

      <input id="fm-city" name="fm-city" type="text" />
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
    <div class="fm-req">
      <label for="fm-postalcode">Zip code:</label>
      <input id="fm-postalcode" name="fm-postalcode" type="text" />
    </div>
    </fieldset>
    <fieldset>

    <legend>Contact information</legend>
    <div class="fm-req">
      <label for="fm-telephone">Telephone:</label>
      <input id="fm-telephone" name="fm-telephone" type="text" title="Enter Phone Number in xxx-xxx-xxxx format" />
    </div>
    </fieldset>
    <fieldset>
    <legend>Policy Information</legend>
    <div class="fm-req">
    	<label for="fm-policy">Policy Number</label>
    	<input id="fm-policy" name="fm-policy" type="text"></input>
    </div>
    <div class="fm-opt">
    	<label for="fm-company">Company</label>
    	<input id="fm-company" name="fm-company" type="text"></input>
    </div>
    </fieldset>
    <div id="fm-submit" class="fm-req">
      <input name="Submit" value="Submit" type="submit" />

    </div>
  </form>
</div>
