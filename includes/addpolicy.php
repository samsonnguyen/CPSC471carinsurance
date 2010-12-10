<div id="container">
	<!-- p id="fm-intro" required for 'hide optional fields' function -->
	<p id="fm-intro">Fields in <strong>bold</strong> are required.</p>
	
<form name"=addprivatepolicy" id="fm-form" method="post" action="policy.php?addprivatepolicy">
		<fieldset>
		<legend>Private Policy</legend>
		<div class="fm-req">
		    <label for="fm-premium">Premium Rate:</label>
      		<input name="fm-premium" id="fm-premium" type="text" />
    	</div>
    	<div class="fm-req">
		    <label for="fm-coverage">Coverage:</label>
      		<input name="fm-coverage" id="fm-coverage" type="text" />
    	</div>
		</fieldset>
		<div id="fm-submit" class="fm-req">
     		<input name="Submit" value="Submit" type="submit" />
    	</div>
	</form>

	<form name"=addcompanypolicy" id="fm-form" method="post" action="policy.php?addcompanypolicy">
		<fieldset>
		<legend>Company Policy</legend>
		<div class="fm-req">
		    <label for="fm-premium">Premium Rate:</label>
      		<input name="fm-premium" id="fm-premium" type="text" />
    	</div>
    	<div class="fm-req">
		    <label for="fm-coverage">Coverage:</label>
      		<input name="fm-coverage" id="fm-coverage" type="text" />
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