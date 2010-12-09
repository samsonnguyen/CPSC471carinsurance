<div id="container">
	<!-- p id="fm-intro" required for 'hide optional fields' function -->
	<p id="fm-intro">Fields in <strong>bold</strong> are required.</p>
	
	<form name"=addpolicy" id="fm-form" method="post" action="policy.php?addpolicy">
		<fieldset>
		<legend>Policy Type</legend>
		<div class="fm-multi">
			<div class="fm-ptype">
			<span>Policy Type</span>
			<label for="fm-ptype-private">
			<input name="fm-ptype" type="radio" id="fm-ptype-private" value="p" checked="checked"/>
			Private</label>
			<label for="fm-ptype-company">
			<input name="fm-ptype" type="radio" id="fm-ptype-company" value="c"/>
			Company</label>
			</div>
		</div>
		</fieldset>
		
		<fieldset>
		<legend>Policy Info</legend>
		<div class="fm-req">
		</div>
		</fieldset>
	</form>

</div>