<div id="container">
	
  <!-- p id="fm-intro" required for 'hide optional fields' function -->
  <p id="fm-intro">Fields in <strong>bold</strong> are required.</p>

  <form name="addticket" id="fm-form" method="post" action="tickets.php?action=add&form" >
    <fieldset>
		    <legend>Ticket Information</legend>
	    <div class="fm-req">
      <label for="fm-clientid">Client ID:</label>
      <input id="fm-clientid" name="fm-clientid" type="text"
      <?php
      if(isset($_GET['client'])){
      		print "value=\"".$_GET['client']."\"";
      }?> />
    </div>
    <div class="fm-req">
      <label for="fm-infraction_no">Infraction Number:</label>
      <input name="fm-infraction_no" id="fm-infraction_no" type="text" />
    </div>
    <div class="fm-req">

      <label for="fm-officer_name">Officer Name:</label>
      <input id="fm-officer_name" name="fm-officer_name" type="text" />
    </div>
    <div class="fm-opt">
      <label for="fm-officer_no">Officer Number:</label>
      <input name="fm-officer_no" id="fm-officer_no" type="text" />
    </div>
    <div class="fm-opt">
      <label for="fm-classification">Classification:</label>
      <input name="fm-classification" id="fm-classification" type="text" />
    </div>
    <div class="fm-req">
      <label for="fm-date">Date:</label>
      <a>Month:</a>
	  <select id="fm-month" name="fm-month">
		<option value='01'>January</option>
		<option value='02'>February</option>
		<option value='03'>March</option>
		<option value='04'>April</option>
		<option value='05'>May</option>
		<option value='06'>June</option>
		<option value='07'>July</option>
		<option value='08'>August</option>
		<option value='09'>September</option>
		<option value='10'>October</option>
		<option value='11'>November</option>
		<option value='12'>December</option>
      </select>
	  
	  <a>Day:</a>
	  <select id="fm-day" name="fm-day">
       <option value='01'>01</option>
		<option value='02'>02</option>
		<option value='03'>03</option>
		<option value='04'>04</option>
		<option value='05'>05</option>
		<option value='06'>06</option>
		<option value='07'>07</option>
		<option value='08'>08</option>
		<option value='09'>09</option>
		<option value='10'>10</option>
		<option value='11'>11</option>
		<option value='12'>12</option>
		<option value='13'>13</option>
		<option value='14'>14</option>
		<option value='15'>15</option>
		<option value='16'>16</option>
		<option value='17'>17</option>
		<option value='18'>18</option>
		<option value='19'>19</option>
		<option value='20'>20</option>
		<option value='21'>21</option>
		<option value='22'>22</option>
		<option value='23'>23</option>
		<option value='24'>24</option>
		<option value='25'>25</option>
		<option value='26'>26</option>
		<option value='27'>27</option>
		<option value='28'>28</option>
		<option value='29'>29</option>
		<option value='30'>30</option>
		<option value='31'>31</option>
		</select>
	  
		<a>Year:</a>
		<input name= "fm-year"	id="fm-year"	type="text" />
	  
    </div>

    </fieldset>
    <div id="fm-submit" class="fm-req">
      <input name="Submit" value="Submit" type="submit" />
    </div>
  </form>
</div>
