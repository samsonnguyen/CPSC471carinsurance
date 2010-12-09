<div id="container">
  <!-- p id="fm-intro" required for 'hide optional fields' function -->
  <p id="fm-intro">Fields in <strong>bold</strong> are required.</p>

  <form name="addticket" id="fm-form" method="post" action="tickets.php?action=update&form&ticket=<?php print $infraction_no;?>" >
    <fieldset>
    <legend>Ticket Information</legend>
    <div class="fm-req">
      <label for="fm-clientid"><a href="client.php?action=update&client=<?php print $info['Client_ID']?>">Client ID:</a></label>
      <input id="fm-clientid" name="fm-clientid" type="text"
      <?php print "value=\"".$info['Client_ID']."\"";?>/>
    </div>
    <div class="fm-req">

      <label for="fm-infraction_no">Infraction Number:</label>
      <input id="fm-infraction_no" name="fm-infraction_no" type="text" <?php print "value=\"".$info['Infraction_No']."\"";?>/>
    </div>
    <div class="fm-req">
      <label for="fm-officer_name">Officer Name:</label>
      <input name="fm-officer_name" id="fm-officer_name" type="text" <?php print "value=\"".$info['Officer_Name']."\"";?>/>
    </div>
    <div class="fm-opt">
      <label for="fm-officer_no">Officer Number:</label>
      <input name="fm-officer_no" id="fm-officer_no" type="text" <?php print "value=\"".$info['Officer_No']."\"";?>/>
    </div>
    <div class="fm-opt">
    	<label for="fm-classification">Classification:</label>
    	<input name="fm-classification" id="fm-classification" type="text" title="" <?php print "value=\"".$info['Classification']."\"";?>/>
    </div>
	
	   <div class="fm-req">
    	<label for="fm-date">Date:</label>
    	<input name="fm-date" id="fm-date" type="text" title="" <?php print "value=\"".$info['Date']."\"";?>/>
    </div>
	
    </fieldset>
    <div id="fm-submit" class="fm-req">
      <input name="Submit" value="Submit" type="submit" />
    </div>
  </form>
</div>