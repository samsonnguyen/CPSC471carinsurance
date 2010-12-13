<div id="container">
	<!-- p id="fm-intro" required for 'hide optional fields' function -->
	<p id="fm-intro">Fields in <strong>bold</strong> are required.</p>
	
	<form name="addprivatepolicy" id="fm-form" method="post" action="policy.php?addprivatepolicy">
		<fieldset>
		<legend>Private Policy</legend>
		 <div class="fm-req">
      		<label for="fm-premium">Premium Rate:</label>
      		<input name="fm-premium" id="fm-premium" type="text" value="<?php if (isset($_GET['addprivatepolicy'])) print $_POST['fm-premium'];?>" />
    	</div>
    	<div class="fm-req">
      		<label for="fm-coverage">Coverage:</label>
      		<select id="fm-coverage" name="fm-coverage">
	        	<option value='0' <?php if (isset($_GET['addprivatepolicy'])){if($_POST['fm-coverage']=="0") print "selected";}?>>0 (Lowest Coverage)</option>
	        	<option value='1' <?php if (isset($_GET['addprivatepolicy'])){if($_POST['fm-coverage']=="1") print "selected";}?>>1</option>
	        	<option value='2' <?php if (isset($_GET['addprivatepolicy'])){if($_POST['fm-coverage']=="2") print "selected";}?>>2</option>
	        	<option value='3' <?php if (isset($_GET['addprivatepolicy'])){if($_POST['fm-coverage']=="3") print "selected";}?>>3</option>
	        	<option value='4' <?php if (isset($_GET['addprivatepolicy'])){if($_POST['fm-coverage']=="4") print "selected";}?>>4</option>
	        	<option value='5' <?php if (isset($_GET['addprivatepolicy'])){if($_POST['fm-coverage']=="5") print "selected";}?>>5</option>
	        	<option value='6' <?php if (isset($_GET['addprivatepolicy'])){if($_POST['fm-coverage']=="6") print "selected";}?>>6</option>
	        	<option value='7' <?php if (isset($_GET['addprivatepolicy'])){if($_POST['fm-coverage']=="7") print "selected";}?>>7</option>
	        	<option value='8' <?php if (isset($_GET['addprivatepolicy'])){if($_POST['fm-coverage']=="8") print "selected";}?>>8</option>
	        	<option value='9' <?php if (isset($_GET['addprivatepolicy'])){if($_POST['fm-coverage']=="9") print "selected";}?>>9</option>
	        	<option value='10' <?php if (isset($_GET['addprivatepolicy'])){if($_POST['fm-coverage']=="10") print "selected";}?>>10 (Highest Coverage)</option>
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
      		<input name="fm-premiumc" id="fm-premiumc" type="text" value="<?php if (isset($_GET['addcompanypolicy'])) print $_POST['fm-premium'];?>" />
    	</div>
    	<div class="fm-req">
      		<label for="fm-coverage">Coverage:</label>
      		<select id="fm-coverage" name="fm-coverage">
	        	<option value='0' <?php if (isset($_GET['addcompanypolicy'])){if($_POST['fm-coverage']=="0") print "selected";}?>>0 (Lowest Coverage)</option>
	        	<option value='1' <?php if (isset($_GET['addcompanypolicy'])){if($_POST['fm-coverage']=="1") print "selected";}?>>1</option>
	        	<option value='2' <?php if (isset($_GET['addcompanypolicy'])){if($_POST['fm-coverage']=="2") print "selected";}?>>2</option>
	        	<option value='3' <?php if (isset($_GET['addcompanypolicy'])){if($_POST['fm-coverage']=="3") print "selected";}?>>3</option>
	        	<option value='4' <?php if (isset($_GET['addcompanypolicy'])){if($_POST['fm-coverage']=="4") print "selected";}?>>4</option>
	        	<option value='5' <?php if (isset($_GET['addcompanypolicy'])){if($_POST['fm-coverage']=="5") print "selected";}?>>5</option>
	        	<option value='6' <?php if (isset($_GET['addcompanypolicy'])){if($_POST['fm-coverage']=="6") print "selected";}?>>6</option>
	        	<option value='7' <?php if (isset($_GET['addcompanypolicy'])){if($_POST['fm-coverage']=="7") print "selected";}?>>7</option>
	        	<option value='8' <?php if (isset($_GET['addcompanypolicy'])){if($_POST['fm-coverage']=="8") print "selected";}?>>8</option>
	        	<option value='9' <?php if (isset($_GET['addcompanypolicy'])){if($_POST['fm-coverage']=="9") print "selected";}?>>9</option>
	        	<option value='10' <?php if (isset($_GET['addcompanypolicy'])){if($_POST['fm-coverage']=="10") print "selected";}?>>10 (Highest Coverage)</option>
     		</select>
   		</div>
    	<div class="fm-opt">
      		<label for="fm-numofemp"># of Employees:</label>
      		<input name="fm-numofemp" id="fm-numofemp" type="text" value="<?php if (isset($_GET['addcompanypolicy'])) print $_POST['fm-numofemp'];?>" />
    	</div>
		</fieldset>
		<div id="fm-submit" class="fm-req">
			<input name="Submit" value="Submit" type="submit" />
    	</div>
	</form>

</div>