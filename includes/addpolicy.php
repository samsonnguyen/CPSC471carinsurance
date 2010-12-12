<div id="container">
	<!-- p id="fm-intro" required for 'hide optional fields' function -->
	<p id="fm-intro">Fields in <strong>bold</strong> are required.</p>
	
	<form name="addprivatepolicy" id="fm-form" method="post" action="policy.php?addprivatepolicy">
		<fieldset>
		<legend>Private Policy</legend>
		 <div class="fm-req">
      		<label for="fm-premium">Premium Rate:</label>
      		<input name="fm-premium" id="fm-premium" type="text" />
    	</div>
    	<div class="fm-req">
      		<label for="fm-coverage">Coverage:</label>
      		<select id="fm-coverage" name="fm-coverage">
	        	<option value='0'>0 (Lowest Coverage)</option>
	        	<option value='1'>1</option>
	        	<option value='2'>2</option>
	        	<option value='3'>3</option>
	        	<option value='4'>4</option>
	        	<option value='5'>5</option>
	        	<option value='6'>6</option>
	        	<option value='7'>7</option>
	        	<option value='8'>8</option>
	        	<option value='9'>9</option>
	        	<option value='10'>10 (Highest Coverage)</option>
     		</select>
   		</div>
		</fieldset>
		<div id="fm-submit" class="fm-req">
			<input name="Submit" value="Submit" type="submit" />
    	</div>
	</form>
	
	<form name="addcompanypolicy" id="fm-form2" method="post" action="policy.php?addcompanypolicy">
		<fieldset>
		<legend>Company Policy</legend>
				 <div class="fm-req">
      		<label for="fm-premiumc">Premium Rate:</label>
      		<input name="fm-premiumc" id="fm-premiumc" type="text" />
    	</div>
    	<div class="fm-req">
      		<label for="fm-coverage">Coverage:</label>
      		<select id="fm-coverage" name="fm-coverage">
	        	<option value='0'>0 (Lowest Coverage)</option>
	        	<option value='1'>1</option>
	        	<option value='2'>2</option>
	        	<option value='3'>3</option>
	        	<option value='4'>4</option>
	        	<option value='5'>5</option>
	        	<option value='6'>6</option>
	        	<option value='7'>7</option>
	        	<option value='8'>8</option>
	        	<option value='9'>9</option>
	        	<option value='10'>10 (Highest Coverage)</option>
     		</select>
   		</div>
    	<div class="fm-opt">
      		<label for="fm-numofemp"># of Employees:</label>
      		<input name="fm-numofemp" id="fm-numofemp" type="text" />
    	</div>
		</fieldset>
		<div id="fm-submit" class="fm-req">
			<input name="Submit" value="Submit" type="submit" />
    	</div>
	</form>

</div>