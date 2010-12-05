<div id="container">
  <!-- p id="fm-intro" required for 'hide optional fields' function -->
  <p id="fm-intro">Fields in <strong>bold</strong> are required.</p>

  	<!-- create a choice of whether to search by Id or by information -->
  
   <form name="searchclientid" id="fm-form" method="post" action="tickets.php?action=search&form=client" >
      <fieldset>
    <legend>Search By Client ID</legend>
	<div class="fm-req">
      <label for="fm-clientID">Client ID:</label>
      <input name="fm-clientID" id="fm-clientID" type="text" />
    </div>
	</fieldset>
	    <div id="fm-submit" class="fm-req">
      <input name="Search" value="Search" type="submit" />

    </div>
	</form>
  
  <form name="searchticketinfraction" id="fm-form" method="post" action="tickets.php?action=search&form=infraction_no" >
	<fieldset>
	<legend>Search By Infraction Number</legend>
	<p>Use * for wildcards</p>
    <div class="fm-req">
      <label for="fm-infraction_no">Infraction Number:</label>
      <input name="fm-ifraction_no" id="fm-infraction_no" type="text" />
    </div>
    </fieldset>  
    <div id="fm-submit" class="fm-req">
      <input name="Search" value="Search" type="submit" />
    </div>
  </form>
  
    <form name="searchticketinfo" id="fm-form" method="post" action="tickets.php?action=search&form=info" >
	<fieldset>
	<legend>Search By Ticket Information</legend>
	<p>Use * for wildcards</p>
    <div class="fm-req">
      <label for="fm-officer_name">Officer Name:</label>
      <input name="fm-officer_name" id="fm-officer_name" type="text" />
    </div>
    <div class="fm-opt">
      <label for="fm-officer_number">Officer Number:</label>
      <input name="fm-officer_number" id="fm-officer_number" type="text" />
    </div>
    <div class="fm-opt">
      <label for="fm-classification">Classification:</label>
      <input name="fm-classification" id="fm-classification" type="text" />
    </div>
	
	<div class="fm-req">
      <label for="fm-date">Date:</label>
      <input name="fm-date" id="fm-date" type="text" />
    </div>
	
    </fieldset>  
    <div id="fm-submit" class="fm-req">
      <input name="Search" value="Search" type="submit" />
    </div>
  </form>
</div>