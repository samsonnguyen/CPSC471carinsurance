<div id="container">
  <!-- p id="fm-intro" required for 'hide optional fields' function -->
  <p id="fm-intro">Fields in <strong>bold</strong> are required.</p>

  	<!-- create a choice of whether to search by Id or by information -->
  
   <form name="searchemployeeid" id="fm-form" method="post" action="manager.php?action=search&form=id" >
      <fieldset>
    <legend>Search By Employee ID</legend>
	<div class="fm-req">
      <label for="fm-employee_id">Employee ID:</label>
      <input name="fm-employee_id" id="fm-employee_id" type="text" />
    </div>
	</fieldset>
	    <div id="fm-submit" class="fm-req">
      <input name="Search" value="Search" type="submit" />

    </div>
	</form>
  
  <form name="searchusername" id="fm-form" method="post" action="manager.php?action=search&form=username" >
	<fieldset>
	<legend>Search By Username</legend>
    <div class="fm-req">
      <label for="fm-username">Username:</label>
      <input name="fm-username" id="fm-username" type="text" />
    </div>
    </fieldset>  
    <div id="fm-submit" class="fm-req">
      <input name="Search" value="Search" type="submit" />
    </div>
  </form>
  
    <form name="searchticketinfo" id="fm-form" method="post" action="manager.php?action=search&form=permissions" >
	<fieldset>
	<legend>Search By Permissions</legend>
    <div class="fm-req">
      <label for="fm-permissions">Permission:</label>
      <select id="fm-permissions" name="fm-permissions">
		<option value='1'>Employee</option>
		<option value='2'>Supervisor</option>
		<option value='3'>Manager</option>
      </select>
    </div>
  
    </fieldset>  
    <div id="fm-submit" class="fm-req">
      <input name="Search" value="Search" type="submit" />
    </div>
  </form>
</div>
