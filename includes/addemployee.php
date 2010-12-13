<div id="container">
	
  <!-- p id="fm-intro" required for 'hide optional fields' function -->
  <p id="fm-intro">Fields in <strong>bold</strong> are required.</p>

  <form name="addticket" id="fm-form" method="post" action="manager.php?action=add&form" >
    <fieldset>
		    <legend>Employee Login Information</legend>
	    <div class="fm-req">
      <label for="fm-username">Username:</label>
      <input id="fm-username" name="fm-username" type="text" value="<?php print $_POST['fm-username'];?>" />
    </div>
    <div class="fm-req">
      <label for="fm-password">Password:</label>
      <input name="fm-password" id="fm-password" type="password" value="<?php print $_POST['fm-password'];?>" />
    </div>
    <div class="fm-req">

      <label for="fm-permissions">Permission:</label>
      <select id="fm-permissions" name="fm-permissions">
		<option value='1' <?php if($_POST['fm-permissions']=="1") print "selected";?>>Employee</option>
		<option value='2' <?php if($_POST['fm-permissions']=="2") print "selected";?>>Supervisor</option>
		<option value='3' <?php if($_POST['fm-permissions']=="3") print "selected";?>>Manager</option>
      </select>
    </div>
    </fieldset>
    <div id="fm-submit" class="fm-req">
      <input name="Submit" value="Submit" type="submit" />
    </div>
  </form>
</div>
