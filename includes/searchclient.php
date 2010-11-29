<div id="container">
  <!-- p id="fm-intro" required for 'hide optional fields' function -->
  <p id="fm-intro">Fields in <strong>bold</strong> are required.</p>

  	<!-- create a choice of whether to search by Id or by information -->
  
   <form name="searchid" id="fm-form" method="post" action="client.php?searchid" >
      <fieldset>
    <legend>Search By ID</legend>
	<div class="fm-req">
      <label for="fm-clientID">Client ID:</label>
      <input name="fm-clientID" id="fm-clientID" type="text" />
    </div>
	</fieldset>
	    <div id="fm-submit" class="fm-req">
      <input name="Search" value="Search" type="submit" />

    </div>
	</form>
  
  <form name="searchclient" id="fm-form" method="post" action="client.php?searchclient" >
	<fieldset>
	<legend>Search By Information</legend>
    <div class="fm-req">
      <label for="fm-firstname">First name:</label>
      <input name="fm-firstname" id="fm-firstname" type="text" />
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
      <label for="fm-city">City or Town:</label>

      <input id="fm-city" name="fm-city" type="text" />
    </div>
    <div class="fm-req">
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
