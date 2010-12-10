<div id="container">
	
  <!-- p id="fm-intro" required for 'hide optional fields' function -->
  <p id="fm-intro">Fields in <strong>bold</strong> are required.</p>

  <form name="addticket" id="fm-form" method="post" action="manager.php?action=add&form" >
    <fieldset>
		    <legend>Employee Login Information</legend>
	    <div class="fm-req">
      <label for="fm-username">Username:</label>
      <input id="fm-username" name="fm-username" type="text" />
    </div>
    <div class="fm-req">
      <label for="fm-password">Password:</label>
      <input name="fm-password" id="fm-password" type="password" />
    </div>
    <div class="fm-req">

      <label for="fm-officer_name">Permission:</label>
      <select id="fm-permissions" name="fm-permissions">
		<option value='1'>Employee</option>
		<option value='2'>Manager</option>
      </select>
    </div>
    </fieldset>
    <div id="fm-submit" class="fm-req">
      <input name="Submit" value="Submit" type="submit" />
    </div>
  </form>
</div>
