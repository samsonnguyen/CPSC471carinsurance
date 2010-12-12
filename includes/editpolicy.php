<div id="container">
	<!-- p id="fm-intro" required for 'hide optional fields' function -->
	<p id="fm-intro">Fields in <strong>bold</strong> are required.</p>
	

	<form <?php if($type==1){ print('name="addprivatepolicy"'); } else { print('name="addcompanypolicy"'); } ?> id="fm-form" method="post" action="policy.php?action=update&policy=<?php print $policyid?>&type=<?php print $type ?>&form" >
		<fieldset>
		<?php if($type==1){ print('<legend>Private Policy Information</legend>'); } else { print('<legend>Company Policy Information</legend>'); } ?>
		<div class="fm-opt">
	    	<label for="fm-policyid">Client ID:</label>
    		<input name="fm-policyid" disabled id="fm-policyid" type="text" value="<?php print $policyid;?>"/>
    	</div>
		<div class="fm-req">
      		<label for="fm-premium">Premium Rate:</label>
      		<input name="fm-premium" id="fm-premium" type="text" value="<?php print $info['Premium_Rate'];?>"/>
    	</div>
    	<div class="fm-req">
      		<label for="fm-coverage">Coverage:</label>
      		<select id="fm-coverage" name="fm-coverage">
	        	<option value='0' <?php if ($info['Coverage']=='0') {print "selected";}?>>0 (Lowest Coverage)</option>
        	<option value='1' <?php if ($info['Coverage']=='1') {print "selected";}?>>1</option>
        	<option value='2' <?php if ($info['Coverage']=='2') {print "selected";}?>>2</option>
        	<option value='3' <?php if ($info['Coverage']=='3') {print "selected";}?>>3</option>
        	<option value='4' <?php if ($info['Coverage']=='4') {print "selected";}?>>4</option>
        	<option value='5' <?php if ($info['Coverage']=='5') {print "selected";}?>>5</option>
        	<option value='6' <?php if ($info['Coverage']=='6') {print "selected";}?>>6</option>
        	<option value='7' <?php if ($info['Coverage']=='7') {print "selected";}?>>7</option>
        	<option value='8' <?php if ($info['Coverage']=='8') {print "selected";}?>>8</option>
        	<option value='9' <?php if ($info['Coverage']=='9') {print "selected";}?>>9</option>
        	<option value='10' <?php if ($info['Coverage']=='10') {print "selected";}?>>10 (Highest Coverage)</option>
     		</select>
   		</div>
   		<?php
   		if($type == 0) {
   		echo('<div class="fm-opt">');
      		echo('<label for="fm-numofemp"># of Employees:</label>');
      		echo('<input name="fm-numofemp" id="fm-numofemp" type="text" value="');
      		print ($info['Num_of_Employees']);
      		echo('"/>');
    	echo('</div>');
   		}
    	?>   
		</fieldset>
		<div id="fm-submit" class="fm-req">
			<input name="Submit" value="Submit" type="submit" />
    	</div>	 
	</form>			
</div>