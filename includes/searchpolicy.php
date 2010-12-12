<div id="container">
	<!-- p id="fm-intro" required for 'hide optional fields' function -->
	<p id="fm-intro"><strong>Blanks</strong> will be <strong>ignored</strong> during search.</p>

	<!-- Search by Policy Number -->
	<form name="searchpolicy" id="fm-form" method="post" action="policy.php?action=search&query=1">
		<fieldset>
			<legend>Search Policy Type</legend>
			<div class="fm-multi">
				<div class="fm-type">
				<span>Policy Type:</span>
				<label for="fm-typeprivate">
				<input name="fm-type" type="radio" id="fm-typeprivate" value="p" checked="checked" />Private</label>
				<label for="fm-typecompany">
				<input name="fm-type" type="radio" id="fm-typecompany" value="c" />Company</label>
				<label for="fm-typeboth">
				<input name="fm-type" type="radio" id="fm-typeboth" value="b" />Private and Company</label>
				</div>
		    </div>
		</fieldset>
		<fieldset>
			<legend>Search Policy Information</legend>
			<div class="fm-opt">
				<label for="fm-policyid">Policy Number:</label>
				<input id="fm-policyid" name="fm-policyid" type="text" />
			</div>
			<div class="fm-opt">
	      		<label for="fm-minrate">Minimum Rate:</label>
	      		<input id="fm-minrate" name="fm-minrate" type="text" />
	    	</div>
	    	<div class="fm-opt">
	      		<label for="fm-maxrate">Maximum Rate:</label>
	      		<input id="fm-maxrate" name="fm-maxrate" type="text" />
	    	</div>
	    	<div class="fm-opt">
	      		<label for="fm-mincover">Min Coverage:</label>
	      		<select id="fm-mincover" name="fm-mincover">
	      			<option value='-1'> </option>
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
	      		<label for="fm-maxcover">Max Coverage:</label>
	      		<select id="fm-maxcover" name="fm-maxcover">
	      			<option value='-1'> </option>
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
	      		<label for="fm-minnumofemp">Min Employees:</label>
	      		<input id="fm-minnumofemp" name="fm-minnumofemp" type="text" /><i> (Company Only)</i> 
	    	</div>
	    	<div class="fm-opt">
	      		<label for="fm-maxnumofemp">Max Employees:</label>
	      		<input id="fm-maxnumofemp" name="fm-maxnumofemp" type="text" /><i> (Company Only)</i>
	    	</div>
		</fieldset>
		<div id="fm-submit" class="fm-opt">
			<input name="Search" value="Search" type="submit" />
		</div>
	</form>
</div>