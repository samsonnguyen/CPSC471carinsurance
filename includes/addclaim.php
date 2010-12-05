<div id="container">
	
  <!-- p id="fm-intro" required for 'hide optional fields' function -->
  <p id="fm-intro">Fields in <strong>bold</strong> are required.</p>

  <form name="addclaim" id="fm-form" method="post" action="claim.php?action=add&form" >
    <fieldset>
    	<legend>Claim Information</legend>
	 	<div class="fm-req">
      		<label for="fm-amount">Claim Amount:</label>
      		<input id="fm-amount" name="fm-amount" type="text" />
    	</div>
      <div class="fm-req">
      <label for="fm-date">Date:</label>
      <span>Month:</span>
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
	  
	  <span>Day:</span>
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
	  
		<span>Year:</span>
		<input name= "fm-year"	id="fm-year"	type="text" />
    </div>
    <div class="fm-req">
      <label for="fm-description">Description:</label>
      <textarea name="fm-description" id="fm-description"></textarea>
    </div>
    
    <div class="fm-req">
      <label for="fm-status">Status:</label>
	  <select id="fm-status" name="fm-status">
		<option value="01" selected>Pending</option>
		<option value="02">Completed</option>
		<option value="03">Filed</option>
		<option value="04">Declined</option>
      </select>
      </div>
	
    </fieldset>
    <fieldset>
    <legend>Third Party information</legend>
    <div class="fm-req">
      <label for="fm-tp-name">Name:</label>
	  <input id="fm-tp-name" name="fm-tp-name" type ="text" />
    </div>
    <div class="fm-req">
      <label for="fm-tp-insurer">Insurer Name:</label>
	  <input id="fm-tp-insurer" name="fm-tp-insurer" type ="text" />
    </div>
    <div class="fm-req">
      <label for="fm-tp-phone">Insurer Phone:</label>
	  <input id="fm-tp-phone" name="fm-tp-phone" type ="text" />
    </div>
    <div class="fm-req">
      <label for="fm-tp-address">Insurer Address:</label>
	  <input id="fm-tp-address" name="fm-tp-address" type ="text" />
    </div>
        <div class="fm-req">
      <label for="fm-tp-rep">Representative:</label>
	  <input id="fm-tp-rep" name="fm-tp-rep" type ="text" />
    </div>
     <div class="fm-req">
      <label for="fm-tp-year">Vehicle Year:</label>
	  <input id="fm-tp-year" name="fm-tp-year" type ="text" />
    </div>
    <div class="fm-req">
      <label for="fm-tp-make">Make:</label>
	  <input id="fm-tp-make" name="fm-tp-make" type ="text" />
    </div>
        <div class="fm-req">
      <label for="fm-tp-model">Model:</label>
	  <input id="fm-tp-model" name="fm-tp-model" type ="text" />
    </div>
    <div class="fm-req">
      <label for="fm-tp-license">Driver's License Number:</label>
	  <input id="fm-tp-license" name="fm-tp-license" type ="text" />
    </div>
    </fieldset>
    <fieldset>
    <legend>Involved with Client</legend>
    <div class="fm-req">
      <label for="fm-cl-clientid">Client ID:</label>
	  <input id="fm-cl-clientid" name="fm-cl-clientid" type ="text" />
    </div>
        <div class="fm-req">
      <label for="fm-cl-vin">Vehicle VIN:</label>
	  <input id="fm-cl-vin" name="fm-cl-vin" type ="text" />
    </div>
    </fieldset>
    <div class="fm-multi">
      <div class="fm-atfault">
      	<span>Is the Client at fault?</span>
        <label for="fm-atfaultyes">
        <input name="fm-atfault" type="radio" id="fm-atfaultyes" value="1" checked="checked" />
        Yes</label>
        <label for="fm-atfaultno">
        <input id="fm-atfaultno" name="fm-atfault" type="radio" value="0" />
        No</label>
      </div>
    </div>
    <div id="fm-submit" class="fm-req">
      <input name="Submit" value="Submit" type="submit" />
    </div>
  </form>
</div>
